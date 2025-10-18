<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sacerdote') }}
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
                            Edit Sacerdote
                        @else
                            Create Sacerdote
                        @endif
                    </h2>

                    <input type="number" wire:model="dpi" placeholder="DPI" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 m-2">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <input type="text" wire:model="name" placeholder="Nombre" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 m-2">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <input type="text" wire:model="lastName" placeholder="Apellido" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 m-2">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <input type="date" wire:model="birthday" placeholder="F. Nacimiento" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 m-2">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <input type="text" wire:model="address" placeholder="Direcciòn" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 m-2">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <input type="number" wire:model="phoneNumber" placeholder="Numero de telèfono" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 m-2">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <input type="email" wire:model="email" placeholder="Correo" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 m-2">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

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
                        @foreach($priests as $priest)
                        <tr>
                            <td class="border py-3 px-6 text-left">{{ $priest->id }}</td>
                            <td class="border py-3 px-6 text-left">{{ $priest->dpi }}</td>
                            <td class="border py-3 px-6 text-left">{{ $priest->name }}</td>
                            <td class="border py-3 px-6 text-left">{{ $priest->last_name }}</td>
                            <td class="border py-3 px-6 text-left">{{ $priest->birthday }}</td>
                            <td class="border py-3 px-6 text-left">{{ $priest->address }}</td>
                            <td class="border py-3 px-6 text-left">{{ $priest->phone_number }}</td>
                            <td class="border py-3 px-6 text-center">
                                <button wire:click="edit({{ $priest->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                                <button wire:click="delete({{ $priest->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
