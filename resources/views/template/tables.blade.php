@extends('template.layouts.user_type.auth')

@section('content')
    {{-- @if (\Request::is('suskes'))
        <script type="text/javascript">
            function sukses(){
                alert('sukses')
            };
            sukses();
        </script>
    @endif --}}

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h4>Kelola Pot Pintar</h4>
                        </div>
                        <div class="card-body pl-5 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">

                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-10">
                                                Pot Pintar</th>
                                            <th
                                                class="text-uppercase text-secondary text-s font-weight-bolder opacity-10 ps-2">
                                                Nama Pot</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>

                                    <style>
                                        .poticon {
                                            vertical-align: middle;
                                            margin-left: 14px;
                                            border-radius: 50%
                                        }
                                    </style>

                                    <tbody>
                                        @foreach ($datatoken as $data => $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('assets/icon/poticon.jpg') }}" alt="icon_pot"
                                                        width="100" height="100" class="poticon">
                                                </td>

                                                <td>
                                                    <p class="text-s font-weight-bold mb-0">{{ $item->nama_alat }}</p>
                                                </td>

                                                <td>
                                                    <a href="{{ "$item->token" . '/main' }}"
                                                        class="btn bg-gradient-info w-100 mb-0">
                                                        Kelola Pot
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <style>
                        .btn-pink-moon {
                            background: #ec008c;
                            /* fallback for old browsers */
                            background: -webkit-linear-gradient(to right, #fc6767, #ec008c);
                            /* Chrome 10-25, Safari 5.1-6 */
                            background: linear-gradient(to right, #fc6767, #ec008c);
                            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                            color: #fff;
                            border: 3px solid #eee;
                            width: 100%
                        }
                    </style>
                    <div class="card mb-4">
                        <div class="card-body pl-5 pt-4 pb-2">
                            <a href="{{ route('scan') }}">
                                <button class="btn btn-pink-moon">Tambahkan Pot Pintar</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
