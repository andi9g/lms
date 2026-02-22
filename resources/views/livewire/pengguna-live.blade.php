<div>
    
    <div class="grid grid-cols-1 md:grid-cols-[2fr_3fr] gap-5">
        <div class="flex">
            <flux:button as='button' variant='primary' color='zink' icon='plus' class="w-sm">Tambah User</flux:button>
        </div>
        <div class="flex">
            <flux:input icon="magnifying-glass" placeholder="Search orders" class="w-sm ms-auto" wire:model.live="search"/>
        </div>
    </div>


    <flux:table :paginate='$user' class="mt-3">
        <flux:table.columns >
            <flux:table.column width="5px">No</flux:table.column>
            <flux:table.column>Email</flux:table.column>
            <flux:table.column>Nama</flux:table.column>
            <flux:table.column >Posisi</flux:table.column>
            <flux:table.column>Status</flux:table.column>
        </flux:table.columns>
    
        <flux:table.rows>
            @foreach ($user as $item)
            <flux:table.row>
                <flux:table.cell>{{ $loop->iteration + $user->firstItem() - 1 }}</flux:table.cell>
                <flux:table.cell variant="strong">{{ $item->name }}</flux:table.cell>
                <flux:table.cell variant="strong">{{ $item->email }}</flux:table.cell>
                <flux:table.cell >
                    
                    <flux:select
                        wire:model.live="posisi.{{ $item->iduser }}"
                        wire:change="updatePosisi({{ $item->iduser }})"
                        class="w-[150px]"
                    >
                        <flux:select.option value="guru">Guru</flux:select.option>
                        <flux:select.option value="waka">Waka</flux:select.option>
                        <flux:select.option value="kepsek">Kepala Sekolah</flux:select.option>
                        <flux:select.option value="admin">Admin</flux:select.option>
                    </flux:select>
                </flux:table.cell>
                <flux:table.cell variant='strong'>
                    @if ($status[$item->iduser] == 0)
                        <flux:badge type="button" wire:click="aktif({{ $status[$item->iduser] }},{{ $item->iduser }})" variant='pill' icon="x-circle" 
                        class="cursor-pointer transition-all duration-200 hover:scale-105 hover:shadow-md"    
                        color='red'>Tidak Aktif</flux:badge>
                    @else
                        <flux:badge type="button" wire:click="aktif({{ $status[$item->iduser] }},{{ $item->iduser }})" variant='pill' icon="check-circle" 
                        class="cursor-pointer transition-all duration-200 hover:scale-105 hover:shadow-md"    
                        color='green'>Aktif</flux:badge>    

                    @endif

                </flux:table.cell>
            </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>


</div>
