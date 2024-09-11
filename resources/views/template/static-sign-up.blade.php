@extends('template.layouts.user_type.auth')

@section('content')
    <style>
        th {
            padding-bottom: 15px;
            padding-right: 10px;
            font-size: 20px;
        }

        tr {
            text-align: left
        }

        input {
            border-radius: 10px;
            padding-left: 10px;
            width: 100%
        }

        button {
            scale: 1.4;
            /* margin-left: 70px; */
            margin-top: 25px;
            border-radius: 10px;
            background-color: rgb(148, 148, 197);
            padding-left: 15px;
            padding-right: 15px;
            border: 1px solid black;
            font-family: Arial;
        }

        label {
            font-size: 18px
        }

        a {
            font-family: Arial;
            font-size: 17px;
        }
    </style>

    {{-- <section class="min-vh-100 mb-8"> --}}
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
        style="background-image: url('../assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Registrasi</h1>
                    <p class="text-lead text-white">Silahkan daftar akun baru</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-5 col-lg-7 col-md-8 mx-auto">
                <div class="card z-index-0">
                    <div class="card-body">

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <table>
                                {{-- Name --}}
                                <tr>
                                    <th>
                                        <label for="name">Nama
                                    </th>
                                    <th>
                                        {{-- <x-text-input id="name" class="mt-1 w-auto" type="text"
                                                name="name" :value="old('name')" required autofocus autocomplete="name" />
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
                                        <input id="name" type="text" name="name" :value="old('name')" required
                                            autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </th>
                                </tr>


                                {{-- Email --}}
                                <tr>
                                    <th>
                                        <label for="email">Email
                                    </th>
                                    <th>
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                            :value="old('email')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </th>
                                </tr>

                                {{-- Password --}}
                                <tr>
                                    <th>
                                        <label for="password">Password
                                    </th>
                                    <th>
                                        <x-text-input id="password" class="block mt-1 w-full" type="password"
                                            name="password" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </th>
                                </tr>

                                {{-- Confirm Password --}}
                                <tr>
                                    <th>
                                        <label for="password_confirmation">Konfirmasi Password
                                    </th>
                                    <th>
                                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                            name="password_confirmation" required autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </th>
                                </tr>

                                <tr style="text-align: center;">
                                    <th>
                                            <a href="{{ route('utama') }}" class="text-info text-gradient font-weight-bold">
                                                {{ __('Sudah Memiliki Akun?') }}
                                            </a>
                                    </th>
                                    <th>
                                        <button type="input" class="btn bg-gradient-info w-50 mt-4 mb-0">
                                            {{ __('Daftar') }}
                                        </button>
                                    </th>
                                </tr>
                            </table>

                            <div class="mt-3">



                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </section> --}}
@endsection
