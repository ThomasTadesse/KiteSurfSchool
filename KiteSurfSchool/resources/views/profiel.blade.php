<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 flex justify-between items-center text-white shadow-lg">
        <div class="space-x-6">
            <a href="/" class="text-lg hover:text-blue-200 transition duration-200">Home</a>
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
        <div>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-lg hover:text-blue-200 transition duration-200">Log uit</button>
            </form>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-12">
        <div class="bg-white p-8 rounded-xl shadow-lg max-w-3xl mx-auto">
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Welkom, {{ Auth::user()->name }}</h1>
            
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Jouw gegevens</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600">Naam</p>
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-medium">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
            
            @if(Auth::user()->isEigenaar())
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Admin Dashboard</h2>
                    <span class="px-3 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                        {{ now()->format('d M Y') }}
                    </span>
                </div>
                
                @if (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Quick Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-100 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Totaal Accounts</p>
                                <p class="text-2xl font-bold text-gray-900">120</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Actieve Lessen</p>
                                <p class="text-2xl font-bold text-gray-900">24</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Openstaande Facturen</p>
                                <p class="text-2xl font-bold text-gray-900">16</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Nieuwe Inschrijvingen</p>
                                <p class="text-2xl font-bold text-gray-900">8</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Quick Actions Panel -->
                    <div class="w-full lg:w-1/3 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 lg:mb-0">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Snelle Acties
                            </h3>
                        </div>

                        <div class="p-6 text-gray-900">
                            <h4 class="text-lg font-semibold mb-3">Cursussen Beheer</h4>
                            <a href="{{ route('lespakketten.index') }}" class="flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mb-4 transition duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Bekijk lespakketten
                            </a>
                        </div>
                
                    </div>

                    <!-- Activity Overview -->
                    <div class="w-full lg:w-2/3 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 lg:mb-0">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                    </svg>
                                    Activiteiten Overzicht
                                </h3>
                                <button onclick="toggleBookings()" class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm hover:bg-indigo-200 transition duration-150">
                                    Toon Details
                                </button>
                            </div>
                        </div>
                        <div class="p-6 text-gray-900">
                            <div id="bookingStats" class="hidden">
                                <h4 class="text-lg font-semibold mb-4">Dagelijkse Statistieken</h4>
                                <div class="mb-6">
                                    <canvas id="dailyStatsChart" height="200"></canvas>
                                </div>

                                <h4 class="text-lg font-semibold mb-4">Recente Activiteiten</h4>
                                <div class="space-y-4">
                                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                                        <div class="p-2 bg-green-100 rounded-full mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium">Nieuwe les ingepland</p>
                                            <p class="text-sm text-gray-500">Jan Jansen - 10:00 - 11:30</p>
                                            <p class="text-xs text-gray-400">Vandaag, 09:15</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                                        <div class="p-2 bg-blue-100 rounded-full mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium">Nieuwe gebruiker geregistreerd</p>
                                            <p class="text-sm text-gray-500">Piet Pieters</p>
                                            <p class="text-xs text-gray-400">Vandaag, 08:24</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section -->
                <div class="mt-8 flex flex-col lg:flex-row gap-8">
                    <!-- System Overview -->
                    <div class="w-full lg:w-2/3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    Systeem Status
                                </h3>
                            </div>
                        </div>
                        <div class="p-6 text-gray-900">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="text-base font-medium mb-2">Schijfruimte</h4>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: 35%"></div>
                                    </div>
                                    <p class="text-sm text-gray-600">3.5 GB van 10 GB gebruikt</p>
                                </div>
                                <div>
                                    <h4 class="text-base font-medium mb-2">CPU Gebruik</h4>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                                        <div class="bg-green-600 h-2.5 rounded-full" style="width: 25%"></div>
                                    </div>
                                    <p class="text-sm text-gray-600">25% belasting</p>
                                </div>
                                <div>
                                    <h4 class="text-base font-medium mb-2">Geheugen</h4>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                                        <div class="bg-yellow-600 h-2.5 rounded-full" style="width: 60%"></div>
                                    </div>
                                    <p class="text-sm text-gray-600">1.8 GB van 3 GB gebruikt</p>
                                </div>
                                <div>
                                    <h4 class="text-base font-medium mb-2">Database Grootte</h4>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                                        <div class="bg-purple-600 h-2.5 rounded-full" style="width: 45%"></div>
                                    </div>
                                    <p class="text-sm text-gray-600">450 MB van 1 GB gebruikt</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Controls -->
                    <div class="w-full lg:w-1/3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Systeem Controle
                                </h3>
                            </div>
                        </div>
                        <div class="p-6 text-gray-900">
                            <div class="space-y-4">
                                <!-- Maintenance Mode Toggle -->
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <form method="POST" action="{{ route('admin.maintenance.toggle') }}" class="space-y-4">
                                        @csrf
                                        <div class="flex items-center justify-between">
                                            <label for="maintenance-toggle" class="flex items-center cursor-pointer">
                                                <span class="mr-3 text-sm font-medium">Onderhoudsmodus</span>
                                                <div class="relative">
                                                    <input type="checkbox" id="maintenance-toggle" name="maintenance_mode" value="1" class="sr-only" {{ isset($isMaintenanceMode) && $isMaintenanceMode ? 'checked' : '' }}>
                                                    <div class="w-10 h-5 bg-gray-300 rounded-full shadow-inner"></div>
                                                    <div class="dot absolute w-5 h-5 bg-white rounded-full shadow -left-1 -top-0 transition"></div>
                                                </div>
                                            </label>
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                {{ isset($isMaintenanceMode) && $isMaintenanceMode ? 'Actief' : 'Inactief' }}
                                            </span>
                                        </div>
                                        <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-150 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Opslaan
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <h4 class="text-base font-medium mb-2">Cache Beheer</h4>
                                    <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-150 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Cache Wissen
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <h2 class="text-xl font-semibold my-4">Ontvangen contactformulieren</h2>
                @if(isset($contacts) && count($contacts) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                            <thead class="bg-blue-100">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Naam</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Email</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Bericht</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Verzonden</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Actie</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($contacts as $contact)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $contact->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $contact->email }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ Str::limit($contact->message, 50) }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $contact->created_at->format('d-m-Y H:i') }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">
                                            <a href="{{ route('contact.show', $contact->id) }}" class="text-blue-600 hover:underline">Bekijken</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-blue-50 rounded-lg p-6 text-center">
                        <p class="text-gray-600">Er zijn nog geen contactformulieren ontvangen.</p>
                    </div>
                @endif
            </div>
            @endif
            
            <div>
                <h2 class="text-xl font-semibold mb-4">Jouw boekingen</h2>
                <div class="bg-blue-50 rounded-lg p-6 text-center">
                    <p class="text-gray-600">Je hebt nog geen boekingen gemaakt.</p>
                    <a href="/" class="inline-block mt-4 px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-200">
                        Bekijk het aanbod
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-8 mt-12">
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

    <!-- JavaScript for Charts and Toggle -->
    <script>
        function toggleBookings() {
            const stats = document.getElementById('bookingStats');
            const button = event.target;
            if (stats.classList.contains('hidden')) {
                stats.classList.remove('hidden');
                button.textContent = 'Verberg Details';
                
                // Initialize chart when shown
                const ctx = document.getElementById('dailyStatsChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'],
                        datasets: [{
                            label: 'Geboekte lessen',
                            data: [12, 19, 8, 15, 10, 3, 0],
                            backgroundColor: 'rgba(59, 130, 246, 0.2)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 2,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            } else {
                stats.classList.add('hidden');
                button.textContent = 'Toon Details';
            }
        }
        
        // Custom toggle styling for maintenance mode
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('maintenance-toggle');
            if (toggle) {
                toggle.addEventListener('change', function() {
                    const dot = this.parentNode.querySelector('.dot');
                    if (this.checked) {
                        dot.classList.add('transform', 'translate-x-full', 'bg-red-500');
                    } else {
                        dot.classList.remove('transform', 'translate-x-full', 'bg-red-500');
                    }
                });
                
                // Initialize toggle state
                if (toggle.checked) {
                    const dot = toggle.parentNode.querySelector('.dot');
                    dot.classList.add('transform', 'translate-x-full', 'bg-red-500');
                }
            }
        });
    </script>
</body>
</html>
