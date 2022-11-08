<div class="p-6">
    <div class="flex items-centre justify-end px-4 py-3 sm:py-6 text-right">

    davidimo
    <x-jet-button wire:click="createShowModal">
        {{ __('Create') }}
    </x-jet-button>
</div>
    {{-- MODAL FORM --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Save Project') }} {{ $projectId }}
        </x-slot>

        <x-slot name="content">

            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                    wire:model="name" />

                @error('name')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email"
                    wire:model="email" />

                @error('email')<span class="error">{{ $message }}</span>@enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="status" value="{{ __('status') }}" />
                <select class="shadow p-2.5 text-sm rounded-lg bg-gray-50 border border-gray-300" 
                    wire:model="status" id="status">
                    <option value="" disabled>Please select one</option>
                    <option value="Design">Design</option>
                    <option value="Ready">Ready</option>
                    <option value="In Progress">In Progress</option>
                    <option value="On Hold">On Hold</option>
                    <option value="Completed">Completed</option>
                </select>
                @error('status')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            @if ($projectId)
                <x-jet-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-button>
           @else
            <x-jet-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
        
    {{-- DELETE MODAL  --}}
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this? Once it is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>


    {{-- TABLE --}}
    <div class="flex flex-col">
        <div class="my-2 overflow-x-auto sm:mx-6 lg:mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>

                                <th class="table-head">Name</th>
                                <th class="table-head">Email</th>
                                <th class="table-head">Status</th>
                                <th class="table-head">buttons</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($data as $project)
                                <tr>


                                    <td class="table-data">{{ $project->name }}</td>

                                    <td class="table-data">{{ $project->email }}</td>

                                    <td class="table-data">{{ $project->status }}</td>

                                    <td class="table-data flex justify-end gap-2">

                                    <x-jet-button wire:click="updateShowModal({{ $project->id }})">
                                        {{ __('Edit') }}
                                    </x-jet-button>
                                    <x-jet-danger-button wire:click="deleteShowModal({{ $project->id }})">
                                        {{ __('Delete') }}
                                        </x-jet-button>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
