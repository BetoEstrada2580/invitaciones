<div class="">
    <div class="max-w-7xl mx-auto">
        <form wire:submit.prevent='formBuscar' class="grid gap-6 mb-3 md:grid-cols-3">
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
            
            <div class="flex items-center w-full justify-end md:col-span-3">
                <input 
                    type="submit"
                    class="bg-indigo-500 hover:bg-indigo-600 transition-colors text-white text-sm font-bold px-10 py-2 rounded cursor-pointer uppercase w-full md:w-auto"
                    value="Buscar"
                    wire:loading.attr="disabled"
                />
            </div>

            <div wire:loading> 
                <x-loading/>
            </div>
        </form>
    </div>
</div>