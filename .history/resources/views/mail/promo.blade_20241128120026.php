<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Promo</title>
    <style>
        /* Style global pour l'email */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #555555;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .code {
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
            background-color: #FF6347;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .expiration-date {
            font-size: 18px;
            font-weight: bold;
            color: #FF6347;
        }

        .course-list {
            margin-top: 20px;
            padding-left: 20px;
        }

        .course-list li {
            font-size: 16px;
            color: #555555;
            margin-bottom: 8px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #888888;
        }

        .footer a {
            color: #FF6347;
            text-decoration: none;
        }

        /* Responsive pour les petits écrans */
        @media only screen and (max-width: 600px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 20px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Profitez de notre code promo !</h1>
        <p>Utilisez le code <span class="code">{{ $code }}</span> pour obtenir une réduction sur votre prochaine commande.</p>
        <p>Ce code expire le : <span class="expiration-date">{{ $expirationDate }}</span>.</p>
        
        @if($courses && count($courses) > 0)
            <p>Les cours suivants bénéficient de cette promotion :</p>
            <ul class="course-list">
                @foreach($courses as $course)
                <li style="font-weight: bold;">{{ $course->course_title }}</li>

                @endforeach
            </ul>
        @else
            <p>Aucun cours n'est associé à cette promotion pour le moment.</p>
        @endif

        <div class="footer">
            <p>Merci pour votre fidélité !</p>
            <p>Si vous avez des questions, n'hésitez pas à <a href="mailto:contact@suptechnology.ma">nous contacter</a>.</p>
        </div>
    </div>
</body>
</html>