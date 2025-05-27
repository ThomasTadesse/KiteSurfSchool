<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel - Windkracht-12</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 p-4 md:p-6 flex flex-col md:flex-row justify-between items-center text-white shadow-lg">
        <div class="flex flex-wrap justify-center gap-4 md:gap-6 mb-4 md:mb-0">
            <a href="/" class="text-base md:text-lg hover:text-blue-200 transition duration-200">Home</a>
            <a href="{{ route('lespakketten.index') }}" class="text-base md:text-lg hover:text-blue-200 transition duration-200">Cursussen</a>
            <a href="/contact" class="text-base md:text-lg hover:text-blue-200 transition duration-200">Contact</a>
            @auth
                @if(Auth::user()->isEigenaar())
                <a href="{{ route('students.index') }}" class="text-base md:text-lg hover:text-blue-200 transition duration-200">Studenten</a>
                <a href="{{ route('instructors.index') }}" class="text-base md:text-lg hover:text-blue-200 transition duration-200">Instructeurs</a>
                <a href="{{ route('bookings.index') }}" class="text-base md:text-lg hover:text-blue-200 transition duration-200">Facturen</a>
                @endif
                <a href="/profiel" class="text-base md:text-lg hover:text-blue-200 transition duration-200">Profiel</a>
            @else
                <a href="/login" class="text-base md:text-lg hover:text-blue-200 transition duration-200">Log in</a>
            @endauth
        </div>
        @auth
        <div class="mt-2 md:mt-0">
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-base md:text-lg hover:text-blue-200 transition duration-200">Log uit</button>
            </form>
        </div>
        @endauth
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="bg-white p-6 md:p-8 rounded-xl shadow-lg max-w-3xl mx-auto">
            <h1 class="text-2xl md:text-3xl font-bold mb-6 text-center text-gray-800">Welkom, {{ Auth::user()->name }}</h1>
            
            <!-- User Information -->
            <section class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Jouw gegevens</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Naam</p>
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-medium">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </section>
            
            @if(Auth::user()->isEigenaar())
            <!-- Admin Dashboard -->
            <section class="mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-2">
                    <h2 class="text-xl font-semibold">Admin Dashboard</h2>
                    <span class="px-3 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                        {{ now()->format('d M Y') }}
                    </span>
                </div>
                
                <!-- Status Messages -->
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

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <!-- Total Users -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-100 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs md:text-sm">Totaal Accounts</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-900">{{ $totalUsers ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Active Lessons -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs md:text-sm">Actieve Lespakketten</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-900">{{ $activeLespakketten ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pending Invoices -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs md:text-sm">Openstaande Facturen</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-900">{{ $pendingInvoices ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- New Registrations -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs md:text-sm">Nieuwe Inschrijvingen</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-900">{{ $newRegistrations ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Panels -->
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Quick Actions -->
                    <div class="w-full lg:w-1/3 bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Snelle Acties
                            </h3>
                        </div>
                        <div class="p-4">
                            <h4 class="text-base font-semibold mb-3">Cursussen Beheer</h4>
                            <a href="{{ route('lespakketten.index') }}" class="flex items-center justify-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mb-4 transition duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Bekijk lespakketten
                            </a>
                        </div>
                         <div class="p-4">
                            <h4 class="text-base font-semibold mb-3">Studenten Beheer</h4>
                            <a href="{{ route('students.index') }}" class="flex items-center justify-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mb-4 transition duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Bekijk studenten
                            </a>
                        </div>
                         <div class="p-4">
                            <h4 class="text-base font-semibold mb-3">Instructeurs Beheer</h4>
                            <a href="{{ route('instructors.index') }}" class="flex items-center justify-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mb-4 transition duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Bekijk instructeurs
                            </a>
                        </div>
                    </div>

                    <!-- Activity Overview -->
                    <div class="w-full lg:w-2/3 bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                    </svg>
                                    Activiteiten Overzicht
                                </h3>
                                <button onclick="toggleBookings(event)" class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm hover:bg-indigo-200 transition duration-150">
                                    Toon Details
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <div id="bookingStats" class="hidden">
                                <h4 class="text-base font-semibold mb-3">Dagelijkse Statistieken</h4>
                                <div class="mb-6 h-48">
                                    <canvas id="dailyStatsChart"></canvas>
                                </div>

                                <h4 class="text-base font-semibold mb-3">Recente Activiteiten</h4>
                                <div class="space-y-3">
                                    @forelse($recentActivities ?? [] as $activity)
                                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                                        <div class="p-2 bg-{{ $activity->type == 'lesson' ? 'green' : 'blue' }}-100 rounded-full mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-{{ $activity->type == 'lesson' ? 'green' : 'blue' }}-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                @if($activity->type == 'lesson')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                                @endif
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ $activity->title }}</p>
                                            <p class="text-sm text-gray-500">{{ $activity->description }}</p>
                                            <p class="text-xs text-gray-400">{{ $activity->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="p-3 bg-gray-50 rounded-lg text-center">
                                        <p class="text-gray-500">Geen recente activiteiten gevonden</p>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Panels -->
                <div class="mt-6 flex flex-col lg:flex-row gap-6">
                    <!-- System Status -->
                    <div class="w-full lg:w-2/3 bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Systeem Status
                            </h3>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if(isset($systemStats))
                                    <div>
                                        <h4 class="text-sm md:text-base font-medium mb-2">Schijfruimte</h4>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $systemStats->diskUsagePercentage }}%"></div>
                                        </div>
                                        <p class="text-xs md:text-sm text-gray-600">{{ $systemStats->diskUsed }} van {{ $systemStats->diskTotal }} gebruikt</p>
                                    </div>
                                    <div>
                                        <h4 class="text-sm md:text-base font-medium mb-2">CPU Gebruik</h4>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                                            <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $systemStats->cpuUsage }}%"></div>
                                        </div>
                                        <p class="text-xs md:text-sm text-gray-600">{{ $systemStats->cpuUsage }}% belasting</p>
                                    </div>
                                    <div>
                                        <h4 class="text-sm md:text-base font-medium mb-2">Geheugen</h4>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                                            <div class="bg-yellow-600 h-2.5 rounded-full" style="width: {{ $systemStats->memoryUsagePercentage }}%"></div>
                                        </div>
                                        <p class="text-xs md:text-sm text-gray-600">{{ $systemStats->memoryUsed }} van {{ $systemStats->memoryTotal }} gebruikt</p>
                                    </div>
                                    <div>
                                        <h4 class="text-sm md:text-base font-medium mb-2">Database Grootte</h4>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                                            <div class="bg-purple-600 h-2.5 rounded-full" style="width: {{ $systemStats->dbSizePercentage }}%"></div>
                                        </div>
                                        <p class="text-xs md:text-sm text-gray-600">{{ $systemStats->dbSize }} van {{ $systemStats->dbMaxSize }} gebruikt</p>
                                    </div>
                                @else
                                    <div class="col-span-2 p-4 bg-gray-50 rounded-lg text-center">
                                        <p class="text-gray-500">Systeem statistieken niet beschikbaar</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- System Controls -->
                    <div class="w-full lg:w-1/3 bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Systeem Controle
                            </h3>
                        </div>
                        <div class="p-4">
                            <div class="space-y-4">
                                <!-- Maintenance Mode -->
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <form method="POST" action="{{ route('admin.maintenance.toggle') }}">
                                        @csrf
                                        <div class="flex items-center justify-between mb-3">
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
                                
                                <!-- Cache Management -->
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <h4 class="text-sm font-medium mb-2">Cache Beheer</h4>
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
                
                <!-- Contact Forms -->
                <section class="mt-6">
                    <h2 class="text-xl font-semibold mb-4">Ontvangen contactformulieren</h2>
                    @if(isset($contacts) && count($contacts) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                                <thead class="bg-blue-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Naam</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Email</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Bericht</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Verzonden</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actie</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($contacts as $contact)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 text-sm text-gray-900">{{ $contact->name }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-900">{{ $contact->email }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-900">{{ Str::limit($contact->message, 50) }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-900">{{ $contact->created_at->format('d-m-Y H:i') }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-900">
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
                </section>
            @endif
            
            <!-- User Bookings -->
            <section class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Jouw boekingen</h2>
                @if(isset($userBookings) && count($userBookings) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                            <thead class="bg-blue-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Lespakket</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Datum</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actie</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($userBookings as $booking)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 text-sm text-gray-900">{{ $booking->lespakket->naam }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-900">{{ $booking->datum->format('d-m-Y H:i') }}</td>
                                        <td class="px-4 py-2 text-sm">
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                @if($booking->status == 'bevestigd') bg-green-100 text-green-800
                                                @elseif($booking->status == 'in behandeling') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-900">
                                            <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-600 hover:underline">Bekijken</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-blue-50 rounded-lg p-6 text-center">
                        <p class="text-gray-600">Je hebt nog geen boekingen gemaakt.</p>
                        <a href="/" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-200">
                            Bekijk het aanbod
                        </a>
                    </div>
                @endif
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <h3 class="text-lg font-semibold mb-3">Windkracht-12</h3>
                    <p class="text-xs md:text-sm text-gray-300">De beste kitesurfschool van Nederland met professionele instructeurs en lessen op de mooiste locaties langs de Nederlandse kust.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-3">Snelle Links</h3>
                    <ul class="text-xs md:text-sm space-y-2">
                        <li><a href="{{ url('/') }}" class="hover:text-blue-300 transition">Home</a></li>
                        <li><a href="{{ url('/cursussen') }}" class="hover:text-blue-300 transition">Cursussen</a></li>
                        <li><a href="{{ url('/locaties') }}" class="hover:text-blue-300 transition">Locaties</a></li>
                        <li><a href="{{ url('/contact') }}" class="hover:text-blue-300 transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-3">Contact Informatie</h3>
                    <p class="text-xs md:text-sm text-gray-300">
                        Hoofdkantoor Utrecht<br>
                        Kitesurfstraat 12<br>
                        3511 BS Utrecht<br>
                        Telefoon: 030-1234567
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-3">Volg Ons</h3>
                    <div class="flex space-x-3">
                        <a href="https://facebook.com" target="_blank" aria-label="Facebook"
                            class="w-8 h-8 md:w-10 md:h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                            </svg>
                        </a>
                        <a href="https://x.com/" target="_blank" aria-label="Twitter"
                            class="w-8 h-8 md:w-10 md:h-10 bg-black rounded-full flex items-center justify-center hover:bg-gray-800 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/" target="_blank" aria-label="Instagram"
                            class="w-8 h-8 md:w-10 md:h-10 bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 rounded-full flex items-center justify-center hover:from-yellow-500 hover:via-red-600 hover:to-purple-600 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-6 pt-6 border-t border-blue-800 text-center text-xs md:text-sm text-gray-300">
                <p>&copy; {{ date('Y') }} Windkracht-12 Kitesurfing School. Alle rechten voorbehouden.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Toggle active state for maintenance mode toggle
        document.addEventListener('DOMContentLoaded', function() {
            // Maintenance mode toggle functionality
            const maintenanceToggle = document.getElementById('maintenance-toggle');
            if(maintenanceToggle) {
                const dot = maintenanceToggle.nextElementSibling.nextElementSibling;
                
                if(maintenanceToggle.checked) {
                    dot.classList.add('translate-x-6');
                }
                
                maintenanceToggle.addEventListener('change', function() {
                    if(this.checked) {
                        dot.classList.add('translate-x-6');
                    } else {
                        dot.classList.remove('translate-x-6');
                    }
                });
            }
        });

        // Bookings toggle functionality
        function toggleBookings(event) {
            event.preventDefault();
            const bookingStats = document.getElementById('bookingStats');
            const button = event.currentTarget;
            
            if(bookingStats.classList.contains('hidden')) {
                bookingStats.classList.remove('hidden');
                button.textContent = 'Verberg Details';
            } else {
                bookingStats.classList.add('hidden');
                button.textContent = 'Toon Details';
            }
        }

        // Initialize Chart.js if statistics are available
        document.addEventListener('DOMContentLoaded', function() {
            const statsChart = document.getElementById('dailyStatsChart');
            if (statsChart) {
                const ctx = statsChart.getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'],
                        datasets: [{
                            label: 'Boekingen',
                            data: [5, 8, 12, 7, 10, 15, 20],
                            backgroundColor: 'rgba(59, 130, 246, 0.2)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 2,
                            tension: 0.4
                        }, {
                            label: 'Bezoekers',
                            data: [15, 25, 30, 22, 28, 40, 50],
                            backgroundColor: 'rgba(16, 185, 129, 0.2)',
                            borderColor: 'rgba(16, 185, 129, 1)',
                            borderWidth: 2,
                            tension: 0.4
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }
        });
    </script>
</body>
</html>