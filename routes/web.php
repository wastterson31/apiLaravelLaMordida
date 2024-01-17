<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\AuthenticationSessionController;
use App\Http\Controllers\PredictController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//RUTAS ZONA PUBLICA =======================================================================0
Route::get('/', [IndexController::class, 'ShowHome'])->name('Home');
Route::get('/admin', [IndexController::class, 'ShowHomeAdmin'])->name('HomeAdmin');
Route::get('/Nosotros', [IndexController::class, 'ShowNosotros'])->name('Nosotros');
Route::get('/categories-public/{id}', [IndexController::class, 'ShowProductsByCategory'])->name('categories');
Route::get('/Products', [IndexController::class, 'ShowProducts'])->name('Products');
Route::get('/Register', [IndexController::class, 'ShowRegister'])->name('Register');

Route::get('/Products/categories/{id}', [IndexController::class, 'ShowProductsByCategory'])->name('categories');

Route::get('/StartSession', [IndexController::class, 'ShowSession'])->name('Session');
Route::get('/StartSessionAdmin', [IndexController::class, 'ShowSessionAdmin'])->name('SessionAdmin');

// rutas de sesión
Route::get('/login', [AuthenticationSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticationSessionController::class, 'store'])->name('start');
Route::get('/logout', [AuthenticationSessionController::class, 'destroy'])->name('logout');
Route::post('/logout', [AuthenticationSessionController::class, 'destroy'])->name('logout');
//Route::get('/login', [AuthenticationSessionController::class, 'administrador'])->name('login');

// registro de compradores
Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store'])->name('save');

//RUTAS ZONA ADMINISTRATIVA-COMPRADOR==================================================================
Route::get('/UserPedido', [IndexController::class, 'ShowUserPedido'])->name('UserPedido');
//Route::get('/Predict', [IndexController::class, 'ShowPredict'])->name('Pedidos');


//RUTAS ZONA ADMINISTRATIVA-ADMINISTRADOR===============================================================
Route::get('/welcome', [AdminController::class, 'ShowAdmin'])->name('Admin');

Route::resource('product', ProductController::class);
Route::resource('category', CategoryController::class);
Route::resource('order', OrderController::class);
// Route::resource('predict', PredictController::class);
//eliminar
Route::get('/products/{id}', [ProductController::class, 'setStateDelete'])->name('setDelete');
Route::get('/categories/{id}', [CategoryController::class, 'setStateDeleteCategory'])->name('setDelete');
Route::get('/orders/{id}', [OrderController::class, 'setStateDelete'])->name('setDelete');

//RUTAS ZONA ADMINISTRATIVA-ADMINISTRADOR===============================================================
Route::post('/buy', [OrderController::class, 'store'])->name('buy');

Route::delete('/eliminar/{id}', [OrderController::class, 'destroyUserOrders'])->name('eliminar');




//rutas de usuario
// Route::get('/ordenes/{id}', [PredictController::class, 'setStateDeletes'])->name('setDeletes');

//dashboard
// Route::get('/dashboard', [PredictController::class, 'viwDashboard'])->name('dashboard');














//Route::get('/welcome', [AdminController::class, 'welcome'])->name('welcomeAdmin')->middleware('auth');
//Route::get('/filtrar/{id}', [AdminController::class, 'ShowAdminFilter'])->name('filtrar');
//Route::put('Product/{product}', [ProductController::class, 'update'])->name('Product.update');








// insertar un producto
//Route::post('/create', [ProductController::class, 'store'])->name('products.store');
//Route::post('/edit', [ProductController::class, 'edit'])->name('products.edit');
//Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update'); // Actualizar un producto
//Route::post('/update/{id}', [ProductController::class, 'update'])->name('products.update');

// Route::post('Login', function () {
//     $validar = request()->only('username', 'password');
//     $offers = Product::where('discount', '>', 0)->get();
//     $categories = Category::all();
//     if (Auth::attempt($validar)) {
//         return view('Index', ['offers' => $offers, 'categories' => $categories]);
//     }
//     return view('UserLoginView');
//     return view('Index');
// })->name('Login');


// Route::get('/Logout', function () {
//     Auth::logout(); // Cierra la sesión del usuario
//     return redirect('/'); // Redirige al usuario a la página de inicio o a donde desees
// })->name('Logout');
