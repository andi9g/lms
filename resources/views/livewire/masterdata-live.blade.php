<div>
    <flux:tab.group>
        <flux:tabs>
            <flux:tab name="Kelas" icon="home-modern">Kelas</flux:tab>
            <flux:tab name="Jurusan" icon="beaker">Jurusan</flux:tab>
            <flux:tab name="Mapel" icon="book-open">Mapel</flux:tab>
            <flux:tab name="Ruang" icon="home">Ruang</flux:tab>
            <flux:tab name="JP" icon="clock">Jam Pelajaran</flux:tab>
        </flux:tabs>

        <flux:tab.panel name="Kelas">

            <div class="grid grid-cols-1 md:grid-cols-[1fr_3fr_1fr] gap-5">
                <div class=""></div>
                <div class="">
                    {{-- modal triger edit --}}
                    <flux:modal.trigger name='tambahkelas'>
                        <flux:badge as='button' variant='pill' color='blue' icon='plus' size='lg'>Tambah Kelas</flux:badge>
                    </flux:modal.trigger>
                    
                    <flux:modal name='tambahkelas' class='md:w-md'>
                        <form wire:submit.prevent='tambah_kelas' class='space-y-6'>
                            <div>
                                <flux:heading size='lg'>Form Kelas</flux:heading>
                            </div>
                    
                            <flux:input 
                            label='Nama Kelas' 
                            placeholder='contoh: X / XI / XII' 
                            wire:model.defer='namakelas'
                            :invalid="$errors->has('namakelas')"/>

                    
                            <div class='flex'>
                                <flux:spacer />
                                <flux:modal.close>
                                    <flux:button variant='filled'>Cancel</flux:button>
                                </flux:modal.close>
                    
                                <flux:separator vertical class='mx-3'/>
                    
                                <flux:button type='submit' variant='primary'>Tambah</flux:button>
                            </div>
                        </form>
                    </flux:modal>     
                    
                    

                    <flux:table>
                        <flux:table.columns >
                            <flux:table.column width="5px">No</flux:table.column>
                            <flux:table.column>Nama Kelas</flux:table.column>
                            <flux:table.column>action</flux:table.column>
                        </flux:table.columns>
                    
                        <flux:table.rows>
                            @foreach ($kelas as $item)
                            <flux:table.row>
                                <flux:table.cell>{{ $loop->iteration }}</flux:table.cell>
                                <flux:table.cell variant="strong">{{ $item->namakelas }}</flux:table.cell>
                                <flux:table.cell>
                                    <flux:badge variant="pill" color="red" icon="trash" size="md" wire:click="hapus_kelas({{ $item->idkelas }})">Hapus</flux:badge>
                                </flux:table.cell>
                            </flux:table.row>
                                
                            @endforeach
                        </flux:table.rows>
                    </flux:table>

                </div>
                <div class=""></div>
            </div>

        </flux:tab.panel>


        <flux:tab.panel name="Jurusan">

            <div class="grid grid-cols-1 md:grid-cols-[1fr_3fr_1fr] gap-5">
                <div class=""></div>
                <div class="">
                    {{-- modal triger edit --}}
                    <flux:modal.trigger name='tambahjurusan'>
                        <flux:badge as='button' variant='pill' color='blue' icon='plus' size='lg'>Tambah Jurusan</flux:badge>
                    </flux:modal.trigger>
                    
                    <flux:modal name='tambahjurusan' class='md:w-md'>
                        <form wire:submit.prevent='tambah_jurusan' class='space-y-6'>
                            <div>
                                <flux:heading size='lg'>Form Jurusan</flux:heading>
                            </div>
                    
                            <flux:input 
                            label='Nama Jurusan' 
                            placeholder='Masukan jurusan contoh: TJKT, RPL dll.' 
                            wire:model.defer='namajurusan'
                            :invalid="$errors->has('namajurusan')"/>

                    
                            <div class='flex'>
                                <flux:spacer />
                                <flux:modal.close>
                                    <flux:button variant='filled'>Cancel</flux:button>
                                </flux:modal.close>
                    
                                <flux:separator vertical class='mx-3'/>
                    
                                <flux:button type='submit' variant='primary'>Tambah</flux:button>
                            </div>
                        </form>
                    </flux:modal>     
                    
                    

                    <flux:table>
                        <flux:table.columns >
                            <flux:table.column width="5px">No</flux:table.column>
                            <flux:table.column>Nama Jurusan</flux:table.column>
                            <flux:table.column>action</flux:table.column>
                        </flux:table.columns>
                    
                        <flux:table.rows>
                            @foreach ($jurusan as $item)
                            <flux:table.row>
                                <flux:table.cell>{{ $loop->iteration }}</flux:table.cell>
                                <flux:table.cell variant="strong">{{ $item->namajurusan }}</flux:table.cell>
                                <flux:table.cell>
                                    <flux:badge variant="pill" color="red" icon="trash" size="md" wire:click="hapus_jurusan({{ $item->idjurusan }})">Hapus</flux:badge>
                                </flux:table.cell>
                            </flux:table.row>
                                
                            @endforeach
                        </flux:table.rows>
                    </flux:table>

                </div>
                <div class=""></div>
            </div>

        </flux:tab.panel>



        <flux:tab.panel name="Mapel">

            <div class="grid grid-cols-1 md:grid-cols-[1fr_3fr_1fr] gap-5">
                <div class=""></div>
                <div class="">
                    {{-- modal triger edit --}}
                    <flux:modal.trigger name='tambahmapel'>
                        <flux:badge as='button' variant='pill' color='blue' icon='plus' size='lg'>Tambah Mapel</flux:badge>
                    </flux:modal.trigger>
                    
                    <flux:modal name='tambahmapel' class='md:w-md'>
                        <form wire:submit.prevent='tambah_mapel' class='space-y-6'>
                            <div>
                                <flux:heading size='lg'>Form Mapel</flux:heading>
                            </div>
                    
                            <flux:input 
                            label='Nama Mapel' 
                            placeholder='Masukan mapel' 
                            wire:model.defer='namamapel'
                            :invalid="$errors->has('namamapel')"/>

                    
                            <div class='flex'>
                                <flux:spacer />
                                <flux:modal.close>
                                    <flux:button variant='filled'>Cancel</flux:button>
                                </flux:modal.close>
                    
                                <flux:separator vertical class='mx-3'/>
                    
                                <flux:button type='submit' variant='primary'>Tambah</flux:button>
                            </div>
                        </form>
                    </flux:modal>     
                    
                    

                    <flux:table>
                        <flux:table.columns >
                            <flux:table.column width="5px">No</flux:table.column>
                            <flux:table.column>Nama Mapel</flux:table.column>
                            <flux:table.column>action</flux:table.column>
                        </flux:table.columns>
                    
                        <flux:table.rows>
                            @foreach ($mapel as $item)
                            <flux:table.row>
                                <flux:table.cell>{{ $loop->iteration }}</flux:table.cell>
                                <flux:table.cell variant="strong">{{ $item->namamapel }}</flux:table.cell>
                                <flux:table.cell>
                                    <flux:badge variant="pill" color="red" icon="trash" size="md" wire:click="hapus_mapel({{ $item->idmapel }})">Hapus</flux:badge>
                                </flux:table.cell>
                            </flux:table.row>
                                
                            @endforeach
                        </flux:table.rows>
                    </flux:table>

                </div>
                <div class=""></div>
            </div>
        
        </flux:tab.panel>
        
        
        <flux:tab.panel name="Ruang">

            <div class="grid grid-cols-1 md:grid-cols-[1fr_3fr_1fr] gap-5">
                <div class=""></div>
                <div class="">
                    {{-- modal triger edit --}}
                    <flux:modal.trigger name='tambahruang'>
                        <flux:badge as='button' variant='pill' color='blue' icon='plus' size='lg'>Tambah Ruang</flux:badge>
                    </flux:modal.trigger>
                    
                    <flux:modal name='tambahruang' class='md:w-md'>
                        <form wire:submit.prevent='tambah_ruang' class='space-y-6'>
                            <div>
                                <flux:heading size='lg'>Form ruang</flux:heading>
                            </div>
                    
                            <flux:pillbox wire:model="namaruang" variant="combobox" multiple label="Pilih / Tambah Ruang">
                                <x-slot name="input">
                                    <flux:pillbox.input wire:model="search" />
                                </x-slot>

                                @foreach ($dataruang as $item)
                                    <flux:pillbox.option :value="$item">{{ $item }}</flux:pillbox.option>
                                    
                                @endforeach

                                <flux:pillbox.option.create wire:click="createTag" min-length="2">
                                    Create tag "<span wire:text="search"></span>"
                                </flux:pillbox.option.create>
                            </flux:pillbox>

                    
                            <div class='flex'>
                                <flux:spacer />
                                <flux:modal.close>
                                    <flux:button variant='filled'>Cancel</flux:button>
                                </flux:modal.close>
                    
                                <flux:separator vertical class='mx-3'/>
                    
                                <flux:button type='submit' variant='primary'>Tambah</flux:button>
                            </div>
                        </form>
                    </flux:modal>     
                    
                    

                    <flux:table>
                        <flux:table.columns >
                            <flux:table.column width="5px">No</flux:table.column>
                            <flux:table.column>Nama Ruang</flux:table.column>
                            <flux:table.column>action</flux:table.column>
                        </flux:table.columns>
                    
                        <flux:table.rows>
                            @foreach ($ruang as $item)
                            <flux:table.row>
                                <flux:table.cell>{{ $loop->iteration }}</flux:table.cell>
                                <flux:table.cell variant="strong">{{ $item->namaruang }}</flux:table.cell>
                                <flux:table.cell>
                                    <flux:badge variant="pill" color="red" icon="trash" size="md" wire:click="hapus_ruang({{ $item->idruang }})">Hapus</flux:badge>
                                </flux:table.cell>
                            </flux:table.row>
                                
                            @endforeach
                        </flux:table.rows>
                    </flux:table>

                </div>
                <div class=""></div>
            </div>

        </flux:tab.panel>
        
        
        <flux:tab.panel name="JP">

            <div class="grid grid-cols-1 md:grid-cols-[1fr_3fr_1fr] gap-5">
                <div class=""></div>
                <div class="">
                    {{-- modal triger edit --}}
                    <flux:modal.trigger name='tambahjp'>
                        <flux:badge as='button' variant='pill' color='blue' icon='plus' size='lg'>Tambah JP dalam sehari</flux:badge>
                    </flux:modal.trigger>
                    
                    <flux:modal name='tambahjp' class='md:w-md'>
                        <form wire:submit.prevent='tambah_jp' class='space-y-6'>
                            <div>
                                <flux:heading size='lg'>Form Jam Pelajaran</flux:heading>
                            </div>
                    
                            <flux:input 
                            label='JP ke:' 
                            placeholder='Masukan jam ke : 1-11' 
                            wire:model.defer='namajp'
                            :invalid="$errors->has('namajp')"/>

                    
                            <div class='flex'>
                                <flux:spacer />
                                <flux:modal.close>
                                    <flux:button variant='filled'>Cancel</flux:button>
                                </flux:modal.close>
                    
                                <flux:separator vertical class='mx-3'/>
                    
                                <flux:button type='submit' variant='primary'>Tambah</flux:button>
                            </div>
                        </form>
                    </flux:modal>     
                    
                    

                    <flux:table>
                        <flux:table.columns >
                            <flux:table.column width="5px">No</flux:table.column>
                            <flux:table.column>Nama jp</flux:table.column>
                            <flux:table.column>action</flux:table.column>
                        </flux:table.columns>
                    
                        <flux:table.rows>
                            @foreach ($jp as $item)
                            <flux:table.row>
                                <flux:table.cell>{{ $loop->iteration }}</flux:table.cell>
                                <flux:table.cell variant="strong">Jam Pelajaran ke {{ $item->namajp }}</flux:table.cell>
                                <flux:table.cell>
                                    <flux:badge variant="pill" color="red" icon="trash" size="md" wire:click="hapus_jp({{ $item->idjp }})">Hapus</flux:badge>
                                </flux:table.cell>
                            </flux:table.row>
                                
                            @endforeach
                        </flux:table.rows>
                    </flux:table>

                </div>
                <div class=""></div>
            </div>


        </flux:tab.panel>
    </flux:tab.group>
</div>
