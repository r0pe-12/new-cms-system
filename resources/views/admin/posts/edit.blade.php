<x-admin-master>
    @section('content')

        <h1>Edit Post</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
            </div>
        @endif

        <form method="post" action="{{route('post.update', $post)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter Posts Title" value="{{$post->title}}">
            </div>

            <div class="form-group">
                <div class="img-fluid"><img src="{{$post->post_image}}" height="100" alt=""></div>
                <label for="file">File</label>
                <input type="file" name="post_image" class="form-control" id="post_image">
            </div>

            <div class="form-group">
                <textarea name="body" id="body" class="form-control" cols="30" rows="10" placeholder="Enter Posts Body">{{$post->body}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    @endsection
</x-admin-master>
