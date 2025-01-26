<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/set-cookie', function () {
    Cookie::queue(Cookie::make('test_cookie', 'HelloWorld', 60)); 
    return response('Cookie has been set!');
});

Route::get('/get-cookie', function () {
    $value = Cookie::get('test_cookie');
    return response('Cookie value: ' . $value);
});
