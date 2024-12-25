@extends('instructor.instructor_dashboard')
@section('instructor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content">
    <!--fil d'Ariane-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier le Cours</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--fin du fil d'Ariane-->
 
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Modifier le Cours</h5>
            
              <form id="myForm" action="{{ route('update.course') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Nom du Cours</label>
                    <input type="text" name="course_name" class="form-control" id="input1" value="{{ $course->course_name }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Titre du Cours</label>
                    <input type="text" name="course_title" class="form-control" id="input1" value="{{ $course->course_title }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Catégorie du Cours</label>
                    <select name="category_id" class="form-select mb-3" aria-label="Sélectionner une catégorie">
                        <option selected="" disabled>Ouvrir ce menu de sélection</option>
                        @foreach ($categories as $cat) 
                        <option value="{{ $cat->id }}" {{ $cat->id == $course->category_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                
               

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Certificat Disponible</label>
                    <select name="certificate" class="form-select mb-3" aria-label="Sélectionner une option">
                        <option selected="" disabled>Ouvrir ce menu de sélection</option>
                        <option value="Yes" {{ $course->certificate == 'Yes' ? 'selected' : '' }}>Oui</option>
                        <option value="No" {{ $course->certificate == 'No' ? 'selected' : '' }}>Non</option>
                    </select>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Niveau du Cours</label>
                    <select name="label" class="form-select mb-3" aria-label="Sélectionner un niveau">
                        <option selected="" disabled>Ouvrir ce menu de sélection</option>
                        <option value="Begginer" {{ $course->label == 'Begginer' ? 'selected' : '' }}>Débutant</option>
                        <option value="Middle" {{ $course->label == 'Middle' ? 'selected' : '' }}>Intermédiaire</option>
                        <option value="Advance" {{ $course->label == 'Advance' ? 'selected' : '' }}>Avancé</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="input1" class="form-label">Prix du Cours</label>
                    <input type="text" name="selling_price" class="form-control" id="input1" value="{{ $course->selling_price }}">
                </div>
                
                <div class="form-group col-md-3">
                    <label for="input1" class="form-label">Prix Remisé</label>
                    <input type="text" name="discount_price" class="form-control" id="input1" value="{{ $course->discount_price }}">
                </div>
                
                <div class="form-group col-md-3">
                    <label for="input1" class="form-label">Durée</label>
                    <input type="text" name="duration" class="form-control" id="input1" value="{{ $course->duration }}">
                </div>
                <div class="form-group col-md-4">
        <label for="nombre_maxDInscrit" class="form-label">Nombre maximum d'inscrits</label>
        <input type="number" name="nombre_maxDInscrit" class="form-control" id="nombre_maxDInscrit" placeholder="Nombre maximum d'inscrits" value="{{ $course->nombre_maxDInscrit }}">
    </div>

    <div class="form-group col-md-4">
        <label for="type_formation" class="form-label">Type de formation</label>
        <select name="type_formation" class="form-select mb-3" aria-label="Default select example">
            <option selected="" disabled>Choisissez le type de formation</option>
            <option value="présentiel"{{ $course->type_formation == 'présentiel' ? 'selected' : '' }}>Présentiel</option>
            <option value="hybride"  {{ $course->type_formation == 'hybride' ? 'selected' : '' }}>Hybride</option>
        </select>
    </div>

    <div class="form-group col-md-6">
        <label for="date_debut" class="form-label">Date de début</label>
        <input type="date" name="date_debut" class="form-control" id="date_debut" placeholder="Date de début" value="{{ $course->date_debut }}">
    </div>

    <div class="form-group col-md-6">
        <label for="date_fin" class="form-label">Date de fin</label>
        <input type="date" name="date_fin" class="form-control" id="date_fin" placeholder="Date de fin" value="{{ $course->date_fin }}">
    </div>
                <div class="form-group col-md-12">
                    <label for="input1" class="form-label">Prérequis du Cours</label>
                    <textarea name="prerequisites" class="form-control" id="input11" placeholder="Prérequis ..." rows="3">{{ $course->prerequisites }}</textarea>
                </div>
                
              

                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bestseller" value="1" id="flexCheckDefault" {{ $course->bestseller == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault">Meilleure Vente</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="featured" value="1" id="flexCheckDefault2" {{ $course->featured == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault2">En vedette</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="highestrated" value="1" id="flexCheckDefault1" {{ $course->highestrated == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault1">Le Mieux Noté</label>
                        </div>
                    </div>
                </div>
             
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Enregistrer les Modifications</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- //// Start Main Course Image Update /// --}}
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('update.course.image') }}" method="post" enctype="multipart/form-data">
                @csrf
            <input type="hidden" name="id" value="{{ $course->id }}">
            <input type="hidden" name="old_img" value="{{ $course->course_image }}">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="input2" class="form-label">Image du cours </label>
                    <input class="form-control" name="course_image" type="file" id="image">
                </div>
                <div class="col-md-6"> 
                    <img id="showImage" src="{{ asset($course->course_image) }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="100">  
                </div>
            </div>
     
            <br>
            <div class="col-md-12">
                <div class="d-md-flex d-grid align-items-center gap-3">
      <button type="submit" class="btn btn-primary px-4">Enregistrer les Modifications</button>
                  
                </div>
            </div>
            </form>
           
         
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('update.course.video') }}" method="post" enctype="multipart/form-data">
                @csrf
            <input type="hidden" name="vid" value="{{ $course->id }}">
            <input type="hidden" name="old_vid" value="{{ $course->video }}">
            <div class="row">
                <div class="form-group col-md-6">
               <label for="input2" class="form-label">Vidéo d'introduction du cours </label>
                    <input type="file" name="video" class="form-control"  accept="video/mp4, video/webm" >
                </div>
                <div class="col-md-6"> 
                    <video width="300" height="130" controls>
                        <source src="{{ asset( $course->video ) }}" type="video/mp4">
                    </video>
                </div>
            </div>
            <br>
            <div class="col-md-12">
                <div class="d-md-flex d-grid align-items-center gap-3">
      <button type="submit" class="btn btn-primary px-4">Enregistrer les Modifications</button>
                  
                </div>
            </div>
            </form>
           
         
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('update.course.pdf') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="pdf" value="{{ $course->id }}">
                <input type="hidden" name="old_pdf" value="{{ $course->programme_file }}">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center">
                            <!-- Input pour télécharger un nouveau fichier PDF -->
                            <div class="form-group  col-md-6">
                                <label for="programme_file" class="form-label">Programme de formation détaillé</label>
                                <input type="file" name="programme_file" class="form-control" accept=".pdf">
                            </div>
                            <br><br>
                            <!-- Lien pour voir le PDF existant -->
                            <div class="ml-2 align-self-center">
                                @if($course->programme_file)
                                    <a href="{{ asset($course->programme_file) }}" target="_blank" class="btn btn-outline-primary modern-btn">
                                        
                                        <i class="fa fa-file-pdf-o" style="font-size:24px;" ></i> Voir le PDF
                                    </a>
                                @else
                                    Aucun PDF disponible
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <br><br>
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Enregistrer les Modifications</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.modern-btn {
    display: inline-flex;
    align-items: center;
    font-size: 14px;
    font-weight: 500;
    padding: 8px 15px;
    border-radius: 8px;
    border: 2px solid #EC5252;
    background-color: transparent;
    color: #EC5252;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
}

.modern-btn:hover {
    background-color: #EC5252;
    color: white;
}

.fa-file-pdf-o {
    margin-right: 10px;
    margin-bottom: 10px;
}

/* Ajustement de la marge entre l'input et le bouton PDF */
.ml-2 {
    margin-left: 30px; /* Petit espace entre l'input et le bouton */
   
}

/* Alignement pour centrer verticalement le bouton */
.align-self-center {
    align-self: center; /* Centre verticalement l'élément */
    
}

/* Retrait de la marge en bas du groupe de formulaire */
.mb-0 {
    margin-bottom: 0; /* Supprime la marge en bas du form-group */
}
</style>

{{-- //// Début de la mise à jour de la vidéo du cours principal /// --}}
<div class="page-content">
    <div class="card">
        <div class="card-body">
        <form action="{{ route('update.course.goal') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $course->id }}">
                <!--   //////////// Options d'objectif /////////////// -->
                @foreach ($goals as $item) 
                <div class="row add_item">
                    <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                        <div class="container mt-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="goals" class="form-label">Objectif</label>
                                        <input type="text" name="course_goals[]" id="goals" class="form-control" value="{{ $item->goal_name }}">
                                    </div>
                                </div>
                                <div class="form-group col-md-6" style="padding-top: 30px;">
                                    <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Ajouter plus..</a>
                                    <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle"></i> Supprimer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!--- fin de la ligne -->
                @endforeach
                <!--   //////////// Fin des options d'objectif /////////////// -->

                <br><br>
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Enregistrer les modifications</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- //// Fin de la mise à jour de la vidéo du cours principal /// --}}


{{-- //// Start Main Course Image Update /// --}}
<!-- Début de l'ajout de classes multiples avec Ajax -->
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="whole_extra_item_delete" id="whole_extra_item_delete">
            <div class="container mt-2">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="goals">Objectifs</label>
                        <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Objectifs">
                    </div>
                    <div class="form-group col-md-6" style="padding-top: 20px">
                        <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Ajouter</i></span>
                        <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Retirer</i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- //// Start Main Course Vidoe Update /// --}}

{{-- //// Start Main Course Vidoe Update /// --}}
<!-- Fin de l'ajout de classes multiples avec Ajax -->
<script type="text/javascript">
    $(document).ready(function(){
        var counter = 0;
        $(document).on("click", ".addeventmore", function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click", ".removeeventmore", function(event){
            $(this).closest(".whole_extra_item_delete").remove();
            counter--;
        });
    });
</script>
@endsection
