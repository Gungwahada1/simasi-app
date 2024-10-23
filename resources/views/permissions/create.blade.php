<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Permission') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('permissions.store') }}" method="POST" class="space-y-5 p-5">
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
                                    @if ($errors->has("name.$index"))
                                        <span class="text-red-500 text-sm">{{ $errors->first("name.$index") }}</span>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="permission-item">
                                <label for="name" class="block text-sm font-medium text-gray-700">Permission Name</label>
                                <input type="text" name="name[]" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @if ($errors->has('name.0'))
                                    <span class="text-red-500 text-sm">{{ $errors->first('name.0') }}</span>
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
    <script>
        document.getElementById('add-permission').addEventListener('click', function() {
            var wrapper = document.getElementById('permissions-wrapper');
            var newPermission = document.createElement('div');
            newPermission.classList.add('permission-item');
            newPermission.innerHTML = `
                <input type="text" name="name[]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @if ($errors->has('name.${permissionCount}'))
                    <span class="text-red-500 text-sm">{{ $errors->first('name.${permissionCount}') }}</span>
                @endif
            `;
            wrapper.appendChild(newPermission);
        });
    </script>
</x-app-layout>