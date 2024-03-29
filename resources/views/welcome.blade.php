@extends('sections.app')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
    <a href="{{route('productos.index')}}" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        <div class="titleSections">
            <span class="h-16 material-symbols-outlined">
                inventory
            </span>
            <h1 class="mt-6 text-xl font-semibold ">Ver/Modificar/Eliminar Productos</h1>
        </div>
    </a>

    <a href="{{route('crearProductos')}}" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        <div class="titleSections">
            <span class="h-16 material-symbols-outlined">
                inventory_2
            </span>
            <h1 class="mt-6 text-xl font-semibold ">Crear Productos</h1>
        </div>
    </a>
</div>
@endsection
                
