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
                <div class="p-8 mb-6">
                    <h2 class="text-xl font-bold mb-2">
                        @if($editId)
                            Editar Certificado
                        @else
                            Guardar Certificado
                        @endif
                    </h2>

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Certificado</label>
                    <input type="file" wire:model="certificate" placeholder="Certificado" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('certificate') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Fecha de pago</label>
                    <input type="date" wire:model="isueDate" placeholder="Fecha" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('isueDate') <span class="text-red-500">{{ $message }}</span> @enderror

                    <label class="block text-sm font-medium text-gray-700 m-2 m-0">Tipo de pago</label>
                    <select wire:model="assignedSacramentId" placeholder="Tipo de sacramento" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Seleccione un sacramento realizado</option>
                        @foreach($assignedSacraments as $assignedSacrament)
                        <option value="{{ $assignedSacrament->id }}">{{ $assignedSacrament->parishioner->name }} {{ $assignedSacrament->parishioner->last_name }} - {{ $assignedSacrament->scheduled_date }}</option>
                        @endforeach
                    </select>
                    @error('assignedSacramentId') <span class="text-red-500">{{ $message }}</span> @enderror

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
                        <option value="parishioner">Feligres</option>
                    </select>
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
                            <td class="border py-3 px-6 text-left">{{ $certificate->id }}</td>
                            <td class="border py-3 px-6 text-left">
                                <button wire:click="viewCertificate({{ $certificate->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Ver</button>
                            </td>
                            <td class="border py-3 px-6 text-left">{{ $certificate->isue_date }}</td>
                            <td class="border py-3 px-6 text-left">{{ $certificate->assigned_sacrament_id }}</td>
                            <td class="border py-3 px-6 text-center">
                                <button wire:click="edit({{ $certificate->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</button>
                                <button wire:click="delete({{ $certificate->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
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
