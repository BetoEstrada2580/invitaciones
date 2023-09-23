<div>
    @if (session()->has('success'))
        <div class="uppercase border border-green-600 bg-green-100 text-green-600
        font-bold p-2 my-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

<form class="grid gap-6 mb-6 md:grid-cols-2" wire:submit.prevent="editarEvento" >
    
    <div>
        <x-input-label for="clave" :value="__('Clave')" />
        <x-text-input 
            id="clave" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="clave"
            placeholder="Clave unica para los eventos"
        />
        <x-input-error :messages="$errors->get('clave')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input 
            id="email" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="email"
            placeholder="Email del usuario a crear"
        />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="tipo_evento" :value="__('Tipo de evento')" />
        <x-select wire:model="tipo_evento_id" id="tipo_evento">
                <option value="">Seleccione un tipo de evento</option>
                @foreach ($tipo_eventos as $tipo_evento)
                    <option value="{{$tipo_evento->id}}">{{$tipo_evento->nombre}}</option>
                @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('tipo_evento_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="nivel_paquete" :value="__('Nivel de paquete')" />
        <x-select wire:model="nivel_paquete_id" id="nivel_paquete">
                <option value="">Seleccione un tipo de evento</option>
                @foreach ($nivel_paquetes as $nivel_paquete)
                    <option value="{{$nivel_paquete->id}}">{{$nivel_paquete->nombre}}</option>
                @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('nivel_paquete_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="plantillas" :value="__('Plantilla')" />
        <x-select wire:model="plantilla_id" id="plantillas">
                <option value="">Seleccione una plantilla</option>
                @foreach ($plantillas as $plantilla)
                    <option value="{{$plantilla->id}}">{{$plantilla->nombre}}</option>
                @endforeach
        </x-select>
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

    <div class="mt-8">
        <x-primary-button class="gap-2">
            Guardar
        </x-primary-button>
    </div>
    
</form>

</div>