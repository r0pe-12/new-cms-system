<x-admin-master>

    @section('content')

    @if(session('post-deleted'))
            <div class="alert alert-danger">
                {{session('post-deleted')}}
            </div>
        @elseif(session('post-created'))
            <div class="alert alert-success">
                {{session('post-created')}}
            </div>
        @elseif(session('post-updated'))
            <div class="alert alert-success">
                {{session('post-updated')}}
            </div>
        @else
            <h1>All Posts</h1>
    @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Created by User</th>
                            <th>DELETE</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td><a href="{{route('post.edit', $post)}}">{{$post->title}}</a></td>
                                {{--                        <td><a href="{{$post->post_image}}" target="_blank">Image</a></td>--}}
                                <td>
                                    <a href="{{$post->post_image}}" target="_blank">
                                        <img src="{{$post->post_image}}" alt="" height="50">
                                    </a>
                                </td>
                                <td>{{$post->created_at->diffForHumans()}}</td>
                                <td>{{$post->updated_at->diffForHumans()}}</td>
                                <td>{{$post->user->name}}</td>
                                <td>
                                    @can('view', $post)
                                        <form method="post" action="{{route('post.destroy', $post->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">DELETE</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Created by User</th>
                            <th>DELETE</th>
                        </tr>
                        </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


{{--        <div class="d-flex">--}}
{{--            <div class="mx-auto">--}}
{{--                {{$posts->links()}}--}}
{{--            </div>--}}
{{--        </div>--}}
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection

</x-admin-master>
