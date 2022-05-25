<x-admin-master>

    @section('content')


        @if(session('user-deleted'))
            <div class="alert alert-danger">
                {{session('user-deleted')}}
            </div>
        @elseif(session('user-created'))
            <div class="alert alert-success">
                {{session('user-created')}}
            </div>
        @elseif(session('user-updated'))
            <div class="alert alert-success">
                {{session('user-updated')}}
            </div>
        @else
            <h1>All Users</h1>
        @endif

{{--            <div class="d-flex">--}}
{{--                <div class="mx-auto">--}}
{{--                    {{$users->links()}}--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Avatar</th>
                                <th>Email</th>
                                <th>Registered At</th>
                                <th>Updated At</th>
                                <th>DELETE</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td><a href="{{route('user.profile.show', $user)}}">{{$user->username}}</a></td>
                                    <td>{{$user->name}}</td>
                                    <td><a href="{{$user->avatar}}"><img src="{{$user->avatar}}" class="img-profile rounded-3" width="50px"></a></td>
                                    <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                    <td>{{$user->created_at->diffForHumans()}}</td>
                                    <td>{{$user->updated_at->diffForHumans()}}</td>
                                    <td>
                                        <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">DELETE</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Avatar</th>
                                <th>Email</th>
                                <th>Registered At</th>
                                <th>Updated At</th>
                                <th>DELETE</th>
                            </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        <div class="d-flex">
            <div class="mx-auto">
                {{$users->links()}}
            </div>
        </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{ $user->username }}</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body alert alert-danger">This action is irreversible</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                            <form method="post" action="{{route('user.destroy', $user)}}" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
{{--                <script src="{{ asset('js/demo/datatables-demo.js')}}"></script>--}}
    @endsection

</x-admin-master>
