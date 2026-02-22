<x-layouts.app :title="$judul">
  
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div>
            <h1 class="mb-2 text-4xl font-bold text-heading md:text-4xl">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">{{ $judul }}</span>
            </h1>
            <div class="md:w-xs">
                <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                    <flux:radio value="light" icon="sun">Light</flux:radio>
                    <flux:radio value="dark" icon="moon">Dark</flux:radio>
                    <flux:radio value="system" icon="computer-desktop">System</flux:radio>
                </flux:radio.group>
            </div>
        </div>

       
        
    </div>

    <flux:separator variant="subtle" class="my-4"/>

    <livewire:absen-live>

    
    
</x-layouts.app>
