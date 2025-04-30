<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Project Header -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="md:flex">
                <div class="md:flex-shrink-0 md:w-1/3 bg-gradient-to-br from-primary-50 to-secondary-50 flex items-center justify-center p-8">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 mb-4">
                            <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">{{ $project->university->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $project->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="p-8 md:w-2/3">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $project->title }}</h1>
                            <p class="text-gray-600 mb-4">by {{ $project->user->name }}</p>
                        </div>
                        @auth
                            @if(auth()->user()->id === $project->user_id)
                                <div class="flex space-x-2">
                                    <a href="{{ route('projects.edit', $project) }}" 
                                       class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('projects.destroy', $project) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-accent-500 hover:bg-accent-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-500"
                                                onclick="return confirm('Are you sure you want to delete this project?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>

                    <div class="flex flex-wrap gap-2 my-4">
                        @foreach(explode(',', $project->tags) as $tag)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                #{{ trim($tag) }}
                            </span>
                        @endforeach
                    </div>

                    <div class="flex space-x-4 mb-6">
                        @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                                </svg>
                                GitHub
                            </a>
                        @endif
                        @if($project->documentation_link)
                            <a href="{{ $project->documentation_link }}" target="_blank" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-secondary-500 hover:bg-secondary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Documentation
                            </a>
                        @endif
                        <form action="{{ route('likes.toggle', $project) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white {{ $project->isLikedBy(auth()->user()) ? 'bg-accent-500 hover:bg-accent-600' : 'bg-gray-500 hover:bg-gray-600' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                Like ({{ $project->likes->count() }})
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Project Description</h2>
                    <div class="prose max-w-none">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Discussion ({{ $project->comments->count() }})</h2>
                    
                    @auth
                        <form action="{{ route('comments.store', $project) }}" method="POST" class="mb-6">
                            @csrf
                            <div class="mb-4">
                                <label for="content" class="sr-only">Add a comment</label>
                                <textarea name="content" id="content" rows="3" 
                                          class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md" 
                                          placeholder="Add your comment..." required></textarea>
                            </div>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Post Comment
                            </button>
                        </form>
                    @else
                        <p class="text-gray-500 mb-6">
                            Please <a href="{{ route('login') }}" class="text-primary-600 hover:underline">login</a> to post a comment.
                        </p>
                    @endauth
                    
                    @if($project->comments->count() > 0)
                        <div class="space-y-6">
                            @foreach($project->comments as $comment)
                                <div class="border-b border-gray-200 pb-6 last:border-0 last:pb-0">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center space-x-3 mb-2">
                                            <img class="h-8 w-8 rounded-full" 
                                                 src="https://ui-avatars.com/api/?name={{ $comment->user->name }}" 
                                                 alt="{{ $comment->user->name }}">
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $comment->user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        @auth
                                            @if(auth()->user()->id === $comment->user_id)
                                                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-xs text-red-500 hover:text-red-700"
                                                            onclick="return confirm('Are you sure you want to delete this comment?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="text-gray-700 mt-2">{{ $comment->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No comments yet.</p>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Team Members -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Project Team</h2>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <img class="h-10 w-10 rounded-full" 
                                 src="https://ui-avatars.com/api/?name={{ $project->user->name }}" 
                                 alt="{{ $project->user->name }}">
                            <div>
                                <p class="font-medium text-gray-900">{{ $project->user->name }}</p>
                                <p class="text-sm text-gray-500">Project Creator</p>
                            </div>
                        </div>
                        <!-- Additional team members can be added here -->
                    </div>
                </div>

                <!-- Project Stats -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Project Stats</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Created</p>
                            <p class="font-medium">{{ $project->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Last Updated</p>
                            <p class="font-medium">{{ $project->updated_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Likes</p>
                            <p class="font-medium">{{ $project->likes->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Comments</p>
                            <p class="font-medium">{{ $project->comments->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Similar Projects -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Similar Projects</h2>
                    <div class="space-y-4">
                        @foreach($similarProjects as $similarProject)
                            <a href="{{ route('projects.show', $similarProject) }}" 
                               class="block p-3 rounded-lg hover:bg-gray-50 transition-colors duration-300">
                                <h3 class="font-medium text-gray-900">{{ $similarProject->title }}</h3>
                                <p class="text-sm text-gray-500">{{ $similarProject->university->name }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>