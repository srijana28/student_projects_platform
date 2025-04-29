<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex items-center mb-6">
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $university->name }}</h1>
                    <p class="text-gray-500">{{ $university->location }}</p>
                </div>
                @auth
                    <a href="{{ route('projects.create') }}?university_id={{ $university->id }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Add Project
                    </a>
                @endauth
            </div>

            <p class="text-gray-600 mb-8">{{ $university->description }}</p>

            <h2 class="text-xl font-semibold mb-4">Projects</h2>
            
            @if($projects->count() > 0)
                <div class="space-y-6">
                    @foreach($projects as $project)
                        <div class="border rounded-lg p-6 hover:bg-gray-50">
                            <div class="flex justify-between">
                                <h3 class="text-lg font-medium text-indigo-600">{{ $project->title }}</h3>
                                <span class="text-sm text-gray-500">{{ $project->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-500 mb-3">by {{ $project->user->name }}</p>
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
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Docs
                                        </a>
                                    @endif
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
                <p class="text-gray-500">No projects yet for this university.</p>
            @endif
        </div>
    </div>
</x-app-layout>