<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-5 p-5">
                    @csrf
                    @method('PUT')
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" name="email" id="email" value="{{ $user->email }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="status_user" class="block text-gray-700">Roles</label>
                        <select name="status_user" id="status_user" 
                                class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                            <option value="" disabled>Select Role</option>
                            <option value="Magang" {{ old('status_user', $user->status_user) == 'Magang' ? 'selected' : '' }}>Magang</option>
                            <option value="Paruh Waktu" {{ old('status_user', $user->status_user) == 'Paruh Waktu' ? 'selected' : '' }}>Paruh Waktu</option>
                            <option value="Pegawai Tetap" {{ old('status_user', $user->status_user) == 'Pegawai Tetap' ? 'selected' : '' }}>Pegawai Tetap</option>
                        </select>
                    </div>
            
                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm 
                    text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>