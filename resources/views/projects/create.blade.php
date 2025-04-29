<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">{{ isset($project) ? 'Edit Project' : 'Create New Project' }}</h1>
            
            <form action="{{ isset($project) ? route('projects.update', $project) : route('projects.store') }}" method="POST">
                @csrf
                @if(isset($project))
                    @method('PUT')
                @endif
                
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Project Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $project->title ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="university_id" class="block text-sm font-medium text-gray-700">University</label>
                        <select name="university_id" id="university_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            <option value="">Select University</option>
                            @foreach($universities as $univ)
                                <option value="{{ $univ->id }}" {{ old('university_id', $project->university_id ?? (request('university_id') ?? '')) == $univ->id ? 'selected' : '' }}>{{ $univ->name }}</option>
                            @endforeach
                        </select>
                        @error('university_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ old('description', $project->description ?? '') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="github_link" class="block text-sm font-medium text-gray-700">GitHub Link (optional)</label>
                        <input type="url" name="github_link" id="github_link" value="{{ old('github_link', $project->github_link ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('github_link')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="documentation_link" class="block text-sm font-medium text-gray-700">Documentation Link (optional)</label>
                        <input type="url" name="documentation_link" id="documentation_link" value="{{ old('documentation_link', $project->documentation_link ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('documentation_link')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700">Tags (comma separated, optional)</label>
                        <input type="text" name="tags" id="tags" value="{{ old('tags', $project->tags ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('tags')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ isset($project) ? route('projects.show', $project) : route('projects.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        {{ isset($project) ? 'Update' : 'Create' }} Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>