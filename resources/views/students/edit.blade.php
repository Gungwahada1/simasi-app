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
                    @if ($message = Session::get('info'))
                    <div id="alert-info" class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg shadow-lg mb-4 animate-bounce-in-down" role="alert">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm.75 5.75h-1.5v1.5h1.5zm0 4h-1.5v6h1.5z"></path>
                            </svg>                                                      
                            <span class="font-medium">{{ $message }}</span>
                        </div>
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
    <script>
        setTimeout(function() {
            let alertType = 'alert-info';
            let alertElement = document.getElementById(alertType);

            if (alertElement) {
                alertElement.style.transition = 'opacity 0.5s ease';
                alertElement.style.opacity = '0';

                setTimeout(function() { alertElement.remove(); }, 500);
            }
        }, 5000);
    </script>
</x-app-layout>
