<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-12">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Profile Update Card -->
            <div class="bg-white text-gray-800 rounded-xl shadow-md overflow-hidden w-full border border-gray-200">
                <div class="p-8">
                    <h2 class="text-2xl font-bold mb-6">Profile Information</h2>

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name"
                                    class="block mt-1 w-full bg-white text-gray-800 border border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-100 rounded-md shadow-sm"
                                    type="text" name="name" :value="old('name', $user->name)" required autofocus
                                    autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email"
                                    class="block mt-1 w-full bg-white text-gray-800 border border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-100 rounded-md shadow-sm"
                                    type="email" name="email" :value="old('email', $user->email)" required
                                    autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button
                                class="bg-teal-600 hover:bg-teal-700 focus:bg-teal-700 text-white px-4 py-2 rounded-md">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Password Update Card -->
            <div class="bg-white text-gray-800 rounded-xl shadow-md overflow-hidden w-full border border-gray-200">
                <div class="p-8">
                    <h2 class="text-2xl font-bold mb-6">Update Password</h2>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="space-y-6">
                            <div>
                                <x-input-label for="current_password" :value="__('Current Password')" />
                                <x-text-input id="current_password"
                                    class="block mt-1 w-full bg-white text-gray-800 border border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-100 rounded-md shadow-sm"
                                    type="password" name="current_password" required
                                    autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')"
                                    class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('New Password')" />
                                <x-text-input id="password"
                                    class="block mt-1 w-full bg-white text-gray-800 border border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-100 rounded-md shadow-sm"
                                    type="password" name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation"
                                    class="block mt-1 w-full bg-white text-gray-800 border border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-100 rounded-md shadow-sm"
                                    type="password" name="password_confirmation" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')"
                                    class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end">
                                <x-primary-button
                                    class="bg-teal-600 hover:bg-teal-700 focus:bg-teal-700 text-white px-4 py-2 rounded-md">
                                    {{ __('Save') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Account Deletion Card -->
            <div class="bg-white text-gray-800 rounded-xl shadow-md overflow-hidden w-full border border-gray-200">
                <div class="p-8">
                    <h2 class="text-2xl font-bold mb-6">Delete Account</h2>

                    <p class="text-gray-700 mb-6">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                    </p>

                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                            <div class="flex-1">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password"
                                    class="block mt-1 w-full bg-white text-gray-800 border border-gray-300 focus:border-red-500 focus:ring focus:ring-red-100 rounded-md shadow-sm"
                                    type="password" name="password" required autocomplete="current-password" />
                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                            </div>

                            <x-danger-button
                                class="ml-0 md:ml-4 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                                {{ __('Delete Account') }}
                            </x-danger-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
