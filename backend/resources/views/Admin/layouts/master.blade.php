<div class="body flex-grow-1 px-3">
    @if (\Session::has('message'))
    <div class="alert alert-success">
        <ul style="margin: 0">
            <li id="message" style="list-style: none">{!! \Session::get('message') !!}</li>
        </ul>
    </div>
    @elseif(\Session::has('error'))
    <div class="alert alert-danger">
        <ul style="margin: 0">
            <li id="message" style="list-style: none">{!! \Session::get('error') !!}</li>
        </ul>
    </div>
    @endif
    @yield('content')
</div>
