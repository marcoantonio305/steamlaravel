<?php

use App\Models\Cliente;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function () {
    $nombre = request('nombre');
    return "Hola, $nombre";
});

Route::get('/clientes', function() {
    return view('clientes.index', [
        'nombre' => 'pepe',
        'clientes' => Cliente::all(),
    ]);
});

Route::get('/clientes/create', function () {
    return view('clientes.create');
    // Cliente::create([
    // 'dni'=>'3333',
    // 'nombre'=>'Antonio',
    // 'apellidos'=>'Martínez',
    // 'direccion'=> 'Calle Anche, 999',
    // 'codpostal'=>11540,
    // 'telefono'=>'111111111',
    // ]);

});

Route::delete('/clientes/borrar/{cliente}', function(Cliente $cliente) {
    $cliente->delete();
    return redirect('/clientes');
});