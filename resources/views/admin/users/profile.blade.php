<x-admin-master>

    @section('content')

        <h1>User Profile for: {{$user->name}}</h1>

        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="{{route('user.profile.update', $user)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <img src="{{$user->avatar}}" class="img-profile rounded-3">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" aria-describedby="" placeholder="" value="{{$user->username}}">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="file" name="avatar" id="avatar" value="{{$user->avatar}}">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" aria-describedby="" placeholder="" value="{{$user->name}}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="" value="{{$user->email}}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="" aria-describedby="" placeholder="" >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" aria-describedby="">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endsection

</x-admin-master>
