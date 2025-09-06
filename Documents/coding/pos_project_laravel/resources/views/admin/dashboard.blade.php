@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p
                                    class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Pendapatan
                                </p>
                                <h5 class="font-weight-bolder">
                                    Rp {{ number_format($todayRevenue ?? 0, 0, ',', '.') }}
                                </h5>
                                <p class="mb-0">
                                    <span
                                        class="text-success text-sm font-weight-bolder">+55%</span>
                                    sejak hari ini
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div
                                class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i
                                    class="ni ni-money-coins text-lg opacity-10"
                                    aria-hidden="true"></i>
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
                                <p
                                    class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Pengguna
                                </p>
                                <h5 class="font-weight-bolder">
                                    {{ $totalUsers ?? 0 }}
                                </h5>
                                <p class="mb-0">
                                    <span
                                        class="text-success text-sm font-weight-bolder">+3%</span>
                                    sejak minggu lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div
                                class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i
                                    class="ni ni-world text-lg opacity-10"
                                    aria-hidden="true"></i>
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
                                <p
                                    class="text-sm mb-0 text-uppercase font-weight-bold">
                                    client
                                    baru
                                </p>
                                <h5 class="font-weight-bolder">
                                    +{{ $newClientsQuarter ?? 0 }}
                                </h5>
                                <p class="mb-0">
                                    <span
                                        class="text-danger text-sm font-weight-bolder">-2%</span>
                                    sejak kuartal lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div
                                class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i
                                    class="ni ni-paper-diploma text-lg opacity-10"
                                    aria-hidden="true"></i>
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
                                <p
                                    class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Total
                                    Penjualan
                                </p>
                                <h5 class="font-weight-bolder">
                                    Rp {{ number_format($totalSales ?? 0, 0, ',', '.') }}
                                </h5>
                                <p class="mb-0">
                                    <span
                                        class="text-success text-sm font-weight-bolder">+5%</span>
                                    sejak bulan lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div
                                class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i
                                    class="ni ni-cart text-lg opacity-10"
                                    aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Pesanan Terbaru</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelanggan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produk</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Qty</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($recentOrders ?? []) as $idx => $order)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td>{{ optional($order->created_at)->format('d/m/Y H:i') }}</td>
                                <td>{{ $order->customer->nama ?? $order->user->nama ?? '-' }}</td>
                                <td>{{ $order->product->name ?? '-' }}</td>
                                <td>{{ $order->quantity ?? 0 }}</td>
                                <td>
                                    @php
                                    $total = isset($order->harga_total)
                                    ? (float) $order->harga_total
                                    : ((isset($order->product) && isset($order->quantity)) ? (float) $order->quantity * (float) $order->product->price : 0);
                                    @endphp
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-sm text-muted">Belum ada pesanan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Sales overview</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">4% more</span>
                        in 2025
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas
                            id="chart-line"
                            class="chart-canvas"
                            height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div
                class="card card-carousel overflow-hidden h-100 p-0">
                <div
                    id="carouselExampleCaptions"
                    class="carousel slide h-100"
                    data-bs-ride="carousel">
                    <div
                        class="carousel-inner border-radius-lg h-100">
                        <div
                            class="carousel-item h-100 active"
                            style="
                                            background-image: url('../assets/img/carousel-1.jpg');
                                            background-size: cover;
                                        ">
                            <div
                                class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div
                                    class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i
                                        class="ni ni-camera-compact text-dark opacity-10"></i>
                                </div>
                                <h5 class="text-white mb-1">
                                    Get started with Argon
                                </h5>
                                <p>
                                    There’s nothing I really wanted
                                    to do in life that I wasn’t able
                                    to get good at.
                                </p>
                            </div>
                        </div>
                        <div
                            class="carousel-item h-100"
                            style="
                                            background-image: url('../assets/img/carousel-2.jpg');
                                            background-size: cover;
                                        ">
                            <div
                                class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div
                                    class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i
                                        class="ni ni-bulb-61 text-dark opacity-10"></i>
                                </div>
                                <h5 class="text-white mb-1">
                                    Faster way to create web pages
                                </h5>
                                <p>
                                    That’s my skill. I’m not really
                                    specifically talented at
                                    anything except for the ability
                                    to learn.
                                </p>
                            </div>
                        </div>
                        <div
                            class="carousel-item h-100"
                            style="
                                            background-image: url('../assets/img/carousel-3.jpg');
                                            background-size: cover;
                                        ">
                            <div
                                class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div
                                    class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i
                                        class="ni ni-trophy text-dark opacity-10"></i>
                                </div>
                                <h5 class="text-white mb-1">
                                    Share with us your design tips!
                                </h5>
                                <p>
                                    Don’t be afraid to be wrong
                                    because you can’t learn anything
                                    from a compliment.
                                </p>
                            </div>
                        </div>
                    </div>
                    <button
                        class="carousel-control-prev w-5 me-3"
                        type="button"
                        data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span
                            class="carousel-control-prev-icon"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button
                        class="carousel-control-next w-5 me-3"
                        type="button"
                        data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span
                            class="carousel-control-next-icon"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                </div>
                </td>
                </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header pb-0 p-3">

            </div>
        </div>
        <div class="d-flex">
            <button
                class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                <i
                    class="ni ni-bold-right"
                    aria-hidden="true"></i>
            </button>
        </div>
        </li>
        </ul>
    </div>
</div>
</div>
</div>
<div
    class="row align-items-center justify-content-lg-between">
    <div class="col-lg-6 mb-lg-0 mb-4">
        <div
            class="copyright text-center text-sm text-muted text-lg-start">
            ©
            <script>
                document.write(
                    new Date().getFullYear()
                );
            </script>
            , made with <i class="fa fa-heart"></i> by
            <a
                href="https://www.creative-tim.com"
                class="font-weight-bold"
                target="_blank">Creative Tim</a>
            for a better web.
        </div>
    </div>
    <div class="col-lg-6">
    </div>
</div>
</div>
</footer>
</div>
</main>
@endsection
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p
                                    class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Pendapatan
                                </p>
                                <h5 class="font-weight-bolder">
                                    Rp {{ number_format($todayRevenue ?? 0, 0, ',', '.') }}
                                </h5>
                                <p class="mb-0">
                                    <span
                                        class="text-success text-sm font-weight-bolder">+55%</span>
                                    sejak hari ini
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div
                                class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i
                                    class="ni ni-money-coins text-lg opacity-10"
                                    aria-hidden="true"></i>
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
                                <p
                                    class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Pengguna
                                </p>
                                <h5 class="font-weight-bolder">
                                    {{ $totalUsers ?? 0 }}
                                </h5>
                                <p class="mb-0">
                                    <span
                                        class="text-success text-sm font-weight-bolder">+3%</span>
                                    sejak minggu lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div
                                class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i
                                    class="ni ni-world text-lg opacity-10"
                                    aria-hidden="true"></i>
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
                                <p
                                    class="text-sm mb-0 text-uppercase font-weight-bold">
                                    client
                                    baru
                                </p>
                                <h5 class="font-weight-bolder">
                                    +{{ $newClientsQuarter ?? 0 }}
                                </h5>
                                <p class="mb-0">
                                    <span
                                        class="text-danger text-sm font-weight-bolder">-2%</span>
                                    sejak kuartal lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div
                                class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i
                                    class="ni ni-paper-diploma text-lg opacity-10"
                                    aria-hidden="true"></i>
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
                                <p
                                    class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Total
                                    Penjualan
                                </p>
                                <h5 class="font-weight-bolder">
                                    Rp {{ number_format($totalSales ?? 0, 0, ',', '.') }}
                                </h5>
                                <p class="mb-0">
                                    <span
                                        class="text-success text-sm font-weight-bolder">+5%</span>
                                    sejak bulan lalu
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div
                                class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i
                                    class="ni ni-cart text-lg opacity-10"
                                    aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Pesanan Terbaru</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelanggan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produk</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Qty</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($recentOrders ?? []) as $idx => $order)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td>{{ optional($order->created_at)->format('d/m/Y H:i') }}</td>
                                <td>{{ $order->customer->nama ?? $order->user->nama ?? '-' }}</td>
                                <td>{{ $order->product->name ?? '-' }}</td>
                                <td>{{ $order->quantity ?? 0 }}</td>
                                <td>
                                    @php
                                    $total = isset($order->harga_total)
                                    ? (float) $order->harga_total
                                    : ((isset($order->product) && isset($order->quantity)) ? (float) $order->quantity * (float) $order->product->price : 0);
                                    @endphp
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-sm text-muted">Belum ada pesanan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Sales overview</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">4% more</span>
                        in 2025
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas
                            id="chart-line"
                            class="chart-canvas"
                            height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div
                class="card card-carousel overflow-hidden h-100 p-0">
                <div
                    id="carouselExampleCaptions"
                    class="carousel slide h-100"
                    data-bs-ride="carousel">
                    <div
                        class="carousel-inner border-radius-lg h-100">
                        <div
                            class="carousel-item h-100 active"
                            style="
                                            background-image: url('../assets/img/carousel-1.jpg');
                                            background-size: cover;
                                        ">
                            <div
                                class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div
                                    class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i
                                        class="ni ni-camera-compact text-dark opacity-10"></i>
                                </div>
                                <h5 class="text-white mb-1">
                                    Get started with Argon
                                </h5>
                                <p>
                                    There’s nothing I really wanted
                                    to do in life that I wasn’t able
                                    to get good at.
                                </p>
                            </div>
                        </div>
                        <div
                            class="carousel-item h-100"
                            style="
                                            background-image: url('../assets/img/carousel-2.jpg');
                                            background-size: cover;
                                        ">
                            <div
                                class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div
                                    class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i
                                        class="ni ni-bulb-61 text-dark opacity-10"></i>
                                </div>
                                <h5 class="text-white mb-1">
                                    Faster way to create web pages
                                </h5>
                                <p>
                                    That’s my skill. I’m not really
                                    specifically talented at
                                    anything except for the ability
                                    to learn.
                                </p>
                            </div>
                        </div>
                        <div
                            class="carousel-item h-100"
                            style="
                                            background-image: url('../assets/img/carousel-3.jpg');
                                            background-size: cover;
                                        ">
                            <div
                                class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div
                                    class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i
                                        class="ni ni-trophy text-dark opacity-10"></i>
                                </div>
                                <h5 class="text-white mb-1">
                                    Share with us your design tips!
                                </h5>
                                <p>
                                    Don’t be afraid to be wrong
                                    because you can’t learn anything
                                    from a compliment.
                                </p>
                            </div>
                        </div>
                    </div>
                    <button
                        class="carousel-control-prev w-5 me-3"
                        type="button"
                        data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span
                            class="carousel-control-prev-icon"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button
                        class="carousel-control-next w-5 me-3"
                        type="button"
                        data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span
                            class="carousel-control-next-icon"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                </div>
                </td>
                </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header pb-0 p-3">

            </div>
        </div>
        <div class="d-flex">
            <button
                class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                <i
                    class="ni ni-bold-right"
                    aria-hidden="true"></i>
            </button>
        </div>
        </li>
        </ul>
    </div>
</div>
</div>
</div>
<div
    class="row align-items-center justify-content-lg-between">
    <div class="col-lg-6 mb-lg-0 mb-4">
        <div
            class="copyright text-center text-sm text-muted text-lg-start">
            ©
            <script>
                document.write(
                    new Date().getFullYear()
                );
            </script>
            , made with <i class="fa fa-heart"></i> by
            <a
                href="https://www.creative-tim.com"
                class="font-weight-bold"
                target="_blank">Creative Tim</a>
            for a better web.
        </div>
    </div>
    <div class="col-lg-6">
    </div>
</div>
</div>
</footer>
</div>
</main>
@endsection
