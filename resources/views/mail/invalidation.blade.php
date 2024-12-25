<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invalidation de reçu</title>
    <style>
        /* Style de la page */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Style du conteneur principal */
        .container {
            max-width: 600px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            text-align: center;
            border: 2px solid #ffffff; /* Ajout d'une bordure bleue */
        }

        /* Texte en gras */
        .bold {
            font-weight: bold;
            color: #007bff;
        }

        /* Paragraphe principal */
        p {
            margin: 15px 0;
            line-height: 1.6;
            font-size: 1rem;
        }

        .contact-info {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #ffffff; /* Accentuation de la bordure gauche */
            color: #333;
            max-width: 500px;
            margin: 20px auto;
            font-size: 0.65rem !important; /* Taille de police réduite */
            font-family: 'Georgia', serif; /* Changement de police */
            font-style: italic; /* Style en italique */
        }

        .contact-info p {
            margin: 10px 0;
            line-height: 1.6;
        }

        /* Style de l'image du logo */
        .logo {
            width: 100%;
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
<img src="{{ asset('backend/assets/images/formation.jfif') }}" alt="LogoP" class="logoP">
    <p>Bonjour, <span class="bold">{{ $name }}</span>, votre reçu ne correspond pas à un reçu de paiement. Veuillez vérifier.</p>

    <div class="contact-info">
        <p>Pour toute question, veuillez contacter le numéro : +212 52299-6566 ou passer à l'adresse suivante :</p>
        <p>Immeuble 4 - Avenue Cadi Iass (en face McDonald's) - Maarif - 20333 Casablanca</p>
    </div>
</div>

</body>
</html>