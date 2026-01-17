<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administración - CineLaravel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-row-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">¡Bienvenido, {{ Auth::user()->name }}!</h3>
                    <p class="mb-4">Has accedido correctamente con el rol de <strong>Administrador</strong>.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        <div class="p-4 border rounded-lg bg-blue-50">
                            <h4 class="font-bold text-blue-700">Gestión de Películas</h4>
                            <p class="text-sm">Próximamente: Podrás añadir, editar y borrar películas.</p>
                        </div>

                        <div class="p-4 border rounded-lg bg-green-50">
                            <h4 class="font-bold text-green-700">Gestión de Géneros</h4>
                            <p class="text-sm">Próximamente: Administra las categorías de tu cine.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>