<x-admin-master>
    @section('content')
        @if(session('permission-clean'))
            <div class="alert alert-success">
                {{ session('permission-clean') }}
            </div>
        @endif
        <h1>Edit permission: {{ $permission->name }}</h1>


        <div class="row">
            <div class="col-4">
                <form method="post" action="{{ route('permission.update', $permission) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name"></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="" placeholder="{{ $permission->name }}" value="{{ $permission->name }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>
