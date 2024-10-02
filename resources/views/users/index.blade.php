<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
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

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                            <label class="badge bg-success">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}"><i
                                            class="fa-solid fa-list"></i> Show</a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i
                                            class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                          style="display:inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fa-solid fa-trash"></i> Delete
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
