<div>
<div class="grid grid-cols-1">
    <div class="space-y-5 max-w-4xl  w-full">
        <flux:card class="bg-zinc">
            <flux:tab.group>
                <flux:tabs>
                    <flux:tab name="Absen" icon="clock">Absen</flux:tab>
                    <flux:tab name="Data Absen" icon="circle-stack">Data Harian</flux:tab>
                </flux:tabs>
                <flux:tab.panel name="Absen">
        
                    
                            <form wire:submit.prevent="absen" class="space-y-5">
                                <flux:select 
                                    variant="listbox" 
                                    searchable 
                                    placeholder="Pilih Mapel..." 
                                    label="Mata Pelajaran"
                                    wire:model="idgurumapel"
                                    wire:model.change="ambilgurumapel">
                                    
                                    @foreach ($gurumapel as $item)
                                        <flux:select.option :value="$item->idgurumapel">{{ 
                                        $item->kelas->namakelas." ".$item->jurusan->namajurusan." - "
                                        .$item->mapel->namamapel
                                         }}</flux:select.option>
                                    @endforeach
        
                                </flux:select>
        
        
                                <div class="grid grid-cols-2 gap-5">
                                    <flux:select variant="listbox" searchable placeholder="Pilih Ruangan..." label="Ruangan" wire:model="idruang">
                                        @foreach ($ruang as $item)
                                        <flux:select.option :value="$item->idruang">{{ $item->namaruang }}</flux:select.option>
                                            
                                        @endforeach
                                    </flux:select>
                                    <flux:select variant="listbox" searchable placeholder="Pilih Jam ke..." label="Jam Pelajaran" wire:model="idjp">
                                        @foreach ($jp as $item)
                                        <flux:select.option :value="$item->idjp">Jam Ke {{ $item->namajp }}</flux:select.option>
                                            
                                        @endforeach
                                    </flux:select>
                                </div>
        
                                <flux:textarea
                                    label="Judul Materi"
                                    placeholder="Masukan judul materi"
                                    wire:model="materi"
                                />

                                <div class="flex">
                                    <flux:button type="submit" variant='primary' color='green' class="w-md ms-auto">Absen Sekarang</flux:button>
                                </div>
        
                            </form>
                        
        
                </flux:tab.panel>
                
                
                <flux:tab.panel name="Data Absen">
                    @php
                        $tgl = \Carbon\Carbon::parse(date("Y-m-d"))->locale("id")->isoFormat("dddd, DD MMMM YYYY");
                    @endphp
                    <flux:text>{{ $tgl }}</flux:text>
                    <flux:table>
                        <flux:table.columns >
                            <flux:table.column width="5px">No</flux:table.column>
                            <flux:table.column>Waktu</flux:table.column>
                            <flux:table.column>Ruang</flux:table.column>
                            <flux:table.column>Mapel</flux:table.column>
                            <flux:table.column>Rombel</flux:table.column>
                            <flux:table.column>Jam</flux:table.column>
                        </flux:table.columns>
                    
                        <flux:table.rows>
                            @foreach ($absenpelajaran as $item)
                            <flux:table.row>
                                <flux:table.cell>{{ $loop->iteration }}</flux:table.cell>
                                <flux:table.cell>Jam ke {{ $item->jp->namajp }}</flux:table.cell>
                                <flux:table.cell>{{ $item->ruang->namaruang }}</flux:table.cell>
                                <flux:table.cell>{{ $item->gurumapel->mapel->namamapel }}</flux:table.cell>
                                <flux:table.cell>
                                    {{ $item->gurumapel->kelas->namakelas. " " . $item->gurumapel->jurusan->namajurusan }}
                                </flux:table.cell>
                                <flux:table.cell variant='strong'>
                                    {{ $item->jamabsen }}
                                </flux:table.cell>
                            </flux:table.row>
                                
                            @endforeach
                        </flux:table.rows>
                    </flux:table>
                
                </flux:tab.panel>
            
            </flux:tab.group>

        </flux:card>
    </div>
</div>
</div>
