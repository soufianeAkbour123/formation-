<!DOCTYPE html>
<html>
<head>
    <title>Facture</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { font-size: 24px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Facture</h1>
    <p>Nom: {{ $data['name'] }}</p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Numéro de Facture: {{ $data['invoice_no'] }}</p>
    <p>Montant: {{ $data['amount'] }}</p>
    <p>Date de Commande: {{ $data['order_date'] }}</p>
    <p>Date d'Envoi: {{ $data['send_date'] }}</p>
    <p>Titre de la Formation: {{ $data['course_title'] }}</p>
</body>
</html>