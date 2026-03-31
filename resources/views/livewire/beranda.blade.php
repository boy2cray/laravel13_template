<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-8 text-gray-900 dark:text-white">{{ $judul }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Card Jumlah Karyawan -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-lg p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="shrink-0">
                    <svg class="w-8 h-8 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Jumlah Karyawan</h2>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $jumlahKaryawan }}</p>
                </div>
            </div>
        </div>

        <!-- Card Jumlah Admin -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-lg p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="shrink-0">
                    <svg class="w-8 h-8 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Jumlah Admin</h2>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $jumlahAdmin }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
