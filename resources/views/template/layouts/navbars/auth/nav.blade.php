<!-- Navbar -->
<style>
    .navbar{
        background: -webkit-linear-gradient(to right, #e53f15, #b31e9f);
            /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #e53f15, #b31e9f);
    }
    h6{
        color: white
    }
    a{
        color: white
    }
</style>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-4">
        <nav aria-label="breadcrumb">
            <h6 class="font-weight-bolder mb-0 text-capitalize">Java Green</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">

            <div class="ms-md-3 pe-md-3 d-flex align-items-center">

            </div>
            <ul class="navbar-nav  justify-content-end">

                <a href="{{ route('menutoken') }}" style="padding-right: 30px">
                    <i class="fa fa-microchip me-sm-1 pr-4"></i>
                    Kelola Alat</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i class="fa fa-user me-sm-1"></i>

                        {{ __('Log Out') }}
                    </a>
                </form>
            </ul>
        </div>
    </div>
</nav>
<hr>
<!-- End Navbar -->
