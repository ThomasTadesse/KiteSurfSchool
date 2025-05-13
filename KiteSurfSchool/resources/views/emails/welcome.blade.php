<!DOCTYPE html>
<html>
<head>
    <title>Welkom bij KiteSurfSchool</title>
</head>
<body>
    <h1>Welkom bij KiteSurfSchool, {{ $user->name }}!</h1>
    
    <p>Bedankt voor het aanmaken van een account bij onze kitesurfschool.</p>
    
    <p>Klik op de onderstaande link om je account te activeren:</p>
    
    <p>
        <a href="{{ $activationUrl }}">Activeer mijn account</a>
    </p>
    
    <p>Als de link niet werkt, kun je de volgende URL kopiëren en plakken in je browser:</p>
    <p>{{ $activationUrl }}</p>
    
    <p>Met vriendelijke groet,<br>
    KiteSurfSchool Team</p>
</body>
</html>
