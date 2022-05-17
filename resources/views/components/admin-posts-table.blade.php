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
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
{{--                        <td><a href="{{$post->post_image}}" target="_blank">Image</a></td>--}}
                        <td>
                            <a href="{{$post->post_image}}" target="_blank">
                                <img src="{{$post->post_image}}" alt="" height="50">
                            </a>
                        </td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                        <td>{{$post->user->name}}</td>
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
                    </tr>
                </tfoot>
                </tbody>
            </table>
        </div>
    </div>
</div>
