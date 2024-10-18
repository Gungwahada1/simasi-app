<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('users.store') }}" method="POST" class="space-y-5 p-5">
                    @csrf
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                    <label for="status_user" class="block text-sm font-medium text-gray-700">Status User</label>
                    <select name="status_user" id="status_user" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                        <option value="" disabled selected>Select Status</option>
                        <option value="Magang">Magang</option>
                        <option value="Paruh Waktu">Paruh Waktu</option>
                        <option value="Pegawai Tetap">Pegawai Tetap</option>
                    </select>

                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                    <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="confirm-password" id="confirm-password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            
                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm 
                    text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
