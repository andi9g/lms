<div>
    <flux:modal name='edit_gurumapel' class="w-xl">
        <form wire:submit.prevent='update_mapel' class='space-y-6'>
            <div>
                <flux:heading size='lg'>Form Mata Pelajaran</flux:heading>
                <flux:text class='mt-2'>silahkan lengkapi form dibawah ini.</flux:text>
            </div>
            
    
            <flux:select variant="listbox" searchable placeholder="Pilih Mata Pelajaran" label="Mata Pelajaran" wire:model.defer="data.idmapel">
                @foreach ($mapel as $item)
                    <flux:select.option :value="$item->idmapel">{{ $item->namamapel }}</flux:select.option>
                    @endforeach
            </flux:select>

            <div class="grid grid-cols-[1fr_2fr] gap-5 items-start">
                <flux:select variant="listbox" placeholder="Pilih Kelas..." label="Kelas" wire:model.defer="data.idkelas">
                    @foreach ($kelas as $item)
                    <flux:select.option :value="$item->idkelas">{{ $item->namakelas }}</flux:select.option>
                    @endforeach
                    
                </flux:select>


                <flux:select variant="listbox" searchable placeholder="Pilih Jurusan..." label="Jurusan" wire:model.defer="data.idjurusan">
                    @foreach ($jurusan as $item)
                        <flux:select.option :value="$item->idjurusan">{{ $item->namajurusan }}</flux:select.option>
                    @endforeach
                    
                </flux:select>
            </div>
    
            
            <div class='flex'>
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant='filled'>Cancel</flux:button>
                </flux:modal.close>
    
                <flux:separator vertical class='mx-3'/>
    
                <flux:button type='submit' variant='primary'>Update Mapel</flux:button>
            </div>
        </form>
    </flux:modal>
    <div class="grid grid-cols-1 md:grid-cols-[1fr_6fr_1fr] gap-5">
        <div class=""></div>
        <div class="spac">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start">
                <div class="">
                    {{-- modal triger edit --}}
                    <flux:modal.trigger name='edit-profile'>
                        <flux:button as='button' variant='primary' color='blue' icon='plus' >Tambah Mata Pelajaran</flux:button>
                    </flux:modal.trigger>
                    
                    <flux:modal name='edit-profile' class='w-xl' flyout variant="floating" position="left">
                        <form wire:submit.prevent='tambah_mapel' class='space-y-6'>
                            <div>
                                <flux:heading size='lg'>Form Mata Pelajaran</flux:heading>
                                <flux:text class='mt-2'>silahkan lengkapi form dibawah ini.</flux:text>
                            </div>
                            
                    
                            <flux:select variant="listbox" searchable placeholder="Pilih Mata Pelajaran" label="Mata Pelajaran" wire:model="idmapel">
                                @foreach ($mapel as $item)
                                    <flux:select.option :value="$item->idmapel">{{ $item->namamapel }}</flux:select.option>
                                    @endforeach
                            </flux:select>
    
                            <div class="grid grid-cols-[1fr_2fr] gap-5 items-start">
                                <flux:select variant="listbox" placeholder="Pilih Kelas..." label="Kelas" wire:model="idkelas">
                                    @foreach ($kelas as $item)
                                    <flux:select.option :value="$item->idkelas">{{ $item->namakelas }}</flux:select.option>
                                    @endforeach
                                    
                                </flux:select>
    
    
                                <flux:select variant="listbox" searchable placeholder="Pilih Jurusan..." label="Jurusan" wire:model="idjurusan">
                                    @foreach ($jurusan as $item)
                                        <flux:select.option :value="$item->idjurusan">{{ $item->namajurusan }}</flux:select.option>
                                    @endforeach
                                    
                                </flux:select>
                            </div>
                    
                            
                            <div class='flex'>
                                <flux:spacer />
                                <flux:modal.close>
                                    <flux:button variant='filled'>Cancel</flux:button>
                                </flux:modal.close>
                    
                                <flux:separator vertical class='mx-3'/>
                    
                                <flux:button type='submit' variant='primary'>Simpan Mapel</flux:button>
                            </div>
                        </form>
                    </flux:modal>
                    
                </div>
                <div class="flex">
                    <flux:input kbd="⌘K" icon="magnifying-glass" placeholder="Search..." class="w-lg ms-auto"/>
                </div>
            </div>

            <flux:table class="mt-5">
                <flux:table.columns >
                    <flux:table.column width="5px">No</flux:table.column>
                    <flux:table.column>Mata Pelajaran</flux:table.column>
                    <flux:table.column>Rombel</flux:table.column>
                    <flux:table.column>Action</flux:table.column>
                </flux:table.columns>
            
                <flux:table.rows>
                    @foreach ($gurumapel as $item)
                    <flux:table.row>
                        <flux:table.cell>{{ $loop->iteration }}</flux:table.cell>
                        <flux:table.cell variant="strong">{{ $item->mapel->namamapel }}</flux:table.cell>
                        <flux:table.cell>{{ $item->kelas->namakelas." - ".$item->jurusan->namajurusan  }}</flux:table.cell>
                        <flux:table.cell>
                                <flux:badge as='button' variant='pill' color='blue' icon='pencil-square' size='sm' wire:click="getData({{ $item->idgurumapel }})">Edit</flux:badge>
                                <flux:badge as='button' variant='pill' color='red' icon='trash' size='sm' wire:click="hapus({{ $item->idgurumapel }})">Hapus</flux:badge>

                        </flux:table.cell>
                    </flux:table.row>
                        
                    @endforeach
                </flux:table.rows>
            </flux:table>

        </div>
        <div class=""></div>


        
    </div>

    
</div>
