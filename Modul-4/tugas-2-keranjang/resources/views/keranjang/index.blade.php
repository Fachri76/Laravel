@extends('layouts.app')

@section('content')

<h1>Keranjang Belanja</h1>

<p>
    Penyimpanan:
    <strong>Cookies</strong>
</p>

@if (count($items) === 0)

    <p>Keranjang kosong.</p>

@else

    @foreach ($items as $item)

        <div class="card">

            <h3>
                {{ $item['barang']->nama }}
            </h3>

            <p>
                Rp
                {{ number_format(
                    $item['barang']->harga,
                    0,
                    ',',
                    '.'
                ) }}

                x

                {{ $item['jumlah'] }}

                =

                Rp
                {{ number_format(
                    $item['subtotal'],
                    0,
                    ',',
                    '.'
                ) }}
            </p>

            <div style="display:flex; gap:8px; align-items:center;">

                <form
                    method="POST"
                    action="{{ route(
                        'keranjang.minus',
                        $item['barang']
                    ) }}"
                >
                    @csrf

                    <button type="submit">
                        -
                    </button>
                </form>

                <strong>
                    {{ $item['jumlah'] }}
                </strong>

                <form
                    method="POST"
                    action="{{ route(
                        'keranjang.plus',
                        $item['barang']
                    ) }}"
                >
                    @csrf

                    <button type="submit">
                        +
                    </button>
                </form>

                <form
                    method="POST"
                    action="{{ route(
                        'keranjang.hapus',
                        $item['barang']
                    ) }}"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Hapus
                    </button>
                </form>

            </div>

        </div>

    @endforeach

    <h2>
        Total:
        Rp {{ number_format(
            $total,
            0,
            ',',
            '.'
        ) }}
    </h2>

    <form
        method="POST"
        action="{{ route(
            'keranjang.kosongkan'
        ) }}"
    >
        @csrf
        @method('DELETE')

        <button type="submit">
            Kosongkan Keranjang
        </button>
    </form>

@endif

@endsection