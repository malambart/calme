@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @include('layouts.nav')
                </div>
                    @yield('navLevel2')
                    @yield('navLevel3')
                    @yield('navLevel4')
                    @yield('navLevel5')
                <div class="panel-body">
                    @yield('body')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection