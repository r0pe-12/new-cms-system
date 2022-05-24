<x-admin-master>

    @section('content')

        <h1>User Profile for: {{$user->name}}</h1>

        <div class="row">
            <div class="col-sm-6">
                <form method="" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
{{--                        <img src="https://via.placeholder.com/900x900.png/000000?text=user%20photo" alt="" width="60px">--}}
                    </div>
                    <div class="form-group">
                        <input type="file">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="" placeholder="" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="" aria-describedby="" placeholder="" >
                    </div>
                    <div class="form-group">
                        <label for="pass-confirm">Confirm Password</label>
                        <input type="password" name="password-confirmation" class="form-control" id="password-confirmation" aria-describedby="">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endsection

</x-admin-master>
