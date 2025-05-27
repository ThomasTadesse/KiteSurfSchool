<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studenten</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 flex justify-between items-center text-white shadow-lg">
        <div class="space-x-6">
            <a href="/" class="text-lg font-semibold hover:text-blue-200 transition duration-200">Home</a>
            <a href="{{ route('lespakketten.index') }}" class="text-lg hover:text-blue-200 transition duration-200">Cursussen</a>
            <a href="/contact" class="text-lg hover:text-blue-200 transition duration-200">Contact</a>
            @if(Auth::user()->isEigenaar())
                <a href="{{ route('students.index') }}" class="text-lg hover:text-blue-200 transition duration-200 ">Studenten</a>
                <a href="{{ route('instructors.index') }}" class="text-lg hover:text-blue-200 transition duration-200">Instructeurs</a>
                <a href="{{ route('bookings.index') }}" class="text-lg font-semibold bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-400 transition duration-200">Boekingen</a>
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
    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="bg-red-500 text-white p-4 rounded">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded">
                    {{ session('success') }}
                </div>
            @endif
            <br>
            <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:items-center md:space-x-4">
                <!-- Compact Search Form -->
                <div class="w-full md:w-auto">
                    <button id="toggleFilters" class="flex items-center text-blue-600 mb-2 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Filters {{ isset($searchBookingNumber) || isset($searchStudent) || isset($searchStatus) || isset($searchDateFrom) || isset($searchDateTo) ? '(Actief)' : '' }}
                    </button>
                    
                    <div id="filterSection" class="{{ isset($searchBookingNumber) || isset($searchStudent) || isset($searchStatus) || isset($searchDateFrom) || isset($searchDateTo) ? '' : 'hidden' }} bg-gray-50 p-3 rounded-md mb-3">
                        <form method="GET" action="{{ route('bookings.index') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                            <div>
                                <input type="text" name="searchBookingNumber" id="searchBookingNumber" placeholder="Boekingsnummer" value="{{ $searchBookingNumber ?? '' }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <input type="text" name="searchStudent" id="searchStudent" placeholder="Student" value="{{ $searchStudent ?? '' }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <select name="searchStatus" id="searchStatus" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Alle statussen</option>
                                    <option value="confirmed" {{ isset($searchStatus) && $searchStatus == 'confirmed' ? 'selected' : '' }}>Bevestigd</option>
                                    <option value="pending" {{ isset($searchStatus) && $searchStatus == 'pending' ? 'selected' : '' }}>In afwachting</option>
                                    <option value="cancelled" {{ isset($searchStatus) && $searchStatus == 'cancelled' ? 'selected' : '' }}>Geannuleerd</option>
                                </select>
                            </div>
                            <div>
                                <input type="date" name="searchDateFrom" id="searchDateFrom" placeholder="Datum vanaf" value="{{ $searchDateFrom ?? '' }}" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <input type="date" name="searchDateTo" id="searchDateTo" placeholder="Datum tot" value="{{ $searchDateTo ?? '' }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div class="flex gap-2 items-center">
                                <button type="submit" class="flex-1 bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600">
                                    Zoeken
                                </button>
                                @if(isset($searchBookingNumber) || isset($searchStudent) || isset($searchStatus) || isset($searchDateFrom) || isset($searchDateTo))
                                    <a href="{{ route('bookings.index') }}" class="flex-1 bg-gray-500 text-white px-3 py-2 rounded-md hover:bg-gray-600 text-center">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <div class="flex-grow"></div>
                <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <label class="flex items-center">
                        <span class="mr-2 text-black !important" style="color: black !important;">Toon Data</span>
                        <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input type="checkbox" id="dataToggle"
                                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                checked />
                            <label for="dataToggle"
                                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                        </div>
                    </label>
                    <a href="{{ route('bookings.create') }}" class="w-full sm:w-auto text-center bg-blue-600 text-white px-5 py-3 rounded-md transition duration-300 hover:bg-green-700 transform hover:scale-105">Boeking Aanmaken</a>
                </div>
            </div>
        </div>

        <div id="dataContainer">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="w-full overflow-x-auto">
                        <div class="bg-white shadow-lg rounded-lg my-6">
                            @if (isset($bookings) && count($bookings) > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full table-auto">
                                        <thead>
                                            <tr class="bg-gray-100 text-gray-800 uppercase text-sm font-medium leading-normal">
                                                <th class="py-4 px-2 sm:px-6 text-left">Factuurnummer</th>
                                                <th class="py-4 px-2 sm:px-6 text-left">Student</th>
                                                <th class="py-4 px-2 sm:px-6 text-left hidden sm:table-cell">Datum</th>
                                                <th class="py-4 px-2 sm:px-6 text-left">Status</th>
                                                <th class="py-4 px-2 sm:px-6 text-right">Acties</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-800 text-sm font-light">
                                            @foreach ($bookings as $booking)
                                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                                    <td class="py-3 px-2 sm:px-6 truncate max-w-[100px] sm:max-w-none">{{ $booking->id }}</td>
                                                    <td class="py-3 px-2 sm:px-6 truncate max-w-[100px] sm:max-w-none">{{ $booking->user->name ?? 'Onbekend' }}</td>
                                                    <td class="py-3 px-2 sm:px-6 hidden sm:table-cell">{{ date('d-m-Y', strtotime($booking->datum)) }}</td>
                                                    <td class="py-3 px-2 sm:px-6">
                                                        <span class="{{ 
                                                            $booking->status == 'bevestigd' ? 'text-green-500 bg-green-100' : 
                                                            ($booking->status == 'geannuleerd' ? 'text-red-500 bg-red-100' : 'text-yellow-500 bg-yellow-100') 
                                                        }} py-1 px-2 sm:px-3 rounded-full text-xs font-medium">
                                                            {{ 
                                                                $booking->status == 'bevestigd' ? 'Bevestigd' : 
                                                                ($booking->status == 'geannuleerd' ? 'Geannuleerd' : 'In afwachting')  
                                                            }}
                                                        </span>
                                                    </td>
                                                    <td class="py-3 px-2 flex text-right space-x-2 justify-end">
                                                        <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-500 hover:underline p-1" title="Details bekijken">ⓘ</a>
                                                        <a href="{{ route('bookings.edit', $booking->id) }}" class="text-yellow-500 hover:underline p-1" title="Bewerken">✎</a>
                                                        @if($booking->status != 'bevestigd')
                                                            <a href="{{ route('bookings.confirm', $booking->id) }}" class="text-green-500 hover:underline p-1" title="Bevestigen">✓</a>
                                                        @endif
                                                        @if($booking->status != 'geannuleerd')
                                                            <a href="{{ route('bookings.cancel', $booking->id) }}" class="text-orange-500 hover:underline p-1" title="Annuleren">✗</a>
                                                        @endif
                                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-500 hover:underline p-1" title="Verwijderen">🗑️</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-red-500 p-6 text-center mx-auto">Geen boekingen gevonden die voldoen aan de zoekcriteria.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    @if(isset($bookings) && method_exists($bookings, 'links'))
                        {{ $bookings->appends(request()->query())->links() }}
                    @endif
                </div>
            </div>
        </div>

        <div id="errorContainer" class="py-12 hidden text-center mx-auto">
            <p class="text-red-500">Geen boekingen gevonden. Maak een nieuwe boeking aan.</p>
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
<script>
    document.getElementById('dataToggle').addEventListener('change', function() {
        const dataContainer = document.getElementById('dataContainer');
        const errorContainer = document.getElementById('errorContainer');
        if (this.checked) {
            dataContainer.classList.remove('hidden');
            errorContainer.classList.add('hidden');
        } else {
            dataContainer.classList.add('hidden');
            errorContainer.classList.remove('hidden');
        }
    });

    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Weet je zeker dat je deze boeking permanent wilt verwijderen? Dit kan niet ongedaan worden gemaakt!')) {
                this.submit();
            }
        });
    });

    // Toggle filter section
    document.getElementById('toggleFilters').addEventListener('click', function() {
        const filterSection = document.getElementById('filterSection');
        filterSection.classList.toggle('hidden');
    });
</script>

<style>
    h2 {
        color: #fff;
    }

    .toon {
        color: #fff;
    }

    .toggle-checkbox:checked {
        right: 0;
        border-color: #38A169;
    }

    .toggle-checkbox:checked+.toggle-label {
        background-color: #38A169;
    }

    .overflow-x-auto {
        overflow-x: auto;
    }
    
    @media (max-width: 640px) {
        table {
            font-size: 0.8rem;
        }
        
        .toggle-checkbox {
            transform: scale(0.9);
        }
        
        input[type="text"], input[type="date"], select {
            padding: 0.4rem;
            min-width: unset;
            width: 100%;
        }
    }
    
    input[type="text"], input[type="date"], select {
        padding: 0.5rem;
    }
</style>
