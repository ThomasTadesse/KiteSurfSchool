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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6 border">
                
                <!-- Bedrijfs- en Klantinformatie -->
                <div class="grid grid-cols-2 gap-6 border-b pb-4">
                    <!-- Bedrijfsgegevens -->
                    <div>
                        <h3 class="text-lg font-bold">Aanbieder:</h3>
                        <p>Windkracht-12 KiteSurfSchool</p>
                        <p>Kitesurfstraat 12, 3511 BS Utrecht</p>
                        <p>KvK: 87654321</p>
                        <p>BTW-nummer: NL987654321B01</p>
                    </div>

                    <!-- Klantgegevens -->
                    <div>
                        <h3 class="text-lg font-bold">Geboekt door:</h3>
                        <p>
                            {{ $booking->user->name ?? 'N/A' }}
                        </p>
                        <p>{{ $booking->user->email ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Boekinggegevens -->
                <div class="mt-6">
                    <p><strong>Boekingnummer:</strong> #{{ $booking->id }}</p>
                    <p><strong>Boekingdatum:</strong> {{ $booking->created_at->format('d-m-Y') }}</p>

                    <p><strong>Status:</strong> 
                        @if($booking->status == 'bevestigd')
                            <span class="bg-green-500 text-white py-1 px-3 rounded-full text-xs font-semibold">Bevestigd</span>
                        @elseif($booking->status == 'in behandeling')
                            <span class="bg-yellow-400 text-white py-1 px-3 rounded-full text-xs font-semibold">In behandeling</span>
                        @else
                            <span class="bg-red-500 text-white py-1 px-3 rounded-full text-xs font-semibold">{{ ucfirst($booking->status) }}</span>
                        @endif
                    </p>
                    
                    <p class="mt-2"><strong>Betaalstatus:</strong> 
                        @if($booking->payment_status == 'paid')
                            <span class="bg-green-500 text-white py-1 px-3 rounded-full text-xs font-semibold">Betaald</span>
                        @elseif($booking->payment_status == 'pending')
                            <span class="bg-yellow-400 text-white py-1 px-3 rounded-full text-xs font-semibold">In afwachting</span>
                        @else
                            <span class="bg-red-500 text-white py-1 px-3 rounded-full text-xs font-semibold">Teruggestort</span>
                        @endif
                    </p>
                </div>

                <!-- Lesdetails -->
                <div class="mt-6 border-t pt-4">
                    <h3 class="text-lg font-bold">Lesinformatie</h3>
                    <p><strong>Lespakket:</strong> {{ $booking->lespakket->naam }}</p>
                    <p><strong>Datum en tijd:</strong> {{ $booking->datum->format('d-m-Y H:i') }}</p>
                    <p><strong>Duur:</strong> {{ $booking->lespakket->duur }} uur</p>
                </div>

                <!-- Bedragen -->
                <div class="mt-6 border-t pt-4">
                    @php
                        $priceExclVat = $booking->lespakket->prijs / 1.21; // Assuming 21% VAT
                        $vat = $booking->lespakket->prijs - $priceExclVat;
                    @endphp
                    <p><strong>Bedrag excl. BTW:</strong> € {{ number_format($priceExclVat, 2, ',', '.') }}</p>
                    <p><strong>BTW (21%):</strong> € {{ number_format($vat, 2, ',', '.') }}</p>
                    <p class="text-xl font-bold"><strong>Totaal:</strong> € {{ number_format($booking->lespakket->prijs, 2, ',', '.') }}</p>
                </div>

                <!-- Lespakket Beschrijving -->
                <div class="mt-6 border-t pt-4">
                    <h3 class="text-lg font-bold">Lespakket details:</h3>
                    <p>{{ $booking->lespakket->beschrijving }}</p>
                </div>

                <!-- Opmerkingen -->
                @if($booking->notes)
                    <div class="mt-6 border-t pt-4">
                        <p><strong>Opmerking:</strong> {{ $booking->notes }}</p>
                    </div>
                @endif

                <!-- Beheeropties -->
                @if(Auth::user()->isEigenaar())
                <div class="flex justify-between mt-6 border-t pt-6">
                    <div>
                        <a href="{{ route('bookings.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-md transition duration-300">
                            Terug naar overzicht
                        </a>
                    </div>
                    <div class="space-x-4">
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md transition duration-300">Bewerken</a>
                        
                        <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" class="inline" onsubmit="return confirm('Weet je zeker dat je deze boeking wilt verwijderen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-md transition duration-300">Verwijderen</button>
                        </form>
                    </div>
                </div>
                @else
                <div class="flex justify-end mt-6 border-t pt-6">
                    <a href="{{ route('bookings.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md transition duration-300">
                        Terug naar overzicht
                    </a>
                </div>
                @endif
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
