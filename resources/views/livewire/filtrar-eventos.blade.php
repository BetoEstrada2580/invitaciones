<div class="">

    <div class="max-w-7xl mx-auto">
        <form wire:submit.prevent='formBuscar' class="grid gap-6 mb-3 md:grid-cols-2">
            <div>
                <x-input-label for="clave" :value="__('Clave')" />
                <x-text-input 
                    id="clave" 
                    class="block mt-1 w-full" 
                    type="text" 
                    wire:model="clave"
                    :value="old('clave')"
                    placeholder="Clave o nombre del festejado"
                />
                <x-input-error :messages="$errors->get('clave')" class="mt-2" />
            </div>
                
            <div>
                <x-input-label for="tipo_evento" :value="__('Tipo de evento')" />
                <select wire:model="tipo_evento_id" id="tipo_evento"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    >
                        <option value="">Seleccione un tipo de evento</option>
                        @foreach ($tipo_eventos as $tipo_evento)
                            <option value="{{$tipo_evento->id}}">{{$tipo_evento->nombre}}</option>
                        @endforeach
                </select>
                <x-input-error :messages="$errors->get('tipo_evento_id')" class="mt-2" />
            </div>
                
            <div>
                <x-input-label for="nivel_paquete" :value="__('Nivel de paquete')" />
                <select wire:model="nivel_paquete_id" id="nivel_paquete"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    >
                        <option value="">Seleccione un tipo de evento</option>
                        @foreach ($nivel_paquetes as $nivel_paquete)
                            <option value="{{$nivel_paquete->id}}">{{$nivel_paquete->nombre}}</option>
                        @endforeach
                </select>
                <x-input-error :messages="$errors->get('nivel_paquete_id')" class="mt-2" />
            </div>
            
            <div>
                @php
                    $dt = new DateTime();
                    $min = $dt->format('Y-m-d');
                @endphp
                <x-input-label for="fecha" :value="__('Fecha del evento')" />
                <x-text-input 
                    id="ultimo_dia" 
                    class="block mt-1 w-full" 
                    type="date" 
                    wire:model="fecha"
                    min="{{$min}}"
                />
                <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
            </div>
            
            <div class="flex items-center w-full justify-center md:justify-end md:col-span-2 gap-3">
                <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900"
                    @click="$dispatch('limpiarFiltro')" wire:loading.attr="disabled" >
                    {{ __('LIMPIAR FILTRO') }}
                </button>
                
                <button type="submit" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
                    wire:loading.attr="disabled" >
                    {{ __('BUSCAR') }}
                </button>
            </div>
            
            <div wire:loading> 
                <x-loading/>
            </div>
        </form>
    </div>
    @push('scripts')
    <script>
    </script>
    @endpush
</div>