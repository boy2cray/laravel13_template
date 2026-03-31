<div class="min-h-screen bg-slate-50 dark:bg-slate-950 pb-20 transition-colors duration-300 font-sans" >

    <div class="relative h-60 lg:h-72 overflow-hidden">
        <div class="absolute rounded-t-2xl inset-0 bg-linear-to-r from-blue-600 via-indigo-600 to-violet-600 dark:from-slate-900 dark:via-blue-950 dark:to-slate-900"></div>
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
        <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute top-10 right-10 w-48 h-48 bg-cyan-400/20 rounded-full blur-2xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-28 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
            
            <div class="lg:col-span-4 xl:col-span-3">
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 overflow-hidden sticky top-6">
                    
                    <div class="pt-8 px-6 pb-6 text-center border-b border-slate-100 dark:border-slate-800">
                        <div class="relative inline-block group">
                            <div class="w-32 h-32 md:w-40 md:h-40 mx-auto rounded-full p-1 bg-white dark:bg-slate-800 ring-4 ring-indigo-50 dark:ring-slate-700 shadow-lg relative z-0">
                                <div class="w-full h-full rounded-full overflow-hidden relative">
                                    @if ($newPhoto)
                                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="{{ $newPhoto->temporaryUrl() }}">
                                    @else
                                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="{{ asset('storage/' . $karyawan->foto) }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($this->karyawan->nama) }}&background=6366f1&color=fff'">
                                    @endif
                                </div>
                            </div>

                            <label for="upload-photo" class="absolute bottom-1 right-1 z-10 p-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full shadow-lg cursor-pointer transition-all hover:scale-110 ring-4 ring-white dark:ring-slate-900" title="Ganti Foto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                </svg>
                                <input type="file" id="upload-photo" wire:model="newPhoto" class="hidden" accept="image/*">
                            </label>
                        </div>

                        <div class="mt-5">
                            <h2 class="text-xl font-bold text-slate-800 dark:text-white leading-tight">
                                {{ $this->karyawan->nama }}
                            </h2>
                            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mt-1">NIK: {{ $this->karyawan->nik }}</p>
                        </div>

                        @if ($newPhoto)
                            <div class="grid grid-cols-2 gap-2 mt-5 animate-pulse">
                                <button wire:click="updatePhoto" class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-xs font-bold shadow-md transition-colors">Simpan</button>
                                <button wire:click="$set('newPhoto', null)" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 rounded-xl text-xs font-bold transition-colors">Batal</button>
                            </div>
                        @endif
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-4 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <div class="bg-indigo-100 dark:bg-indigo-900/30 p-2 rounded-lg shrink-0">
                                <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Email Akun</p>
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 truncate" title="{{ $this->karyawan->user->email }}">
                                    {{ $this->karyawan->user->email }}
                                </p>
                            </div>
                        </div>

                        <button @click.prevent="modalEdit = true" class="w-full flex items-center justify-center gap-2 py-3 rounded-xl border border-dashed border-slate-300 dark:border-slate-700 text-slate-500 dark:text-slate-400 text-sm font-semibold hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 dark:hover:bg-slate-800 dark:hover:border-slate-600 transition-all group">
                            <svg class="h-4 w-4 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Ganti Password
                        </button>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 xl:col-span-9 space-y-6" x-cloak>
                {{-- TAB --}}

                @php
                    $myTabs = [
                        ['id' => 'tab1', 'label' => 'Profil Saya', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'], 
                        ['id' => 'tab2', 'label' => 'Tab 2', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'], 
                        ['id' => 'tab3', 'label' => 'Tab 3', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'], 
                        ['id' => 'tab4', 'label' => 'Tab 4', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'], 
                        //Tambahkan tab disini jika perlu
                    ];
                @endphp

                <x-tabs :tabs="$myTabs" active="tab1">

                    {{-- TAB 1: --}}
                    <x-tabs.panel id="tab1" class="p-6 md:p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-slate-800 dark:text-white flex items-center gap-2">
                                <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                                Detail Biodata
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700">
                                <div class="flex items-start justify-between mb-2">
                                    <span class="text-xs font-bold text-indigo-500 uppercase tracking-widest">Alamat KTP</span>
                                    <svg class="w-5 h-5 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </div>
                                <p class="text-slate-700 dark:text-slate-300 font-medium leading-relaxed">
                                    {{ $this->karyawan->alamat ?? 'Belum ada data alamat.' }}
                                </p>
                            </div>

                            <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700">
                                {{-- TAMBAHKAN INFO LAIN JIKA ADA --}}
                            </div>
                        </div>
                    </x-tabs.panel>

                    {{-- TAB 2:  --}}
                    <x-tabs.panel id="tab2">
                        
                    </x-tabs.panel>

                    {{-- TAB 3:  --}}
                    <x-tabs.panel id="tab3">
                        
                    </x-tabs.panel>

                    {{-- TAB 4:  --}}
                    <x-tabs.panel id="tab4">
                        
                    </x-tabs.panel>

                </x-tabs>
            </div>

        </div>
    </div>
</div>