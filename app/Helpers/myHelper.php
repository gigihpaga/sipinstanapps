<?php

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

if (!function_exists('getMenus')) {
    function getMenus()
    {

        return Menu::with('subMenus')->where('type', 'main_menu')->get();
    }
}
