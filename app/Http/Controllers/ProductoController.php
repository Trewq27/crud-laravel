<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Producto::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }
        if ($request->filled('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->descripcion . '%');
        }
        if ($request->filled('caracteristicas')) {
            $query->where('caracteristicas', 'like', '%' . $request->caracteristicas . '%');
        }

    $productos = $query->get();

    return view('productos.index', compact('productos'));


        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'caracteristicas' => 'required',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);
    
        $producto = new Producto($request->all());

        if ($request->hasFile('imagen')) {
            $nombreImagen = $request->file('imagen')->getClientOriginalName();
            $ruta = $request->file('imagen')->storeAs('imagenes', $nombreImagen, 'public');
            $producto->imagen = $ruta;
        }

        $producto->save();
    
        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'caracteristicas' => 'required',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);
    
        $producto = Producto::findOrFail($id);
        if ($request->hasFile('imagen')) {
            $nombreImagen = $request->file('imagen')->getClientOriginalName();
            $ruta = $request->file('imagen')->storeAs('imagenes', $nombreImagen, 'public');
        }
        $producto->nombre = $request->nombre;
        if($ruta){
            $producto->imagen = $ruta;
        }
        $producto->descripcion = $request->descripcion;
        $producto->caracteristicas = $request->caracteristicas;
        $producto->stock = $request->stock;
        $producto->precio = $request->precio;
        $producto->save();
    
        return redirect()->route('productos.index')->with('success', 'Producto modificado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito.');
    }
}
