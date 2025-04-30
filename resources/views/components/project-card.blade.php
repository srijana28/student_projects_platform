<div 
    class="relative bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 group border border-gray-100"
    x-data="{ isHovered: false }"
    @mouseenter="isHovered = true"
    @mouseleave="isHovered = false"
>
    <!-- Ribbon for featured projects -->
    <div class="absolute -right-8 top-4 bg-primary-500 text-white px-8 py-1 transform rotate-45 shadow-md text-xs font-bold" 
         :class="{ 'opacity-0': !isHovered, 'opacity-100': isHovered }"
         x-transition>
        Featured
    </div>

    <div class="h-48 bg-gradient-to-r from-primary-100 to-secondary-100 flex items-center justify-center">
        <svg class="h-20 w-20 text-primary-500 group-hover:text-primary-600 transition-colors duration-300" 
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                  d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
    </div>

    <div class="p-6">
        <div class="flex items-center space-x-2 mb-2">
            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-primary-100 text-primary-800">
                {{ $project->university->name }}
            </span>
            <span class="text-xs text-gray-500">
                {{ $project->created_at->diffForHumans() }}
            </span>
        </div>

        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors duration-300">
            <a href="{{ route('projects.show', $project) }}">
                {{ $project->title }}
            </a>
        </h3>

        <p class="text-gray-600 mb-4 line-clamp-2">
            {{ $project->description }}
        </p>

        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="flex -space-x-1 overflow-hidden">
                    @foreach($project->likes->take(3) as $like)
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" 
                             src="https://ui-avatars.com/api/?name={{ $like->user->name }}&background=random" 
                             alt="{{ $like->user->name }}">
                    @endforeach
                </div>
                <span class="text-sm text-gray-500">
                    {{ $project->likes_count }} likes
                </span>
            </div>

            <div>
                <a href="{{ route('projects.show', $project) }}" 
                   class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-700 hover:bg-primary-200 transition-colors duration-300">
                    View Project
                    <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>