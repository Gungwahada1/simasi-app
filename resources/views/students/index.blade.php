<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{--                    <div class="row">--}}
                    {{--                        <div class="col-lg-12 margin-tb">--}}
                    {{--                            <div class="pull-left">--}}
                    {{--                                <h2>Users Management</h2>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="pull-right">--}}
                    {{--                                <a class="btn btn-success mb-2" href="{{ route('users.create') }}"><i--}}
                    {{--                                        class="fa fa-plus"></i> Create New User</a>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    {{--                    @session('success')--}}
                    {{--                    <div class="alert alert-success" role="alert">--}}
                    {{--                        {{ $value }}--}}
                    {{--                    </div>--}}
                    {{--                    @endsession--}}

                    <a href="{{ route('students.create') }}" class="inline-flex items-center px-4 py-2 m-3 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow">
                        Add User
                    </a>
                    <table class="table table-bordered" style="width: 100%;">
                        <tr class="bg-gray-100">
                            <th width="5%">No</th>
                            <th width="15%">Name</th>
                            <th width="15%">Grade</th>
                            <th width="15%">Gender</th>
                            <th width="10%">Action</th>
                        </tr>
                        @foreach ($data as $key => $student)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td class="text-center">{{ $student->name }}</td>
                                <td class="text-center">{{ $student->grade }}</td>
                                <td class="text-center">{{ $student->gender }}</td>
                                {{--                                <td>--}}
                                {{--                                    @if($user->getRoleNames()->isNotEmpty())--}}
                                {{--                                        @foreach($user->getRoleNames() as $v)--}}
                                {{--                                            <label class="badge bg-success">{{ $v }}</label>--}}
                                {{--                                        @endforeach--}}
                                {{--                                    @endif--}}
                                {{--                                </td>--}}
                                <td class="text-center">
                                    <a class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow"
                                       href="{{ route('students.show',$student->id) }}">
                                        <i class="fa-solid fa-list"></i> Show
                                    </a>
                                    <a class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow"
                                       href="{{ route('students.edit',$student->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('students.destroy', $student->id) }}"
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

                    {!! $data->links('pagination::bootstrap-5') !!}

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