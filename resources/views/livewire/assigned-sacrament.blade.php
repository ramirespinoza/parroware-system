<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-flex items-center">
                {{ __('Asignación de sacramentos') }}
            </h2>
            <div class="flex flex-col items-center space-y-4 self-end px-4 py-2 rounded m-2 grid">
                <button class="self-end bg-blue-500 text-black px-4 py-2 rounded"><x-nav-link class="text-white" href="{{ route('sacrament-types') }}" :active="request()->routeIs('sacrament-types')">
                    {{ __('Tipos de sacramentos') }}
                </x-nav-link></button>
                <button class="self-end bg-blue-500 text-black px-4 py-2 rounded"><x-nav-link class="text-white" href="{{ route('certificates') }}" :active="request()->routeIs('certificates')">
                    {{ __('Certificados') }}
                </x-nav-link></button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                            Editar Asignación de Sacramentos
                        @else
                            Asignar Sacramento
                        @endif
                    </h2>

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Tipo de sacramento</label>
                    <select wire:model="sacramentTypeId" placeholder="Tipo de sacramento" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Seleccione un tipo de sacramento</option>
                        @foreach($sacramentTypes as $sacramentType)
                        <option value="{{ $sacramentType->id }}">{{ $sacramentType->name }}</option>
                        @endforeach
                    </select>
                    @error('sacramentTypeId') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2">Feligres</label>
                    <select wire:model="parishionerId" placeholder="Feligres" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Seleccione un feligres</option>
                        @foreach($parishioners as $parishioner)
                        <option value="{{ $parishioner->id }}">{{ $parishioner->name }} {{ $parishioner->last_name }}</option>
                        @endforeach
                    </select>
                    @error('parishionerId') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2">Fecha asignada</label>
                    <input type="date" wire:model="scheduledDate" placeholder="Fecha asignada" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('scheduledDate') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2">Estado del sacramento</label>
                    <select wire:model="assignedSacramentStatus" placeholder="Estado del sacramento asignado" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" list="sacramentStatusList">
                        <option value="">Seleccione un estatus</option>
                        <option value="Pending">Pendiente</option>
                        <option value="Done">Listo</option>
                        <option value="Cancelled">Cancelado</option>
                    </select>
                    @error('assignedSacramentStatus') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2">Sacerdote</label>
                    <select wire:model="priestId" placeholder="Sacerdote" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Seleccione un sacerdote</option>
                        @foreach($priests as $priest)
                        <option value="{{ $priest->id }}">{{ $priest->name }} {{ $priest->last_name }}</option>
                        @endforeach
                    </select>
                    @error('priestId') <span class="text-red-500">{{ $message }}</span> @enderror
                    <br>
                    @if($editId)
                        <button wire:click="update" class="bg-blue-500 text-white px-4 py-2 rounded m-2">Update</button>
                        <button wire:click="resetInput" class="bg-gray-500 text-white px-4 py-2 rounded m-2">Cancel</button>
                    @else
                        <button wire:click="store" class="bg-green-500 text-white px-4 py-2 rounded m-2">Guardar</button>
                    @endif
                </div>

                <div class="p-4">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Busqueda" class="w-mid rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                    <select wire:model="searchType" class="w-mid rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Todos los tipos</option>
                        <option value="sacramentType">Tipo Sacramento</option>
                        <option value="parishioner">Feligres</option>
                        <option value="priest">Sacerdotes</option>
                    </select>
                </div>

                <table class="table-auto w-full border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Tipo</th>
                            <th class="px-4 py-2 border">Feligres</th>
                            <th class="px-4 py-2 border">Fecha</th>
                            <th class="px-4 py-2 border">Estatus</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignedSacraments as $assignedSacrament)
                        <tr>
                            <td class="border py-3 px-6 text-left">{{ $assignedSacrament->id }}</td>
                            <td class="border py-3 px-6 text-left">{{ $assignedSacrament->sacramentType->name }}</td>
                            <td class="border py-3 px-6 text-left">{{ $assignedSacrament->parishioner->dpi }} - {{ $assignedSacrament->parishioner->name  }} {{ $assignedSacrament->parishioner->last_name  }}</td>
                            <td class="border py-3 px-6 text-left">{{ $assignedSacrament->scheduled_date }}</td>
                            <td class="border py-3 px-6 text-left">{{ $assignedSacrament->assigned_sacrament_status }}</td>
                            <td class="border py-3 px-6 text-center">
                                <button wire:click="edit({{ $assignedSacrament->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                                <button wire:click="delete({{ $assignedSacrament->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
