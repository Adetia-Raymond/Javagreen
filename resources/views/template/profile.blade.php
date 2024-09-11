
@extends('template.layouts.user_type.auth')

@section('content')
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../assets/img/profil.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                Alec Thompson
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                User
              </p>
            </div>
          </div>
          
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        
        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Profile Information</h6>
                </div>
                <div class="col-md-4 text-end">
                  <a href="javascript:;">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <p class="text-sm">
                Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).
              </p>
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; Alec M. Thompson</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; (44) 123 1234 123</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; alecthompson@mail.com</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; USA</li>
                
              </ul>
            </div>
          </div>
        </div>
        
        <div class="col-12 col-xl-4">
          <p></p>
          <div class="card h-10">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Informasi Perangkat</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                {{-- <form action="{{ route('template.profile') }}" method="POST"> --}}
                  {{-- @csrf
                  @method('PUT') --}}
                  <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                    
                    <div class="d-flex align-items-start flex-column justify-content-center">
                      <div class="mb-3">
                          <div class="text">
                            <input id="token" for="token" value="{{ old('token') }}" type="token" class="form-control" placeholder="Masukan Token Arduino" aria-label="Email" aria-describedby="email-addon">
                            <button type="submit" class="btn bg-gradient-info w-80 mt-4 mb-0" >Simpan</button>
                          </div>
                      </div>
                      
                      <h6 class="mb-0 text-sm">Sophie B.</h6>
                      <p class="mb-0 text-xs">Token</p>
                    </div>
                    
                    <a class="btn btn-link pe-3 ps-0 mb-1 ms-auto mt-3" >Hapus Perangkat</a>
                  </li>
              </form>
              </ul>
            </div>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>

@endsection

