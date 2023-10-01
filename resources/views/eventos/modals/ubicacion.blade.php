<x-modal name="ModalUbicacion" :show="$errors->userDeletion->isNotEmpty()" focusable id="ModalUbicacion">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Ubicación
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                x-on:click="show = false" >
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form class="grid gap-6 mb-6 md:grid-cols-2" wire:submit.prevent="formUbicacion" novalidate>

                    <div>
                        <x-input-label for="tipo_ubicacion_id" :value="__('Tipo de ubicación')" />
                        <x-select wire:model="tipo_ubicacion_id" id="tipo_ubicacion_id">
                                <option value="">Seleccione un tipo de ubicación</option>
                                @foreach ($tipo_ubicaciones as $tipo_ubicacion)
                                    <option value="{{$tipo_ubicacion->id}}">{{$tipo_ubicacion->nombre}}</option>
                                @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('tipo_ubicacion_id')" class="mt-2" />
                    </div>
                
                    <div>
                        <x-input-label for="nombre" :value="__('Lugar')" />
                        <x-text-input 
                            id="clave" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="nombre"
                            placeholder="Nombre del lugar"
                        />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>
                
                    <div>
                        <x-input-label for="direccion" :value="__('Dirección')" />
                        <x-text-input 
                            id="direccion" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="direccion"
                            :value="old('direccion')"
                            placeholder="Dirección de la ubicación"
                        />
                        <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
                    </div>
                
                    <div>
                        <x-input-label for="url" :value="__('URL')" />
                        <x-text-input 
                            id="url" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="url"
                            :value="old('url')"
                            placeholder="url de la ubicación"
                        />
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>
                
                    <div>
                        @php
                            $dt = new DateTime();
                            $min = $dt->format('Y-m-d\TH:i');
                        @endphp
                        <x-input-label for="fecha" :value="__('Cuando')" />
                        <x-text-input 
                            id="ultimo_dia" 
                            class="block mt-1 w-full" 
                            type="datetime-local" 
                            wire:model="fecha"
                            min="{{$min}}"
                        />
                        <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
                    </div>
                
                    <div class="mt-8">
                        <x-primary-button class="gap-2" wire:loading.attr="disabled">
                            Guardar
                        </x-primary-button>
                    </div>

                    <div wire:loading> 
                        <x-loading/>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</x-modal>