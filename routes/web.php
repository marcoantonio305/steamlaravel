<?php

use App\Models\Cliente;
use Illuminate\Http\Request;
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


Route::post('/clientes/create', function (Request $request) {
    $validated = $request->validate([
        'dni' => 'required|max:9|unique:clientes',
        'nombre' => 'required|max:255',
        'apellidos' => 'max:255',
        'direccion' => 'max:255',
        'codpostal' => 'nullable|numeric|decimal:0|min_digits:5|max_digits:5',
        'telefono' => 'nullable|max:255',

    ]);
    Cliente::create($request->input());
    return redirect('/clientes');
});

Route::delete('/clientes/borrar/{cliente}', function(Cliente $cliente) {
    $cliente->delete();
    return redirect('/clientes');
});