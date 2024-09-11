@extends('template.layouts.user_type.auth')

@section('content')
<style>
    .button-container {
        display: flex;
        justify-content: space-between;
      }
  
      .fancy-button {
        padding: 8px 30px;
        border: none;
        border-radius: 5px;
        font-size: 30px;
        cursor: pointer; /* Indicate clickable button */
        background-color: #5100c1; /* Adjust background color as desired */
        color: rgb(255, 255, 255); /* Text color */
        transition: all 0.2s ease-in-out; /* Add smooth transition effects */
      }
  
      .fancy-button:hover {
        background-color: #c5005f;
        color: rgb(246, 246, 246); /* Adjust hover background color */
      }
  
      .fancy-button:active {
        transform: translateY(2px); /* Simulate button press effect */
      }
      .welcome-text span {
        display: inline-block;
        font-size: 25px;
        font-weight: bold;
        animation: color-change 1s infinite alternate; 
        text-shadow: #1a2126;/* Optional color animation */
      }
  
      @keyframes color-change {
        from { color: rgb(217, 255, 0); }
        to { color: #0008f2; } /* Change to desired final color */
      }
      
  </style>

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Mode Manual</h6>
              {{-- <p>Pengertian Mode Jadwal</p> --}}
            </div>
            <div class="card-body px-4 pt-0 pb-2">
                <h6>Status Pompa : {{strtoupper($data->tombol)}}</h6>
                <ul class="list-group">
                    <li class="list-group-item border-0 px-0">
                    <div class="form-check form-switch ps-0">
                        <form action="" method="POST">
                        @csrf
                        @method('put')
                        @if($data->tombol == 'off')
                        <input type="hidden" id="hiddenInput" name="tombol" value="ON">
                        <button type="submit" class="fancy-button">Nyalakan Pompa</button>
                        @elseif($data->tombol == 'on')
                        <input type="hidden" id="hiddenInput" name="tombol" value="OFF">
                        <button type="submit" class="fancy-button">Matikan Pompa</button>
                        @endif                          
                        </form>
                    </div>
                    </li>
                </ul>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </main>
  
  @endsection
