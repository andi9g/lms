<div>
    <div class="grid grid-cols-1 md:grid-cols-[30%_70%] gap-5">
        <div class="w-full">
            <img src="{{ asset("storage/".empty($instansi->logo)?'':$instansi->logo) }}" alt="" class="w-full rounded-lg">

            <!-- Blade view: -->

            <form wire:submit="save">
                <flux:file-upload wire:model="photo" label="Upload file">
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

                <flux:button type="submit" variant="primary" class="w-full">Save</flux:button>
            </form>

        </div>
    </div>
</div>
