<div>
     @if(session('warning'))
        <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded mb-4">
            {{ session('warning') }}
        </div>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-[30%_65%] gap-5">
        <div class="">
            <flux:card class="border-none">
                <center>
            <img src="{{ $instansi?->logo 
            ? asset('storage/'.$instansi->logo) 
            : url('noimage.jpg') }}" alt="" class="w-[80%] rounded-lg border ">

                </center>

            </flux:card>

            <!-- Blade view: -->

            <form wire:submit="update_logo">
                <flux:file-upload wire:model="photo" label="Upload file" class="mt-2">
                    <flux:file-upload.dropzone heading="Drop file here or click to browse" text="JPG, PNG, GIF up to 2MB" class="h-[120px]"/>
                </flux:file-upload>

                <div class="mt-3 flex flex-col gap-2">
                    @if ($photo)
                        <flux:file-item
                            :heading="$photo->getClientOriginalName()"
                            :image="$photo->temporaryUrl()"
                            :size="$photo->getSize()"
                        >
                            <x-slot name="actions">
                                <flux:file-item.remove wire:click="removePhoto" aria-label="{{ 'Remove file: ' . $photo->getClientOriginalName() }}" />
                            </x-slot>
                        </flux:file-item>
                    @endif
                </div>

                <flux:button type="submit" variant="primary" class="w-full">Update Gambar</flux:button>
            </form>

        </div>

        <form wire:submit="update_instansi">
            <div class="space-y-5 pt-10">
                <flux:input 
                label='NPSN' 
                placeholder='Masukan NPSN' 
                type="number"
                wire:model='npsn'
                :invalid="$errors->has('npsn')"/>
                
                <flux:input 
                label='Nama Instansi' 
                placeholder='Masukan nama instansi' 
                wire:model='namainstansi'
                :invalid="$errors->has('namainstansi')"/>


                <flux:textarea 
                label='Alamat Instansi' 
                placeholder='Masukan alamat' 
                wire:model='alamatinstansi'
                :invalid="$errors->has('alamatinstansi')"/>

                <div class="flex">
                    <flux:button type="submit" variant='primary' color='green' class="ms-auto">UPDATE INSTANSI</flux:button>
                </div>
                
            </div>
        </form>
    </div>
</div>
