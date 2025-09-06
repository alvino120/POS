<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') | Toko Jaya</title>
    <link rel="stylesheet" href="{{ asset('assets/css/argon-dashboard.css?v=2.1.0') }}">
    <style>
        body,
        html {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <body style="overflow:hidden; height:100vh;">
    <main class="container mt-5">
        @yield('content')
    </main>
</body>

</html>