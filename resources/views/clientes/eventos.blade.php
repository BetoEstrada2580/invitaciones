<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Eventos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-card>
                    @forelse ($eventos as $evento)
                    <a href="">
                        <div class="p-2 md:p-6 border-b border-gray-200 text-gray-900 dark:text-gray-100
                        grid gap-1 mb-3 md:grid-cols-3">
                            <div class="space-y-3 font-bold">
                                <p class="text-2xl text">
                                    Clave: {{$evento->clave}}
                                </p>
                                <p class="text-lg truncate">
                                    Festejad@: {{$evento->festejado}}
                                </p>
                            </div>
                            
                            <div class="space-y-3 font-bold text-lg">
                                <p class="text-2xl">
                                    Fecha: {{$evento->fecha->format('d/m/Y')}}
                                </p>
                                <p class="truncate ">
                                    Paquete: {{$evento->paquete->nombre}}
                                </p>
                            </div>
                            
                            <div class="space-y-3 font-bold text-lg">
                                <p class="text-2xl">
                                    Evento: {{$evento->tipoEvento->nombre}}
                                </p>
                            </div>
                        </div>
                    </a>
                    @empty
                    <p class="p-3 text-center text-2xl text-gray-900 dark:text-gray-100">
                        No hay evento que mostrar
                    </p>
                    @endforelse
                </x-card>
                <div class="mt-10">
                    {{ $eventos->links() }}
                </div>
        </div>
    </div>
</x-app-layout>
