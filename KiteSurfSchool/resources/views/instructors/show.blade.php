<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructeur Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 flex justify-between items-center text-white shadow-lg">
        <div class="space-x-6">
            <a href="/" class="text-lg font-semibold hover:text-blue-200 transition duration-200">Home</a>
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
    </nav>
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 h-40 w-full relative flex items-center justify-center text-white text-xl font-semibold shadow-lg">
        <img src="https://img.freepik.com/free-photo/person-surfing-flying-parachute-same-time-kitesurfing-bonaire-caribbean_181624-11389.jpg?t=st=1746515797~exp=1746519397~hmac=b494e04f2567079e70d4fd4dd664a39a45d0063234cc0fbf35038fbe555deced&w=1380" 
            alt="Kitesurfing in Bonaire" 
            class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center">
            <h1 class="text-4xl font-bold text-white tracking-wider">Surf the waves</h1>
        </div>
    </div>
    
    <div class="container mx-auto px-4 py-12">
        <div class="bg-white p-8 rounded-xl shadow-lg">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">{{ $instructor->user->name }}</h1>
                <div class="flex space-x-3">
                    <a href="{{ route('instructors.edit', $instructor) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        Bewerken
                    </a>
                    <a href="{{ route('instructors.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        Terug naar overzicht
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-blue-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-800 mb-4">Persoonlijke Informatie</h2>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="text-lg">{{ $instructor->user->email }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Specialisatie</p>
                        <p class="text-lg">{{ $instructor->specialization }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Certificeringen</p>
                        <p class="text-lg">{{ $instructor->certifications ?? 'Geen certificeringen' }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Ervaring</p>
                        <p class="text-lg">{{ $instructor->years_of_experience ?? '0' }} jaar</p>
                    </div>
                </div>
                
                <div class="bg-blue-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-800 mb-4">Biografie</h2>
                    <p class="text-gray-800 leading-relaxed">
                        {{ $instructor->bio ?? 'Geen biografie beschikbaar.' }}
                    </p>
                </div>

                <div class="bg-blue-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-800 mb-4">Beoordeling</h2>
                    <div class="flex items-center">
                        @for ($i = 1; $i <= rand(1, 5); $i++)
                            <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                </div>
            </div>
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
                        <li><a href="{{ route('lespakketten.index') }}" class="hover:text-blue-300 transition">Cursussen</a></li>
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
