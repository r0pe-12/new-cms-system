<x-admin-master>

    @section('content')

        @if(Auth::user()->hasRole('admin'))
            <h1 class="h3 mb-4 text-gray-800">{{Auth::user()->name}}</h1>
        @endif

    @endsection

</x-admin-master>
