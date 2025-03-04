<x-app-layout>


    <!-- Main Content -->
    <div class="max-w-7xl mx-auto pt-20 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Profile Card -->

            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="relative">
                        <div class="h-24 bg-gradient-to-r from-blue-600 to-blue-400"></div>
                        <img src="https://avatar.iran.liara.run/public/boy" alt="Profile"
                            class="absolute -bottom-6 left-4 w-20 h-20 rounded-full border-4 border-white shadow-md" />
                    </div>
                    <div class="pt-14 p-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold">{{ auth()->user()->name }}</h2>
                            <a href="https://github.com" target="_blank" class="text-gray-600 hover:text-black">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg>
                            </a>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">Senior Full Stack Developer</p>
                        <p class="text-gray-500 text-sm mt-2">Building scalable web applications with modern technologies</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs"></span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Node.js</span>
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">React</span>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Python</span>
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Docker</span>
                        </div>
                        <div class="mt-4 pt-4 border-t">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Connections</span>
                                <span class="text-blue-600 font-medium">487</span>
                            </div>
                            <div class="flex justify-between text-sm mt-2">
                                <span class="text-gray-500">Posts</span>
                                <span class="text-blue-600 font-medium">{{ $posts->count()}}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Tags -->
                <!-- Suggested Connections -->
                <div class="bg-white rounded-xl shadow-sm p-4">
                    <h3 class="font-semibold mb-4">Suggested Connections</h3>
                    <div class="space-y-4">
                        <div class=" items-center justify-between">
                            @foreach($users as $user)
                            <div class="flex items-center space-x-3" id="user-{{ $user->id }}">
                                <img src=" https://avatar.iran.liara.run/public/boy" alt="User" class="w-10 h-10 rounded-full" />
                                <div>
                                    <a href="{{ route('showUsers') }}" class="text-blue-500 hover:text-blue-700">
                                    </a>
                                    <h4 class="font-medium">{{ $user->name}}</h4>

                                </div>
                                @if ($user->connectionStatus === 'accepter')
                                    <a href="" class="text-blue-500 hover:text-blue-600">Message</a>
                                    @elseif ($user->connectionStatus === 'en attente')
                                    <span class="text-blue-500 hover:text-blue-600">en attente</span>
                                    @else
                                    <button onclick="connect('{{$user->id}}')" class="text-blue-500 hover:text-blue-600 connect-btn">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                @endif

                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>
                <!--add competence-->

            </div>
            <!-- Main Feed -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Post Creation -->
                <div class="bg-white rounded-xl shadow-sm p-4">
                    <div class="flex items-center space-x-4">
                        <img src="https://avatar.iran.liara.run/public/boy" alt="User" class="w-12 h-12 rounded-full" />
                        <button class="bg-gray-100 hover:bg-gray-200 text-gray-500 text-left rounded-lg px-4 py-3 flex-grow transition-colors duration-200" id="addpostButton">
                            Share your knowledge or ask a question...
                        </button>

                    </div>




                    <!-- ----------------------------------------- -->
                    <div class="bg-white rounded-lg shadow-md p-6 hidden" id="addpostform">
                        <h1 class="text-2xl font-bold mb-6">Create New Post</h1>

                        <form action="{{ route('dashboard.addPost') }}" method="POST" enctype="multipart/form-data">
                            <!-- CSRF Token -->
                            @csrf
                            <!-- Title Input -->
                            <div class="mb-6">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Post Title</label>
                                <input value="" type="text" id="titre" name="titre"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Enter post title">
                            </div>

                            <!-- Category Selection -->

                            <!-- Tags Input -->
                            <div class="mb-6">
                                <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                                <input type="text" id="tags" name="tags"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Enter tags separated by commas">
                                <p class="mt-1 text-sm text-gray-500">Example: coding, tutorial, beginner</p>
                            </div>

                            <!-- Featured Image Upload -->
                            <div class="mb-6">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="image-upload" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 2MB)</p>
                                        </div>
                                        <input id="image-upload" name="image" type="file" class="hidden" accept="image/*" />
                                    </label>
                                </div>

                                <div id="image-preview" class="mt-4 hidden">
                                    <div class="relative w-full h-48 overflow-hidden rounded-lg">
                                        <img id="preview-image" src="#" alt="Preview" class="w-full h-full object-cover">
                                        <button type="button" id="remove-image" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Description/Content -->
                            <div class="mb-6">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Post Content</label>
                                <div class="border border-gray-300 rounded-lg p-2 bg-white">
                                    <!-- Basic Text Formatting Toolbar -->
                                    <div class="flex items-center space-x-3 border-b border-gray-200 pb-2 mb-2">
                                        <button type="button" class="p-1 rounded hover:bg-gray-100">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12M6 18h12M6 6h12" />
                                            </svg>
                                        </button>
                                        <button type="button" class="p-1 rounded hover:bg-gray-100">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                                            </svg>
                                        </button>
                                        <button type="button" class="p-1 rounded hover:bg-gray-100 font-bold">B</button>
                                        <button type="button" class="p-1 rounded hover:bg-gray-100 italic">I</button>
                                        <button type="button" class="p-1 rounded hover:bg-gray-100 underline">U</button>
                                        <button type="button" class="p-1 rounded hover:bg-gray-100">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                            </svg>
                                        </button>
                                        <button type="button" class="p-1 rounded hover:bg-gray-100">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <textarea id="description" name="description" rows="12"
                                        class="w-full px-3 py-2 border-none focus:outline-none focus:ring-0"
                                        placeholder="Write your post content here..."></textarea>
                                    @error('description')
                                    <div>
                                        <p class="mt-1 text-sm text-gray-500 text-red-700">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Post Settings -->


                            <!-- Action Buttons -->
                            <div class="flex items-center justify-end space-x-4">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" id="" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Publish Post
                                    </button>
                                </form>
                            </div>
                        </form>
                    </div>

                    <!-- ----------------------------- -->
                    <div class="flex justify-between mt-4 pt-4 border-t">
                        <button class="flex items-center space-x-2 text-gray-500 hover:bg-gray-100 px-4 py-2 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                            <span>Code</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-500 hover:bg-gray-100 px-4 py-2 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Image</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-500 hover:bg-gray-100 px-4 py-2 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            <span>Link</span>
                        </button>
                    </div>
                </div>

                <!-- Posts -->
                @forelse ($posts as $post)

                <!-- Post Content -->
                <article class="bg-white rounded-lg shadow-md">
                    <!-- Post Header -->

                    <div class="p-6">



                        <h1 class="text-3xl font-bold mb-4"> {{$post->titre}}</h1>

                        <!-- Post Metadata -->
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
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
                    <div class="border-t border-gray-200 p-6">
                        <h3 class="text-xl font-bold mb-6">Comments</h3>
                        <div class="space-y-6">
                            <!-- Comment Input -->
                            <form action="{{ route('dashboard.addComment',$post->id) }}" method="POST">
                                @csrf
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 bg-gray-300 rounded-full"></div>

                                    <div class="flex-1">
                                        <textarea class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Add to the discussion..." name="content"></textarea>
                                        <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Comment</button>
                                    </div>
                                </div>

                            </form>

                            <!-- Existing Comments -->
                            @foreach ($post->comments as $comment)
                            <div class="space-y-6">
                                <!-- Comment 1 -->


                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                                    <div class="flex-1">
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex items-center justify-between mb-2">
                                                <h4 class="font-semibold">{{ $comment->user->name}}</h4>
                                                <span class="text-gray-500 text-sm"></span>
                                            </div>
                                            <p class="text-gray-800">{{ $comment->content}}</p>
                                            <div class="mt-3 flex items-center space-x-4">
                                                <button class="text-gray-500 hover:text-blue-500 text-sm">Reply</button>
                                                <button class="text-gray-500 hover:text-blue-500 text-sm">Like</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>
                    </div>

                </article>

                @empty
                <h1>You have no posts</h1>
                @endforelse


                <div class="my-6">
                    {{ $posts->links()}}
                </div>

                <!-- Right Sidebar -->
                <div class="space-y-6">
                    <!-- Job Recommendations -->



                </div>

                <!-- </body>

    </html> -->



</x-app-layout>

<script>
    async function connect(userId) {
        try {
            const response = await fetch(`/users/${userId}/connection`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (data.success) {
                console.log('success');

                const userElement = document.getElementById(`user-${userId}`);
                console.log(userElement);


                if (userElement) {
                    const button = userElement.querySelector('.connect-btn');
                    console.log(button);

                    if (button) {
                        button.remove();
                    }

                    const pendingText = document.createElement('span');
                    pendingText.className = "text-blue-500 hover:text-blue-600";
                    pendingText.textContent = "en attente";
                    userElement.appendChild(pendingText);
                }
            }
        } catch (error) {
            console.error('Error Connecting:', error);
        }
    }

    function likePost(postId) {
        fetch(`/posts/${ 
                                postId
                            }
                            /like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .then(data => {
                const likeButton = document.getElementById(`like-button-${postId}`);
                const likeCount = likeButton.querySelector('span');
                likeCount.textContent = data.count + (data.count !== 1 ? ' Likes' : ' Like');
                // likeButton.classList.add('text-blue-500');


                if (data.liked) {
                    likeButton.classList.add('text-blue-500');
                    likeButton.classList.remove('text-gray-400');
                } else {
                    likeButton.classList.add('text-gray-400');
                    likeButton.classList.remove('text-blue-500');
                }
            });
    }
    // Add Post Form
    const addpostButton = document.getElementById('addpostButton');
    const addpostform = document.getElementById('addpostform');
    addpostButton.addEventListener('click', function() {
        addpostform.classList.remove('hidden')
    })
    document.addEventListener('DOMContentLoaded', function() {
        const imageUpload = document.getElementById('image-upload');
        const imagePreview = document.getElementById('image-preview');
        const previewImage = document.getElementById('preview-image');
        const removeImage = document.getElementById('remove-image');

        imageUpload.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                if (file.type.match('image.*')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                    }

                    reader.readAsDataURL(file);
                }
            }
        });

        removeImage.addEventListener('click', function() {
            imageUpload.value = '';
            imagePreview.classList.add('hidden');
            previewImage.src = '#';
        });
    });
</script>