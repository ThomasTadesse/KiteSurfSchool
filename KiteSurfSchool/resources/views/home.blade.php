<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 flex justify-between items-center text-white shadow-lg">
        <div class="space-x-6">
            <a href="/" class="text-lg font-semibold bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-400 transition duration-200">Home</a>
            <a href="/contact" class="text-lg hover:text-blue-200 transition duration-200">Contact</a>
            @auth
                <a href="/profiel" class="text-lg hover:text-blue-200 transition duration-200">Profiel</a>
            @else
                <a href="/login" class="text-lg hover:text-blue-200 transition duration-200">Log in</a>
            @endauth
        </div>
        <div class="space-x-3">
            <span class="inline-block w-4 h-4 transform hover:scale-110 transition-transform">📧</span>
            <span class="inline-block w-4 h-4 transform hover:scale-110 transition-transform">🛒</span>
        </div>
    </nav>
    
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 h-40 w-full relative flex items-center justify-center text-white text-xl font-semibold shadow-lg">
        <img src="https://img.freepik.com/free-photo/person-surfing-flying-parachute-same-time-kitesurfing-bonaire-caribbean_181624-11389.jpg?t=st=1746515797~exp=1746519397~hmac=b494e04f2567079e70d4fd4dd664a39a45d0063234cc0fbf35038fbe555deced&w=1380" 
            alt="Kitesurfing in Bonaire" 
            class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center">
            <h1 class="text-4xl font-bold text-white tracking-wider">Kitesurfschool Windkracht-12</h1>
        </div>
    </div>
    
    <div class="p-8 space-y-8 max-w-6xl mx-auto">
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="flex items-start gap-4">
                    <div class="w-40 rounded-lg">
                        <img src="https://img.freepik.com/premium-photo/kite-surfing-goa-exhilarating-action-shot_1324785-151889.jpg?w=826" 
                            alt="Kitesurfing action shot" 
                            class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-blue-700 mb-2">Spectaculaire actie</h3>
                        <p class="text-gray-600">Ervaar de ultieme vrijheid van kitesurfen met een perfecte combinatie van wind, water en adrenaline. Onze lessen helpen je snel deze sensatie te beleven.</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4 mt-6 md:mt-0">
                    <div class="w-40 rounded-lg">
                        <img src="https://img.freepik.com/premium-photo/person-kitesurfing-with-kite-board-harness-surf_1314467-56480.jpg?w=826" 
                            alt="Kitesurfer with equipment" 
                            class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-blue-700 mb-2">Professionele uitrusting</h3>
                        <p class="text-gray-600">Bij Windkracht-12 krijg je les met moderne, veilige en goed onderhouden materialen. Alle uitrusting is inbegrepen bij onze lessen.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 flex items-center justify-between">
            <div class="w-80 flex items-center justify-center">
                <img src="https://img.freepik.com/free-photo/young-man-with-kitesurf-board_23-2148197356.jpg?t=st=1746516224~exp=1746519824~hmac=f7244e4f0b20e591e53f1ce8afa309b5c10e2d948cd69a76edd7734f51a393b6&w=1380" alt="">
            </div>
           
            <div class="flex-1 p-6">
                <h2 class="text-2xl font-bold text-blue-700 mb-4">Leer kitesurfen bij ons</h2>
                <p class="text-gray-600 mb-4">Begin je avontuur in kitesurfen met onze professionele instructeurs. We bieden lessen aan voor alle niveaus, van beginner tot gevorderd.</p>
                <ul class="list-disc list-inside text-gray-600 mb-6">
                    <li>Veilige en gecertificeerde instructie</li>
                    <li>Kleine groepen voor persoonlijke aandacht</li>
                    <li>Modern materiaal inbegrepen</li>
                    <li>Flexibele planning</li>
                </ul>
                <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                    <a href="{{ route('lespakketten.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Reserveer nu</a>
                </button>
            </div>

        </div>
        
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 space-y-6 text-gray-800">
    <h2 class="text-2xl font-bold text-blue-700">Algemene omschrijving</h2>
    <p>Kitesurfen is een vorm van watersport waarbij een sporter op een kleine surfplank staat en zich laat voorttrekken door een kite oftewel vlieger. Een persoon die aan kitesurfen doet wordt een kiter, kitesurfer of kitboarder genoemd. Bij sterke wind kunnen er snelheden behaald worden van 100 km/h. Kitesurfen op de binnenwateren is niet toegestaan in Nederland. Op dit moment zijn er 117 spots waar de sport kan worden beoefend, voornamelijk in bij de kustgebieden van Nederland.</p>

    <h3 class="text-xl font-semibold mt-6">KiteSurfschool Windkracht-12</h3>
    <p>De kitesurfschool Windkracht-12 bestaat al 8 jaar en werkt momenteel met 5 instructeurs: Duco Veenstra, Waldemar van Dongen, Ruud Terlingen, Saskia Brink en Bernie Vredenstein. Daarnaast is Terence Olieslager oprichter en eigenaar. Vanuit Utrecht rijden de instructeurs met de kitespullen naar diverse locaties in Nederland waar ze de studenten treffen die zich hebben aangemeld voor een cursus. De locaties die nu worden gebruikt zijn: Zandvoort, Muiderberg, Wijk aan Zee, IJmuiden, Scheveningen en Hoek van Holland.</p>

    <p class="mt-4">De maximale groepsgrootte bestaat uit maximaal 2 personen per kite-instructeur. Daarnaast is privéles ook mogelijk maar dat is wel duurder. De huur van materialen (kite, board en wetsuite) die nodig zijn voor de les zijn bij de prijs inbegrepen. De volgende pakketten worden aangeboden:</p>

    <ul class="list-disc pl-6 space-y-2 mt-4">
        <li><strong>Privéles 2,5 uur:</strong> € 175,- inclusief alle materialen, één persoon per les, 1 dagdeel</li>
        <li><strong>Losse Duo Kiteles 3,5 uur:</strong> € 135,- per persoon inclusief alle materialen, maximaal 2 personen per les, 1 dagdeel</li>
        <li><strong>Kitesurf Duo lespakket 3 lessen 10,5 uur:</strong> € 375,- per persoon inclusief materialen, maximaal 2 personen per les, 3 dagdelen</li>
        <li><strong>Kitesurf Duo lespakket 5 lessen 17,5 uur:</strong> € 675,- per persoon inclusief materialen, maximaal 2 personen per les, 5 dagdelen</li>
    </ul>
</div>

    </div>
    
    <footer class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Windkracht-12</h3>
                    <p class="text-sm text-gray-300">De beste kitesurfschool van Nederland met professionele instructeurs en lessen op de mooiste locaties langs de Nederlandse kust.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Snelle Links</h3>
                    <ul class="text-sm space-y-2">
                        <li><a href="{{ url('/') }}" class="hover:text-blue-300 transition">Home</a></li>
                        <li><a href="{{ url('/cursussen') }}" class="hover:text-blue-300 transition">Cursussen</a></li>
                        <li><a href="{{ url('/locaties') }}" class="hover:text-blue-300 transition">Locaties</a></li>
                        <li><a href="{{ url('/contact') }}" class="hover:text-blue-300 transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Informatie</h3>
                    <p class="text-sm text-gray-300">
                        Hoofdkantoor Utrecht<br>
                        Kitesurfstraat 12<br>
                        3511 BS Utrecht<br>
                        Telefoon: 030-1234567
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Volg Ons</h3>
                    <div class="flex space-x-4">
                        <a href="https://facebook.com" target="_blank"
                            class="text-xl text-white hover:text-blue-300 transition duration-300">
                            <span class="inline-block w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">f</span>
                        </a>
                        <a href="https://x.com/" target="_blank"
                            class="text-xl text-white hover:text-blue-300 transition duration-300">
                            <span class="inline-block w-6 h-6 bg-blue-400 rounded-full flex items-center justify-center">𝕏</span>
                        </a>
                        <a href="https://www.instagram.com/" target="_blank"
                            class="text-xl text-white hover:text-blue-300 transition duration-300">
                            <span class="inline-block w-6 h-6 bg-pink-500 rounded-full flex items-center justify-center">🥀</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto text-center mt-6 pt-6 border-t border-blue-600">
            <p>&copy; {{ date('Y') }} KiteSurfschool Windkracht-12. Alle rechten voorbehouden.</p>
        </div>
    </footer>
</body>
</html>
