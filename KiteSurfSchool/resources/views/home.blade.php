<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Windkracht-12 - Kitesurfen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen text-gray-800">
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 flex justify-between items-center text-white shadow-lg">
        <div class="space-x-6">
            <a href="/" class="text-lg font-semibold bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-400 transition duration-200">Home</a>
            <a href="{{ route('lespakketten.index') }}" class="text-lg hover:text-blue-200 transition duration-200">Cursussen</a>
            <a href="/contact" class="text-lg hover:text-blue-200 transition duration-200">Contact</a>
            @auth
                <a href="{{ route('students.index') }}" class="text-lg hover:text-blue-200 transition duration-200">Studenten</a>
                <a href="{{ route('instructors.index') }}" class="text-lg hover:text-blue-200 transition duration-200">Instructeurs</a>
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
    
    @if (isset($isMaintenanceMode) && $isMaintenanceMode)
        <main
            class="fixed inset-0 z-50 grid min-h-screen min-w-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
            <!-- Preloader -->
            <div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-white">
                <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-indigo-600"></div>
            </div>

            <img src="{{ asset('svg/maintenance.svg') }}" alt="Onderhoud"
                class="absolute inset-0 w-full h-full object-cover opacity-80 pointer-events-none" style="z-index:0;">
            <div class="text-center relative z-10">
                <h1 class="mt-4 text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl">
                    De website is momenteel in onderhoud.
                </h1>
                <p class="mt-6 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">
                    Sorry, we kunnen de pagina niet vinden.
                </p>
            </div>
        </main>
    @else
    <!-- Hero Section - Enhanced with call-to-action -->
    <div class="relative h-[500px]">
        <img src="https://img.freepik.com/free-photo/person-surfing-flying-parachute-same-time-kitesurfing-bonaire-caribbean_181624-11389.jpg?t=st=1746515797~exp=1746519397~hmac=b494e04f2567079e70d4fd4dd664a39a45d0063234cc0fbf35038fbe555deced&w=1380" 
            alt="Kitesurfing in Bonaire" 
            class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center items-center text-white text-center px-6">
            <h1 class="text-4xl font-bold text-white tracking-wider mb-4">Kitesurfschool Windkracht-12</h1>
            <p class="text-lg mb-6">Leer kitesurfen met professionele begeleiding op de mooiste locaties van Nederland.</p>
            <a href="{{ route('lespakketten.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg transition">Bekijk Lessen</a>
        </div>
    </div>
    
    <!-- Overzicht Lessen -->
    <section class="max-w-6xl mx-auto p-8 space-y-8">
        <h2 class="text-2xl font-bold text-blue-700 mb-6 text-center">Onze Lespakketten</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h2 class="text-xl font-bold text-blue-700 mb-2">Privéles</h2>
                <p>2,5 uur – €175 – Volledige persoonlijke aandacht. Alle uitrusting inbegrepen.</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h2 class="text-xl font-bold text-blue-700 mb-2">Duo Kitesurf</h2>
                <p>3,5 uur – €135 p.p. – Samen met een partner. Maximaal 2 per instructeur.</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h2 class="text-xl font-bold text-blue-700 mb-2">Lespakket 3x</h2>
                <p>10,5 uur – €375 p.p. – Gehele introductie tot zelfstandig varen.</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h2 class="text-xl font-bold text-blue-700 mb-2">Lespakket 5x</h2>
                <p>17,5 uur – €675 p.p. – Compleet traject inclusief certificering.</p>
            </div>
        </div>
    </section>

    <!-- Tijdschema -->
    <section class="bg-blue-100 py-10">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-2xl font-bold text-blue-800 mb-4">Voorbeeld Lesplanning</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-lg overflow-hidden shadow-lg">
                    <thead class="bg-blue-700 text-white">
                        <tr>
                            <th class="py-3">Tijd</th>
                            <th>Locatie</th>
                            <th>Les</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center border-t">
                            <td class="py-2">09:00 - 11:30</td>
                            <td>Zandvoort</td>
                            <td>Privéles (vol)</td>
                        </tr>
                        <tr class="text-center border-t">
                            <td>12:30 - 16:00</td>
                            <td>Muiderberg</td>
                            <td>Duo Les</td>
                        </tr>
                        <tr class="text-center border-t">
                            <td>17:00 - 19:30</td>
                            <td>Wijk aan Zee</td>
                            <td>Lespakket 3x</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

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
                <a href="{{ route('lespakketten.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200 inline-block">Reserveer nu</a>
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

          <!-- Testimonials -->
        <section class="py-8">
            <h2 class="text-2xl font-bold text-center text-blue-700 mb-8">Wat zeggen onze cursisten?</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="italic">"Fantastische ervaring! Duco was een topinstructeur en ik voelde me altijd veilig."</p>
                    <p class="mt-4 font-semibold text-blue-600">– Sarah V.</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="italic">"De lessen waren goed gestructureerd en super leerzaam. Absolute aanrader!"</p>
                    <p class="mt-4 font-semibold text-blue-600">– Omar D.</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6">
                    <p class="italic">"Heerlijke dag gehad op Scheveningen. Goed materiaal en professionele begeleiding."</p>
                    <p class="mt-4 font-semibold text-blue-600">– Femke L.</p>
                </div>
            </div>
        </section>
        
        <!-- FAQ Section -->
        <section class="bg-blue-50 py-8 rounded-xl shadow-lg">
            <div class="max-w-4xl mx-auto px-6">
                <h2 class="text-2xl font-bold text-blue-700 mb-6">Veelgestelde vragen</h2>
                <div class="space-y-4">
                    <details class="bg-white p-4 rounded-lg shadow">
                        <summary class="font-semibold cursor-pointer">Wat gebeurt er bij slecht weer?</summary>
                        <p class="mt-2">Bij te weinig of gevaarlijke wind wordt je les kosteloos verplaatst.</p>
                    </details>
                    <details class="bg-white p-4 rounded-lg shadow">
                        <summary class="font-semibold cursor-pointer">Heb ik een eigen wetsuit nodig?</summary>
                        <p class="mt-2">Nee, alle benodigde materialen worden door ons geleverd.</p>
                    </details>
                    <details class="bg-white p-4 rounded-lg shadow">
                        <summary class="font-semibold cursor-pointer">Waar vinden de lessen plaats?</summary>
                        <p class="mt-2">Op diverse locaties: Zandvoort, Muiderberg, Wijk aan Zee, IJmuiden, Scheveningen en Hoek van Holland.</p>
                    </details>
                </div>
            </div>
        </section>

        <!-- Nieuwsbrief -->
        <section class="bg-blue-700 text-white py-10 rounded-xl">
            <div class="max-w-md mx-auto text-center px-6">
                <h2 class="text-2xl font-bold mb-4">Blijf op de hoogte!</h2>
                <p class="mb-6">Schrijf je in voor onze nieuwsbrief en ontvang updates over nieuwe cursussen en acties.</p>
                <form class="flex flex-col sm:flex-row gap-3">
                    <input type="email" placeholder="E-mailadres" class="p-3 rounded-lg text-gray-800 flex-1" required>
                    <button type="submit" class="bg-white text-blue-700 font-semibold px-6 py-3 rounded-lg hover:bg-gray-200">Inschrijven</button>
                </form>
            </div>
        </section>
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
                        <li><a href="{{ route('lespakketten.index') }}" class="hover:text-blue-300 transition">Cursussen</a></li>
                        <li><a href="{{ url('/locaties') }}" class="hover:text-blue-300 transition">Locaties</a></li>
                        <li><a href="{{ url('/contact') }}" class="hover:text-blue-300 transition">Contact</a></li>
                        <li><a href="#" class="hover:text-blue-300 transition">Privacybeleid</a></li>
                        <li><a href="#" class="hover:text-blue-300 transition">Algemene Voorwaarden</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Informatie</h3>
                    <p class="text-sm text-gray-300">
                        Hoofdkantoor Utrecht<br>
                        Kitesurfstraat 12<br>
                        3511 BS Utrecht<br>
                        Telefoon: 030-1234567<br>
                        info@windkracht12.nl
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
    @endif
</body>
</html>
