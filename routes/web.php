<?php

    use Illuminate\Support\Facades\Route;
    use Carbon\Carbon;

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
    //Route::get('/welcome', 'WelcomeController@index')->name('welcome');
    $anio = Carbon::now()->format('Y');
    return view('welcome', compact('anio'));
});

Auth::routes(['register' => false]);

Route::get('logout', function (){
    Auth::logout();
    return redirect('/login');
});

//Route::get('/', 'HomeController@index')->name('inicio');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'empresas'], function(){
    Route::get('/home', 'HomeController@index')->name('empresas');
});

Route::group(['prefix' => 'instituciones'], function(){
    Route::get('/home', 'HomeController@index')->name('instituciones');
});

Route::group(['prefix' => 'estudios'], function(){
    Route::get('/home', 'HomeController@index')->name('estudios');
});

Route::group(['prefix' => 'especialistas'], function(){
    Route::get('/home', 'HomeController@index')->name('especialistas');
});

Route::group(['prefix' => 'trnestudios'], function(){
    Route::get('/home', 'HomeController@index')->name('trnestudios');
});

Route::group(['prefix' => 'trncobros'], function(){
    Route::get('/home', 'HomeController@index')->name('trncobros');
});

Route::group(['prefix' => 'trnpagos'], function(){
    Route::get('/home', 'HomeController@index')->name('trnpagos');
});

Route::group(['middleware' => ['permission:seguridad']], function () {
    Route::group(['prefix' => 'permissions'], function(){
        Route::get('listado', 'PermissionController@index')->name('permisos');  
        Route::get('editar/{permiso_id}', 'PermissionController@edit')->name('editar_permiso');
        Route::post('grabar', 'PermissionController@store')->name('grabar_permiso');
        Route::post('actualizar/{permiso_id}', 'PermissionController@update')->name('actualizar_permiso');
    });
    Route::group(['prefix' => 'roles'], function(){
        Route::get('listado', 'RoleController@index')->name('roles');   
        Route::get('editar/{role_id}', 'RoleController@edit')->name('editar_role');
        Route::post('grabar', 'RoleController@store')->name('grabar_role');
        Route::post('actualizar/{role_id}', 'RoleController@update')->name('actualizar_role');
    });

    Route::group(['prefix' => 'usuarios'], function(){
        Route::get('listado', 'UsuarioController@index')->name('usuarios'); 
        Route::get('editar/{usuario_id}', 'UsuarioController@edit')->name('editar_usuario');
        Route::post('grabar', 'UsuarioController@store')->name('grabar_usuario');
        Route::post('actualizar/{usuario_id}', 'UsuarioController@update')->name('actualizar_usuario');
        Route::get('contrasena', 'UsuarioController@index_contrasena')->name('contrasena'); 
        Route::get('perfil', 'UsuarioController@profile')->name('perfil');
        Route::post('perfil_actualizar', 'UsuarioController@profile_update')->name('perfil_actualizar');
        Route::post('actualizar_contrasena', 'UsuarioController@update_contrasena')->name('actualizar_contrasena');
        Route::get('actualizar_pass/{usuario_id}', 'UsuarioController@update_pass')->name('actualizar_pass');
    });
});
