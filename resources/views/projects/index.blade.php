<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">All Projects</h1>
                @auth
                    <a href="{{ route('projects.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        New Project
                    </a>
                @endauth
            </div>

            <div class="mb-6">
                <form action="{{ route('projects.index') }}" method="GET" class="flex items-center space-x-4">
                    <div class="flex-1">
                        <input type="text" name="search" placeholder="Search projects..." value="{{ request('search') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('projects.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            @if($projects->count() > 0)
                <div class="space-y-6">
                    @foreach($projects as $project)
                        <div class="border rounded-lg p-6 bg-pink-50 hover:bg-pink-100">
                            <div class="flex justify-between">
                                <h3 class="text-lg font-medium text-indigo-600">{{ $project->title }}</h3>
                                <span class="text-sm text-gray-500">{{ $project->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-500 mb-3">by {{ $project->user->name }} from {{ $project->university->name }}</p>
                            <p class="text-gray-600 mb-4">{{ Str::limit($project->description, 200) }}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex space-x-4">
                                    @if($project->github_link)
                                        <a href="{{ $project->github_link }}" target="_blank" class="text-sm text-gray-500 hover:text-indigo-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                                            </svg>
                                            GitHub
                                        </a>
                                    @endif
                                    @if($project->documentation_link)
                                        <a href="{{ $project->documentation_link }}" target="_blank" class="text-sm text-gray-500 hover:text-indigo-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Docs
                                        </a>
                                    @endif
                                    <span class="text-sm text-gray-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        {{ $project->likes_count }} likes
                                    </span>
                                    <span class="text-sm text-gray-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        {{ $project->comments_count }} comments
                                    </span>
                                </div>
                                <a href="{{ route('projects.show', $project) }}" class="text-indigo-500 text-sm hover:underline">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $projects->links() }}
                </div>
            @else
                <p class="text-gray-500">No projects found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
