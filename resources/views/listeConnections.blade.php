<x-app-layout>


    <div class="max-w-4xl mx-auto mt-6 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Vos connexions</h2>

        @if ($connections->isEmpty())
        <p class="text-gray-500">Vous n'avez encore aucune connexion.</p>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($connections as $connection)
            <div class="flex items-center bg-gray-100 p-4 rounded-lg shadow-sm">
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="w-12 h-12 rounded-full object-cover">


                <div class="ml-4">
                    <h3 class="text-lg font-medium">
                        {{ $connection->name }}
                    </h3>
                    <p class="text-sm text-gray-500">jjjjj</p>
                </div>

                <div class="ml-auto">
                    <a href="#" class="text-blue-500 hover:text-blue-600 text-sm font-medium">
                        💬 Message
                    </a>
                </div>
            </div>
            @endforeach

        </div>
        @endif
    </div>

</x-app-layout>