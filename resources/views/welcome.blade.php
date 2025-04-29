<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Welcome to Student Projects Platform</h1>
            <p class="text-gray-600 mb-8">A collaborative platform for students to share and discover academic projects from universities across the country.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Featured Universities</h2>
                    <div class="space-y-4">
                        @foreach($featuredUniversities as $university)
                            <div class="p-4 border rounded-lg hover:bg-gray-50">
                                <h3 class="font-medium text-indigo-600">{{ $university->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $university->location }}</p>
                                <p class="text-sm mt-2">{{ $university->projects_count }} projects</p>
                                <a href="{{ route('universities.show', $university) }}" class="text-indigo-500 text-sm hover:underline">View projects</a>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('universities.index') }}" class="inline-block mt-4 text-indigo-600 hover:underline">View all universities →</a>
                </div>
                
                <div>
                    <h2 class="text-xl font-semibold mb-4">Recent Projects</h2>
                    <div class="space-y-4">
                        @foreach($recentProjects as $project)
                            <div class="p-4 border rounded-lg hover:bg-gray-50">
                                <h3 class="font-medium text-indigo-600">{{ $project->title }}</h3>
                                <p class="text-sm text-gray-500">by {{ $project->user->name }} from {{ $project->university->name }}</p>
                                <p class="text-sm mt-2 line-clamp-2">{{ $project->description }}</p>
                                <div class="flex justify-between items-center mt-3">
                                    <a href="{{ route('projects.show', $project) }}" class="text-indigo-500 text-sm hover:underline">View details</a>
                                    <span class="text-xs text-gray-500">{{ $project->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('projects.index') }}" class="inline-block mt-4 text-indigo-600 hover:underline">View all projects →</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>