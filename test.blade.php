<div class="border-t border-gray-200 p-6">
                <h3 class="text-xl font-bold mb-6">Comments</h3>
                <div class="space-y-6">
                    <!-- Comment Input -->
                    <form action="" method="POST">
                        @csrf
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                            
                            <div class="flex-1">
                                <textarea class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                          placeholder="Add to the discussion..." name="content"></textarea>
                                <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Comment</button>
                            </div>
                        </div>
                            
                    </form>
                
                    <!-- Existing Comments -->
                    <div class="space-y-6">
                        <!-- Comment 1 -->
                        @foreach ($post->comments->sortByDesc('created_at') as $comment)
                            
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                            <div class="flex-1">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="font-semibold">{{$comment->user->name}}</h4>
                                        <span class="text-gray-500 text-sm">{{$comment->created_at->diffForHumans()}}</span>
                                    </div>
                                    <p class="text-gray-800">{{$comment->content}}</p>
                                    <div class="mt-3 flex items-center space-x-4">
                                        <button class="text-gray-500 hover:text-blue-500 text-sm">Reply</button>
                                        <button class="text-gray-500 hover:text-blue-500 text-sm">Like</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                       
                      
                    </div>
                </div>
            </div>