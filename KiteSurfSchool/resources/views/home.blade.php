<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Pagina</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 flex justify-between items-center text-white shadow-lg">
        <div class="space-x-6">
            <a href="/" class="text-lg font-semibold bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-400 transition duration-200">Home</a>
            <a href="/contact" class="text-lg hover:text-blue-200 transition duration-200">Contact</a>
            <a href="/login" class="text-lg hover:text-blue-200 transition duration-200">Log in</a>
        </div>
        <div class="space-x-3">
            <span class="inline-block w-4 h-4 bg-blue-200 rounded-full transform hover:scale-110 transition-transform"></span>
            <span class="inline-block w-4 h-4 bg-blue-200 transform hover:scale-110 transition-transform"></span>
        </div>
    </nav>
    
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 h-40 w-full flex items-center justify-center text-white text-xl font-semibold shadow-lg">
        Header Placeholder
    </div>
    
    <div class="p-8 space-y-8 max-w-6xl mx-auto">
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="bg-blue-100 w-32 h-20 mb-4 rounded-lg flex items-center justify-center text-blue-600 font-medium">
                Image 1
            </div>
            <div class="bg-blue-500 w-24 h-24 rounded-lg flex items-center justify-center text-white font-medium">
                Image 2
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 flex items-center justify-between">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 w-16 h-16 rounded-full flex items-center justify-center text-white font-medium shadow-md">
                Icon
            </div>
            <div class="bg-blue-500 px-6 py-2 rounded-lg flex items-center justify-center text-white font-medium">
                Text
            </div>
        </div>
        
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 flex items-center justify-center text-gray-600 font-medium">
            Content Placeholder
        </div>
    </div>
    
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 h-20 w-full flex items-center justify-center text-white font-medium mt-8">
        Footer Placeholder
    </div>
</body>
</html>
