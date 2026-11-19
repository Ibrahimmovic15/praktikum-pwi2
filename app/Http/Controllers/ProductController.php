<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $data_toko = [
            'nama_toko' => 'Ibrahim',
            'alamat_toko' => 'Jl. Terus Jadian Kagak',
            'status_toko' => 'Belum Pasti'
        ];

        // kita gunakan Eloquent ORM
        // data terbaru di atas, 10 data per halaman (pagination)
        $data_product = Product::orderBy('id_product', 'desc')->paginate(10);

        return view('pages.product.show', [
            'data_toko' => $data_toko,
            'data_produk' => $data_product,
        ]);
    }

    public function addProduct()
    {
        return view('pages.product.addProduct');
    }

    public function store(Request $request)
    {
        // validasi setiap data yang diinputkan
        $request->validate([
            'name_product' => 'required|min:4|max:20',
            'stock_product' => 'required|integer|min:0',
            'price_product' => 'required|integer|min:0',
            'desc_product' => 'required',
        ], [
            'name_product.required' => 'Nama produk wajib diisi.',
            'name_product.min' => 'Nama produk minimal 4 karakter.',
            'name_product.max' => 'Nama produk maksimal 20 karakter.',
            'stock_product.required' => 'Stok produk wajib diisi.',
            'stock_product.integer' => 'Stok produk harus berupa angka bulat.',
            'stock_product.min' => 'Stok produk tidak boleh kurang dari 0.',
            'price_product.required' => 'Harga produk wajib diisi.',
            'price_product.integer' => 'Harga produk harus berupa angka bulat.',
            'price_product.min' => 'Harga produk tidak boleh kurang dari 0.',
            'desc_product.required' => 'Deskripsi produk wajib diisi.',
        ]);

        // tambahkan data dari form ke database
        Product::create([
            'name_product' => $request->name_product,
            'stock_product' => $request->stock_product,
            'price_product' => $request->price_product,
            'desc_product' => $request->desc_product,
            'id_category' => rand(1, 3), // kategori diacak dari 1 sampai 3
        ]);

        // kembali ke halaman produk + pesan sukses
        return redirect('/product')->with('message', 'Data Berhasil Ditambahkan');
    }

    // BARU Modul 10: menampilkan detail produk berdasarkan id
    public function show($id)
    {
        // findOrFail: kalau id nggak ada, otomatis tampil halaman 404
        $produk_detail = Product::findOrFail($id);

        return view('pages.product.detail', [
            'detail_produk' => $produk_detail
        ]);
    }

    // BARU Modul 10: menampilkan form edit dengan data lama
    public function edit($id)
    {
        $data_product = Product::findOrFail($id);

        return view('pages.product.editProduct', [
            'updated_produk' => $data_product,
        ]);
    }

    // BARU Modul 10: menyimpan perubahan data
    public function update($id, Request $request)
    {
        // validasi sama seperti store()
        $request->validate([
            'name_product' => 'required|min:4|max:20',
            'stock_product' => 'required|integer|min:0',
            'price_product' => 'required|integer|min:0',
            'desc_product' => 'required',
        ], [
            'name_product.required' => 'Nama produk wajib diisi.',
            'name_product.min' => 'Nama produk minimal 4 karakter.',
            'name_product.max' => 'Nama produk maksimal 20 karakter.',
            'stock_product.required' => 'Stok produk wajib diisi.',
            'stock_product.integer' => 'Stok produk harus berupa angka bulat.',
            'stock_product.min' => 'Stok produk tidak boleh kurang dari 0.',
            'price_product.required' => 'Harga produk wajib diisi.',
            'price_product.integer' => 'Harga produk harus berupa angka bulat.',
            'price_product.min' => 'Harga produk tidak boleh kurang dari 0.',
            'desc_product.required' => 'Deskripsi produk wajib diisi.',
        ]);

        // update data (id_category sengaja nggak diubah)
        Product::findOrFail($id)->update([
            'name_product' => $request->name_product,
            'stock_product' => $request->stock_product,
            'price_product' => $request->price_product,
            'desc_product' => $request->desc_product,
        ]);

        return redirect('/product')->with('message', 'Data Berhasil Diupdate');
    }

    // BARU Modul 10: menghapus produk
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect('/product')->with('message', 'Data Berhasil Dihapus');
    }
}