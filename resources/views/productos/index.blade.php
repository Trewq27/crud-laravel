@extends('sections.app')
@section('content')
@if(sizeof($productos) != 0)
<form action="{{ route('productos.index') }}" method="GET">
    <div class="divFiltros">
        <input class="inputFiltros scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" placeholder="Nombre" type="text" id="nombre" name="nombre" value="{{ request('nombre') }}">
    </div>
    <div class="divFiltros">
        <input class="inputFiltros scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" placeholder="Descripcion" type="text" id="descripcion" name="descripcion" value="{{ request('descripcion') }}">
    </div>
    <div class="divFiltros">
        <input class="inputFiltros scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" placeholder="Caracteristicas" type="text" id="caracteristicas" name="caracteristicas" value="{{ request('caracteristicas') }}">
    </div>
    <button class="botonEnviarYBorrar scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" type="submit">Filtrar</button>
</form>
<table class="tableProduct" border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Caracteristicas</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Imagen</th>
            <td>Settings</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->caracteristicas }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->precio }}</td>
                <td>
                    @if($producto->imagen)
                        <img src="{{ asset('storage/'.$producto->imagen) }}" alt="Imagen del producto" width="100">
                    @else
                        Sin imagen
                    @endif
                </td>
                <td>
                    <a href="{{ route('productos.edit', $producto->id) }}">Editar</a>

                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
    No hay productos creados
@endif
@if(session('success'))
<div id="popupMensaje" class="popup-mensaje">
    {{ session('success') }}
</div>
@endif
<script>
    window.onload = function() {
        if (document.getElementById("popupMensaje")) {
            var popup = document.getElementById("popupMensaje");
            popup.style.display = "block";
    
            setTimeout(function() {
                popup.style.display = "none";
            }, 3000); // El popup se ocultará después de 3 segundos
        }
    };
</script>
@endsection