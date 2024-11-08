<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('absent') }}
        </h2>
        <style>
            #map {
                width: 100%;
                height: 500px;
            }
        </style>
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($message = Session::get('success'))
                    <div id="alert-success" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg mb-4 animate-bounce-in-down" role="alert">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 12a5 5 0 1110 0 5 5 0 01-10 0z"></path>
                            </svg>
                            <span class="font-medium">{{ $message }}</span>
                        </div>
                    </div>
                    @endif

                    @if ($message = Session::get('warning'))
                        <div id="alert-warning" class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow-lg mb-4 animate-bounce-in-down" role="alert">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-yellow-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 12a5 5 0 1110 0 5 5 0 01-10 0z"></path>
                                </svg>
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        </div>
                    @endif

                    @if ($message = Session::get('danger'))
                        <div id="alert-danger" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-lg mb-4 animate-bounce-in-down" role="alert">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 12a5 5 0 1110 0 5 5 0 01-10 0z"></path>
                                </svg>
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        </div>
                    @endif
                    <div class="flex justify-between items-center mb-4">
                        <form action="{{ route('absents.index') }}" method="GET" class="flex-grow mr-2 flex">
                            <input type="text" name="search" placeholder="Cari absent" class="border border-gray-300 rounded-lg p-2 w-full " value="{{ request('search') }}">
                            <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow">
                                Search
                            </button>
                        </form>
                        <a href="{{ route('absents.create') }}" class="inline-flex items-center px-4 py-2 m-3 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow">
                            Add absent
                        </a>
                    </div>
                    <table class="table table-bordered" style="width: 100%;">
                        <tr class="bg-gray-100">
                            <th width="5%">No</th>
                            <th width="15%">Nama</th>
                            <th width="15%">Detail Subject</th>
                            <th width="15%">Status</th>
                            <th width="15%">Tanggal Ngajar</th>
                            <th width="10%">Action</th>
                        </tr>
                        @foreach ($data as $key => $absent)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td class="text-center">{{ $absent->name }}</td>
                                <td class="text-center">{{ $absent->detail_subject }}</td>
                                <td class="text-center">{{ $absent->status }}</td>
                                <td class="text-center">{{ $absent->start_date_time }}</td>
                                <td class="text-center">
                                    <a class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow"
                                       href="{{ route('absents.show',$absent->id) }}">
                                        <i class="fa-solid fa-list"></i> Show
                                    </a>
                                    <a class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-black bg-yellow-400 hover:bg-yellow-500 rounded-lg shadow"
                                       href="{{ route('absents.edit',$absent->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('absents.destroy', $absent->id) }}"
                                          style="display:inline" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg shadow" id="btnDelete">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <div class="flex justify-center mt-4">
                        {!! $data->links('layouts.pagination') !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(){
            return confirm("Are you sure you want to delete this absent?")
        }

        setTimeout(function() {
        let alertTypes = ['alert-success', 'alert-warning', 'alert-danger'];

        alertTypes.forEach(function(id) {
            let alertElement = document.getElementById(id);
            if (alertElement) {
                alertElement.style.transition = 'opacity 0.5s ease';
                alertElement.style.opacity = '0';
                setTimeout(function() { alertElement.remove(); }, 500);
            }
        });
        }, 5000);
    </script>
</x-app-layout>
