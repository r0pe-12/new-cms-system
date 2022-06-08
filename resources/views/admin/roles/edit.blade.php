<x-admin-master>
    @section('content')
        @if(session('role-clean'))
            <div class="alert alert-success">
                {{ session('role-clean') }}
            </div>
        @elseif(session('role-permission-attached'))
            <div class="alert alert-success">
                {{ session('role-permission-attached') }}
            </div>
        @elseif(session('role-permission-detached'))
            <div class="alert alert-success">
                {{ session('role-permission-detached') }}
            </div>
        @endif
        <h1>Edit role: {{ $role->name }}</h1>


        <div class="row">
            <div class="col-4">
                <form method="post" action="{{ route('role.update', $role) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name"></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="" placeholder="{{ $role->name }}" value="{{ $role->name }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
        <div class="row">
            @if($permissions->isNotEmpty())
                <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                    <th>DELETE</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td>
                                                <input type="checkbox" @if($role->hasPermission($permission->slug)) checked @endif>
                                            </td>
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->slug }}</td>
                                            <td>{{ $permission->created_at->diffForHumans() }}</td>
                                            <td>{{ $permission->updated_at->diffForHumans() }}</td>
                                            <td>
                                                <form method="post" action="{{ route('role.permission.attach', [$role, $permission]) }}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-primary" @if($role->hasPermission($permission->slug)) disabled @endif>Attach</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" action="{{route('role.permission.detach', [$role, $permission])}}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-danger" @if(!$role->hasPermission($permission->slug)) disabled @endif>Detach</button>
                                                </form>
                                            </td>
                                            <td><button class="btn btn-outline-danger">Delete</button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <td>Attach</td>
                                    <th>Detach</th>
                                    <th>DELETE</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
{{--                laravel paginator--}}
                <div class="d-flex">
                    <div class="mx-auto">
                        {{$permissions->links()}}
                    </div>
                </div>
            </div>
            @endif
        </div>
    @endsection
</x-admin-master>
