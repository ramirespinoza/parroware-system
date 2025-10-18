<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Certificados') }}
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
                            Editar Certificado
                        @else
                            Guardar Certificado
                        @endif
                    </h2>

                    <input type="file" wire:model="certificate" placeholder="Certificado" class="border p-2 mb-2 w-full">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <input type="date" wire:model="isueDate" placeholder="Fecha" class="border p-2 mb-2 w-full">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                    <input type="number" wire:model="assignedSacramentId" placeholder="Sacramento" class="border p-2 mb-2 w-full">
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
                            <th class="px-4 py-2 border">Certificado</th>
                            <th class="px-4 py-2 border">Fecha</th>
                            <th class="px-4 py-2 border">Sacramento</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($certificates as $certificate)
                        <tr>
                            <td class="border px-4 py-2">{{ $certificate->id }}</td>
                            <td class="border px-4 py-2">
                                <button wire:click="viewCertificate({{ $certificate->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Ver</button>
                            </td>
                            <td class="border px-4 py-2">{{ $certificate->isue_date }}</td>
                            <td class="border px-4 py-2">{{ $certificate->assigned_sacrament_id }}</td>
                            <td class="border px-4 py-2">
                                <button wire:click="edit({{ $certificate->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                                <button wire:click="delete({{ $certificate->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Visor de PDF --}}
    @if ($selectedCertificate)
        <div class="fixed inset-0 bg-black bg-opacity-70 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-2/3 p-4 relative">
                <button wire:click="closeViewer"
                        class="absolute top-2 right-2 text-gray-600 hover:text-black text-xl">
                    ✖
                </button>

                <h3 class="text-lg font-semibold mb-2">
                    {{ $selectedCertificate->name }}
                </h3>

                <iframe src="{{ asset('storage/' . $selectedCertificate->certificate) }}"
                        class="w-full h-[80vh]" frameborder="0"></iframe>
            </div>
        </div>
    @endif

</div>
