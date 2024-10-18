<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Subject') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" id="subjectForm">
                <form action="{{ route('subjects.store') }}" method="POST" class="space-y-5 p-5">
                    @csrf
                    <label for="subject_name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="subject_name" id="subject_name" value="{{ old('subject_name') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('subject_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
            
                    <label for="subject_description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="subject_description" id="subject_description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('subject_description') }}</textarea>
                    @error('subject_description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
            
                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm 
                    text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        
    </script>
</x-app-layout>