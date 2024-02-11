<?php
namespace App\Routes;

use App\Core\Routing\Route;

Route::get("/a", "this is a");
Route::get("/", "index");
Route::get("/b", "this is b");
Route::get("/c", "this is c");