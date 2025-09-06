<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Produk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Style sama seperti kamu */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #2c3e50;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        .main {
            margin-left: 270px;
            padding: 20px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .navbar h2 {
            margin: 0;
        }

        .logout-btn {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #ff6b6b, #e74c3c);
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            text-align: center;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .price {
            color: #27ae60;
            font-weight: bold;
        }

        .buy-button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 8px 15px;
            margin-top: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .buy-button:hover {
            background: #45a049;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .search-bar input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>📚 Toko Jaya</h2>
        <a href="#">Dashboard</a>
        <a href="#">Produk</a>
        <a href="{{ route('cart.index') }}">Pesanan</a>
        <a href="#">Laporan</a>
    </div>

    <!-- Main Content -->
    <div class="main">
        <!-- Navbar -->
        <div class="navbar">
            <h2>Dashboard Produk</h2>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">🚪 Logout</button>
            </form>
        </div>

        <!-- Search Bar (optional) -->
        <div class="search-bar">
            <input type="text" id="searchBar" placeholder="Cari produk...">
        </div>

        <!-- Produk -->
        @if ($product->isEmpty())
        <p>Tidak ada produk.</p>
        @else
        <div class="dashboard">
            @foreach ($product as $product)
            <div class="product-card" data-name="{{ strtolower($product->name) }}">
                @if (!empty($product->image_path))
              <img src="{{ $product->image_path ? asset('image.produk/' . $product->image_path) : asset('images/no-image.png') }}" alt="{{ $product->name }}">

                @else
                <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                @endif

                <h3>{{ $product->name }}</h3>
                <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p>Stok: {{ $product->stock }}</p>

                @if ($product->stock > 0)
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" value="1" />
                    <button type="submit" class="buy-button">Beli</button>
                </form>
                @else
                <button class="buy-button" disabled>Stok habis</button>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <script>
        const searchBar = document.getElementById("searchBar");
        const productCards = document.querySelectorAll(".product-card");

        searchBar.addEventListener("input", () => {
            const query = searchBar.value.toLowerCase();

            productCards.forEach(card => {
                const name = card.getAttribute("data-name");
                card.style.display = name.includes(query) ? "block" : "none";
            });
        });
    </script>

</body>

</html>
