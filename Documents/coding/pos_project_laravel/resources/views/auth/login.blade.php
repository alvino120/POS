@extends('layouts.guest')

@section('content')
<section>
    <div class="page-header min-vh-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-start">
                            <h4 class="font-weight-bolder">Masuk ke Toko Jaya</h4>
                            <p class="mb-0">Masukkan email dan password anda untuk login.</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('/auth/login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" required value="{{ old('password') }}">
                                </div>

                                <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Login</button>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                Tidak memiliki akun ?
                                <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Daftar Sekarang</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                    <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
                                background-size: cover;">
                        <span class="mask bg-gradient-primary opacity-6"></span>
                        <h4 class="mt-5 text-white font-weight-bolder position-relative">Kepuasan pelanggan adalah kunci kesuksesan.</h4>
                        <p class="text-white position-relative">Jangan lupa 5S <br /> ( Senyum, Sapa, Sopan, Santun, Sukses ).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection