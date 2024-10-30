<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Permission') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4 rounded-lg shadow-lg mb-4 space-y-2">
                        <p class="text-xl font-bold">Permissions Create Information</p>
                        <p>Here are some steps to create appropriate permissions:</p>
                        <ol class="list-decimal ms-4">
                            <li>Make sure to use permission names with all lowercase letters.</li>
                            <li>When specifying permission names, avoid using numbers. The name should clearly describe the function.</li>
                            <li>When creating a permission, replace all spaces with a dash (-).</li>
                        </ol>
                    </div>
                    <form action="{{ route('permissions.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div id="permissions-wrapper">
                            @if(old('name'))
                                @foreach(old('name') as $index => $oldName)
                                    <div class="permission-item">
                                        @if ($loop->first)
                                            <label for="name" class="block text-sm font-medium text-gray-700">Permission Name</label>
                                        @endif
                                        <input type="text" name="name[]" value="{{ $oldName }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                        focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @if ($errors->has('name'))
                                            <div class="text-red-500 text-sm">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="permission-item">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Permission Name</label>
                                    <input type="text" name="name[]" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @if ($errors->has('name'))
                                        <div class="text-red-500 text-sm">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    
                        <button type="button" id="add-permission" class="mt-2 text-sm text-blue-500">+ Add another permission</button>
    
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('permissions.index') }}" 
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
    </div>
    <script>
        document.getElementById('add-permission').addEventListener('click', function() {
            var wrapper = document.getElementById('permissions-wrapper');
            var newPermission = document.createElement('div');
            newPermission.classList.add('permission-item');
            newPermission.innerHTML = `
                <input type="text" name="name[]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            `;
            wrapper.appendChild(newPermission);
        });
    </script>
</x-app-layout>