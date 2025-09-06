@auth
<style>
  .dropdown-menu.show {
    display: block;
  }

  .dropdown-toggle::after {
    display: none !important;
  }

  .dropdown-toggle::before {
    display: none !important;
  }
</style>
<!-- Navbar -->
<nav
  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl"
  id="navbarBlur"
  data-scroll="false">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol
        class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm">
          <a class="opacity-5 text-white" href="javascript:;">Pages</a>
        </li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">
          Dashboard
        </li>
      </ol>
      <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <div class="input-group">
          <span class="input-group-text text-body">
            <i class="fas fa-search" aria-hidden="true"></i>
          </span>
          <input type="text" class="form-control" placeholder="Type here..." />
        </div>
      </div>
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item dropdown d-flex align-items-center">
          <a type="button" class="nav-link text-white font-weight-bold px-0 dropdown-toggle" href="#"
            id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->nama }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" id="dropdownMenuCustom">
            <li>
              <a class="dropdown-item" href="#">
                <i class="fa fa-id-card me-2"></i> My Profile
              </a>
            </li>
            <li>
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item">
                  <i class="fa fa-sign-out me-2"></i> Logout
                </button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Javascript -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const dropdownToggle = document.getElementById("userDropdown");
    const dropdownMenu = document.getElementById("dropdownMenuCustom");

    // toggle ketika tombol diklik
    dropdownToggle.addEventListener("click", function(e) {
      e.preventDefault();
      e.stopPropagation();
      dropdownMenu.classList.toggle("show");
    });

    // tutup dropdown kalau klik di luar
    document.addEventListener("click", function(e) {
      if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.classList.remove("show");
      }
    });
  });
</script>
<!-- End Navbar -->
@endauth