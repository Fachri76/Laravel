<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barang = [
            [
                'nama' => 'Buku Tulis',
                'harga' => 5000,
                'stok' => 20,
            ],
            [
                'nama' => 'Pulpen',
                'harga' => 3000,
                'stok' => 30,
            ],
            [
                'nama' => 'Penggaris',
                'harga' => 4000,
                'stok' => 15,
            ],
            [
                'nama' => 'Pensil 2B',
                'harga' => 2500,
                'stok' => 25,
            ],
            [
                'nama' => 'Penghapus',
                'harga' => 1500,
                'stok' => 20,
            ],
        ];

        foreach ($barang as $item) {
            Barang::create($item);
        }
    }
}