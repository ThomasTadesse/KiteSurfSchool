<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Bericht</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 flex justify-between items-center text-white shadow-lg">
        <div class="space-x-6">
            <a href="/" class="text-lg hover:text-blue-200 transition duration-200">Home</a>
            <a href="/contact" class="text-lg hover:text-blue-200 transition duration-200">Contact</a>
            <a href="/profiel" class="text-lg hover:text-blue-200 transition duration-200">Profiel</a>
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
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Contact Bericht Details</h1>
                <a href="/profiel" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    Terug naar profiel
                </a>
            </div>
            
            <div class="border-t border-gray-200 pt-6">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <p class="text-sm text-gray-600">Naam</p>
                        <p class="font-medium text-lg">{{ $contact->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-medium text-lg">{{ $contact->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Verzonden op</p>
                        <p class="font-medium">{{ $contact->created_at->format('d-m-Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Bericht</p>
                        <div class="mt-2 p-4 bg-gray-50 rounded-lg">
                            <p class="whitespace-pre-wrap">{{ $contact->message }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 pt-6 border-t border-gray-200 flex space-x-4">
                    <a href="mailto:{{ $contact->email }}" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                        Reageren via email
                    </a>
                    <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                            Verwijderen
                        </button>
                    </form>
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
</body>
</html>
