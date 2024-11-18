<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Role') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('roles.store') }}" method="POST" class="space-y-5 p-5">
                    @csrf
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br/>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($permission as $value)
                                    <label class="flex items-center" for="permission-{{$value->uuid}}">
                                        <input type="checkbox" name="permission[{{$value->uuid}}]" id="permission-{{$value->uuid}}" value="{{$value->uuid}}" class="mr-2">
                                        {{ $value->name }}
                                    </label>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <button type="button" id="check-all" class="text-blue-600 underline mr-4">
                                    Check All
                                </button>
                                <button type="button" id="uncheck-all" class="text-blue-600 underline">
                                    Unselect All
                                </button>
                            </div>
                        </div>
                    </div>
            
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('roles.index') }}" 
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
        document.getElementById('check-all').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name^="permission"]');
            checkboxes.forEach(checkbox => checkbox.checked = true);
        });

        document.getElementById('uncheck-all').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name^="permission"]');
            checkboxes.forEach(checkbox => checkbox.checked = false);
        });
    </script>
</x-app-layout>
