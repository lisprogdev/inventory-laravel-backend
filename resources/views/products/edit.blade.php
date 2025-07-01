@extends('products.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-3">
        <h2>Edit Produk</h2>
        <a class="btn btn-primary" href="{{ route('products.index') }}">Kembali</a>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Ups!</strong> Ada beberapa masalah dengan input Anda.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <strong>Nama:</strong>
        <input type="text" name="nama" value="{{ $product->nama }}" class="form-control" placeholder="Nama">
    </div>

    <div class="form-group">
        <strong>Detail:</strong>
        <textarea class="form-control" name="detail" style="height:150px">{{ $product->detail }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>
@endsection
