<div>
     @if(session('warning'))
        <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded mb-4">
            {{ session('warning') }}
        </div>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-[1fr_3fr] gap-6">
        <form wire:submit="simpan_semester" class="space-y-5">
            <flux:input 
            label='Nama Instansi' 
            placeholder='masukan nama instansi' 
            readonly
            class="bg-zink"
            :value="$instansi->namainstansi"
            :invalid="$errors->has('elemen')"/>

            <flux:select wire:model="namasemester" variant="listbox" searchable placeholder="Pilih Semester..." label="Semester" :invalid="$errors->has('namasemester')">
                <flux:select.option value="ganjil">Semester Ganjil</flux:select.option>
                <flux:select.option value="genap">Semester Genap</flux:select.option>
            </flux:select>

            <flux:select wire:model="tahunpelajaran" variant="listbox" searchable placeholder="Pilih Tahun pelajaran..." label="Tahun Pelajaran" :invalid="$errors->has('tahunpelajaran')">
                @foreach ($tp as $item)
                <flux:select.option value="{{ $item }}">{{ $item }}</flux:select.option>
                    
                @endforeach
            </flux:select>

            <div class="flex">
                <flux:button type="submit" variant='primary' color="green" class="w-full ms-auto">Tambah Semester</flux:button>
            </div>
        </form>


        <div class="">
            <div class="flex">
                <flux:input
                    icon="magnifying-glass"
                    placeholder="Search orders"
                    wire:model.live="search"
                    class="!w-70 focus:!w-70 transition-all duration-300 ms-auto"
                />

            </div>

            <flux:table :paginate='$semester'>
                <flux:table.columns >
                    <flux:table.column width="5px">No</flux:table.column>
                    <flux:table.column>Tahun Pelajaran</flux:table.column>
                    <flux:table.column>Semester</flux:table.column>
                    <flux:table.column>action</flux:table.column>
                </flux:table.columns>
            
                <flux:table.rows>
                    @foreach ($semester as $item)
                    <flux:table.row>
                        <flux:table.cell>{{ $loop->iteration + $semester->firstItem() - 1 }}</flux:table.cell>
                        <flux:table.cell>{{ $item->tahunpelajaran }}</flux:table.cell>
                        <flux:table.cell variant='strong' style="text-transform: capitalize">{{ $item->namasemester }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge as='button' variant='pill' color='red' icon='trash' size='lg' wire:click="hapus_semester({{ $item->idsemester }})">Hapus</flux:badge>
                        </flux:table.cell>
                    </flux:table.row>
                        
                    @endforeach
                </flux:table.rows>
            </flux:table>
        </div>
    </div>
</div>
