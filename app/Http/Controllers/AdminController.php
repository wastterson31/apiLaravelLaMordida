<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function ShowAdmin()
    {
        return view('admin.WilcomeAdminView');
    }

    public function ShowAdminFilter($id)
    {

        $url = env('URL_SERVER_API');

        $response = Http::get($url . 'v1/categories');
        $categories = $response->json('data');

        $response = Http::get($url . 'v1/categories/' . $id);
        $products = $response->json('data');


        return view('admin.product.AdminProductView', ['products' => $products, 'categories' => $categories]);
    }
}
