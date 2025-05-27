<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>facturen</title>
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
                <a href="{{ route('bookings.index') }}" class="text-lg font-semibold bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-400 transition duration-200">Facturen</a>
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
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-5 bg-white">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Factuur bewerken</h2>

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('bookings.update', $booking) }}">
                    @csrf
                    @method('PUT')

                    <!-- Cursus informatie section -->
                    <div class="mb-4">
                        <h3 class="text-base font-medium text-gray-700 mb-2 pb-1 border-b border-gray-200">Cursus informatie</h3>
                        
                        <!-- Lespakket -->
                        <div class="mb-3">
                            <label for="lespakket_id" class="block text-sm font-medium text-gray-700 mb-1">Lespakket</label>
                            <select name="lespakket_id" id="lespakket_id" 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 @error('lespakket_id') border-red-500 @enderror" required>
                                <option value="">Selecteer een lespakket</option>
                                @foreach($lespakketten as $lespakket)
                                    <option value="{{ $lespakket->id }}" {{ (old('lespakket_id', $booking->lespakket_id) == $lespakket->id) ? 'selected' : '' }}>
                                        {{ $lespakket->naam }} (€{{ number_format($lespakket->prijs, 2) }}) - {{ $lespakket->duur }} min.
                                    </option>
                                @endforeach
                            </select>
                            @error('lespakket_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Datum en tijd -->
                        <div class="mb-3">
                            <label for="datum" class="block text-sm font-medium text-gray-700 mb-1">Datum en tijd</label>
                            <input type="datetime-local" name="datum" id="datum" 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 @error('datum') border-red-500 @enderror" 
                                value="{{ old('datum', $booking->datum ? date('Y-m-d\TH:i', strtotime($booking->datum)) : '') }}" required>
                            @error('datum')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Instructeur -->
                        <div class="mb-3">
                            <label for="instructor_id" class="block text-sm font-medium text-gray-700 mb-1">Instructeur</label>
                            <select name="instructor_id" id="instructor_id" 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 @error('instructor_id') border-red-500 @enderror">
                                <option value="">Selecteer een instructeur (optioneel)</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}" {{ (old('instructor_id', $booking->instructor_id) == $instructor->id) ? 'selected' : '' }}>
                                        {{ $instructor->user->name }} ({{ $instructor->specialization }})
                                    </option>
                                @endforeach
                            </select>
                            @error('instructor_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status informatie section -->
                    <div class="mb-4">
                        <h3 class="text-base font-medium text-gray-700 mb-2 pb-1 border-b border-gray-200">Status informatie</h3>
                        
                        <div class="md:flex md:space-x-3">
                            <!-- Boekingsstatus -->
                            <div class="mb-3 md:w-1/2">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status" 
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 @error('status') border-red-500 @enderror" required>
                                    <option value="in behandeling" {{ old('status', $booking->status) == 'in behandeling' ? 'selected' : '' }}>In behandeling</option>
                                    <option value="bevestigd" {{ old('status', $booking->status) == 'bevestigd' ? 'selected' : '' }}>Bevestigd</option>
                                    <option value="geannuleerd" {{ old('status', $booking->status) == 'geannuleerd' ? 'selected' : '' }}>Geannuleerd</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Betalingsstatus -->
                            <div class="mb-3 md:w-1/2">
                                <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Betalingsstatus</label>
                                <select name="payment_status" id="payment_status" 
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 @error('payment_status') border-red-500 @enderror" required>
                                    <option value="pending" {{ old('payment_status', $booking->payment_status) == 'pending' ? 'selected' : '' }}>Nog niet betaald</option>
                                    <option value="paid" {{ old('payment_status', $booking->payment_status) == 'paid' ? 'selected' : '' }}>Betaald</option>
                                    <option value="refunded" {{ old('payment_status', $booking->payment_status) == 'refunded' ? 'selected' : '' }}>Terugbetaald</option>
                                </select>
                                @error('payment_status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Extra informatie section -->
                    <div class="mb-4">
                        <h3 class="text-base font-medium text-gray-700 mb-2 pb-1 border-b border-gray-200">Extra informatie</h3>
                        
                        <!-- Opmerkingen -->
                        <div class="mb-3">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Opmerkingen</label>
                            <textarea name="notes" id="notes" rows="3" 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 @error('notes') border-red-500 @enderror"
                                placeholder="Voeg hier eventuele opmerkingen toe...">{{ old('notes', $booking->notes) }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Boeking informatie section -->
                    <div class="mb-4">
                        <h3 class="text-base font-medium text-gray-700 mb-2 pb-1 border-b border-gray-200">Boeking informatie</h3>
                        <div class="bg-blue-50 p-3 rounded-md border border-blue-100">
                            <p class="mb-1 text-sm"><span class="font-medium">Factuursnummer:</span> {{ $booking->invoice_number ?? 'Nog niet toegewezen' }}</p>
                            <p class="mb-1 text-sm"><span class="font-medium">Klant:</span> {{ $booking->user->name ?? 'Onbekend' }}</p>
                            <p class="mb-1 text-sm"><span class="font-medium">Aangemaakt op:</span> {{ $booking->created_at->format('d-m-Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('bookings.index') }}" 
                            class="mr-3 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition duration-150 ease-in-out">
                            Annuleren
                        </a>
                        <button type="submit" 
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Boeking bijwerken
                        </button>
                    </div>
                </form>
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