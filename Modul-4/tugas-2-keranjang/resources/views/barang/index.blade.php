@extends('layouts.app')

@section('content')

<h1>Daftar Barang</h1>

<p>
    Isi keranjang:
    <strong>{{ $jumlahKeranjang }}</strong>
</p>

<a href="{{ route('keranjang.index') }}">
    Lihat Keranjang
</a>

<hr>

@foreach ($barang as $item)

    <div class="card">

        <h3>
            {{ $item->nama }}
        </h3>

        <p>
            Harga:
            Rp {{ number_format(
                $item->harga,
                0,
                ',',
                '.'
            ) }}
        </p>

        <p>
            Stok:
            {{ $item->stok }}
        </p>

        <form
            method="POST"
            action="{{ route(
                'keranjang.tambah',
                $item
            ) }}"
        >
            @csrf

            <button type="submit">
                Masukkan ke Keranjang
            </button>
        </form>

    </div>

@endforeach

@endsection