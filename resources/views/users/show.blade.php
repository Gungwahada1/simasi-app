<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Show User') }}
            </h2>
            <a href="{{ route('users.index') }}" class="bg-red-500 text-white font-medium px-3 py-2 rounded-md hover:bg-red-600">
                {{ __('Back') }}
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-3xl font-bold mb-4">{{ $user->name }}</h1>
                <p class="text-xl font-bold mb-4">User Information</p>
                <p class="text-gray-700 mb-4"><b>Email: </b>{{ $user->email}}</p>
                <p class="text-gray-700 mb-4"><b>Role: </b>{{ $user->status_user}}</p>
                <div class="grid grid-cols-2 gap-2 mb-4">
                    <p class="font-bold text-gray-700">First Name</p>
                    <p class="font-bold text-gray-700">Last Name</p>
                    
                    <p class="text-gray-700">{{{ $user->first_name }}}</p>
                    <p class="text-gray-700">{{{ $user->last_name }}}</p>
                </div>                                
                <div class="flex space-x-4">
                    <a class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow"
                        href="{{ route('users.edit',$user->id) }}">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg shadow">Delete</button>
                    </form>
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
