@extends('products.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-3">
        <h2>Data Produk</h2>
        <a class="btn btn-success float-right" href="{{ route('products.create') }}">Buat Produk Baru</a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Detail</th>
        <th width="280px">Aksi</th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $product->nama }}</td>
        <td>{{ $product->detail }}</td>
        <td>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Lihat</a>
                <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>

                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $products->links() !!}
@endsection
