<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\CourseLecture;
use App\Models\CourseSection;
use App\Models\CourseDescriptionSection;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


use Illuminate\Support\Facades\Log;
use DB;
use Illuminate\Support\Str;  


class CourseController extends Controller
{
    public function AllCourse(){
 
      $id = Auth::user()->id;
      $courses = Course::where('instructor_id',$id)->orderBy('id','desc')->get();
        return view('instructor.courses.all_course',compact('courses'));
    }// End Method 
    public function AddCourse(){
      $categories = Category::latest()->get();
      return view('instructor.courses.add_course',compact('categories'));
  }// End Method 
  public function GetSubCategory($category_id){
    $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
    return json_encode($subcat);
}// End Method 
public function StoreCourse(Request $request)
{
      // Ajoutez ces règles de validation personnalisées
      Validator::extend('after_or_equal_today', function ($attribute, $value, $parameters, $validator) {
        $date = Carbon::parse($value)->startOfDay();
        return $date->greaterThanOrEqualTo(Carbon::now()->startOfDay());
    });

    Validator::extend('logical_date_range', function ($attribute, $value, $parameters, $validator) {
        $dateDebut = Carbon::parse($validator->getData()['date_debut'])->startOfDay();
        $dateFin = Carbon::parse($value)->startOfDay();
        return $dateFin->greaterThanOrEqualTo($dateDebut);
    });

    // Mise à jour des règles de validation
    $rules = [
        // ... autres règles de validation existantes ...
        'date_debut' => [
            'required',
            'date',
            'after_or_equal_today'
        ],
        'date_fin' => [
            'required',
            'date',
            'logical_date_range'
        ],
    ];

    // Messages d'erreur personnalisés
    $messages = [
        'date_debut.after_or_equal_today' => 'La date de début ne peut pas être dans le passé',
        'date_fin.logical_date_range' => 'La date de fin doit être postérieure ou égale à la date de début',
    ];

    // Validation avec messages personnalisés
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        Log::error('Validation failed: ', $validator->errors()->toArray());
        return back()
            ->withErrors($validator)
            ->withInput();
    }
    // Définition des règles de validation
    $rules = [
        'course_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'video' => 'required|mimes:mp4|max:20000',
        'programme_file' => 'nullable|mimes:pdf|max:5120',
        'category_id' => 'required|integer|exists:categories,id',
        'course_title' => 'required|string|max:500',
        'course_name' => 'required|string|max:500',
        'duration' => 'required|string|max:100',
        'date_debut' => 'required|date|after_or_equal:today',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'selling_price' => 'required|numeric|min:0|max:999999.99',
        'discount_price' => 'nullable|numeric|min:0|max:999999.99|lt:selling_price',
        'prerequisites' => 'nullable|string|max:2000',
        'label' => 'nullable|string|max:255',
        'certificate' => 'nullable|string|max:255',
        'nombre_maxDInscrit' => 'nullable|integer|min:1|max:9999',
        'type_formation' => 'nullable|string|max:100',
        'bestseller' => 'nullable|boolean',
        'featured' => 'nullable|boolean',
        'highestrated' => 'nullable|boolean',
        'course_goals' => 'nullable|array|max:20',
        'course_goals.*' => 'string|max:500',
    ];

    // Validation des données
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        Log::error('Validation failed: ', $validator->errors()->toArray());
        return back()->withErrors($validator)->withInput();
    }

    DB::beginTransaction();

    try {
        // Traitement de l'image du cours
        $save_url = $this->handleCourseImage($request);

        // Traitement de la vidéo
        $save_video = $this->handleCourseVideo($request);

        // Traitement du fichier PDF
        $save_pdf = $this->handleCoursePDF($request);

        // Création du cours
        $course = Course::create([
            'category_id' => $request->category_id,
         
            'instructor_id' => Auth::user()->id,
            'course_image' => $save_url,
            'course_title' => $request->course_title,
            'course_name' => $request->course_name,
            'course_name_slug' => Str::slug($request->course_name),
            'video' => $save_video,
            'label' => $request->label,
            'duration' => $request->duration,
            'date_debut' => Carbon::parse($request->date_debut)->format('Y-m-d'),
            'date_fin' => Carbon::parse($request->date_fin)->format('Y-m-d'),
           
            'certificate' => $request->certificate,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'prerequisites' => $request->prerequisites,
            'bestseller' => $request->boolean('bestseller'),
            'featured' => $request->boolean('featured'),
            'highestrated' => $request->boolean('highestrated'),
            'status' => 1,
            'nombre_maxDInscrit' => $request->nombre_maxDInscrit,
            'type_formation' => $request->type_formation,
            'programme_file' => $save_pdf,
            'created_at' => Carbon::now(),
        ]);

        // Création des objectifs du cours
        if (!empty($request->course_goals)) {
            foreach ($request->course_goals as $goal) {
                if (!empty($goal)) {
                    Course_goal::create([
                        'course_id' => $course->id,
                        'goal_name' => $goal
                    ]);
                }
            }
        }

        DB::commit();
        return redirect()->route('all.course')->with('message', 'Cours ajouté avec succès');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Erreur lors de l\'insertion du cours : ' . $e->getMessage());
        return back()->with('error', 'Erreur lors de l\'ajout du cours : ' . $e->getMessage())->withInput();
    }
}

// Méthodes de traitement des fichiers
private function handleCourseImage(Request $request)
{
    if (!$request->hasFile('course_image')) {
        throw new \Exception('L\'image du cours est obligatoire.');
    }

    $image = $request->file('course_image');
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

    // Créez le dossier s'il n'existe pas
    $directoryPath = public_path('upload/course/thumbnail');
    if (!file_exists($directoryPath)) {
        mkdir($directoryPath, 0775, true);
    }

    try {
        $imagePath = $directoryPath . '/' . $name_gen;
        Image::make($image)->resize(370, 246)->save($imagePath);
        return 'upload/course/thumbnail/' . $name_gen;
    } catch (\Exception $e) {
        throw new \Exception('Erreur lors du traitement de l\'image : ' . $e->getMessage());
    }
}


private function handleCourseVideo(Request $request)
{
    if (!$request->hasFile('video')) {
        throw new \Exception('La vidéo est obligatoire.');
    }

    $video = $request->file('video');
    $videoName = time() . '.' . $video->getClientOriginalExtension();

    try {
        $video->move(public_path('upload/course/video/'), $videoName);
        return 'upload/course/video/' . $videoName;
    } catch (\Exception $e) {
        throw new \Exception('Erreur lors du traitement de la vidéo : ' . $e->getMessage());
    }
}

private function handleCoursePDF(Request $request)
{
    if (!$request->hasFile('programme_file')) {
        return null; // PDF est optionnel
    }

    $pdf = $request->file('programme_file');
    $pdfName = time() . '.' . $pdf->getClientOriginalExtension();

    try {
        $pdf->move(public_path('upload/course/PDF/'), $pdfName);
        return 'upload/course/PDF/' . $pdfName;
    } catch (\Exception $e) {
        throw new \Exception('Erreur lors du traitement du PDF : ' . $e->getMessage());
    }
}
public function viewPDF($id)  
{  
    $course = Course::findOrFail($id);  
    $pdf = PDF::loadView('frontend.course.pdf_course_details', compact('course'));  

    // Cette ligne affichera le PDF dans le navigateur  
    return $pdf->stream('details_cours_' . Str::slug($course->course_name) . '.pdf');  
}  

public function downloadPDF($id)  
{  
    $course = Course::findOrFail($id);  
    $pdf = PDF::loadView('frontend.course.pdf_course_details', compact('course'));  

    // Cette ligne téléchargera le PDF  
    return $pdf->download('details_cours_' . Str::slug($course->course_name) . '.pdf');  
}

public function EditCourse($id){
    $course = Course::find($id);
    $goals = Course_goal::where('course_id',$id)->get();
    $categories = Category::latest()->get();
    $subcategories = SubCategory::latest()->get();
    return view('instructor.courses.edit_course',compact('course','categories','subcategories','goals'));
}// End Method 
public function UpdateCourse(Request $request){
    $cid = $request->course_id;
     
       Course::find($cid)->update([
        'category_id' => $request->category_id,
           
            'instructor_id' => Auth::user()->id,
            'course_title' => $request->course_title,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'description' => $request->description,
            'label' => $request->label,
            'duration' => $request->duration,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'certificate' => $request->certificate,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'prerequisites' => $request->prerequisites,
            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highestrated' => $request->highestrated,
            'status' => 1,
            'nombre_maxDInscrit' => $request->nombre_maxDInscrit,
            'type_formation' => $request->type_formation,
            'created_at' => Carbon::now(), 
    ]); 
    $notification = array(
        'message' => 'Cours mis à jour avec succès',
        'alert-type' => 'success'
    );
    return redirect()->route('all.course')->with($notification);  
}// End Method 
public function UpdateCourseImage(Request $request){
    $course_id = $request->id;
    $oldImage = $request->old_img;
    $image = $request->file('course_image');  
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    Image::make($image)->resize(370,246)->save('upload/course/thambnail/'.$name_gen);
    $save_url = 'upload/course/thambnail/'.$name_gen;
    if (file_exists($oldImage)) {
        unlink($oldImage);
    }
    Course::find($course_id)->update([
        'course_image' => $save_url,
        'updated_at' => Carbon::now(),
    ]);
    $notification = array(
        'message' => 'Image du cours mise à jour avec succès',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification); 
}// End Method 
public function UpdateCourseVideo(Request $request){
    $course_id = $request->vid;
    $oldVideo = $request->old_vid;
    $video = $request->file('video');  
    $videoName = time().'.'.$video->getClientOriginalExtension();
    $video->move(public_path('upload/course/video/'),$videoName);
    $save_video = 'upload/course/video/'.$videoName;
    if (file_exists($oldVideo)) {
        unlink($oldVideo);
    }
    Course::find($course_id)->update([
        'video' => $save_video,
        'updated_at' => Carbon::now(),
    ]);
    $notification = array(
        'message' => 'Course Video Updated Successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification); 
}// End Method 
public function UpdateCoursePdf(Request $request){
    $course_id = $request->pdf;
    $oldPdf = $request->old_pdf;
    $pdf = $request->file('programme_file');  
    $pdfName = time().'.'.$pdf->getClientOriginalExtension();
    $pdf->move(public_path('upload/course/PDF/'),$pdfName);
    $save_pdf = 'upload/course/PDF/'.$pdfName;
    if (file_exists($oldPdf)) {
        unlink($oldPdf);
    }
    Course::find($course_id)->update([
        'programme_file' => $save_pdf,
        'updated_at' => Carbon::now(),
    ]);
    $notification = array(
        'message' => 'Course pdf Updated Successfully',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification); 
}// End Method 

            public function UpdateCourseGoal(Request $request){
                $cid = $request->id;
                if ($request->course_goals == NULL) {
                    return redirect()->back();
                } else{
                    Course_goal::where('course_id',$cid)->delete();
                    $goles = Count($request->course_goals);
                    
                        for ($i=0; $i < $goles; $i++) { 
                            $gcount = new Course_goal();
                            $gcount->course_id = $cid;
                            $gcount->goal_name = $request->course_goals[$i];
                            $gcount->save();
                        }  // end for
                } // end else 
                $notification = array(
                    'message' => 'Course Goals Updated Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification); 
            }// End Method 
            public function DeleteCourse($id){
                $course = Course::find($id);
                unlink($course->course_image);
                unlink($course->video);
                Course::find($id)->delete();
                $goalsData = Course_goal::where('course_id',$id)->get();
                foreach ($goalsData as $item) {
                    $item->goal_name;
                    Course_goal::where('course_id',$id)->delete();
                }
                $notification = array(
                    'message' => 'Course Deleted Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification); 
            }// End Method 
            public function AddCourseLecture($id) {
                $course = Course::find($id); // Assuming you have a Course model
                $sections = CourseSection::where('course_id', $id)->get(); // Fetch sections for the course
            
                return view('instructor.courses.section.add_course_lecture', compact('course', 'sections'));
            }

            public function AddCourseSection(Request $request)
            {
                \Log::info('Données reçues:', $request->all());
            
                try {
                    // Validation de base des données
                    $validator = Validator::make($request->all(), [
                        'course_id' => 'required|exists:courses,id',
                        'section_title' => 'required|string|max:255',
                        'date' => 'required|date|date_format:Y-m-d|after_or_equal:today',
                        'start_time' => [
                            'required',
                            'date_format:H:i',
                            function ($attribute, $value, $fail) {
                                $hour = (int) substr($value, 0, 2);
                                if ($hour < 8) {
                                    $fail('Les cours ne peuvent pas commencer avant 08:00');
                                }
                            },
                        ],
                        'end_time' => [
                            'required',
                            'date_format:H:i',
                            'after:start_time',
                            function ($attribute, $value, $fail) {
                                $hour = (int) substr($value, 0, 2);
                                $minutes = (int) substr($value, 3, 2);
                                if ($hour >= 23 && $minutes > 0) {
                                    $fail('Les cours doivent se terminer au plus tard à 23:00');
                                }
                            },
                        ],
                        'link' => 'required|url',
                        'note' => 'nullable|string|max:255',
                    ]);
            
                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'message' => $validator->errors()->first(),
                            'errors' => $validator->errors()
                        ], 422);
                    }
            
                    // Convertir les entrées en objets Carbon
                    $date = Carbon::parse($request->date);
                    $startTime = Carbon::parse($request->date . ' ' . $request->start_time);
                    $endTime = Carbon::parse($request->date . ' ' . $request->end_time);
            
                    // Vérification des chevauchements avant la validation temporelle
                    $overlappingSections = $this->getOverlappingSections($request->course_id, $startTime, $endTime, $date);
                    
                    if ($overlappingSections->isNotEmpty()) {
                        $conflictTimes = $overlappingSections->map(function($section) {
                            return Carbon::parse($section->date)->format('d/m/Y') . ' ' . 
                                   Carbon::parse($section->start_time)->format('H:i') . ' - ' . 
                                   Carbon::parse($section->end_time)->format('H:i');
                        })->join(', ');
                        
                        return response()->json([
                            'success' => false,
                            'message' => "Conflit horaire détecté avec les séances existantes: $conflictTimes"
                        ], 422);
                    }
            
                    // Validation de la cohérence temporelle
                    $validationResult = $this->validateTimeLogic($date, $startTime, $endTime);
                    if (!$validationResult['valid']) {
                        return response()->json([
                            'success' => false,
                            'message' => $validationResult['message']
                        ], 422);
                    }
            
                    // Création de la section
                    $courseSection = CourseSection::create([
                        'course_id' => $request->course_id,
                        'section_title' => $request->section_title,
                        'note' => $request->note ?? '',
                        'date' => $date,
                        'start_time' => $startTime->format('H:i'),
                        'end_time' => $endTime->format('H:i'),
                        'link' => $request->link
                    ]);
            
                    return response()->json([
                        'success' => true,
                        'message' => 'Séance ajoutée avec succès',
                        'data' => $courseSection
                    ], 201);
            
                } catch (\Exception $e) {
                    \Log::error('Erreur lors de l\'ajout de la section:', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Une erreur est survenue lors de l\'ajout de la séance',
                        'debug' => config('app.debug') ? $e->getMessage() : null
                    ], 500);
                }
            }
            
private function validateTimeLogic($date, $startTime, $endTime)
{
    // Vérification si la date est dans le passé
    if ($date->startOfDay()->isPast()) {
        return [
            'valid' => false,
            'message' => 'Impossible de planifier une séance dans le passé'
        ];
    }

    // Vérification de la cohérence début/fin
    if ($endTime <= $startTime) {
        return [
            'valid' => false,
            'message' => 'L\'heure de fin doit être postérieure à l\'heure de début'
        ];
    }

    // Vérification de la durée maximale (8 heures max)
    $duration = $startTime->diffInHours($endTime);
    if ($duration > 8) {
        return [
            'valid' => false,
            'message' => 'La durée d\'une séance ne peut pas dépasser 8 heures'
        ];
    }

    return ['valid' => true];
}

private function getOverlappingSections($courseId, $startTime, $endTime, $date)
{
    return CourseSection::where('course_id', $courseId)
        ->where('date', $date->toDateString()) // Vérification exacte de la date
        ->where(function ($query) use ($startTime, $endTime) {
            $query->where(function ($q) use ($startTime, $endTime) {
                $q->where('start_time', '<', $endTime->format('H:i'))
                  ->where('end_time', '>', $startTime->format('H:i'));
            });
        })
        ->get();

    if ($overlappingSections->isNotEmpty()) {
        \Log::info('Sections en conflit trouvées:', $overlappingSections->toArray());
    }

    return $overlappingSections;
}
            public function UpdateCourseSection(Request $request)
            {
                try {
                    $section = CourseSection::findOrFail($request->id);
                    
                    // Préparer les données à mettre à jour
                    $updateData = [];
            
                    // Gestion du titre de section
                    if (isset($request->section_title)) {
                        $updateData['section_title'] = $request->section_title;
                    }
            
                    // Gestion de la date
                    if (isset($request->date)) {
                        $updateData['date'] = $request->date;
                    }
            
                    // Gestion des heures
                    if (isset($request->start_time) || isset($request->end_time)) {
                        $startTime = isset($request->start_time) ? $request->start_time : $section->start_time;
                        $endTime = isset($request->end_time) ? $request->end_time : $section->end_time;
            
                        // Validation des horaires entre 08:00 et 23:00
                        $minTime = '08:00:00';
                        $maxTime = '23:00:00';
            
                        if (strtotime($startTime) < strtotime($minTime) || strtotime($endTime) > strtotime($maxTime)) {
                            return response()->json([
                                'success' => false,
                                'message' => 'Les séances doivent être programmées entre 08:00 et 23:00'
                            ], 422);
                        }
            
                        // Validation que l'heure de fin est après l'heure de début
                        if (strtotime($startTime) >= strtotime($endTime)) {
                            return response()->json([
                                'success' => false,
                                'message' => 'L\'heure de fin doit être après l\'heure de début'
                            ], 422);
                        }
            
                        // Vérification des chevauchements
                        $hasOverlap = CourseSection::where('course_id', $section->course_id)
                            ->where('id', '!=', $section->id)
                            ->whereDate('date', isset($request->date) ? $request->date : $section->date)
                            ->where(function ($query) use ($startTime, $endTime) {
                                $query->where('start_time', '<', $endTime)
                                      ->where('end_time', '>', $startTime);
                            })
                            ->exists();
                            
                        if ($hasOverlap) {
                            return response()->json([
                                'success' => false,
                                'message' => 'Il existe déjà une séance programmée sur ce créneau horaire'
                            ], 422);
                        }
            
                        // Ajouter les heures aux données de mise à jour
                        $updateData['start_time'] = $startTime;
                        $updateData['end_time'] = $endTime;
                    }
            
                    // Gestion du lien
                    if (isset($request->link)) {
                        if (!filter_var($request->link, FILTER_VALIDATE_URL)) {
                            return response()->json([
                                'success' => false,
                                'message' => 'Le lien fourni n\'est pas valide'
                            ], 422);
                        }
                        $updateData['link'] = $request->link;
                    }
            
                    // Effectuer la mise à jour
                    $section->update($updateData);
            
                    return response()->json([
                        'success' => true,
                        'message' => 'Séance mise à jour avec succès',
                        'data' => $section
                    ]);
                    
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Erreur lors de la mise à jour de la séance: ' . $e->getMessage()
                    ], 500);
                }
            }
public function updateVideoUrl(Request $request)
{
    $validator = Validator::make($request->all(), [
        'section_id' => 'required|exists:course_sections,id',
        'video_url' => 'nullable|url'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'URL invalide',
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        CourseSection::where('id', $request->section_id)
            ->update(['video_url' => $request->video_url]);

        return response()->json([
            'success' => true,
            'message' => 'URL mise à jour avec succès'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de la mise à jour'
        ], 500);
    }
}
            
public function SaveLecture(Request $request)
{
    try {
        // Changement de Lecture à CourseLecture
        $lecture = new CourseLecture();
        $lecture->course_id = $request->course_id;
        $lecture->section_id = $request->section_id;
        $lecture->lecture_title = $request->lecture_title;
        $lecture->save();

        return response()->json([
            'success' => true,
            'message' => 'Chapitre ajouté avec succès',
            'lecture' => $lecture
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue lors de l\'ajout du chapitre'
        ], 500);
    }
}
            
            public function EditLecture($id){
                $clecture = CourseLecture::find($id);
                return view('instructor.courses.lecture.edit_course_lecture',compact('clecture'));
            }// End Method 
            
            public function UpdateCourseLecture(Request $request) {
                try {
                    $lid = $request->id;
                    
                    // Validation de base
                    $validator = Validator::make($request->all(), [
                        'lecture_title' => 'required|string|max:255',
                        
                    ]);
            
                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Données invalides',
                            'errors' => $validator->errors()
                        ], 422);
                    }
            
                    // Mise à jour du chapitre
                    CourseLecture::findOrFail($lid)->update([
                        'lecture_title' => $request->lecture_title,
                        'content' => $request->content,
                    ]);
            
                    return response()->json([
                        'success' => true,
                        'message' => 'Titre du chapitre mis à jour avec succès'
                    ]);
            
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Erreur lors de la mise à jour du chapitre'
                    ], 500);
                }
            }
            
            public function DeleteLecture($id) {
                try {
                    $lecture = CourseLecture::findOrFail($id);
                    $lecture->delete();
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'Chapitre supprimé avec succès'
                    ]);
                    
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Erreur lors de la suppression'
                    ], 500);
                }
            }
            
            public function DeleteSection($id) {
                try {
                    $section = CourseSection::findOrFail($id);
                    
                    // Supprimer les chapitres associés
                    $section->lectures()->delete();
                    
                    // Supprimer la séance
                    $section->delete();
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'Séance supprimée avec succès'
                    ]);
                    
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Erreur lors de la suppression'
                    ], 500);
                }
            } 
            public function cancelSection(Request $request)
            {
                $request->validate([
                    'section_id' => 'required|exists:course_sections,id',
                    'cancellation_reason' => 'required|string'
                ]);
        
                $section = CourseSection::findOrFail($request->section_id);
                $section->update([
                    'is_cancelled' => true,
                    'cancellation_reason' => $request->cancellation_reason
                ]);
        
                return response()->json(['success' => true]);
            }
            public function restoreSection(Request $request) {
                $request->validate([
                    'section_id' => 'required|exists:course_sections,id'
                ]);
            
                $section = CourseSection::findOrFail($request->section_id);
                $section->update([
                    'is_cancelled' => false,
                    'cancellation_reason' => null
                ]);
            
                return response()->json([
                    'success' => true,
                    'section' => $section  // Renvoyer les données de la section si nécessaire
                ]);
            }
            public function postponeSection(Request $request) {
                // Validate the request
                $validator = Validator::make($request->all(), [
                    'section_id' => 'required|exists:course_sections,id',
                    'note' => 'required|string|max:255'
                ]);
            
                // If validation fails, return error response
                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Données invalides',
                        'errors' => $validator->errors()
                    ], 422);
                }
            
                try {
                    // Find the section
                    $section = CourseSection::findOrFail($request->section_id);
            
                    // Update the section with the postpone note
                    $section->update([
                        'note' => $request->note
                        // You might want to add additional logic here, 
                        // such as marking the section as postponed
                    ]);
            
                    return response()->json([
                        'success' => true,
                        'message' => 'La séance a été reportée avec succès'
                    ]);
                } catch (\Exception $e) {
                    // Log the error for debugging
                    \Log::error('Postpone section error: ' . $e->getMessage());
            
                    return response()->json([
                        'success' => false,
                        'message' => 'Impossible de reporter la séance'
                    ], 500);
                }
            }
           
            public function rescheduleSection(Request $request)
            {
                $originalSection = CourseSection::findOrFail($request->section_id);
                $originalTitle = $originalSection->section_title;
            
                // Create a new section with rescheduled details
                $newSection = $originalSection->replicate();
                $newSection->date = $request->date;
                $newSection->start_time = $request->start_time;
                $newSection->end_time = $request->end_time;
                $newSection->section_title = $originalTitle . ' ';
                $newSection->is_rescheduled = true;
                $newSection->save();
            
                // Keep the original section as cancelled
                $originalSection->is_cancelled = true;
                $originalSection->cancellation_reason = 'Séance reprogrammée';
                $originalSection->save();
            
                return response()->json([
                    'success' => true,
                    'message' => 'Séance reprogrammée avec succès',
                    'original_title' => $originalTitle
                ]);
            }
        }

