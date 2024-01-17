<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = env('URL_SERVER_API');

        $response = Http::get($url . 'v1/categories');
        $categories = $response->json('data');
        //dd($orders);
        //$orders = Order::where('delete', '=', false)->get();
        return view('admin.category.AdminCategoryView', ['categories' => $categories]);
    }

    public function ShowHome()
    {
        $url = env('URL_SERVER_API');

        $response = Http::get($url . 'v1/categories');
        $categories = $response->json('data');

        $response = Http::get($url . 'v1/products');
        $allProducts = $response->json('data');

        // Filtrar solo los productos que tienen descuento
        $offers = array_filter($allProducts, function ($product) {
            return $product['discount'] > 0;
        });

        return view('Index', ['offers' => $offers, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.CreateCategory', ['category' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
        //     'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        // ]);

        // // Manejar la carga y almacenamiento de la imagen
        // $imageName = $request->file('image')->store('category_images', 'public');

        // $imageName = time() . '.' . $request->image->extension();
        // //copiar la imagen al directorio publico hay que crear las carpetas  storage/pets/
        // $request->image->move(public_path('public'), $imageName);

        // Category::create([
        //     'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
        //     'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        // ]);

        // return redirect()->route('category.index');


        $request->validate([
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);
        // dd($request);
        $extension = $request->image->extension();
        $imageName = time() . '.' . $extension;
        $request->image->move(public_path('public'), $imageName);

        $url = env('URL_SERVER_API');
        $response = Http::post($url . 'v1/categories', [
            'name' => $request->name,
            'image' => $imageName,
            'state' => 'activo',
            'delete' => false
        ]);
        if ($response->successful()) {
            return redirect()->route('category.index')->with([
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . 'v1/categories');
        $responseCategory = Http::get($url . 'v1/categories/' . $category);

        if ($response->successful() && $responseCategory->successful()) {
            $category = $responseCategory->json('data');
            return view('admin.category.ModifyCategory', ['category' => $category]);
        } else {
            return back()->withErrors([
                'message' => 'Error al editar una categoría'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $category)
    {
        $request->validate([
            'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Procesar la imagen solo si se proporciona una nueva
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('public/'), $imageName);
        } else {
            // Si no se proporciona una nueva imagen, mantener la imagen existente
            $url = env('URL_SERVER_API');
            $responseCategory = Http::get($url . 'v1/categories/' . $category);

            if ($responseCategory->successful()) {
                $existingCategory = $responseCategory->json('data');
                $imageName = $existingCategory['image'];
            } else {
                return back()->withErrors([
                    'message' => 'Error al obtener la información de la categoría existente'
                ]);
            }
        }

        $url = env('URL_SERVER_API');
        $response = Http::put($url . 'v1/categories/' . $category, [
            'name' => $request->name,
            'image' => $imageName,
            'state' => 'activo',
        ]);

        if ($response->successful()) {
            return redirect()->route('category.index')->with([
                'message' => 'La categoría se modificó correctamente'
            ]);
        } else {
            return back()->withErrors([
                'message' => 'Error al modificar la información de la categoría'
            ]);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category)
    {
        $url = env('URL_SERVER_API');
        $response = Http::delete($url . 'v1/categories/' . $category);

        if ($response->successful()) {
            return redirect()->route('category.index')->with([
                'message' => 'La categoría se eliminó correctamente'
            ]);
        } else {
            return back()->withErrors([
                'message' => 'Error al eliminar la categoría'
            ]);
        }
    }
    // public function setStateDeleteCategory($id)
    // {
    //     //dd($id);
    //     $category = Category::find($id);
    //     $category->update(
    //         [
    //             'delete' => true
    //         ]
    //     );
    //     return redirect()->route('category.index');
    // }
}
