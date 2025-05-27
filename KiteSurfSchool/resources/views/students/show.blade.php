<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
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
                <a href="{{ route('students.index') }}" class="text-lg font-semibold bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-400 transition duration-200">Studenten</a>
                <a href="{{ route('instructors.index') }}" class="text-lg hover:text-blue-200 transition duration-200">Instructeurs</a>
                <a href="/profiel" class="text-lg hover:text-blue-200 transition duration-200">Profiel</a>
            @else
                <a href="/login" class="text-lg hover:text-blue-200 transition duration-200">Log in</a>
            @endauth
        </div>
    </nav>

    <div class="container mx-auto px-4 py-12">
        <div class="bg-white p-8 rounded-xl shadow-lg">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Student Details</h1>
                <div class="flex space-x-3">
                    <a href="{{ route('students.edit', $student) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Bewerk
                    </a>
                    <a href="{{ route('students.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Terug naar lijst
                    </a>
                </div>
            </div>
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-blue-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-800 mb-4">Persoonlijke Informatie</h2>
                    <div class="space-y-3">
                        <div class="flex border-b border-gray-200 pb-2">
                            <span class="font-medium w-1/3 text-gray-600">Naam:</span>
                            <span class="text-gray-800">{{ $student->user->name }}</span>
                        </div>
                        <div class="flex border-b border-gray-200 pb-2">
                            <span class="font-medium w-1/3 text-gray-600">Email:</span>
                            <span class="text-gray-800">{{ $student->user->email }}</span>
                        </div>
                        <div class="flex border-b border-gray-200 pb-2">
                            <span class="font-medium w-1/3 text-gray-600">Geboortedatum:</span>
                            <span class="text-gray-800">{{ $student->date_of_birth ?? 'Niet opgegeven' }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-800 mb-4">Noodcontact</h2>
                    <div class="space-y-3">
                        <div class="flex border-b border-gray-200 pb-2">
                            <span class="font-medium w-1/3 text-gray-600">Naam:</span>
                            <span class="text-gray-800">{{ $student->emergency_contact_name ?? 'Niet opgegeven' }}</span>
                        </div>
                        <div class="flex border-b border-gray-200 pb-2">
                            <span class="font-medium w-1/3 text-gray-600">Telefoon:</span>
                            <span class="text-gray-800">{{ $student->emergency_contact_phone ?? 'Niet opgegeven' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-blue-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Medische Notities</h2>
                <p class="text-gray-800">{{ $student->medical_notes ?? 'Geen medische notities opgegeven.' }}</p>
            </div>

            <div class="mt-8">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Ingeschreven Lespakketten</h2>
                
                @if($student->lespakketten && $student->lespakketten->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                            <thead class="bg-blue-100">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Lespakket</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Start Datum</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Eind Datum</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($student->lespakketten as $lespakket)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $lespakket->naam }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $lespakket->pivot->start_date ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $lespakket->pivot->end_date ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-900">
                                            @if(isset($lespakket->pivot->status))
                                            <span class="px-2 py-1 rounded-full text-xs 
                                                {{ $lespakket->pivot->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $lespakket->pivot->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $lespakket->pivot->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                                {{ $lespakket->pivot->status === 'scheduled' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            ">
                                                {{ ucfirst($lespakket->pivot->status) }}
                                            </span>
                                            @else
                                            <span class="px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-800">
                                                Onbekend
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-blue-50 rounded-lg p-6 text-center">
                        <p class="text-gray-600">Deze student is nog niet ingeschreven voor lespakketten.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <footer class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-8 mt-12">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} KiteSurfschool Windkracht-12. Alle rechten voorbehouden.</p>
        </div>
    </footer>
</body>
</html>
