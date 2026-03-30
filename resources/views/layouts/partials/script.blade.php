<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

<script>
    document.addEventListener('livewire:initialized', () => {

        if (window.__alertEngineLoaded) return;
        window.__alertEngineLoaded = true;

        let queue = [];
        let isShowing = false;

        // Cek apakah SweetAlert2 ter-load
        if (typeof Swal === 'undefined') {
            console.warn('SweetAlert2 belum ter-load. Alert tidak akan ditampilkan');
            return;
        }

        function processQueue() {
            // Jika sedang menampilkan atau queue kosong, skip
            if (isShowing || queue.length === 0) return;

            isShowing = true;
            const data = queue.shift();
            
            // Validasi data minimal
            if (!data || !data.title) {
                console.warn('Invalid alert data received:', data);
                isShowing = false;
                processQueue();
                return;
            }

            const isDark = document.documentElement.classList.contains('dark');

            // Pengaturan dasar SweetAlert2 dengan default values
            const swalConfig = {
                title: data.title || 'Notifikasi',
                text: data.message || '',
                icon: data.type || 'info',
                background: isDark ? '#1f2937' : '#fff',
                color: isDark ? '#e5e7eb' : '#111827',
                allowOutsideClick: !data.confirm,
                allowEscapeKey: !data.confirm,
                ...data // Spread data tambahan dari PHP
            };

            try {
                if (data.confirm) {
                    Swal.fire({
                        ...swalConfig,
                        showCancelButton: true,
                        confirmButtonText: 'Lanjutkan',
                        cancelButtonText: 'Batal',
                    }).then(result => {
                        try {
                            if (result.isConfirmed && data.onConfirm) {
                                // Mencari komponen spesifik yang mengirim alert berdasarkan ID
                                const component = Livewire.find(data.componentId);
                                if (component) {
                                    component.call(data.onConfirm);
                                } else {
                                    // Fallback jika ID tidak ditemukan
                                    Livewire.dispatch(data.onConfirm);
                                }
                            }
                        } catch (err) {
                            console.error('Error executing confirm callback:', err);
                        } finally {
                            isShowing = false;
                            processQueue();
                        }
                    }).catch(err => {
                        console.error('Error in confirm dialog:', err);
                        isShowing = false;
                        processQueue();
                    });
                    return;
                }

                // Standar Alert / Toast
                Swal.fire({
                    ...swalConfig,
                    toast: data.toast !== false, // Default true jika tidak didefinisikan
                    position: data.toast !== false ? 'top-end' : 'center',
                    timer: data.toast !== false ? 3000 : undefined,
                    timerProgressBar: data.toast !== false,
                    showConfirmButton: data.toast === false,
                    didOpen: (modal) => {
                        // Log untuk debugging
                        console.log('Alert ditampilkan:', data.title);
                    }
                }).then((result) => {
                    // Selalu jalankan ini setelah modal ditutup
                    isShowing = false;
                    processQueue();
                }).catch(err => {
                    console.error('Error in alert:', err);
                    isShowing = false;
                    processQueue();
                });
            } catch (err) {
                console.error('Error firing Swal:', err);
                isShowing = false;
                processQueue();
            }
        }

        // Listener Event Livewire v3 - dengan normalisasi yang lebih robust
        Livewire.on('app:alert', (payload) => {
            try {
                // Normalisasi payload v3 
                // Livewire v3 bisa mengirim payload sebagai array atau object
                let data;
                if (Array.isArray(payload)) {
                    data = payload[0] || {};
                } else if (typeof payload === 'object') {
                    data = payload;
                } else {
                    console.warn('Invalid payload format:', payload);
                    return;
                }

                // Tambahkan ke queue
                queue.push(data);
                console.log('Alert ditambahkan ke queue. Queue length:', queue.length);
                processQueue();
            } catch (err) {
                console.error('Error processing alert event:', err);
            }
        });

        // Fitur Page Loader (Dipertahankan)
        const pageLoader = document.getElementById('page-loader');
        if (pageLoader) {
            window.addEventListener('livewire:navigate', () => {
                pageLoader.classList.remove('hidden');
                pageLoader.classList.add('flex'); 
            });

            window.addEventListener('livewire:navigated', () => {
                pageLoader.classList.add('hidden');
                pageLoader.classList.remove('flex');
            });

            window.addEventListener('livewire:navigation-error', () => {
                pageLoader.classList.add('hidden');
                pageLoader.classList.remove('flex');
            });
        }
    });

    // Listener Dark Mode 
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
        if (!('theme' in localStorage)) {
            if (event.matches) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    });
</script>