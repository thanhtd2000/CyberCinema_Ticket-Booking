<div class="body flex-grow-1 px-3">

    @if (\Session::has('message') && \Session::has('errors'))
        <div class="alert alert-success">
            <ul style="margin: 0">
                <li id="message" style="list-style: none">{!! \Session::get('message') !!}</li>
            </ul>
        </div>
        <div class="alert alert-danger">
            <ul style="margin: 0">
                <li id="message" style="list-style: none">{!! \Session::get('errors') !!}</li>
            </ul>
        </div>
    @elseif(Session::has('errors'))
    <script>
        toastr.options = {
            "progressBar" : true,
            'timeOut'     : 1500,
        }
        toastr.error("{{Session::get('errors') }}");
     </script>
    @elseif(Session::has('message'))
         <script>
            toastr.options = {
                "progressBar" : true,
                'timeOut'     : 1000,
            }
            toastr.success("{{Session::get('message') }}",{timeOut:100});
         </script>
        {{-- <div class="alert alert-success">
           <ul style="margin: 0">
                <li id="message" style="list-style: none">{!! \Session::get('message') !!}</li>
            </ul>
        </div>  --}}
    @endif

    @yield('content')
</div>
