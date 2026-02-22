<x-layouts.app :title="$judul">
  
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div>
            <h1 class="mb-2 text-4xl font-bold text-heading md:text-4xl">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">{{ $judul }}</span>
            </h1>
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ url('/dashboard', []) }}" icon="home">Home</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Laporan</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>

        <div>
           <flux:input icon="magnifying-glass" placeholder="Search orders" />
        </div>
        
    </div>

    <flux:separator variant="subtle" class="my-4"/>
    
    <div class="grid grid-cols-1">
        <div class="space-y-5 max-w-5xl mx-auto w-full">

            <flux:tab.group>
                <flux:tabs wire:model="tab">
                    <flux:tab name="Laporan Absen">Laporan Absen</flux:tab>
                    <flux:tab name="Laporan Berikutnya">Laporan Berikutnya</flux:tab>
                </flux:tabs>
                <flux:tab.panel name="Laporan Absen">

                <flux:card >
                    <form action="{{ route('cetak.absen', []) }}" target="_blank" class="space-y-5">
                        <flux:date-picker :value="date('Y-m-d')" label="Tanggal Cetak Absen"  name="tanggalabsen"/>

                        <div class="flex">
                            <flux:button type="submit" variant='primary' class="ms-auto w-md" color='green'>Cetak</flux:button>
                        </div>
                    </form>

                </flux:card>
                
                </flux:tab.panel>
                <flux:tab.panel name="Laporan Berikutnya">...</flux:tab.panel>
            </flux:tab.group>
            
        </div>
    </div>

    
</x-layouts.app>