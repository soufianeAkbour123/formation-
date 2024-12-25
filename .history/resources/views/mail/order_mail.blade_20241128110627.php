<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: ;
            color: #333;
            padding: 20px;
            margin: 0;
        }
        .email-container {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }
        .email-header {
            font-size: 18px;
            color: #333;
        }
        .email-content {
            font-size: 16px;
            color: #555;
        }
        .highlight {
            color: #007bff;
        }
        .email-details {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table td {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }
        h4 {
            font-size: 20px;
            color: #333;
            text-align: center;
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
    </style>
</head>
<body>
<div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5;">
    <div style="padding: 10px; text-align: center; border-radius: 8px;">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('backend/assets/images/formation.jfif'))) }}" alt="Logo Formation ++" style="width: auto; max-width: 150px; max-height: 100px; margin: 10px 0;">
    </div>
</div>




    <div class="email-container">
        <p class="email-header"><strong>Bonjour {{ $data['name'] }},</strong></p>
        <p class="email-content">
            <strong>Votre demande a été confirmée pour la date suivante :</strong> 
            <span class="highlight">{{ $data['send_date'] }}</span>
        </p>

        <div class="email-details">
            <h4>Détails du paiement</h4>
            <table>
                <tr>
                    <td><strong>Formation :</strong></td>
                    <td>{{ $data['course_title'] }}</td>
                </tr>
                <tr>
                    <td><strong>Numéro de facture :</strong></td>
                    <td>{{ $data['invoice_no'] }}</td>
                </tr>
                <tr>
                    <td><strong>Montant :</strong></td>
                    <td>{{ $data['amount'] }} DHS</td>
                </tr>
                <tr>
                    <td><strong>Date de paiement :</strong></td>
                    <td>{{ $data['order_date'] }}</td>
                </tr>
                <tr>
                    <td><strong>Email :</strong></td>
                    <td>{{ $data['email'] }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Contact: +212 52299-6566 | Email: formation_plus@gmail.com</p>
            <p class="small-text">Adresse: Immeuble 4 - Avenue Cadi Iass (en face McDonald's) - Maarif - 20333 Casablanca</p>
            Merci pour votre confiance,<br/>
            L'équipe de formation
        </div>

        
          
       
    </div>
</body>
</html>