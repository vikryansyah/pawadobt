<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anjing - Shelter Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body class="bg-gray-50">

    <div x-data="shelterDashboard()">
        
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-40">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center">
                            <span class="text-2xl">🐾</span>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-800">Paw Rehome Shelter</h1>
                            <p class="text-sm text-gray-600">Dashboard Pengelolaan</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <button class="p-2 hover:bg-gray-100 rounded-full relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <div class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                JD
                            </div>
                            <div class="hidden md:block">
                                <p class="text-sm font-semibold">John Doe</p>
                                <p class="text-xs text-gray-600">Shelter Admin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-8">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <span class="text-3xl">🐕</span>
                        </div>
                        <span class="text-2xl font-bold text-blue-600">24</span>
                    </div>
                    <p class="text-gray-600 font-medium">Total Anjing</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-green-100 rounded-lg">
                            <span class="text-3xl">✅</span>
                        </div>
                        <span class="text-2xl font-bold text-green-600">18</span>
                    </div>
                    <p class="text-gray-600 font-medium">Tersedia</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-orange-100 rounded-lg">
                            <span class="text-3xl">⏳</span>
                        </div>
                        <span class="text-2xl font-bold text-orange-600">4</span>
                    </div>
                    <p class="text-gray-600 font-medium">Proses Adopsi</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <span class="text-3xl">🏠</span>
                        </div>
                        <span class="text-2xl font-bold text-purple-600">2</span>
                    </div>
                    <p class="text-gray-600 font-medium">Teradopsi Bulan Ini</p>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-1">Daftar Anjing</h2>
                        <p class="text-gray-600">Kelola data anjing di shelter Anda</p>
                    </div>
                    
                    <button 
                        @click="openModal()"
                        class="px-6 py-3 bg-orange-500 text-white rounded-xl hover:bg-orange-600 transition font-semibold flex items-center justify-center space-x-2 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Tambah Anjing Baru</span>
                    </button>
                </div>
            </div>

            <!-- Dogs Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Anjing</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ras</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Umur</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Gender</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <template x-for="dog in dogs" :key="dog.id">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-2xl">
                                                🐕
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-800" x-text="dog.name"></p>
                                                <p class="text-xs text-gray-500" x-text="'ID: ' + dog.id"></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-700" x-text="dog.breed"></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-700" x-text="dog.age + ' bulan'"></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm" x-text="dog.gender === 'male' ? '♂️ Jantan' : '♀️ Betina'"></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold" 
                                              :class="{
                                                  'bg-green-100 text-green-800': dog.status === 'available',
                                                  'bg-orange-100 text-orange-800': dog.status === 'pending',
                                                  'bg-gray-100 text-gray-800': dog.status === 'adopted'
                                              }"
                                              x-text="dog.statusText">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </button>
                                            <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Modal Tambah Anjing -->
        <div x-show="showModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto" 
             style="display: none;">
            
            <!-- Overlay -->
            <div class="modal-overlay fixed inset-0" @click="closeModal()"></div>
            
            <!-- Modal Content -->
            <div class="flex items-center justify-center min-h-screen px-4 py-8">
                <div x-show="showModal"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full relative z-10 max-h-[90vh] overflow-y-auto">
                    
                    <!-- Modal Header -->
                    <div class="sticky top-0 bg-white border-b px-8 py-6 rounded-t-2xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                                    <span class="text-3xl mr-3">🐕</span>
                                    Tambah Anjing Baru
                                </h3>
                                <p class="text-gray-600 mt-1">Isi data lengkap anjing yang akan ditambahkan</p>
                            </div>
                            <button @click="closeModal()" class="p-2 hover:bg-gray-100 rounded-full transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <form @submit.prevent="addDog()" class="p-8 space-y-6">
                        
                        <!-- Nama Anjing -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Anjing <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                x-model="newDog.name"
                                placeholder="Contoh: Max"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:outline-none transition"
                                required>
                        </div>

                        <!-- Ras -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Ras <span class="text-red-500">*</span>
                            </label>
                            <select 
                                x-model="newDog.breed"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:outline-none transition"
                                required>
                                <option value="">Pilih Ras</option>
                                <option value="Golden Retriever">Golden Retriever</option>
                                <option value="Labrador">Labrador</option>
                                <option value="Siberian Husky">Siberian Husky</option>
                                <option value="German Shepherd">German Shepherd</option>
                                <option value="Beagle">Beagle</option>
                                <option value="Bulldog">Bulldog</option>
                                <option value="Poodle">Poodle</option>
                                <option value="Shih Tzu">Shih Tzu</option>
                                <option value="Chihuahua">Chihuahua</option>
                                <option value="Mixed">Mixed/Campuran</option>
                            </select>
                        </div>

                        <!-- Grid 2 Kolom -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Umur -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Umur (bulan) <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="number" 
                                    x-model="newDog.age"
                                    placeholder="12"
                                    min="1"
                                    max="180"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:outline-none transition"
                                    required>
                            </div>

                            <!-- Berat -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Berat (kg) <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="number" 
                                    x-model="newDog.weight"
                                    placeholder="25"
                                    min="1"
                                    step="0.1"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:outline-none transition"
                                    required>
                            </div>

                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jenis8 Kelamin <span class="text-red-500">*</span>
                            </label>
                            <div class="flex space-x-4">
                                <label class="flex-1 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        x-model="newDog.gender" 
                                        value="male"
                                        class="peer sr-only"
                                        required>
                                    <div class="p-4 border-2 border-gray-200 rounded-xl peer-checked:border-orange-500 peer-checked:bg-orange-50 transition text-center">
                                        <span class="text-3xl block mb-2">♂️</span>
                                        <span class="font-semibold">Jantan</span>
                                    </div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        x-model="newDog.gender" 
                                        value="female"
                                        class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-xl peer-checked:border-orange-500 peer-checked:bg-orange-50 transition text-center">
                                        <span class="text-3xl block mb-2">♀️</span>
                                        <span class="font-semibold">Betina</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Ukuran -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Ukuran <span class="text-red-500">*</span>
                            </label>
                            <select 
                                x-model="newDog.size"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:outline-none transition"
                                required>
                                <option value="">Pilih Ukuran</option>
                                <option value="small">Kecil (< 10 kg)</option>
                                <option value="medium">Sedang (10-25 kg)</option>
                                <option value="large">Besar (> 25 kg)</option>
                            </select>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                x-model="newDog.description"
                                rows="4"
                                placeholder="Ceritakan tentang anjing ini... (kepribadian, kebiasaan, kesehatan, dll)"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:outline-none transition resize-none"
                                required></textarea>
                        </div>

                        <!-- Health Status -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Status Kesehatan <span class="text-red-500">*</span>
                            </label>
                            <div class="space-y-3">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        x-model="newDog.vaccinated"
                                        class="w-5 h-5 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                                    <span class="text-gray-700">Sudah Vaksin</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        x-model="newDog.sterilized"
                                        class="w-5 h-5 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                                    <span class="text-gray-700">Sudah Steril</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        x-model="newDog.healthChecked"
                                        class="w-5 h-5 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                                    <span class="text-gray-700">Sudah Medical Check-up</span>
                                </label>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex space-x-4 pt-4">
                            <button 
                                type="button"
                                @click="closeModal()"
                                class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-semibold">
                                Batal
                            </button>
                            <button 
                                type="submit"
                                class="flex-1 px-6 py-3 bg-orange-500 text-white rounded-xl hover:bg-orange-600 transition font-semibold shadow-lg">
                                Tambah Anjing
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- Success Toast -->
        <div x-show="showToast"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-4"
             class="fixed bottom-8 right-8 bg-green-500 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center space-x-3 z-50"
             style="display: none;">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <div>
                <p class="font-semibold">Berhasil!</p>
                <p class="text-sm">Anjing berhasil ditambahkan</p>
            </div>
        </div>

    </div>

    <script>
        function shelterDashboard() {
            return {
                showModal: false,
                showToast: false,
                
                dogs: [
                    { 
                        id: 'DOG001', 
                        name: 'Max', 
                        breed: 'Golden Retriever', 
                        age: 24, 
                        gender: 'male',
                        status: 'available',
                        statusText: 'Tersedia'
                    },
                    { 
                        id: 'DOG002', 
                        name: 'Luna', 
                        breed: 'Siberian Husky', 
                        age: 18, 
                        gender: 'female',
                        status: 'pending',
                        statusText: 'Proses Adopsi'
                    },
                    { 
                        id: 'DOG003', 
                        name: 'Buddy', 
                        breed: 'Beagle', 
                        age: 30, 
                        gender: 'male',
                        status: 'available',
                        statusText: 'Tersedia'
                    },
                ],

                newDog: {
                    name: '',
                    breed: '',
                    age: '',
                    weight: '',
                    gender: '',
                    size: '',
                    description: '',
                    vaccinated: false,
                    sterilized: false,
                    healthChecked: false
                },

                openModal() {
                    this.showModal = true;
                    document.body.style.overflow = 'hidden';
                },

                closeModal() {
                    this.showModal = false;
                    document.body.style.overflow = 'auto';
                    this.resetForm();
                },

                resetForm() {
                    this.newDog = {
                        name: '',
                        breed: '',
                        age: '',
                        weight: '',
                        gender: '',
                        size: '',
                        description: '',
                        vaccinated: false,
                        sterilized: false,
                        healthChecked: false
                    };
                },

                addDog() {
                    // Generate ID
                    const newId = 'DOG' + String(this.dogs.length + 1).padStart(3, '0');
                    
                    // Add dog to list
                    const dog = {
                        id: newId,
                        name: this.newDog.name,
                        breed: this.newDog.breed,
                        age: parseInt(this.newDog.age),
                        weight: parseFloat(this.newDog.weight),
                        gender: this.newDog.gender,
                        size: this.newDog.size,
                        description: this.newDog.description,
                        vaccinated: this.newDog.vaccinated,
                        sterilized: this.newDog.sterilized,
                        healthChecked: this.newDog.healthChecked,
                        status: 'available',
                        statusText: 'Tersedia'
                    };
                    
                    this.dogs.unshift(dog);
                    
                    console.log('Anjing baru ditambahkan:', dog);
                    
                    // Close modal
                    this.closeModal();
                    
                    // Show success toast
                    this.showToast = true;
                    setTimeout(() => {
                        this.showToast = false;
                    }, 3000);
                }
            }
        }
    </script>

</body>
</html>