<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
public function showIndex()
{
    return view('home');
}


public function showArray()
{
    $array = [
['id' => 1, 'title' => 'продукт 1', 'price' => 500, 'path' => 'cat1.jpg'],
['id' => 2, 'title' => 'продукт 2', 'price' => 1500, 'path' => 'cat2.jpg'],

];
}
}
