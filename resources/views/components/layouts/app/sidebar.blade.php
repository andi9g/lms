<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-zinc dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:sidebar.nav>
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->is('dashboard*')" wire:navigate>Home</flux:sidebar.item>
                    <flux:sidebar.item icon="clock" :href="route('absen')" :current="request()->is('absen*')" wire:navigate>Absen Pembelajaran</flux:sidebar.item>
                    <flux:sidebar.item icon="book-open" :href="route('mapel')" :current="request()->is('mapel*')" wire:navigate>Mata Pelajaran</flux:sidebar.item>
                    @if (auth()->user()->posisi->posisi == "admin" || auth()->user()->posisi->posisi == "waka")
                    <flux:sidebar.item icon="clipboard-document-list" :href="route('laporan')" :current="request()->is('laporan*')" wire:navigate>Laporan</flux:sidebar.item>
                    
                    @endif
                    @if (auth()->user()->posisi->posisi == "admin")
                    <flux:sidebar.item icon="users" :href="route('account')" :current="request()->is('account*')" wire:navigate>Account</flux:sidebar.item>
                    
                    <flux:sidebar.group expandable icon="cog-6-tooth" heading="Setting" class="grid">
                        <flux:sidebar.item :href="route('instansi')"  :current="request()->is('instansi*')" wire:navigate>Instansi</flux:sidebar.item>
                        <flux:sidebar.item :href="route('semester')"  :current="request()->is('semester*')" wire:navigate>Semester</flux:sidebar.item>
                        <flux:sidebar.item :href="route('masterdata')" :current="request()->is('masterdata*')" wire:navigate>Master Data</flux:sidebar.item>
                    </flux:sidebar.group>
                    @endif
                </flux:sidebar.nav>

                
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                <flux:radio value="light" icon="sun" />
                <flux:radio value="dark" icon="moon" />
                <flux:radio value="system" icon="computer-desktop" />
            </flux:radio.group>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                    :avatar="auth()->user()->fotoprofil->fotoprofil"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <flux:profile
                                        :name="auth()->user()->name"
                                        :initials="auth()->user()->initials()"
                                        icon:trailing="chevrons-up-down"
                                        :avatar="auth()->user()->fotoprofil->fotoprofil"
                                    />
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profil')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                    :avatar="auth()->user()->fotoprofil->fotoprofil"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <flux:profile
                                        :name="auth()->user()->name"
                                        :initials="auth()->user()->initials()"
                                        icon:trailing="chevrons-up-down"
                                        :avatar="auth()->user()->fotoprofil->fotoprofil"
                                    />
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profil')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}
        <!-- Flux Scripts - TAMBAHKAN INI -->
    @fluxScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <flux:toast />
    </body>
</html>
