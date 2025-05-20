<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructors</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 flex justify-between items-center text-white shadow-lg">
        <div class="space-x-6">
            <a href="/" class="text-lg font-semibold bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-400 transition duration-200">Home</a>
            <a href="{{ route('lespakketten.index') }}" class="text-lg hover:text-blue-200 transition duration-200">Cursussen</a>
            <a href="/contact" class="text-lg hover:text-blue-200 transition duration-200">Contact</a>
            @auth
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
            <h1 class="text-4xl font-bold text-white tracking-wider">Instructors</h1>
        </div>
    </div>
    
    <div class="p-8 space-y-8 max-w-6xl mx-auto">
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="card-header d-flex justify-content-between align-items-center flex justify-between mb-4">
                <span class="text-2xl font-bold text-blue-700">{{ __('Instructors') }}</span>
                <a href="{{ route('instructors.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-200">Add New Instructor</a>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Specialization</th>
                                <th class="px-4 py-2 text-left">Experience</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($instructors as $instructor)
                                <tr class="border-t">
                                    <td class="px-4 py-2">{{ $instructor->id }}</td>
                                    <td class="px-4 py-2">{{ $instructor->user->name }}</td>
                                    <td class="px-4 py-2">{{ $instructor->user->email }}</td>
                                    <td class="px-4 py-2">{{ $instructor->specialization }}</td>
                                    <td class="px-4 py-2">{{ $instructor->years_of_experience }} years</td>
                                    <td class="px-4 py-2">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('instructors.show', $instructor) }}" class="bg-blue-500 text-white px-2 py-1 rounded text-sm hover:bg-blue-600">View</a>
                                            <a href="{{ route('instructors.edit', $instructor) }}" class="bg-yellow-500 text-white px-2 py-1 rounded text-sm hover:bg-yellow-600">Edit</a>
                                            <form action="{{ route('instructors.destroy', $instructor) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this instructor?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center">No instructors found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
