<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('roles.update', $role->id) }}" method="POST" class="space-y-5 p-5">
                    @csrf
                    @method('PUT')
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ $role->name }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br/>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($permission as $value)
                                    <label class="flex items-center" for="permission-{{$value->id}}">
                                        <input {{($hasPermissions->contains($value->name)) ? 'checked' : ''}} type="checkbox" name="permission[{{$value->id}}]" id="permission-{{$value->id}}" value="{{$value->name}}" class="mr-2">
                                        {{ $value->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
            
                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm 
                    text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>