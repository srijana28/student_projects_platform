<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Universities</h1>
                @auth
                    <button onclick="document.getElementById('university-modal').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Add University
                    </button>
                @endauth
            </div>

            <!-- University Modal -->
            <div id="university-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Add New University</h3>
                        <button onclick="document.getElementById('university-modal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">
                            &times;
                        </button>
                    </div>
                    <form action="{{ route('universities.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">University Name</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md bg-gray-100 border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" class="mt-1 block w-full rounded-md bg-gray-100 border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md bg-gray-100 border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="document.getElementById('university-modal').classList.add('hidden')" class="mr-2 bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </button>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- University Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach($universities as $university)
                    <div class="rounded-lg overflow-hidden shadow-lg bg-blue-50 hover:bg-blue-100 transition duration-300 ease-in-out transform hover:scale-105"> <!-- Very Light Blue with subtle hover effect -->
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $university->name }}</h3>
                            <p class="text-sm text-gray-700 mb-2">{{ $university->location }}</p>
                            <p class="text-sm text-gray-800 mb-4 line-clamp-3">{{ $university->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-700">{{ $university->projects_count }} projects</span>
                                <a href="{{ route('universities.show', $university) }}" class="text-indigo-700 text-sm font-medium hover:underline">View Projects</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
