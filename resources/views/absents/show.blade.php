<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Student') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-xl font-bold mb-4">{{ $student->name }}</h1>
                <table class="table table-bordered mb-3" style="width: 25%;">
                    <tr>
                        <th class="w-1/5 text-left">Grade</th>
                        <th class="w-1/5 text-left">Gender</th>
                    </tr>
                    <tr>
                        <td class="text-gray-700 mb-6">{{ $student->grade }}</td>
                        <td class="text-gray-700 mb-6">{{ $student->gender == 'M' ? 'Male' : 'Female' }}</td>
                    </tr>
                </table>
                <div class="flex space-x-4">
                    <a class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow"
                        href="{{ route('students.edit',$student->id) }}">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg shadow">Delete</button>
                    </form>
                    <a href="{{ route('absents.index') }}" class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-gray-700 bg-gray-300 hover:bg-gray-400 rounded-lg shadow">
                        {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(){
            return confirm("Are you sure you want to delete this student?")
        }
    </script>
</x-app-layout>