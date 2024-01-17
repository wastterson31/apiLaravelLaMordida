<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = env('URL_SERVER_API');

        $response = Http::get($url . 'v1/orders');
        $orders = $response->json('data');
        //dd($orders);
        //$orders = Order::where('delete', '=', false)->get();
        return view('admin.orders.AdminOrdersView', ['orders' => $orders]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $url = env('URL_SERVER_API');
        $response = Http::delete($url . 'v1/categories');
        $categories = $response->json('data');

        $response = Http::delete($url . 'v1/products');
        $products = $response->json('data');
        // Valida y procesa los datos del formulario
        $request->validate([
            'amount' => 'required|integer',
            'address' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|integer',
            'product_id' => 'required|integer',

        ]);
        // dd($request);

        $url = env('URL_SERVER_API');
        $response = Http::post($url . 'v1/orders', [

            'product_id' => $request->product_id,
            'address' => $request->address,
            'description' => $request->description,
            'amount' => $request->amount,
            'price' => $request->price,
            'user_id' => $request->user_id,
        ]);
        // dd($response);
        if ($response->successful()) {
            //mensaje de éxito en la sesión
            session()->flash('success_message', 'La orden se iso correctamente');
        } else {
            //mensaje de error en la sesión
            session()->flash('error_message', 'Error al comprar la orden');
        }
        // Redirige de nuevo a la vista actual
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($order)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . 'v1/products');
        if ($response->successful()) {
            $products = $response->json('data');

            $response = Http::get($url . 'v1/orders/' . $order);
            if ($response->successful()) {
                $order = $response->json('data');
                return view('admin.orders.EditOrders', ['order' => $order, 'products' => $products]);
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
        // $products = Product::get();
        // return view('admin.orders.EditOrders', ['order' => $order, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $order)
    {
        // $request->validate([
        //     //'name' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,100',
        //     'address' => 'required',
        //     'description' => 'required',
        //     'amount' => 'required|integer',
        //     'price' => 'required|numeric'
        // ]);

        // $order->update([
        //     // 'name' => $request->input('name'),
        //     'address' => $request->input('address'),
        //     'description' => $request->input('description'),
        //     'amount' => $request->input('amount'),
        //     'price' => $request->input('price')
        // ]);

        // return redirect()->route('order.index');


        $request->validate([
            'address' => 'required',
            'description' => 'required',
            'amount' => 'required|integer',
            'price' => 'required|numeric'
        ]);


        $url = env('URL_SERVER_API');
        $response = Http::put($url . 'v1/orders/' . $order, [
            'address' => $request->address,
            'description' => $request->description,
            'amount' => $request->amount,
            'price' => $request->price
        ]);

        if ($response->successful()) {
            return redirect()->route('order.index')->with([
                'message' => 'La orden se modificó correctamente'
            ]);
        } else {
            return back()->withErrors([
                'message' => 'Error al modificar la información de la orden'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($order)
    {
        $url = env('URL_SERVER_API');
        $response = Http::delete($url . 'v1/orders/' . $order);

        if ($response->successful()) {
            return redirect()->route('order.index')->with([
                'message' => 'La orden se eliminó correctamente'
            ]);
        } else {
            return back()->withErrors([
                'message' => 'Error al eliminar la orden'
            ]);
        }
    }

    public function destroyUserOrders($order)
    {
        $url = env('URL_SERVER_API');
        $response = Http::delete($url . 'v1/orders/' . $order);

        if ($response->successful()) {
            return redirect()->back()->with([
                'message' => 'La orden se eliminó correctamente'
            ]);
        } else {
            return back()->withErrors([
                'message' => 'Error al eliminar la orden'
            ]);
        }
    }


    // public function setStateDelete($id)
    // {
    //     //dd($id);
    //     $order = Order::find($id);
    //     $order->update(
    //         [
    //             // 'delete' => !$order->delete
    //             'delete' => true
    //         ]
    //     );
    //     return redirect()->route('order.index');
    // }
}
