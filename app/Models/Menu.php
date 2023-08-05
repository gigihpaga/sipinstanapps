<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subMenus()
    {
        // relasi ke dirinya sendiri one-to-many, main_menu mempunya banyak sub_menu
        return $this->hasMany(Menu::class, 'parrent_menu_id');
    }
}
