<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Web')->group(function (){
   Route::any('index/{type?}', 'IndexController');
});