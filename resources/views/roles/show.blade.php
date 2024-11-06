<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Role') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-3xl font-bold mb-3">{{ $role->name }}</h1>
                <div class="mb-3">
                    <strong class="text-xl">Description</strong>
                    <p class="mt-1 text-gray-700">This role includes the following permissions:</p>
                </div>
                <div class="text-gray-700 mb-3">
                    <ul class="list-none grid grid-cols-2 md:grid-cols-4 gap-2">
                        @foreach ($role->permissions->pluck('name') as $permission)
                            <li class="bg-gray-100 px-3 py-1 rounded text-center text-sm font-medium text-gray-800">
                                {{ $permission }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex space-x-4 mt-3">
                    <a class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow"
                        href="{{ route('roles.edit',$role->id) }}">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg shadow">Delete</button>
                    </form>
                    <a href="{{ route('roles.index') }}" class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 rounded-lg shadow">
                        {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(){
            return confirm("Are you sure you want to delete this user?")
        }
    </script>
</x-app-layout>