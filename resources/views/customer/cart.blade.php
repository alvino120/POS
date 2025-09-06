<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Saya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: 'Poppins', sans-serif; margin: 0; background:#f4f6f9; }
        .container { max-width: 900px; margin: 30px auto; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 3px 8px rgba(0,0,0,.1); }
        h2 { margin-top: 0; display:flex; justify-content:space-between; align-items:center; }
        .btn { display:inline-block; padding:8px 12px; border:0; border-radius:8px; cursor:pointer; }
        .btn-danger { background:#e74c3c; color:#fff; }
        .btn-outline { background:#fff; color:#e74c3c; border:1px solid #e74c3c; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #fae6e6ff; }
        .empty { color: #888; }
    </style>
    </head>
<body>
    <div class="container">
        <h2>
            <span>Pesanan Saya</span>
            @if(!$cartItems->isEmpty())
            <form action="{{ route('cart.clear') }}" method="POST" style="margin:0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline">Kosongkan</button>
            </form>
            <form action="#" method="POST">
                 @csrf
                <button type="submit" class="btn btn-success">Checkout</button>
            </form>
            @endif

        </h2>
        @if($cartItems->isEmpty())
            <p class="empty">Belum ada pesanan.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Gambar</th>
                        <th>Kuantitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name ?? '-' }}</td>
                            <td>
                                @if(($item->product->image_path ?? null))
                                    <img src="{{ asset('image.produk/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" style="height:60px; border-radius:6px;">
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>


