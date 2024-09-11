@extends('template.layouts.app')
@include('template.layouts.navbars.auth.sidebar')
            <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
                @include('template.layouts.navbars.auth.nav')
                @yield('content')
            </div>
