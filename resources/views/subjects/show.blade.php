<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Subject') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-3xl font-bold mb-4">{{ $subject->subject_name }}</h1>
                <p class="text-xl font-bold mb-4">Subject Description</p>
                <p class="text-gray-700 mb-6">{{ $subject->subject_description }}</p>
                <div class="flex space-x-4">
                    @if (auth()->user()->hasRole('Pegawai Tetap') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Developer'))    
                    <a class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow"
                        href="{{ route('subjects.edit',$subject->id) }}">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg shadow">Delete</button>
                    </form>
                    @endif
                    <a href="{{ route('subjects.index') }}" class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-gray-700 bg-gray-300 hover:bg-gray-400 rounded-lg shadow">
                        {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(){
            return confirm("Are you sure you want to delete this subject?")
        }
    </script>
</x-app-layout>