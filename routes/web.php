<?php
namespace App\Routes;

use App\Core\Routing\Route;


Route::get("/", ['HomeController','index']);
Route::get("/a", ['HomeController','index2']);
