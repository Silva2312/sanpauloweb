<?php

use App\Http\Controllers\UsuarioController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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
//login
Route::get('/', function () {
    return view('welcome');
});

//cerrar sesion
Route::get('/logout', function () {
    if (session()->has('usuario')) {
        session()->pull('usuario');
        session()->pull('identificador');
        session()->pull('cargo_supervisor');
        session()->pull('Id_supervisor');
        session()->pull('passwd_supervisor');
    }
    return view('welcome');
});

//menu principal, despues del login
Route::post('/Usuario/IniciarSesion', [UsuarioController::class, 'index']);

Route::get('/Log', [UsuarioController::class, 'Inicio_Login'])->name('login_try');

//intentar recuperar password
Route::get('/Login', [UsuarioController::class, 'Inicio_recuperarPassword'])->name('log_pass');

//crud de usuarios
Route::resource('/Usuario', UsuarioController::class);

//segundo buscador - javascript
Route::get('/buscar/search', 'App\Http\Controllers\UsuarioController@buscar');

//buscador, lista de opciones                                            //nombre del metodo para buscar
Route::get('/search/User', 'App\Http\Controllers\UsuarioController@search')->name('user.search');

//buscador del menu principal
Route::post('/Usuario/Filtro', [UsuarioController::class, 'Filtro']);

//eliminar un registro
Route::get('/delete/{codigo}/eliminar', [UsuarioController::class, 'eliminar']);

//paginacion despues del login y al insertar, actualizar, eliminar un registro
Route::get('/Menu', [UsuarioController::class, 'MenuPrincipal'])->name('dashboard');

//Route::get('/Menu/Paginacion', [UsuarioController::class, 'MenuPrincipal_Paginacion'])->name('menu_paginacion');

//paginacion, al usar el primer Buscador
Route::get('/Menu/{codigo}/Filtro', [UsuarioController::class, 'MenuFiltro'])->name('dashboard_filtro');

//paginacion, botones de insertar
Route::get('/Menu/Insertar', [UsuarioController::class, 'MenuInsertar'])->name('dashboard_insert');

//paginacion, boton de actualizar
Route::get('/Menu/{id}/Actualizar', [UsuarioController::class, 'MenuActualizar']);

//paginacion boton de gestion
Route::get('Menu/Gestion', [UsuarioController::class, 'MenuGestion'])->name('dashboard_gestion');

//pagina de inicio para los reportes
Route::get('Reporte', [UsuarioController::class, 'Reporte']);

//generando un nuevo reporte
Route::post('Reporte/Generar', [UsuarioController::class, 'GenerarReporte']);

//descargar el reporte en pdf
Route::post('Reporte/Descargar', [UsuarioController::class, 'DescargarReporte']);

//cambiar password
Route::get('/Password', [UsuarioController::class, 'Password']);

Route::get('/Password/RepetirPassword', [UsuarioController::class, 'RepetirPassword']);

Route::post('/ConfirmarPassword', [UsuarioController::class, 'CambiarPassword']);

Route::post('/Password/NuevoPassword', [UsuarioController::class, 'NuevoPassword']);

//configuracion supervisor
Route::get('/Configuracion', [UsuarioController::class, 'Gestion']);

Route::match(['post', 'put'], '/Gestion/Config', [UsuarioController::class, 'GestionSupervisor']);

//agregar nuevo admin
Route::get('/AgregarAdmin', [UsuarioController::class, 'CreateAdmin']);

Route::post('/NuevoAdmin', [UsuarioController::class, 'NuevoAdmin']);

//recuperar password
Route::post('/RecuperarPassword', [UsuarioController::class, 'RecuperarPassword']);