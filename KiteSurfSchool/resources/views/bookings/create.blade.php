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

    <h2 class="mt-16 ml-6 text-xl font-bold text-gray-800 leading-tight">
        {{ __('Nieuwe Factuur') }}
    </h2>

    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded mb-4 text-sm">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded mb-4 text-sm">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-5 bg-white">
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf

                        <!-- Boeking details section -->
                        <div class="mb-4">
                            <h3 class="text-base font-medium text-gray-700 mb-2 pb-1 border-b border-gray-200">{{ __('Boeking details') }}</h3>
                            
                            <!-- Student Selection -->
                            <div class="mb-3">
                                <select name="user_id" id="user_id" 
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 @error('user_id') border-red-500 @enderror" required>
                                    <option value="">Selecteer een student</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->user_id }}" {{ old('user_id') == $student->user_id ? 'selected' : '' }}>
                                            {{ $student->user->name }} ({{ $student->user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Lespakket Selection -->
                            <div class="mb-3">
                                <select name="lespakket_id" id="lespakket_id" 
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 @error('lespakket_id') border-red-500 @enderror" required>
                                    <option value="">Selecteer een lespakket</option>
                                    @foreach($lespakketten as $lespakket)
                                        <option value="{{ $lespakket->id }}" {{ old('lespakket_id') == $lespakket->id ? 'selected' : '' }}>
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
                                <input type="datetime-local" name="datum" id="datum"
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 @error('datum') border-red-500 @enderror"
                                    value="{{ old('datum') }}" required>
                                @error('datum')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Selecteer de datum en tijd van de les</p>
                            </div>

                            <!-- Notes -->
                            <div class="mb-3">
                                <textarea name="notes" id="notes" rows="3" 
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 @error('notes') border-red-500 @enderror"
                                    placeholder="Opmerkingen">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Instructor Selection -->
                            <div class="mb-3">
                                <select name="instructor_id" id="instructor_id" 
                                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 @error('instructor_id') border-red-500 @enderror">
                                    <option value="">Selecteer een instructeur (optioneel)</option>
                                    @foreach($instructors as $instructor)
                                        <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->user->name }} ({{ $instructor->specialization }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('instructor_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit button -->
                            <div class="mt-4">
                                <button type="submit" 
                                    class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-md shadow hover:bg-blue-500 transition duration-200">
                                    {{ __('Aanmaken') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>