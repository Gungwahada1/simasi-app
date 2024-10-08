<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subjects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($message = Session::get('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg mb-4 animate-bounce-in-down" role="alert">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 12a5 5 0 1110 0 5 5 0 01-10 0z"></path>
                            </svg>
                            <span class="font-medium">{{ $message }}</span>
                        </div>
                    </div>                    
                    @endif
                    <a href="{{ route('subjects.create') }}" class="inline-flex items-center px-4 py-2 m-3 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow">
                        Add Subject
                    </a>
                    <table class="table table-bordered">
                        <tr class="bg-gray-100">
                            <th width="5%">No</th>
                            <th width="15%">Name</th>
                            <th width="15%">Description</th>
                            <th width="10%">Action</th>
                        </tr>
                        @foreach ($data as $key => $subject)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td class="text-center">{{ $subject->subject_name }}</td>
                                <td class="text-center">{{ $subject->subject_description }}</td>
                                {{--                                <td>--}}
                                {{--                                    @if($subject->getRoleNames()->isNotEmpty())--}}
                                {{--                                        @foreach($subject->getRoleNames() as $v)--}}
                                {{--                                            <label class="badge bg-success">{{ $v }}</label>--}}
                                {{--                                        @endforeach--}}
                                {{--                                    @endif--}}
                                {{--                                </td>--}}
                                <td class="text-center">
                                    <a class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow"
                                       href="{{ route('subjects.show',$subject->id) }}">
                                        <i class="fa-solid fa-list"></i> Show
                                    </a>
                                    <a class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow"
                                       href="{{ route('subjects.edit',$subject->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('subjects.destroy', $subject->id) }}"
                                          style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg shadow">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {!! $data->links('pagination::bootstrap-5') !!}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>