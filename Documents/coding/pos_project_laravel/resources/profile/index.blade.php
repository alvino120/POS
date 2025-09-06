@extends('layouts.app')

@section('content')
<div class="container">
    <h3>My Profile</h3>
    <div class="card p-3">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Dibuat sejak:</strong> {{ $user->created_at->format('d M Y') }}</p>
    </div>
</div>
@endsection
