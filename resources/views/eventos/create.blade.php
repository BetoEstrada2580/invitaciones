<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear evento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session()->has('success'))
                <div class="uppercase border border-green-600 bg-green-100 text-green-600
                font-bold p-2 my-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            <x-card>
                <h1 class="text-2xl font-bold text-center my-2">Datos del evento</h1>
                <div class="md:flex md:justify-center p-3">
                    @livewire('crear-evento')
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
