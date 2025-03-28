<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation de votre compte</title>
</head>
<body>
    <h2>Bienvenue {{ $user->name }}</h2>
    <p>Merci de vous être inscrit sur notre plateforme.</p>
    <p>Voici votre code de validation : <strong>{{ $user->validation_code }}</strong></p>
    <p>Veuillez l'entrer dans le formulaire de validation pour activer votre compte.</p>
</body>
</html>
