<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre compte a été créé</title>
</head>
<body>
    <h2>Bienvenue {{ $user->name }} !</h2>
    <p>Votre compte sur la plateforme ELS a été créé avec succès.</p>
    <p><strong>Email :</strong> {{ $user->email }}</p>
    <p><strong>Mot de passe :</strong> {{ $password }}</p>
    <p>Nous vous recommandons de modifier votre mot de passe dès votre première connexion.</p>
    <p><a href="{{ url('/login') }}">Se connecter</a></p>
</body>
</html>
