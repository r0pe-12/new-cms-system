<x-admin-master>

    @section('content')

        <h1>User Profile for : {{$user->name}}</h1>

        @if(session('user-updated'))
            <div class="alert alert-success">
                {{ session('user-updated') }}
            </div>
        @elseif(session('user-role-attached'))
            <div class="alert alert-success">
                {{ session('user-role-attached') }}
            </div>
        @elseif(session('user-role-detached'))
            <div class="alert alert-success">
                {{ session('user-role-detached') }}
            </div>
        @endif
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

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
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
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td><input type="checkbox" {{$user->hasRole($role->slug) ? 'checked' : ''}}></td>
                                            <td>{{$role->id}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>{{$role->slug}}</td>

                                            <td>
                                                @if(Auth::user()->hasRole('admin'))
                                                        <form method="post" action="{{route('user.role.attach', [$user, $role])}}" enctype="multipart/form-data">
                                                            @method('PUT')
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary"
                                                    @if($user->hasRole($role->slug))
                                                        disabled
                                                    @endif
                                                            >Attach</button>
                                                        </form>
                                                @endif
                                            </td>

                                            <td>
                                                    <a href="#" data-toggle="modal" data-target="#detachModal-{{ $user->id . '-' . $role->name }}" class="{{ $user->hasRole($role->slug)? 'btn': 'btn disabled' }}">
                                                        <button class="btn btn-danger" {{ $user->hasRole($role->slug)?: 'disabled' }}>Detach</button>
                                                    </a>
                                            </td>
                                        </tr>
{{--                                        MODAL ????--}}
                                        <div class="modal fade" id="detachModal-{{ $user->id . '-' . $role->name }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to detach role '{{ $role->name }}' from {{ $user->name }}</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body alert alert-danger">This action is not reversible</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                                        <form method="post" action="{{route('user.role.detach', [$user, $role])}}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-danger">DETACH</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                <tfoot>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </tfoot>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

</x-admin-master>
