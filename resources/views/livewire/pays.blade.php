<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-flex items-center">
                {{ __('Pagos') }}
            </h2>
            <button class="inline-flex self-end bg-blue-500 text-black px-4 py-2 rounded m-2"><x-nav-link class="text-white" href="{{ route('service-types') }}" :active="request()->routeIs('service-types')">
                {{ __('Tipos de servicios') }}
            </x-nav-link></button>
        </div>
    </x-slot>

    <div class=" py-12">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                @if (session()->has('message'))
                <div class="bg-green-100 p-3 mb-4 rounded">
                    {{ session('message') }}
                </div>
                @endif

                <!-- FORMULARIO -->
                <div class="p-8 mb-6">
                    <h2 class="text-xl font-bold mb-2">
                        @if($editId)
                            Editar Pago
                        @else
                            Registrar Pago
                        @endif
                    </h2>

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Tipo de pago</label>
                    <select wire:model="serviceTypeId" placeholder="Tipo de sacramento" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Seleccione un tipo de pago</option>
                        @foreach($serviceTypes as $serviceType)
                        <option value="{{ $serviceType->id }}">{{ $serviceType->name }}</option>
                        @endforeach
                    </select>
                    @error('serviceTypeId') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2">Feligres</label>
                    <select wire:model="parishionerId" placeholder="Feligres" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Seleccione un feligres</option>
                        @foreach($parishioners as $parishioner)
                        <option value="{{ $parishioner->id }}">{{ $parishioner->name }} {{ $parishioner->last_name }}</option>
                        @endforeach
                    </select>
                    @error('parishionerId') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Fecha de pago</label>
                    <input type="date" wire:model="payDate" placeholder="Fecha de pago" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Monto</label>
                    <input type="number" wire:model="ammount" placeholder="Monto" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('ammount') <span class="text-red-500">{{ $message }}</span> @enderror

                    <br>
                    @if($editId)
                        <button wire:click="update" class="bg-blue-500 text-white px-4 py-2 rounded m-2">Actualizar</button>
                        <button wire:click="resetInput" class="bg-gray-500 text-white px-4 py-2 rounded m-2">Cancelar</button>
                    @else
                        <button wire:click="store" class="bg-green-500 text-white px-4 py-2 rounded m-2">Guardar</button>
                    @endif
                </div>

                <table class="table-auto w-full border">
                    <div class="p-4">
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Busqueda" class="w-mid rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                        <select wire:model="searchType" class="w-mid rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Todos los tipos</option>
                            <option value="serviceType">Tipo Servicio</option>
                            <option value="parishioner">Feligres</option>
                        </select>
                    </div>
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Tipo</th>
                            <th class="px-4 py-2 border">Feligres</th>
                            <th class="px-4 py-2 border">Fecha</th>
                            <th class="px-4 py-2 border">Monto</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pays as $pay)
                        <tr>
                            <td class="border py-3 px-6 text-left">{{ $pay->id }}</td>
                            <td class="border py-3 px-6 text-left">{{ $pay->serviceType->name }}</td>
                            <td class="border py-3 px-6 text-left">{{ $pay->parishioner->dpi }} - {{ $pay->parishioner->name  }} {{ $pay->parishioner->last_name  }}</td>
                            <td class="border py-3 px-6 text-left">{{ $pay->pay_date }}</td>
                            <td class="border py-3 px-6 text-left">{{ $pay->ammount }}</td>
                            <td class="border py-3 px-6 text-center">
                                <button wire:click="edit({{ $pay->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                                <button wire:click="delete({{ $pay->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pays->links() }}
            </div>
        </div>
    </div>
</div>
