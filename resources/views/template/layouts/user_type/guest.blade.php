@extends('template.layouts.app')

@section('guest')
    @if(\Request::is('login/forgot-password')) 
        @include('template.layouts.navbars.guest.nav')
        @yield('content') 
    @else
        <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12">
                    @include('template.layouts.navbars.guest.nav')
                </div>
            </div>
        </div>
        @yield('content')        
        @include('template.layouts.footers.guest.footer')
    @endif
@endsection