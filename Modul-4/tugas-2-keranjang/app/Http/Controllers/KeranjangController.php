<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KeranjangController extends Controller
{
    private function bacaKeranjang(Request $request): array
    {
        $data = $request->cookie('keranjang');

        if (!$data) {
            return [];
        }

        $keranjang = json_decode($data, true);

        return is_array($keranjang)
            ? $keranjang
            : [];
    }

    private function cookieKeranjang(array $keranjang)
    {
        return cookie(
            'keranjang',
            json_encode($keranjang),
            60 * 24 * 7
        );
    }

    public function index(Request $request): View
    {
        $barang = Barang::orderBy('id')->get();

        $keranjang = $this->bacaKeranjang($request);

        $jumlahKeranjang = array_sum($keranjang);

        return view(
            'barang.index',
            compact(
                'barang',
                'jumlahKeranjang'
            )
        );
    }

    public function keranjang(Request $request): View
    {
        $keranjang = $this->bacaKeranjang($request);

        $products = Barang::whereIn(
            'id',
            array_keys($keranjang)
        )->get();

        $items = [];

        $total = 0;

        foreach ($products as $product) {
            $jumlah = (int) (
                $keranjang[$product->id] ?? 0
            );

            $subtotal =
                $product->harga * $jumlah;

            $total += $subtotal;

            $items[] = [
                'barang' => $product,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal,
            ];
        }

        return view(
            'keranjang.index',
            compact(
                'items',
                'total'
            )
        );
    }

    public function tambah(
        Request $request,
        Barang $barang
    ): RedirectResponse {
        $keranjang =
            $this->bacaKeranjang($request);

        $jumlah =
            (int) ($keranjang[$barang->id] ?? 0);

        if ($jumlah >= $barang->stok) {
            return back()->withErrors([
                'stok' => 'Jumlah tidak boleh melebihi stok.',
            ]);
        }

        $keranjang[$barang->id] =
            $jumlah + 1;

        return back()
            ->with(
                'success',
                'Barang ditambahkan ke keranjang.'
            )
            ->cookie(
                $this->cookieKeranjang(
                    $keranjang
                )
            );
    }

    public function tambahJumlah(
        Request $request,
        Barang $barang
    ): RedirectResponse {
        $keranjang =
            $this->bacaKeranjang($request);

        $jumlah =
            (int) ($keranjang[$barang->id] ?? 0);

        if ($jumlah >= $barang->stok) {
            return back()->withErrors([
                'stok' => 'Jumlah tidak boleh melebihi stok.',
            ]);
        }

        $keranjang[$barang->id] =
            $jumlah + 1;

        return back()->cookie(
            $this->cookieKeranjang(
                $keranjang
            )
        );
    }

    public function kurangJumlah(
        Request $request,
        Barang $barang
    ): RedirectResponse {
        $keranjang =
            $this->bacaKeranjang($request);

        if (!isset($keranjang[$barang->id])) {
            return back();
        }

        $keranjang[$barang->id]--;

        if ($keranjang[$barang->id] <= 0) {
            unset($keranjang[$barang->id]);
        }

        return back()->cookie(
            $this->cookieKeranjang(
                $keranjang
            )
        );
    }

    public function hapus(
        Request $request,
        Barang $barang
    ): RedirectResponse {
        $keranjang =
            $this->bacaKeranjang($request);

        unset($keranjang[$barang->id]);

        return back()->cookie(
            $this->cookieKeranjang(
                $keranjang
            )
        );
    }

    public function kosongkan(): RedirectResponse
    {
        return redirect()
            ->route('keranjang.index')
            ->withoutCookie('keranjang');
    }
}