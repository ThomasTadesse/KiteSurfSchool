<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Pagina</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 flex justify-between items-center text-white shadow-lg">
        <div class="space-x-6">
            <a href="/" class="text-lg hover:text-blue-200 transition duration-200">Home</a>
            <a href="/contact" class="text-lg font-semibold bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-400 transition duration-200">Contact</a>
            <a href="/login" class="text-lg hover:text-blue-200 transition duration-200">Login</a>
        </div>
    </nav>
    <div class="flex items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md space-y-8 transform hover:scale-[1.01] transition-transform duration-300">
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Contact</h1>
            <form class="space-y-6">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="naam">
                        Naam
                    </label>
                    <input class="block w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" id="naam" type="text" placeholder="Uw naam">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                        E-mail
                    </label>
                    <input class="block w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" id="email" type="email" placeholder="Uw e-mailadres">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="bericht">
                        Bericht
                    </label>
                    <textarea class="block w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 min-h-[120px]" id="bericht" placeholder="Uw bericht"></textarea>
                </div>
                <div class="flex items-center justify-center">
                    <button class="bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform transition-all duration-200 hover:scale-105 w-full" type="button">
                        Versturen
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>