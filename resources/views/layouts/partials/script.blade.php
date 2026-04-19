<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

<script>
    document.addEventListener('livewire:initialized', () => {

        if (window.__alertLoaded) return;
        window.__alertLoaded = true;

        let queue = [];
        let isShowing = false;

        function next() {
            if (isShowing || queue.length === 0) return;

            isShowing = true;
            const data = queue.shift();

            const isDark = document.documentElement.classList.contains('dark');

            // 🔥 CONFIRM
            if (data.confirm) {
                Swal.fire({
                    title: data.title,
                    text: data.message,
                    icon: data.type,
                    showCancelButton: true,
                    confirmButtonText: 'Lanjutkan',
                    cancelButtonText: 'Batal',
                    background: isDark ? '#1f2937' : '#fff',
                    color: isDark ? '#e5e7eb' : '#111827'
                }).then(result => {

                    if (result.isConfirmed && data.onConfirm) {

                        const component = Livewire.find(data.componentId);

                        if (component) {
                            component.call(data.onConfirm);
                        }
                    }

                    isShowing = false;
                    next();
                });

                return;
            }

            // 🔥 ALERT / TOAST
            Swal.fire({
                icon: data.type,
                title: data.title,
                text: data.message,
                toast: data.toast ?? false,
                position: data.toast ? 'top-end' : 'center',
                timer: data.toast ? 3000 : undefined,
                showConfirmButton: !data.toast,
                allowOutsideClick: !data.toast,
                background: isDark ? '#1f2937' : '#fff',
                color: isDark ? '#e5e7eb' : '#111827'
            }).then(() => {
                isShowing = false;
                next();
            });
        }

        Livewire.on('app:alert', (payload) => {
            const data = Array.isArray(payload) ? payload[0] : payload;
            queue.push(data);
            next();
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