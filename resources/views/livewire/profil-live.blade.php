<div>
    <div class="grid grid-cols-1 md:grid-cols-[1fr_5fr_1fr] gap-5">
        <div class=""></div>
        <div class="">
            <flux:tab.group>
                <flux:tabs>
                    <flux:tab name="profil" icon="user">profil</flux:tab>
                    <flux:tab name="password" icon="cog-6-tooth">password</flux:tab>
                </flux:tabs>
    
                <flux:tab.panel name="profil">
                    <form action="" wire:submit.prevent="update_profil" class="space-y-6">
                        
                        <div class="flex">
                            
                            
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start">
                            <flux:input 
                            label='NIP*' 
                            placeholder='Masukan NIP' 
                            wire:model='nip'
                            type="number"
                            :invalid="$errors->has('nip')"/>
                            
                            <flux:input 
                            label='Nama Lengkap*' 
                            placeholder='Masukan namalengkap' 
                            wire:model='namalengkap'
                            :invalid="$errors->has('namalengkap')"/>
                            
                        </div>
                         <div class="grid grid-cols-[7fr_1fr] gap-5">
                            <div class="">
                                <flux:input 
                                    label='Email*' 
                                    placeholder='Masukan email' 
                                    wire:model='email'
                                    readonly
                                    variant="filled"
                                    :invalid="$errors->has('email')"/>
                            </div>
                            <div class="">
                                <br>
                                <flux:badge as='button' variant='pill' :color="$status==0?'red':'green'" :icon="$status==0?'x-circle':'check-circle'" size='lg' class="w-full text-center py-2 mt-1">{{ $status==0?'Non Verifikasi':'Terverifikasi' }}</flux:badge>                                
                            </div>
                                 


                         </div>

                        <flux:input 
                        label='Posisi*' 
                        placeholder='masukan posisi' 
                        wire:model='posisi'
                        style="text-transform: uppercase"
                        variant="filled"
                        readonly
                        :invalid="$errors->has('posisi')"/>

                         <flux:input 
                            label='Nama Instansi*' 
                            placeholder='Masukan nama instansi' 
                            wire:model='namainstansi'
                            readonly
                            variant="filled"
                            :invalid="$errors->has('namainstansi')"/>

                        <div class="flex">
                            <flux:button type="submit" variant='primary' color='zink' class="ms-auto w-md">UPDATE PROFIL</flux:button>
                        </div>

                    </form>

                </flux:tab.panel>
                
                
                <flux:tab.panel name="password">

                <form action="" wire:submit.prevent="update_password" class="space-y-6">
                    <div 
                        x-data="{
                            password: '',
                            confirm: '',
                            get strength() {
                                if (this.password.length < 6) return 'weak'
                                if (this.password.match(/[A-Z]/) && this.password.match(/[0-9]/)) return 'strong'
                                return 'medium'
                            }
                        }"
                        class="space-y-4"
                    >
                    
                        <!-- Password -->
                        <flux:input 
                            type="password"
                            label="New Password"
                            x-model="password"
                            wire:model="password"
                            viewable
                            :invalid="$errors->has('password')"
                            placeholder="Masukkan password"
                        />
                    
                           <div class="h-1 rounded-full bg-zinc-200 overflow-hidden">
                               <div 
                                   class="h-full transition-all duration-300"
                                   :class="{
                                       'w-1/3 bg-red-500': strength === 'weak',
                                       'w-2/3 bg-yellow-500': strength === 'medium',
                                       'w-full bg-green-500': strength === 'strong'
                                   }"
                               ></div>
                           </div>
                          
                    
                    
                        <!-- Confirm Password -->
                        <flux:input 
                            type="password"
                            label="Retype Password"
                            x-model="confirm"
                            viewable
                            wire:model="password_confirmation"
                            :invalid="$errors->has('password_confirmation')"
                            placeholder="Ulangi password"
                        />
                    
                        <!-- Match Indicator -->
                        <p 
                            class="text-sm"
                            x-show="confirm.length > 0"
                            :class="password === confirm ? 'text-green-500' : 'text-red-500'"
                            x-text="password === confirm ? 'Password cocok' : 'Password tidak cocok'"
                        ></p>


                    
                    </div>

                    
                    <div class="flex">
                        <flux:button type="submit" variant='primary' color='zink' class="ms-auto w-md">UPDATE PASSWORD</flux:button>
                    </div>

                </form>

                </flux:tab.panel>
                
            </flux:tab.group>
        </div>
        <div class=""></div>
    </div>
</div>
