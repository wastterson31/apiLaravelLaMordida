<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = env('URL_SERVER_API');

        $response = Http::get($url . 'v1/products');
        if ($response->successful()) {
            $products = $response->json('data');
            return view('admin.product.AdminProductView', ['products' => $products]);
        } else {
            return back()->withErrors([
                'message' => 'Error al consultar la información del producto'
            ]);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . 'v1/categories');

        if ($response->successful()) {
            $categories = $response->json('data');
            return view('admin.product.CreateProduct', ['categories' => $categories, 'product' => null]);
        } else {
            return back()->withErrors([
                'message' => 'Error al consultar la información de las categorías'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Almacena un nuevo producto en el almacenamiento.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
            'description' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,50',
            'price' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048', // Validación de imagen
            'discount' => 'required|integer',
            'category_id' => 'required'
        ]);

        $extension = $request->image->extension();
        $imageName = time() . '.' . $extension;
        $request->image->move(public_path('public'), $imageName);

        $url = env('URL_SERVER_API');
        $response = Http::post($url . 'v1/products', [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName, // Guardar el nombre de la imagen en la base de datos
            'discount' => $request->discount,
            'category_id' => $request->category_id,
            'delete' => false
        ]);
        if ($response->successful()) {
            return redirect()->route('product.index')->with([
                'message' => 'El producto se registró correctamente'
            ]);
        } else {
            return back()->withErrors([
                'message' => 'Error al registrar la información del producto'
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . 'v1/categories');
        if ($response->successful()) {
            $categories = $response->json('data');

            $response = Http::get($url . 'v1/products/' . $product);
            if ($response->successful()) {
                $product = $response->json('data');
                return view('admin.product.EditProduct', ['categories' => $categories, 'product' => $product]);
            } else {
                return back()->withErrors([
                    'message' => 'Error al consultar la información del producto'
                ]);
            }
        } else {
            return back()->withErrors([
                'message' => 'Error al consultar la información de las categorías'
            ]);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $product)
    {
        $request->validate([
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
            'description' => 'required',
            'price' => 'required|min:1|max:1000000',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            'discount' => 'required|integer',
            'category_id' => 'required'
        ]);

        // Procesar la imagen solo si se proporciona una nueva
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('public/'), $imageName);
        } else {
            // Si no se proporciona una nueva imagen, obtener la información del producto existente
            $url = env('URL_SERVER_API');
            $response = Http::get($url . 'v1/products/' . $product);
            if ($response->successful()) {
                $existingProduct = $response->json('data');
                $imageName = $existingProduct['image'];
            } else {
                return back()->withErrors([
                    'message' => 'Error al obtener la información del producto existente'
                ]);
            }
        }

        $url = env('URL_SERVER_API');
        $response = Http::put($url . 'v1/products/' . $product, [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
            'image' => $imageName, // Agregar la imagen a la solicitud
        ]);

        if ($response->successful()) {
            return redirect()->route('product.index')->with([
                'message' => 'El producto se modificó correctamente'
            ]);
        } else {
            return back()->withErrors([
                'message' => 'Error al modificar la información del producto'
            ]);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
        $url = env('URL_SERVER_API');
        $response = Http::delete($url . 'v1/products/' . $product);

        if ($response->successful()) {
            return redirect()->route('product.index')->with([
                'message' => 'El producto se eliminó correctamente'
            ]);
        } else {
            return back()->withErrors([
                'message' => 'Error al eliminar la información del producto'
            ]);
        }
    }
}
