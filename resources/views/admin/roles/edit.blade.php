<x-admin-master>
    @section('content')
        @if(session('role-clean'))
            <div class="alert alert-success">
                {{ session('role-clean') }}
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
    @endsection
</x-admin-master>
