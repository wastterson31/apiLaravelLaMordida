<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function ShowHome()
    {
        $url = env('URL_SERVER_API');

        $response = Http::get($url . 'v1/categories');
        $categories = $response->json('data');

        $response = Http::get($url . 'v1/products', ['discount' => true]);
        $offers = $response->json('data');

        return view('Index', ['offers' => $offers, 'categories' => $categories]);
    }



    public function ShowProductsByCategory($id)
    {
        $url = env('URL_SERVER_API');

        $response = Http::get($url . 'v1/categories');
        $categories = $response->json('data');


        if ($id != '0') {
            // Usando la URL base de la API y asumiendo que $id contiene el ID de la categoría deseada
            $response = Http::get($url . 'v1/categories/' . $id . '/products');
            $products = $response->json('data');  // Cambio aquí

            // dd($products);
            //dd($response);
            return view('ProductsView', ['products' => $products, 'categories' => $categories, 'category_id' => $id]);
        } else {
            $response = Http::get($url . 'v1/products');
            $products = $response->json('data');
            return view('ProductsView', ['products' => $products, 'categories' => $categories, 'category_id' => $id]);
        }
    }


    public function ShowProducts()
    {
        $url = env('URL_SERVER_API');

        $response = Http::get($url . 'v1/offers');
        $offers = $response->json('data');

        $response = Http::get($url . 'v1/products');
        $products = $response->json('data');

        $response = Http::get($url . 'v1/categories');
        $categories = $response->json('data');
        // $offers = Product::where('discount', '>', 0)->get();
        // $categories = Category::all();
        // $products = Product::all();

        return view('ProductsView', ['products' => $products, 'offers' => $offers, 'categories' => $categories]);
    }

    public function ShowPredict()
    {
        return view('user.UserPedido');
    }





    public function ShowRegister()
    {
        return view('UserRegisterView');
    }

    public function ShowSession()
    {
        return view('UserLoginView');
    }
    public function ShowSessionAdmin()
    {
        return view('admin.auth.Login');
    }
    public function ShowNOSOTROS()
    {
        return view('Nosotros');
    }

    public function  ShowUserPedido()
    {
        $url = env('URL_SERVER_API');

        $response = Http::get($url . 'v1/user/' . session('user_id') . '/orders');
        $orders = $response->json('data');
        // dd($orders);

        return view('user.UserPedido', ['orders' => $orders]);
    }

    public function ShowAdmin()
    {
        return view('admin/AdminWelcomeView');
    }

    public function ShowAdminProduct()
    {
        return view('admin/AdminProductsView');
    }

    public function ShowAdminCategory()
    {
        return view('admin/AdminCategory');
    }

    public function ShowAdminOrders()
    {
        return view('admin/AdminOrders');
    }
}
