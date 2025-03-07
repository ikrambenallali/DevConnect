<x-app-layout>
<nav class="fixed top-0 w-full bg-gray-900 text-white z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <div class="text-2xl font-bold text-blue-400">&lt;DevConnect/&gt;</div>
                  
                </div>

                <div class="flex items-center space-x-6">
                    <a href="#" class="flex items-center space-x-1 hover:text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </a>
                    <a href="#" class="flex items-center space-x-1 hover:text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                        <span class="bg-blue-500 rounded-full w-2 h-2"></span>
                    </a>
                    <a href="#" class="flex items-center space-x-1 hover:text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="bg-red-500 rounded-full w-2 h-2"></span>
                    </a>
                    <div class="h-8 w-8 rounded-full overflow-hidden">
                        <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'images/placeholder.jpg')) }}" alt="Profile">
                    </div>
                    <form class="bg-white text-black rounded-md" method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto pt-20 px-4 sm:px-6 lg:px-8">
        <!-- Users Section -->
        <div class="mt-6 bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-2xl font-semibold mb-4">Users</h2>
            <div class="space-y-3">
                @forelse ($users as $user)
                    <div class="user-item p-3 hover:bg-gray-50 transition rounded-md cursor-pointer flex items-center space-x-4">
                        <img src="{{ asset('storage/' . ($user->profile_picture ? $user->profile_picture : '/images/placeholder.jpg')) }}"
                            alt="{{ $user->name }}'s Profile Picture" class="w-12 h-12 rounded-full object-cover">
                            <a href="{{ route('profil', ['user' => auth()->user()->name, 'id' => auth()->user()->id]) }}">
                                <h3 class="font-semibold">{{ $user->name }}</h3>
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500 italic">No users found.</p>
                @endforelse
            </div>
        </div>

        <!-- Posts Section -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Posts</h2>
            <div class="space-y-8">
                @forelse ($posts as $post)
                    <!-- Post Content -->
                    <article class="bg-white rounded-lg shadow-md">
                    <!-- Post Header -->

                    <div class="p-6">



                        <h1 class="text-3xl font-bold mb-4"> {{$post->titre}}</h1>

                        <!-- Post Metadata -->
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gray-300 rounded-full">
                                    <img src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="Profile Picture" class="w-12 h-12 rounded-full object-cover">

                                </div>
                                <div class="ml-4">
                                    <h3 class="font-semibold">{{$post->user->name}}</h3>
                                    <div class="text-gray-500 text-sm">
                                        <span>Published on {{$post->created_at->toFormattedDateString()}}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{$post->created_at->diffForHumans()}} read</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit/Delete for post owner -->
                            <div class="flex space-x-3">
                                <a href="{{ route('editPost',$post->id) }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>

                                <form action="{{ route('dashboard.destroy',$post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 flex items-center" type="submit">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>

                                </form>
                            </div>
                        </div>

                        <!--  Tags -->
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500">#webdev</span>
                                <span class="text-sm text-gray-500">#coding</span>
                                <span class="text-sm text-gray-500">#beginners</span>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <div class="mb-6">
                            <img src="{{asset('storage/'.$post->image)}}" alt="Featured Image" class="w-full h-auto rounded-lg">
                        </div>

                        <!-- Post Content -->
                        <div class="prose max-w-none">
                            <p class="mb-4">{{$post->description}}</p>

                        </div>

                        <!-- Engagement Metrics -->
                        <div class="flex items-center space-x-6 mt-8 pt-6 border-t">
                            <!-- Like button -->
                            <button id="like-button-{{ $post->id }}" data-post-id="{{ $post->id }}"
                                class="flex items-center {{ $post->isLikedBy(auth()->user()) ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}"
                                onclick='likePost(`{{ $post->id }}`)'>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                                <span class="ml-2">{{ $post->likes->count() }} Like{{ $post->likes->count() != 1 ? 's' : '' }}</span>
                            </button>

                            <button class="text-gray-500 hover:text-blue-500 flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                            </button>
                            <button class="text-gray-500 hover:text-blue-500 flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                <span>Share</span>
                            </button>

                        </div>
                    </div>

                    <!-- Comments Section -->
                 

                </article>
                @empty
                    <div class="bg-white rounded-lg shadow-md p-8 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <h3 class="text-xl font-medium text-gray-500">No posts yet</h3>
                       
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
