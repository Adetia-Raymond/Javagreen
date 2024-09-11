@extends('template.layouts.user_type.auth')

@section('content')

    {{-- script jquery --}}
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ ('jquery/jquery.min.js') }}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

    {{-- script ajax untuk membaca link url php untuk data suhu dan kelembaban setiap 1 detik --}}
    <script type="text/javascript">
        $(document).ready(function() {

          //Val
          var statusText =
              "{{ abs($data->updated_at->diffInSeconds($currentDateTime)) >= 30 ? 'TIDAK AKTIF' : 'AKTIF' }}";
          setInterval(() => {
              $("#suhu").load("{{ url('bacasuhu', $data->id) }}")
              $("#kelembaban").load("{{ url('bacakelembaban', $data->id) }}")
              $("#soil").load("{{ url('bacasoil', $data->id) }}")
              $("#aktifStatus").load("{{ url('cekstatus', $data->id) }}");
          }, 1000);


          var ctx = document.getElementById('liveChart').getContext('2d');
          var liveChart = new Chart(ctx, {
              type: 'line',
              data: {
                  labels: [], // Time labels
                  datasets: [{
                      label: 'Suhu',
                      borderColor: 'rgb(255, 99, 132)',
                      fill: false,
                      data: [] // Suhu data
                  }, {
                      label: 'Kelembaban',
                      borderColor: 'rgb(54, 162, 235)',
                      fill: false,
                      data: [] // Kelembaban data
                  }, {
                      label: 'Soil Moisture',
                      borderColor: 'rgb(75, 192, 192)',
                      fill: false,
                      data: [] // Soil moisture data
                  }]
              },
              options: {
                  scales: {
                      x: {
                          type: 'time',
                          time: {
                              unit: 'minute',
                              tooltipFormat: 'MMM D, h:mm:ss a',
                              displayFormats: {
                                  minute: 'h:mm:ss a'
                              }
                          },
                          title: {
                              display: true,
                              text: 'Time'
                          }
                      },
                      y: {
                          beginAtZero: true,
                          title: {
                              display: true,
                              text: 'Sensor Readings'
                          }
                      }
                  }
              }
          });

          // Function to add new data and update the chart
          function updateChart(sensor, response){
              liveChart.data.labels.push(new Date()); // Add current timestamp
              sensor.data.push(response); // Update sensor data
              
              if (liveChart.data.labels.length > 6) { // Limit to 6 points
                  liveChart.data.labels.shift(); // Remove oldest timestamp
                  liveChart.data.datasets.forEach(dataset => {
                      dataset.data.shift(); // Remove oldest data point
                  });
              }
              
              liveChart.update(); // Update the chart
          }
          
          // Update every 10 minutes (600000 milliseconds)
          setInterval(() => {
              $("#suhu").load("{{url('bacasuhu',$data->id)}}", function(response){
                  updateChart(liveChart.data.datasets[0], response);
              });
              $("#kelembaban").load("{{url('bacakelembaban',$data->id)}}", function(response){
                  updateChart(liveChart.data.datasets[1], response);
              });
              $("#soil").load("{{url('bacasoil',$data->id)}}", function(response){
                  updateChart(liveChart.data.datasets[2], response);
              });
              }, 600000); // 600000 ms = 10 minutes

        });

    </script>



    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Suhu Udara</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <p></p>
                                    <span id="suhu" class="text-bold text-xl"></span> <span>°C</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-thermometer-empty text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Kelembaban Udara</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <p></p>
                                    <span id="kelembaban" class="text-bold text-xl"></span> <span>%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-empire text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Kelembaban Tanah</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <p></p>
                                    <span id="soil" class="text-bold text-xl"></span> <span>%</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-sun-o text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Koneksi Perangkat</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <p></p>
                                    <span id="aktifStatus" class="text-bold text-xl"></span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-microchip text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .dropbtn {
            background-color: #a200bb;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            width: 100%;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            /* Initially hidden (optional) */
            position: absolute;
            width: 100%;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover~.dropbtn {
            background-color: #3e8e41;
        }
    </style>

    <style>
        .button-container {
            display: flex;
            justify-content: space-between;
        }

        .fancy-button {
            width: 100%;
            padding: 8px 30px;
            border: none;
            border-radius: 5px;
            font-size: 25px;
            cursor: pointer;
            /* Indicate clickable button */
            background-color: #be00cc;
            /* Adjust background color as desired */
            color: rgb(255, 255, 255);
            /* Text color */
            transition: all 0.2s ease-in-out;
            /* Add smooth transition effects */
        }

        .fancy-button:hover {
            background-color: #b90041;
            color: rgb(246, 246, 246);
            /* Adjust hover background color */
        }

        .fancy-button:active {
            transform: translateY(2px);
            /* Simulate button press effect */
        }

        .welcome-text span {
            display: inline-block;
            font-size: 25px;
            font-weight: bold;
            animation: color-change 1s infinite alternate;
            text-shadow: #1a2126;
            /* Optional color animation */
        }

        @keyframes color-change {
            from {
                color: rgb(217, 255, 0);
            }

            to {
                color: #0008f2;
            }

            /* Change to desired final color */
        }

        .fancy-select-mode {
            width: 100%;
            padding: 8px 3px;
            border: #4d0049 solid 2px;
            border-radius: 5px;
            font-size: 20px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            background-color: #fae3ff;
            color: rgb(0, 0, 0);
            transition: all 0.2s ease-in-out;
        }

        .fancy-select-jadwal {
            padding: 8px 10px;
            border: #000000 solid 2px;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            transition: all 0.2s ease-in-out;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .fancy-button-jadwal {
            padding: 8px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            /* Indicate clickable button */
            background-color: #1a2126;
            /* Adjust background color as desired */
            color: #fff;
            /* Text color */
            transition: all 0.2s ease-in-out;
            /* Add smooth transition effects */
        }

        .fancy-button-jadwal:hover {
            background-color: #ee00ff;
            color: #ffc0f8;
            /* Adjust hover background color */
        }

        .fancy-button-jadwal:active {
            transform: translateY(2px);
            /* Simulate button press effect */
        }

        .bordered-table {
            width: 100%;
            border-collapse: collapse;
            /* Ensures borders don't overlap between cells */
            border: 2px solid #9c00e4;
        }

        .bordered-table th,
        .bordered-table td {
            border: 1px solid #9c00e4;
            text-align: center;
            /* Sets 1px solid gray borders for each cell */
        }
    </style>



    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex flex-column h-100">
                                @php
                                    $path = str_replace('-', ' ', Request::path());
                                    $segments = explode('/', $path);
                                    $tokenurl = $segments[0];
                                @endphp
                                <h5 class="font-weight-bolder">MODE ALAT SAAT INI:</h5>
                                {{-- <span>{{$tokenurl}}</span> --}}
                                <h3>
                                    {{ strtoupper($modealat->mode) }}
                                </h3>

                                @if ($modealat->mode == 'manual')
                                    <h5>
                                        POMPA SAAT INI : {{ strtoupper($datamanual->tombol) }}
                                    </h5>
                                    <form action="{{ route('updatemanual') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        @if ($datamanual->tombol == 'off')
                                            <input type="hidden" id="hiddenInput" name="tombol" value="on">
                                            <input type="hidden" id="hiddenInput" name="crypttoken"
                                                value="{{ $tokenurl }}">
                                            <button type="submit" class="fancy-button">Nyalakan Pompa</button>
                                        @elseif($datamanual->tombol == 'on')
                                            <input type="hidden" id="hiddenInput" name="tombol" value="off">
                                            <input type="hidden" id="hiddenInput" name="crypttoken"
                                                value="{{ $tokenurl }}">
                                            <button type="submit" class="fancy-button">Matikan Pompa</button>
                                        @endif
                                    </form>
                                    <p></p>
                                @elseif($modealat->mode == 'auto')
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 px-0">
                                            <div class="form-check form-switch ps-0">
                                                <h5>Saat ini alat akan menyiram pada kelembaban tanah kurang dari
                                                    {{ $dataauto->kelembaban_tanah }}%</h5>
                                                <form action="{{ route('updateauto') }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <select name="kelembaban_tanah" class="fancy-select-mode">
                                                        <?php
                                                        for ($i = 1; $i <= 100; $i++) {
                                                            echo "<option value='$i'>$i</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <p></p>
                                                    <input type="hidden" id="hiddenInput" name="crypttoken"
                                                        value="{{ $tokenurl }}">
                                                    <button type="submit" class="fancy-button">Ubah Parameter</button>
                                                </form>
                                            </div>
                                    </ul>
                                @elseif($modealat->mode == 'jadwal')
                                    <form method="POST" action="{{ route('tambahjadwal') }}">
                                        @csrf
                                        <div class="card-body p-3">
                                            <h6 class="text-uppercase text-body text-xs font-weight-bolder">Pengaturan
                                                Jadwal (Hari / Jam / Menit)</h6>
                                            <ul class="list-group">
                                                <li class="list-group-item border-0 px-0">
                                                    <div class="form-check form-switch ps-0">
                                                        <select name="hari" id="menit"
                                                            class="fancy-select-jadwal">
                                                            <option value="0">Minggu</option>
                                                            <option value="1">Senin</option>
                                                            <option value="2">Selasa</option>
                                                            <option value="3">Rabu</option>
                                                            <option value="4">Kamis</option>
                                                            <option value="5">Jumat</option>
                                                            <option value="6">Sabtu</option>
                                                        </select>
                                                        <select name="jam" id="hour"
                                                            class="fancy-select-jadwal">
                                                            <?php
                                                            for ($i = 0; $i < 25; $i++) {
                                                                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                                echo "<option value='$hour'>$hour</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        :
                                                        <select name="menit" id="menit"
                                                            class="fancy-select-jadwal">
                                                            <?php
                                                            for ($i = 0; $i < 61; $i++) {
                                                                $minute = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                                echo "<option value='$minute'>$minute</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body p-3">
                                            <h6 class="text-uppercase text-body text-xs font-weight-bolder">Lama Penyiraman
                                                (detik)</h6>
                                            <ul class="list-group">
                                                <li class="list-group-item border-0 px-0">
                                                    <div class="form-check form-switch ps-0">

                                                        <select name="delay" class="fancy-select-jadwal">
                                                            <?php
                                                            for ($i = 1; $i < 61; $i++) {
                                                                $second = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                                echo "<option value='$second'>$second</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="list-group-item border-0 px-0">
                                                    <div class="form-check form-switch ps-0">
                                                        <input type="hidden" id="hiddenInput" name="crypttoken"
                                                            value="{{ $tokenurl }}">

                                                        <button type="submit" class="fancy-button">
                                                            Tambahkan Jadwal
                                                        </button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>

                                    {{-- TABEL JADWAL --}}
                                    <div class="px-3 pb-3" style="overflow-x:auto;">
                                        <table class="bordered-table">
                                            <!-- Table header -->
                                            <thead class="text-[13px] text-slate-500/70">
                                                <tr>
                                                    <th
                                                        class="px-1 py-2 first:pl-3 last:pr-3 bg-slate-100 first:rounded-l last:rounded-r last:pl-5 last:sticky last:right-0">
                                                        <div class="font-medium text-left">No.</div>
                                                    </th>
                                                    <th
                                                        class="px-1 py-2 first:pl-3 last:pr-3 bg-slate-100 first:rounded-l last:rounded-r last:pl-5 last:sticky last:right-0">
                                                        <div class="font-medium text-left">Hari</div>
                                                    </th>

                                                    <th
                                                        class="px-1 py-2 first:pl-3 last:pr-3 bg-slate-100 first:rounded-l last:rounded-r last:pl-5 last:sticky last:right-0">
                                                        <div class="font-medium text-left">Waktu</div>
                                                    </th>

                                                    <th
                                                        class="px-1 py-2 first:pl-3 last:pr-3 bg-slate-100 first:rounded-l last:rounded-r last:pl-5 last:sticky last:right-0">
                                                        <div class="font-medium text-left">Lama Penyiraman</div>
                                                    </th>

                                                    <th
                                                        class="px-1 py-2 first:pl-3 last:pr-3 bg-slate-100 first:rounded-l last:rounded-r last:pl-5 last:sticky last:right-0">
                                                        <div class="font-medium text-left sr-only">Opsi</div>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <!-- Table body -->

                                            <tbody class="text-sm font-medium">
                                                @foreach ($datajadwal as $index => $item)
                                                    <!-- Row -->
                                                    <tr>
                                                        <td
                                                            class="px-1 py-3 border-b border-slate-200 last:border-none first:pl-3 last:pr-3 last:bg-gradient-to-r last:from-transparent last:to-white last:to-[12px] last:pl-5 last:sticky last:right-0">
                                                            <div class="text-slate-500">{{ $index + 1 }}</div>
                                                        </td>
                                                        <td
                                                            class="px-1 py-3 border-b border-slate-200 last:border-none first:pl-3 last:pr-3 last:bg-gradient-to-r last:from-transparent last:to-white last:to-[12px] last:pl-5 last:sticky last:right-0">
                                                            <div class="flex items-center">
                                                                <div class="text-slate-900">{{ $weekDays["$item->hari"] }}
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td
                                                            class="px-1 py-3 border-b border-slate-200 last:border-none first:pl-3 last:pr-3 last:bg-gradient-to-r last:from-transparent last:to-white last:to-[12px] last:pl-5 last:sticky last:right-0">
                                                            @php
                                                                $jam = $item->jam;
                                                                $menit = $item->menit;

                                                                $jam = strval($jam);
                                                                $menit = strval($menit);
                                                            @endphp
                                                            @if (strlen($jam) == 1 && strlen($menit) == 1)
                                                                <div class="text-slate-500">
                                                                    0{{ $jam }}:0{{ $menit }}</div>
                                                            @elseif (strlen($jam) == 1)
                                                                <div class="text-slate-500">
                                                                    0{{ $jam }}:{{ $menit }}</div>
                                                            @elseif (strlen($menit) == 1)
                                                                <div class="text-slate-500">
                                                                    {{ $jam }}:0{{ $menit }}</div>
                                                            @else
                                                                <div class="text-slate-500">
                                                                    {{ $jam }}:{{ $menit }}</div>
                                                            @endif
                                                        </td>

                                                        <td
                                                            class="px-1 py-3 border-b border-slate-200 last:border-none first:pl-3 last:pr-3 last:bg-gradient-to-r last:from-transparent last:to-white last:to-[12px] last:pl-5 last:sticky last:right-0">
                                                            <div class="text-slate-900">{{ $item->delay / 1000 }} Detik
                                                            </div>
                                                        </td>

                                                        {{-- @csrf --}}
                                                        {{-- @method('DELETE') --}}
                                                        <td
                                                            class="px-1 py-3 border-b border-slate-200 last:border-none first:pl-3 last:pr-3 last:bg-gradient-to-r last:from-transparent last:to-white last:to-[12px] last:pl-5 last:sticky last:right-0">
                                                            {{-- <a class="fancy-button-jadwal" href="{{url($tokenurl,$item->id.'/hapusJadwal')}}">HAPUS</a> --}}
                                                            <a class="fancy-button-jadwal"
                                                                href="{{ route('hapusjadwal', [$tokenurl, $item->id]) }}">HAPUS</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <!-- Row -->

                                            </tbody>

                                        </table>
                                    </div>
                                @endif
                                <div class="dropdown">
                                    <button class="dropbtn" style="font-weight: bold; font-size:20px">Ganti dan Setting
                                        Mode</button>
                                    <div class="dropdown-content">
                                        <a href="{{ 'mode-manual' }}" style="font-weight: bold; font-size:20px">MODE
                                            MANUAL</a>
                                        <a href="{{ 'mode-auto' }}" style="font-weight: bold; font-size:20px">MODE
                                            AUTO</a>
                                        <a href="{{ 'mode-jadwal' }}" style="font-weight: bold; font-size:20px">MODE
                                            TERJADWAL</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
              <div class="bg-gradient-primary border-radius-lg h-100">
                <img src="../assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                <div class="position-relative d-flex align-items-center justify-content-center h-100">
                  <img class="w-100 position-relative z-index-2 pt-4" src="../assets/img/illustrations/Pot.png" alt="rocket">
                </div>
              </div>
            </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card h-100 p-3">
                <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100"
                    style="background-image: url('../assets/img/dashboard.png');">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                        <h5 class="text-white font-weight-bolder mb-4 pt-2">Dapatkan Tips Merawat Tanaman</h5>
                        <p class="text-white">Kunjungi laman kami untuk mendapatkan tips merawat tanaman yang baik dan
                            benar.</p>
                        <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                            Read More
                            <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('dashboard')
    <script>
        window.onload = function() {
            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Sales",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "#fff",
                        data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                        maxBarThickness: 6
                    }, ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: 500,
                                beginAtZero: true,
                                padding: 15,
                                font: {
                                    size: 14,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#fff"
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false
                            },
                            ticks: {
                                display: false
                            },
                        },
                    },
                },
            });


            var ctx2 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
            gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                            label: "Mobile apps",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#cb0c9f",
                            borderWidth: 3,
                            backgroundColor: gradientStroke1,
                            fill: true,
                            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                            maxBarThickness: 6

                        },
                        {
                            label: "Websites",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#3A416F",
                            borderWidth: 3,
                            backgroundColor: gradientStroke2,
                            fill: true,
                            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                            maxBarThickness: 6
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#b2b9bf',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        }
    </script>
@endpush
