<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pagos') }}
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
                <div class="mb-6">
                    <h2 class="text-xl font-bold mb-2">
                        @if($editId)
                            Editar Pago
                        @else
                            Registrar Pago
                        @endif
                    </h2>

                    <input type="number" wire:model="serviceTypeId" placeholder="Tipo de servicio" class="border p-2 mb-2 w-full">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <input type="number" wire:model="parishionerId" placeholder="Feligres" class="border p-2 mb-2 w-full">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <input type="date" wire:model="payDate" placeholder="Fecha de pago" class="border p-2 mb-2 w-full">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <input type="number" wire:model="ammount" placeholder="Monto" class="border p-2 mb-2 w-full">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror


                    @if($editId)
                        <button wire:click="update" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                        <button wire:click="resetInput" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    @else
                        <button wire:click="store" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
                    @endif
                </div>

                <table class="table-auto w-full border">
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
                            <td class="border px-4 py-2">{{ $pay->id }}</td>
                            <td class="border px-4 py-2">{{ $pay->service_type_id }}</td>
                            <td class="border px-4 py-2">{{ $pay->parishioner_id }}</td>
                            <td class="border px-4 py-2">{{ $pay->pay_date }}</td>
                            <td class="border px-4 py-2">{{ $pay->ammount }}</td>
                            <td class="border px-4 py-2">
                                <button wire:click="edit({{ $pay->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                                <button wire:click="delete({{ $pay->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
