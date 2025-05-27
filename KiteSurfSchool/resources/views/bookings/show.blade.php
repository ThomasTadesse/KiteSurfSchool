<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boeking Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 flex justify-between items-center text-white shadow-lg">
        <div class="space-x-6">
            <a href="/" class="text-lg hover:text-blue-200 transition duration-200">Home</a>
            <a href="{{ route('lespakketten.index') }}" class="text-lg hover:text-blue-200 transition duration-200">Cursussen</a>
            <a href="/contact" class="text-lg hover:text-blue-200 transition duration-200">Contact</a>
            @auth
                @if(Auth::user()->isEigenaar())
                <a href="{{ route('students.index') }}" class="text-lg hover:text-blue-200 transition duration-200">Studenten</a>
                <a href="{{ route('instructors.index') }}" class="text-lg hover:text-blue-200 transition duration-200">Instructeurs</a>
                @endif
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
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Boeking Details</h1>
                <a href="/profiel" class="text-blue-600 hover:underline">← Terug naar profiel</a>
            </div>

            <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Lespakket</p>
                        <p class="font-medium">{{ $booking->lespakket->naam }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Datum en tijd</p>
                        <p class="font-medium">{{ $booking->datum->format('d-m-Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <p class="inline-flex px-2 py-1 text-xs rounded-full
                            @if($booking->status == 'bevestigd') bg-green-100 text-green-800
                            @elseif($booking->status == 'in behandeling') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($booking->status) }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Betaalstatus</p>
                        <p class="inline-flex px-2 py-1 text-xs rounded-full
                            @if($booking->payment_status == 'paid') bg-green-100 text-green-800
                            @elseif($booking->payment_status == 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ $booking->payment_status == 'paid' ? 'Betaald' : 
                               ($booking->payment_status == 'pending' ? 'In afwachting' : 'Teruggestort') }}
                        </p>
                    </div>
                </div>
                
                @if($booking->notes)
                <div class="mt-4">
                    <p class="text-sm text-gray-600">Opmerkingen</p>
                    <p class="font-medium">{{ $booking->notes }}</p>
                </div>
                @endif
            </div>
            
            <div class="border-t border-gray-200 pt-6">
                <h2 class="text-xl font-semibold mb-4">Lespakket Informatie</h2>
                <div class="p-4 bg-blue-50 rounded-lg">
                    <h3 class="font-semibold text-lg">{{ $booking->lespakket->naam }}</h3>
                    <p class="text-gray-700 mb-2">{{ $booking->lespakket->beschrijving }}</p>
                    <div class="flex justify-between">
                        <p>Duur: <span class="font-medium">{{ $booking->lespakket->duur }} uur</span></p>
                        <p>Prijs: <span class="font-medium">€{{ number_format($booking->lespakket->prijs, 2, ',', '.') }}</span></p>
                    </div>
                </div>
            </div>

            @if(Auth::user()->isEigenaar())
            <div class="border-t border-gray-200 pt-6 mt-6">
                <h2 class="text-xl font-semibold mb-4">Beheeropties</h2>
                <div class="flex space-x-4">
                    <a href="{{ route('bookings.edit', $booking->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Bewerken</a>
                    
                    <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" class="inline" onsubmit="return confirm('Weet je zeker dat je deze boeking wilt verwijderen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Verwijderen</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>

    <footer class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-8 mt-12">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} KiteSurfschool Windkracht-12. Alle rechten voorbehouden.</p>
        </div>
    </footer>
</body>
</html>
