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
        @else
            <h1>All Posts</h1>
    @endif

        <x-admin-posts-table :posts="$posts">

        </x-admin-posts-table>

    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection

</x-admin-master>
