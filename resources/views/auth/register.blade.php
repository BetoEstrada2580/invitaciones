<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear usuario') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            @if (session()->has('success'))
                <div class="uppercase border border-green-600 bg-green-100 text-green-600
                font-bold p-2 my-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            <x-card>
                <h1 class="text-2xl font-bold text-center my-10">Datos del usuario</h1>
                <div class="md:justify-center p-3">
                    <form method="POST" action="{{ route('register') }}" novalidate>
                        @csrf
                        
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        
                        <!-- Tipo Cuenta -->
                        <div class="mt-4">
                        <x-input-label for="rol_id" :value="__('¿Que tipo de cuenta deseas crear?')" />
                            <select name="rol_id" id="rol_id"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            >
                                <option value="">Selecciona un rol</option>
                                <option value="1">Admin</option>
                                <option value="2">Vendedor</option>
                                <option value="3">Cliente</option>
                            </select>
                            <x-input-error :messages="$errors->get('rol_id')" class="mt-2" />
                        </div>
                        
                        <div class="mt-4 flex items-center justify-between w-full">
                            <a href="{{ route('evento.index') }}">
                                <x-secondary-button>
                                    {{ __('Regresar') }}
                                </x-secondary-button>
                            </a>
                            
                            <x-primary-button class="gap-2">
                                {{ __('Crear cuenta') }}
                            </x-primary-button>
                        </div>
                    
                    </form>
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
