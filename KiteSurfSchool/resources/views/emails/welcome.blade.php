<!DOCTYPE html>
<html>
<head>
    <title>Welkom bij KiteSurfSchool</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            color: #555;
            font-size: 12px;
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .contact {
            margin-top: 20px;
        }
        a {
            color: #0066cc;
        }
    </style>
</head>
<body>
    <div class="header">
        Van: info@kitesurfschool.nl<br>
        Onderwerp: Welkom bij KiteSurfSchool - Activeer Uw Account
    </div>

    <h2>Beste {{ $user->name }},</h2>
    
    <p>We hebben uw registratie bij KiteSurfSchool succesvol ontvangen. Hartelijk dank voor het aanmaken van een account bij onze kitesurfschool.</p>
    
    <p>Om uw account te activeren en gebruik te kunnen maken van al onze diensten, klik op de onderstaande link:</p>
    
    <p>
        <a href="{{ $activationUrl }}">Activeer mijn account</a>
    </p>
    
    <p>Als de link niet werkt, kunt u de volgende URL kopiëren en plakken in uw browser:</p>
    <p>{{ $activationUrl }}</p>
    
    <p>Na activatie kunt u direct inloggen en gebruik maken van al onze faciliteiten, waaronder het boeken van lessen en het huren van materiaal.</p>

    <div class="contact">
        <p><strong>Neem gerust contact met ons op</strong><br>
        Heeft u vragen of hulp nodig? Neem dan contact met ons op via:</p>
        <ul>
            <li>E-mail: info@kitesurfschool.nl</li>
            <li>Telefoon: 06-12345678</li>
        </ul>
    </div>

    <div class="footer">
        <p>Met vriendelijke groet,<br>
        <strong>Het KiteSurfSchool Team</strong></p>
    </div>
</body>
</html>
