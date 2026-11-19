<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    // inisialisasi tabel category_product
    protected $table = 'category_product';

    // inisialisasi primary key
    protected $primaryKey = 'id_category';

    // kolom yang tidak dapat diisi secara massal
    protected $guarded = ['id_category'];
}