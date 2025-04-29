<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $project->title }}</h1>
                    <p class="text-gray-500">by {{ $project->user->name }} from {{ $project->university->name }}</p>
                </div>
                @auth
                    @if(auth()->user()->id === $project->user_id)
                        <div class="flex space-x-2">
                            <a href="{{ route('projects.edit', $project) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-md text-sm font-medium">
                                Edit
                            </a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm font-medium">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="flex space-x-4 mb-6">
                @if($project->github_link)
                    <a href="{{ $project->github_link }}" target="_blank" class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                        </svg>
                        GitHub
                    </a>
                @endif
                @if($project->documentation_link)
                    <a href="{{ $project->documentation_link }}" target="_blank" class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Documentation
                    </a>
                @endif
                <form action="{{ route('likes.toggle', $project) }}" method="POST">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium {{ $project->isLikedBy(auth()->user()) ? 'bg-indigo-100 text-indigo-700' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                        </svg>
                        Like ({{ $project->likes->count() }})
                    </button>
                </form>
            </div>

            @if($project->tags)
                <div class="mb-6">
                    @foreach(explode(',', $project->tags) as $tag)
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ trim($tag) }}</span>
                    @endforeach
                </div>
            @endif

            <div class="prose max-w-none mb-8">
                {!! nl2br(e($project->description)) !!}
            </div>

            <div class="border-t pt-6">
                <h2 class="text-xl font-semibold mb-4">Comments ({{ $project->comments->count() }})</h2>
                
                @auth
                    <form action="{{ route('comments.store', $project) }}" method="POST" class="mb-6">
                        @csrf
                        <div class="mb-4">
                            <label for="content" class="sr-only">Add a comment</label>
                            <textarea name="content" id="content" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Add a comment..." required></textarea>
                        </div>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Post Comment
                        </button>
                    </form>
                @else
                    <p class="text-gray-500 mb-6">Please <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">login</a> to post a comment.</p>
                @endauth
                
                @if($project->comments->count() > 0)
                    <div class="space-y-4">
                        @foreach($project->comments as $comment)
                            <div class="border rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $comment->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                    @auth
                                        @if(auth()->user()->id === $comment->user_id)
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                                <p class="mt-2 text-gray-700">{{ $comment->content }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No comments yet.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>