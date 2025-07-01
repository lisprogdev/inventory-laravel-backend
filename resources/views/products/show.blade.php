@extends('products.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-3">
        <h2>Detail Produk</h2>
        <a class="btn btn-primary" href="{{ route('products.index') }}">Kembali</a>
    </div>
</div>

<div class="form-group">
    <strong>Nama:</strong>
    {{ $product->nama }}
</div>

<div class="form-group">
    <strong>Detail:</strong>
    {{ $product->detail }}
</div>
@endsection
