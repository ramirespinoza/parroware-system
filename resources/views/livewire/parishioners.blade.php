<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-flex items-center">
                {{ __('Feligreses') }}
            </h2>

            <div class="flex flex-col items-center space-y-4 self-end px-4 py-2 rounded m-2 grid">
                <button class="self-end bg-green-500 text-black px-4 py-2 rounded m-2"><x-nav-link class="text-white" href="{{ route('parishioners-export') }}" :active="request()->routeIs('parishioners-export')">
                    {{ __('Exportar Feligreses') }}
                </x-nav-link></button>
                <button class="self-end bg-blue-500 text-black px-4 py-2 rounded m-2"><x-nav-link class="text-white" href="{{ route('communities') }}" :active="request()->routeIs('communities')">
                    {{ __('Comunidades') }}
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
                            Editar Feligres
                        @else
                            Registrar Feligres
                        @endif
                    </h2>

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">DPI</label>
                    <input type="number" wire:model="dpi" placeholder="DPI" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('dpi') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Nombre</label>
                    <input type="text" wire:model="name" placeholder="Nombre" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Apellido</label>
                    <input type="text" wire:model="lastName" placeholder="Apellido" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('lastName') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Fecha de nacimiento</label>
                    <input type="date" wire:model="birthday" placeholder="F. Nacimiento" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('birthday') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Dirección</label>
                    <input type="text" wire:model="address" placeholder="Direcciòn" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('address') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Número de contacto</label>
                    <input type="number" wire:model="phoneNumber" placeholder="Numero de telèfono" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('phoneNumber') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Correo electrónico</label>
                    <input type="email" wire:model="email" placeholder="Correo electrónico" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Comunidad</label>
                    <select wire:model="communityId" placeholder="Comunidad" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Seleccione una comunidad</option>
                        @foreach($communities as $community)
                        <option value="{{ $community->id }}">{{ $community->name }}</option>
                        @endforeach
                    </select>
                    @error('communityId') <span class="text-red-500">{{ $message }}</span> @enderror

                    <br>
                    @if($editId)
                        <button wire:click="update" class="bg-blue-500 text-white px-4 py-2 rounded m-2">Actualizar</button>
                        <button wire:click="resetInput" class="bg-gray-500 text-white px-4 py-2 rounded m-2">Cancelar</button>
                    @else
                        <button wire:click="store" class="bg-green-500 text-white px-4 py-2 rounded m-2">Guardar</button>
                    @endif
                </div>

                <div class="p-4">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Busqueda" class="w-mid rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                    <select wire:model="searchType" class="w-mid rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Todos los tipos</option>
                        <option value="serviceType">Tipo Servicio</option>
                        <option value="parishioner">Feligres</option>
                    </select>
                </div>

                <table class="table-auto w-full border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">DPI</th>
                            <th class="px-4 py-2 border">Nombre</th>
                            <th class="px-4 py-2 border">Apellido</th>
                            <th class="px-4 py-2 border">F. Nacimiento</th>
                            <th class="px-4 py-2 border">Direcciòn</th>
                            <th class="px-4 py-2 border">Telefono</th>

                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parishioners as $parishioner)
                        <tr>
                            <td class="border py-3 px-6 text-left">{{ $parishioner->id }}</td>
                            <td class="border py-3 px-6 text-left">{{ $parishioner->dpi }}</td>
                            <td class="border py-3 px-6 text-left">{{ $parishioner->name }}</td>
                            <td class="border py-3 px-6 text-left">{{ $parishioner->last_name }}</td>
                            <td class="border py-3 px-6 text-left">{{ $parishioner->birthday }}</td>
                            <td class="border py-3 px-6 text-left">{{ $parishioner->address }}</td>
                            <td class="border py-3 px-6 text-left">{{ $parishioner->phone_number }}</td>
                            <td class="border py-3 px-6 text-center">
                                <button wire:click="edit({{ $parishioner->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                                <button wire:click="delete({{ $parishioner->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
