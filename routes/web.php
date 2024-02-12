<?php
namespace App\Routes;

use App\Core\Routing\Route;
use App\Middleware\BlockFirefox;


Route::get("/", ['HomeController','index'], [BlockFirefox::class]);
Route::get("/a", ['HomeController','index2']);
