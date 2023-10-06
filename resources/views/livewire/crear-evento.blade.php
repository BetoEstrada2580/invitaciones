<form class=" md:w-1/2 space-y-5" wire:submit.prevent="crearEvento" >
    <div>
        <x-input-label for="clave" :value="__('Clave')" />
        <x-text-input 
            id="clave" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="clave"
            :value="old('clave')"
            placeholder="Clave unica para los eventos"
        />
        <x-input-error :messages="$errors->get('clave')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="user_id" :value="__('Usuario')" />
        <select wire:model="user_id" id="user_id"
            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            >
                <option value="">Seleccione un usuario</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{$usuario->id}}">{{$usuario->email}}</option>
                @endforeach
        </select>
        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
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
        <x-input-label for="plantillas" :value="__('Plantilla')" />
        <select wire:model="plantilla_id" id="plantillas"
            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            >
                <option value="">Seleccione una plantilla</option>
                @foreach ($plantillas as $plantilla)
                    <option value="{{$plantilla->id}}">{{$plantilla->nombre}}</option>
                @endforeach
        </select>
        <x-input-error :messages="$errors->get('plantilla_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="festejado" :value="__('Festejado')" />
        <x-text-input 
            id="festejado" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="festejado"
            :value="old('festejado')"
            placeholder="Nombre del/los festejados"
        />
        <x-input-error :messages="$errors->get('festejado')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="titulo" :value="__('Titulo')" />
        <x-text-input 
            id="titulo" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="titulo"
            :value="old('titulo')"
            placeholder="Titulo del evento"
        />
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    </div>

    <div>
        @php
            $dt = new DateTime();
            $min = $dt->format('Y-m-d\TH:i');
        @endphp
        <x-input-label for="fecha" :value="__('Fecha del evento')" />
        <x-text-input 
            id="ultimo_dia" 
            class="block mt-1 w-full" 
            type="datetime-local" 
            wire:model="fecha" 
            :value="old('fecha')"
            min="{{$min}}"
        />
        <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
    </div>


    <div class="flex items-center justify-between w-full">
        <a href="{{ route('evento.index') }}" wire:loading.attr="disabled">
            <x-secondary-button>
                Regresar
            </x-secondary-button>
        </a>
        
        <x-primary-button class="gap-2" wire:loading.attr="disabled">
            Guardar
        </x-primary-button>
    </div>
    
    <div wire:loading> 
        <x-loading/>
    </div>
</form>
