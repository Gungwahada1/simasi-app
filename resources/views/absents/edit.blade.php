<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('students.update', $student->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" name="name" id="name" 
                                   value="{{ old('name', $student->name) }}" 
                                   class="form-input rounded-md shadow-sm mt-1 block w-full" 
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="grade" class="block text-gray-700">Grade</label>
                            <input type="text" name="grade" id="grade" 
                                   value="{{ old('grade', $student->grade) }}" 
                                   class="form-input rounded-md shadow-sm mt-1 block w-full" 
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="gender" class="block text-gray-700">Gender</label>
                            <select name="gender" id="gender" 
                                    class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="" disabled>Select gender</option>
                                <option value="M" {{ old('gender', $student->gender) == 'M' ? 'selected' : '' }}>Male</option>
                                <option value="F" {{ old('gender', $student->gender) == 'F' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('students.index') }}" 
                               class="mr-4 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-300 hover:bg-gray-400 rounded-md shadow">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
