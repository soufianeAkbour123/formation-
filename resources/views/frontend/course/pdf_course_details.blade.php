<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Programme de formation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 5px;
            line-height: 1.3;
            color: #333;
            font-size: 8pt;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .header img {
            max-width: 80px;
            max-height: 80px;
            margin-bottom: 4px;
        }

        .course-image {
            max-width: 80px;
            max-height: 80px;
            margin: 4px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .header h1 {
            font-size: 10pt;
            font-weight: bold;
            margin: 3px 0;
            color: #333;
        }

        .subheader {
            font-size: 8pt;
            font-style: italic;
            color: #555;
            margin-bottom: 3px;
        }

        h2, h3 {
            color: #333;
            font-size: 10pt;
            font-weight: bold;
            margin: 10px 0 5px 0;
            padding-bottom: 3px;
            border-bottom: 2px solid cornflowerblue;
        }

        p, li {
            font-size: 9pt;
            color: #4B4B4B;
            margin-bottom: 3px;
        }

        ul {
            margin: 0;
            padding-left: 20px;
        }

        li {
            margin-bottom: 3px;
        }

        .blue-text {
            color: cornflowerblue;
        }

        .objectives {
            background-color: #F2F2F2;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border-left: 3px solid cornflowerblue;
        }

        .table-info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 8pt;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: cornflowerblue;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:hover td {
            background-color: #f1f1f1;
        }

        .footer {
            font-size: 7pt;
            color: #333;
            text-align: center;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-style: italic;
        }

        .small-text {
            font-size: 7pt;
            color: #666;
            text-align: center;
        }

        .instructor-section {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 10px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .instructor-image {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid cornflowerblue;
        }

        .instructor-details {
            flex: 1;
        }

        .instructor-name {
            font-weight: bold;
            margin: 0 0 3px 0;
            color: #333;
            font-size: 9pt;
        }

        .instructor-title {
            margin: 0;
            color: #666;
            font-style: italic;
            font-size: 8pt;
        }

        .accordion-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }

        .accordion-item {
            flex: 1;
            min-width: 250px;
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
        }

        .accordion-header {
            padding: 8px;
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            color: #333;
            transition: background-color 0.2s;
        }

        .accordion-header:hover {
            background-color: #f0f0f0;
        }

        .checkmark {
            color: cornflowerblue;
            margin-right: 5px;
        }

        @media print {
            body {
                padding: 20px;
            }
            
            .accordion-item {
                break-inside: avoid;
            }
            
            .table-info {
                break-inside: avoid;
            }
            
            .instructor-section {
                break-inside: avoid;
            }
        }

        @page {
            size: A4;
            margin: 30px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('frontend/images/formation.jfif'))) }}" alt="logo de l'entreprise">
        <h1>{{ $course->course_title }}</h1>
        <p class="subheader">Programme de formation 2024-2025</p>
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($course->course_image))) }}" class="course-image img-thumbnail" alt="Image du cours"/>
    </div>
    @php 
    $goals = App\Models\Course_goal::where('course_id', $course->id)->get();     
@endphp
    <h2>Objectifs de formation</h2>
    <div class="objectives">
        <ul>
            @foreach ($goals as $goal)
                <li>{{ $goal->goal_name }}</li>
            @endforeach
        </ul>
    </div>

    <h2>Programme du Cours</h2>
    <div id="accordion">
        @foreach($course->descriptionSections->chunk(2) as $chunk)
            <div class="accordion-row">
                @foreach($chunk as $section)
                    <div class="accordion-item">
                        <div class="accordion-header">
                            <span class="checkmark">▸</span>
                            {{ $section->title }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    @php 
        $instructor = App\Models\User::find($course->instructor_id);     
    @endphp
    <h2>Formateur(s)</h2>
    <div class="instructor-section">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path(!empty($course->user->photo) 
            ? 'upload/instructor_images/'.$course->user->photo 
            : 'upload/no_image.jpg'))) }}" 
             class="instructor-image" 
             alt="Photo du formateur">
        <div class="instructor-details">
            <p class="instructor-name">{{ $instructor ? $instructor->name : 'Aucun formateur disponible' }}</p>
            <p class="instructor-title">{{ $instructor ? $instructor->username : 'Aucun formateur disponible' }}</p>
        </div>
    </div>

    <h2>Caractéristiques de la formation</h2>
    <table class="table-info">
        <tr>
            <th>Caractéristique</th>
            <th>Détails</th>
        </tr>
        <tr>
            <td>Durée</td>
            <td>{{ $course->duration }} heures</td>
        </tr>
        <tr>
            <td>Participants max</td>
            <td>{{ $course->nombre_maxDInscrit }}</td>
        </tr>
        <tr>
            <td>Date de début</td>
            <td>{{ \Carbon\Carbon::parse($course->date_debut)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td>Date de fin</td>
            <td>{{ \Carbon\Carbon::parse($course->date_fin)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td>Prix total</td>
            <td>{{ $course->selling_price }} DH</td>
        </tr>
        <tr>
            <td>Mode de formation</td>
            <td>{{ $course->type_formation }}</td>
        </tr>
        <tr>
            <td>Certificat délivré</td>
            <td>{{ $course->certificate ? 'Oui' : 'Non' }}</td>
        </tr>
        <tr>
            <td>Niveau</td>
            <td>
                @switch($course->label)
                    @case('Begginer')
                        Débutant
                        @break
                    @case('Middle')
                        Intermédiaire
                        @break
                    @case('Advance')
                        Avancé
                        @break
                    @default
                        Non défini
                @endswitch
            </td>
        </tr>
    </table>

    <h2>Prérequis nécessaires</h2>
    <p>{{ $course->prerequisites }}</p>

    <div class="footer">
        <p>Contact: +212 52299-6566 | Email: formation_plus@gmail.com</p>
        <p class="small-text">Adresse: Immeuble 4 - Avenue Cadi Iass (en face McDonald's) - Maarif - 20333 Casablanca</p>
    </div>

    <script>
        document.querySelectorAll('.accordion-header').forEach(header => {
            header.addEventListener('click', () => {
                const content = header.nextElementSibling;
                if (content) {
                    content.style.display = content.style.display === 'block' ? 'none' : 'block';
                }
            });
        });
    </script>
</body>
</html>