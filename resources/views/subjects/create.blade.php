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
                    <input type="text" placeholder="Insert Name Subject"  name="subject_name" id="subject_name" value="{{ old('subject_name') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('subject_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
            
                    <label for="subject_description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="subject_description" placeholder="Insert Subject Description"  id="subject_description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('subject_description') }}</textarea>
                    @error('subject_description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
            
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('subjects.index') }}" 
                           class="mr-4 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-300 hover:bg-gray-400 rounded-md shadow">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        
    </script>
</x-app-layout>