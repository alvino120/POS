@extends('layouts.app')
@section('title', 'registration')
@section('content')

<div class="page-header pb-8 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
  <span class="mask bg-gradient-dark opacity-6"></span>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 text-center mx-auto">
        <h1 class="text-white mb-2 mt-5">Selamat Datang di TOKO JAYA</h1>
        <p class="text-lead text-white">Penuhi kebutuhan harian anda dengan berbagai pilihan produk menarik kami!</p>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
      <div class="card z-index-0">

        <div class="card-body">
          {{-- Menampilkan error validasi --}}
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form method="POST" action="{{ url('/auth/register') }}">
            @csrf

            <div class="mb-3">
              <input
                type="text"
                class="form-control @error('nama') is-invalid @enderror"
                name="nama"
                placeholder="Masukkan Nama Anda"
                value="{{ old('nama') }}"
                required
                autofocus>

              @error('nama')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <input
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                placeholder="Masukkan Email Anda"
                value="{{ old('email') }}"
                required>
              @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <input
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                placeholder="Masukkan Password Anda"
                required
                autocomplete="new-password">
              @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <input
                type="password"
                class="form-control"
                name="password_confirmation"
                placeholder="Confirm Password"
                required
                autocomplete="new-password">
            </div>

            <div class="form-check form-check-info text-start mb-3">
              <input
                class="form-check-input"
                type="checkbox"
                value="1"
                id="terms"
                name="terms"
                required>
              <label class="form-check-label" for="terms">
                Saya setuju dengan <a href="javascript:;" class="text-dark font-weight-bolder">Kebijakan Privasi</a>
              </label>
            </div>

            <div class="text-center">
              <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar Sekarang</button>
            </div>

            <p class="text-sm mt-3 mb-0">
              Sudah memiliki akun ?
              <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Login disini</a>
            </p>

          </form>


        </div>

      </div>
    </div>
  </div>
</div>

@endsection