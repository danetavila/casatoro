<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('products', 'ProductController');

Route::get('test', function () {

    $rows = collect([0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);

    $inventory = \App\Models\Inventory::whereNull('sale_id')
        ->orderByDesc('position')
        ->get();

    $inventory->each(function ($product) use (&$rows) {
        $rows[$product->position] = 1;
    });

    $rows = $rows->filter(function ($row) {
        return $row === 0;
    });

    dd($rows->chunk(4)->first()->keys()->random());

    dd(rand(1, $rows->chunk(4)->first()->count()));
});
