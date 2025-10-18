<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tipos de Sacramento') }}
        </h2>
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
                            Editar Tipo Servicio
                        @else
                            Crear Tipo Servicio
                        @endif
                    </h2>

                    <input type="text" wire:model="name" placeholder="Nombre" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 m-2">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <textarea wire:model="description" placeholder="Descripcion" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 m-2"></textarea>
                    @error('description') <span class="text-red-500">{{ $message }}</span> @enderror

                    @if($editId)
                        <button wire:click="update" class="bg-blue-500 text-white px-4 py-2 rounded m-2">Update</button>
                        <button wire:click="resetInput" class="bg-gray-500 text-white px-4 py-2 rounded m-2">Cancel</button>
                    @else
                        <button wire:click="store" class="bg-green-500 text-white px-4 py-2 rounded m-2">Save</button>
                    @endif
                </div>

                <table class="table-auto w-full border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Description</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($service_types as $service_type)
                        <tr>
                            <td class="border py-3 px-6 text-left">{{ $service_type->id }}</td>
                            <td class="border py-3 px-6 text-left">{{ $service_type->name }}</td>
                            <td class="border py-3 px-6 text-left">{{ $service_type->description }}</td>
                            <td class="border py-3 px-6 text-center">
                                <button wire:click="edit({{ $service_type->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                                <button wire:click="delete({{ $service_type->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
