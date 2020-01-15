<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // $fillable = kolom yg boleh diisi sisanya engga. kalo $guarded kebalikannya
    protected $fillable = ['title', 'parent_id', 'url', 'icon', 'order', 'is_active'];
}
