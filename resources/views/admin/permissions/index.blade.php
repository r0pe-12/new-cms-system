<x-admin-master>
    @section('content')
        @if(session('permission-created'))
            <div class="alert alert-success">
                {{ session('permission-created') }}
            </div>
        @elseif(session('permission-deleted'))
            <div class="alert alert-success">
                {{ session('permission-deleted') }}
            </div>
        @elseif(session('permission-updated'))
            <div class="alert alert-success">
                {{ session('permission-updated') }}
            </div>
        @endif

        @error('name')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <div class="row">
            <div class="col-4">
                <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Permission Name:</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="" placeholder="" value="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                </form>
            </div>
            <div class="col-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>DELETE</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="6">
                                        <a href="#" data-toggle="modal" data-target="#newRoleModal">
                                            <button class="btn btn-outline-primary btn-block">CREATE NEW PERMISSION</button>
                                        </a>
                                    </td>
                                </tr>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td><a href="{{ route('permission.edit', $permission) }}">{{ $permission->name }}</a></td>
                                        <td>{{ $permission->slug }}</td>
                                        <td>{{ $permission->created_at->diffForHumans() }}</td>
                                        <td>{{ $permission->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <form method="post" action="{{route('permission.destroy', $permission)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-block">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>DELETE</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create new Permission:</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">??</span>
                                </button>
                            </div>
                            <form method="post" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Permission Name:</label>
                                    <input type="text" name="name" class="form-control" id="name" aria-describedby="" placeholder="" value="">
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--laravel paginator--}}
                <div class="d-flex">
                    <div class="mx-auto">
                        {{$permissions->links()}}
                    </div>
                </div>
            </div>
        </div>

    @endsection
</x-admin-master>
