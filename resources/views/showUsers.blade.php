<x-app-layout>
                    <!-- Suggested Connections -->
                    <div class="bg-white rounded-xl shadow-sm p-4">
                    <h3 class="font-semibold mb-4">Suggested Connections</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            @foreach($users as $user)
                            <div class="flex items-center space-x-3">
                                <img src="https://avatar.iran.liara.run/public/boy" alt="User" class="w-10 h-10 rounded-full" />
                                <div>
                                <a href="{{ route('showUsers') }}" class="text-blue-500 hover:text-blue-700">
                                </a>
                                    <h4 class="font-medium">{{ $user->name}}</h4>
                                  
                                </div>
                            </div>
                            <button class="text-blue-500 hover:text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>
</x-app-layout>