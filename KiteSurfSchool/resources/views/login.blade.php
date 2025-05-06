<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in pagina</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 flex justify-between items-center text-white shadow-lg">
        <div class="space-x-6">
            <a href="/" class="text-lg hover:text-blue-200 transition duration-200">Home</a>
            <a href="/contact" class="text-lg hover:text-blue-200 transition duration-200">Contact</a>
            <a href="/login" class="text-lg font-semibold bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-400 transition duration-200">Log in</a>
        </div>
    </nav>
    <div class="flex items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md space-y-8 transform hover:scale-[1.01] transition-transform duration-300">
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Login</h1>
            <form class="space-y-6">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                        E-mail
                    </label>
                    <input class="block w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" id="email" type="email" placeholder="Uw e-mailadres">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">
                        Wachtwoord
                    </label>
                    <input class="block w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" id="password" type="password" placeholder="Uw wachtwoord">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform transition-all duration-200 hover:scale-105" type="button">
                        Inloggen
                    </button>
                    <a class="font-semibold text-sm text-blue-500 hover:text-blue-600 hover:underline transition duration-200" href="#">
                        Wachtwoord vergeten?
                    </a>
                </div>
            </form>

            <div class="my-8 flex items-center justify-center space-x-4">
                <div class="flex-1 h-px bg-gray-200"></div>
                <p class="text-gray-500 font-medium">Of</p>
                <div class="flex-1 h-px bg-gray-200"></div>
            </div>

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Registreren</h2>
            <form class="space-y-6">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="register-naam">
                        Naam
                    </label>
                    <input class="block w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" id="register-naam" type="text" placeholder="Uw naam">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="register-email">
                        E-mail
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="register-email" type="email" placeholder="Uw e-mailadres">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="register-password">
                        Wachtwoord
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="register-password" type="password" placeholder="Kies een wachtwoord">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="register-password-confirm">
                        Bevestig Wachtwoord
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="register-password-confirm" type="password" placeholder="Bevestig uw wachtwoord">
                </div>
                <div class="flex items-center justify-center">
                    <button class="bg-gradient-to-r from-green-500 to-green-600 text-white font-bold py-3 px-6 rounded-lg hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transform transition-all duration-200 hover:scale-105 w-full" type="button">
                        Registreren
                    </button>
                </div>
            </form>
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
                        <a href="#" target="_blank"
                            class="text-xl text-white hover:text-blue-300 transition duration-300">
                            <span class="inline-block w-6 h-6 bg-blue-400 rounded-full flex items-center justify-center">t</span>
                        </a>
                        <a href="#" target="_blank"
                            class="text-xl text-white hover:text-blue-300 transition duration-300">
                            <span class="inline-block w-6 h-6 bg-pink-500 rounded-full flex items-center justify-center">i</span>
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
