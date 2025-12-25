<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anjing - Paw Rehome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .filter-btn.active {
            background-color: #F97316;
            color: white;
            border-color: #F97316;
        }
        .pet-card {
            transition: all 0.3s ease;
        }
        .pet-card:hover {
            transform: translateY(-4px);
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center">
                        <span class="text-2xl">🐾</span>
                    </div>
                    <span class="text-xl font-bold text-gray-800">Paw Rehome</span>
                </div>
                
                <nav class="hidden md:flex space-x-6">
                    <a href="#" class="text-gray-600 hover:text-orange-500 transition">Home</a>
                    <a href="#" class="text-orange-500 font-semibold">Hewan Tersedia</a>
                    <a href="#" class="text-gray-600 hover:text-orange-500 transition">Cara Adopsi</a>
                    <a href="#" class="text-gray-600 hover:text-orange-500 transition">Blog</a>
                </nav>

                <div class="flex items-center space-x-4">
                    <span class="hidden md:inline text-sm text-gray-600">For Support?</span>
                    <a href="tel:+980-34984089" class="text-sm font-semibold text-orange-500">+980-34984089</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8" x-data="dogListApp()">
        
        <!-- Breadcrumb -->
        <div class="mb-6 text-sm text-gray-600">
            <a href="#" class="hover:text-orange-500">Home</a>
            <span class="mx-2">/</span>
            <a href="#" class="hover:text-orange-500">Hewan Tersedia</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800">Anjing</span>
        </div>

        <!-- Page Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2 flex items-center">
                    <span class="mr-3 text-5xl">🐕</span>
                    Daftar Anjing
                </h1>
                <p class="text-gray-600 text-lg">Temukan anjing yang cocok untuk keluarga Anda</p>
            </div>
            <div class="text-right">
                <p class="text-3xl font-bold text-orange-500" x-text="filteredDogs.length"></p>
                <p class="text-sm text-gray-600">Anjing Tersedia</p>
            </div>
        </div>

        <!-- Category Pills -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 overflow-x-auto pb-4">
                <button @click="filterByCategory('all')" 
                        :class="{'active': selectedCategory === 'all'}"
                        class="filter-btn flex-shrink-0 px-6 py-3 rounded-full border-2 border-gray-300 hover:border-orange-500 transition font-medium whitespace-nowrap">
                    <span class="mr-2">🐕</span>
                    Semua Anjing
                </button>
                <button @click="filterByCategory('small')" 
                        :class="{'active': selectedCategory === 'small'}"
                        class="filter-btn flex-shrink-0 px-6 py-3 rounded-full border-2 border-gray-300 hover:border-orange-500 transition font-medium whitespace-nowrap">
                    <span class="mr-2">🐕</span>
                    Anjing Kecil
                </button>
                <button @click="filterByCategory('medium')" 
                        :class="{'active': selectedCategory === 'medium'}"
                        class="filter-btn flex-shrink-0 px-6 py-3 rounded-full border-2 border-gray-300 hover:border-orange-500 transition font-medium whitespace-nowrap">
                    <span class="mr-2">🐕</span>
                    Anjing Sedang
                </button>
                <button @click="filterByCategory('large')" 
                        :class="{'active': selectedCategory === 'large'}"
                        class="filter-btn flex-shrink-0 px-6 py-3 rounded-full border-2 border-gray-300 hover:border-orange-500 transition font-medium whitespace-nowrap">
                    <span class="mr-2">🐕</span>
                    Anjing Besar
                </button>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <div class="mb-8 bg-white rounded-2xl shadow-sm p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                
                <!-- Search -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Anjing</label>
                    <input 
                        type="text" 
                        x-model="searchQuery"
                        @input.debounce.300ms="filterDogs()"
                        placeholder="Cari berdasarkan nama atau ras..."
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-orange-500 focus:outline-none">
                </div>

                <!-- Gender Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                    <select 
                        x-model="selectedGender" 
                        @change="filterDogs()"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-orange-500 focus:outline-none">
                        <option value="all">Semua</option>
                        <option value="male">♂️ Jantan</option>
                        <option value="female">♀️ Betina</option>
                    </select>
                </div>

                <!-- Age Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Umur</label>
                    <select 
                        x-model="selectedAge" 
                        @change="filterDogs()"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-orange-500 focus:outline-none">
                        <option value="all">Semua Umur</option>
                        <option value="puppy">Anak Anjing (0-1 tahun)</option>
                        <option value="young">Muda (1-3 tahun)</option>
                        <option value="adult">Dewasa (3-7 tahun)</option>
                        <option value="senior">Senior (7+ tahun)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Dog Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <template x-for="dog in filteredDogs" :key="dog.id">
                <div class="pet-card bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-xl cursor-pointer">
                    
                    <!-- Dog Image -->
                    <div class="relative h-72 overflow-hidden bg-gradient-to-br from-orange-100 to-yellow-50">
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-9xl" x-text="dog.emoji"></span>
                        </div>
                        
                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1.5 bg-green-500 text-white text-xs font-bold rounded-full shadow-lg">
                                ✓ Tersedia
                            </span>
                        </div>

                        <!-- Size Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1.5 bg-blue-500 text-white text-xs font-bold rounded-full shadow-lg" x-text="dog.sizeLabel"></span>
                        </div>

                        <!-- Favorite -->
                        <button class="absolute bottom-4 right-4 p-3 bg-white rounded-full shadow-lg hover:bg-red-50 transition">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Dog Info -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-2xl font-bold text-gray-800" x-text="dog.name"></h3>
                            <span class="text-lg" x-text="dog.gender === 'male' ? '♂️' : '♀️'"></span>
                        </div>

                        <p class="text-orange-600 font-semibold mb-4" x-text="dog.breed"></p>
                        
                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <div class="flex items-center">
                                <span class="w-6 mr-2">📅</span>
                                <span x-text="dog.ageText"></span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-6 mr-2">⚖️</span>
                                <span x-text="dog.weight"></span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-6 mr-2">🏠</span>
                                <span x-text="dog.personality"></span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm text-gray-600 line-clamp-2" x-text="dog.description"></p>
                        </div>

                        <!-- Traits -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <template x-for="trait in dog.traits" :key="trait">
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded-full" x-text="trait"></span>
                            </template>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-2">
                            <button class="flex-1 px-4 py-3 bg-orange-500 text-white rounded-xl hover:bg-orange-600 transition font-semibold">
                                Adopsi Sekarang
                            </button>
                            <button class="px-4 py-3 border-2 border-orange-500 text-orange-500 rounded-xl hover:bg-orange-50 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Empty State -->
            <template x-if="filteredDogs.length === 0">
                <div class="col-span-full text-center py-20">
                    <div class="text-9xl mb-6">🐕</div>
                    <h3 class="text-3xl font-bold text-gray-700 mb-3">Tidak Ada Anjing Ditemukan</h3>
                    <p class="text-gray-500 text-lg mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                    <button @click="resetFilters()" class="px-8 py-4 bg-orange-500 text-white rounded-xl hover:bg-orange-600 transition font-semibold text-lg">
                        Reset Semua Filter
                    </button>
                </div>
            </template>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-20">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-lg font-bold mb-4 flex items-center">
                        <span class="text-2xl mr-2">🐾</span>
                        Paw Rehome
                    </h4>
                    <p class="text-gray-400 text-sm">
                        Memberikan rumah penuh cinta untuk anjing yang membutuhkan.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-orange-400">Daftar Anjing</a></li>
                        <li><a href="#" class="hover:text-orange-400">Daftar Kucing</a></li>
                        <li><a href="#" class="hover:text-orange-400">Cara Adopsi</a></li>
                        <li><a href="#" class="hover:text-orange-400">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-orange-400">FAQ</a></li>
                        <li><a href="#" class="hover:text-orange-400">Donasi</a></li>
                        <li><a href="#" class="hover:text-orange-400">Volunteer</a></li>
                        <li><a href="#" class="hover:text-orange-400">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>📞 +980-34984089</li>
                        <li>📧 info@pawrehome.com</li>
                        <li>📍 Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2024 Paw Rehome. All rights reserved. Made with ❤️ for dogs.</p>
            </div>
        </div>
    </footer>

    <script>
        function dogListApp() {
            return {
                allDogs: [
                    { 
                        id: 1, 
                        name: 'Max', 
                        breed: 'Golden Retriever', 
                        age: 24, 
                        ageCategory: 'adult',
                        gender: 'male', 
                        size: 'large',
                        weight: '30-35 kg',
                        personality: 'Ramah & Aktif',
                        description: 'Anjing yang sangat ramah dan suka bermain. Cocok untuk keluarga dengan anak-anak. Sudah dilatih basic commands.',
                        traits: ['Jinak', 'Suka Anak', 'Aktif', 'Mudah Dilatih'],
                        emoji: '🦮'
                    },
                    { 
                        id: 2, 
                        name: 'Luna', 
                        breed: 'Siberian Husky', 
                        age: 18, 
                        ageCategory: 'young',
                        gender: 'female', 
                        size: 'large',
                        weight: '20-25 kg',
                        personality: 'Energik & Ceria',
                        description: 'Husky cantik dengan mata biru. Sangat energik dan butuh aktivitas harian yang cukup. Cocok untuk owner aktif.',
                        traits: ['Energik', 'Playful', 'Penyayang', 'Sehat'],
                        emoji: '🐕'
                    },
                    { 
                        id: 3, 
                        name: 'Buddy', 
                        breed: 'Beagle', 
                        age: 30, 
                        ageCategory: 'adult',
                        gender: 'male', 
                        size: 'medium',
                        weight: '10-15 kg',
                        personality: 'Ceria & Pemberani',
                        description: 'Beagle yang ceria dan suka berpetualang. Cocok untuk keluarga yang suka outdoor activities. Sangat friendly.',
                        traits: ['Friendly', 'Curious', 'Aktif', 'Loyal'],
                        emoji: '🐕'
                    },
                    { 
                        id: 4, 
                        name: 'Bella', 
                        breed: 'Toy Poodle', 
                        age: 36, 
                        ageCategory: 'adult',
                        gender: 'female', 
                        size: 'small',
                        weight: '3-5 kg',
                        personality: 'Pintar & Manja',
                        description: 'Poodle kecil yang sangat pintar dan mudah dilatih. Cocok untuk apartemen. Tidak banyak rontok.',
                        traits: ['Pintar', 'Hypoallergenic', 'Manja', 'Jinak'],
                        emoji: '🐩'
                    },
                    { 
                        id: 5, 
                        name: 'Rocky', 
                        breed: 'French Bulldog', 
                        age: 48, 
                        ageCategory: 'adult',
                        gender: 'male', 
                        size: 'medium',
                        weight: '10-12 kg',
                        personality: 'Tenang & Santai',
                        description: 'Bulldog yang santai dan tenang. Cocok untuk apartemen atau rumah kecil. Tidak butuh exercise berlebihan.',
                        traits: ['Tenang', 'Loyal', 'Cocok Apartemen', 'Ramah'],
                        emoji: '🐕'
                    },
                    { 
                        id: 6, 
                        name: 'Charlie', 
                        breed: 'Labrador Retriever', 
                        age: 20, 
                        ageCategory: 'young',
                        gender: 'male', 
                        size: 'large',
                        weight: '28-32 kg',
                        personality: 'Setia & Cerdas',
                        description: 'Labrador yang sangat cerdas dan mudah dilatih. Cocok untuk service dog atau family pet. Sangat penyayang.',
                        traits: ['Cerdas', 'Setia', 'Ramah', 'Patient'],
                        emoji: '🦮'
                    },
                    { 
                        id: 7, 
                        name: 'Daisy', 
                        breed: 'Shih Tzu', 
                        age: 15, 
                        ageCategory: 'young',
                        gender: 'female', 
                        size: 'small',
                        weight: '4-7 kg',
                        personality: 'Manis & Lembut',
                        description: 'Shih Tzu cantik dengan bulu panjang yang lembut. Sangat manja dan suka dipeluk. Cocok untuk senior atau pemula.',
                        traits: ['Manja', 'Lembut', 'Tidak Agresif', 'Cute'],
                        emoji: '🐕'
                    },
                    { 
                        id: 8, 
                        name: 'Duke', 
                        breed: 'German Shepherd', 
                        age: 36, 
                        ageCategory: 'adult',
                        gender: 'male', 
                        size: 'large',
                        weight: '30-40 kg',
                        personality: 'Protektif & Setia',
                        description: 'German Shepherd yang protektif dan sangat loyal. Sudah dilatih obedience. Cocok untuk keamanan rumah.',
                        traits: ['Protektif', 'Cerdas', 'Loyal', 'Pemberani'],
                        emoji: '🐕‍🦺'
                    },
                    { 
                        id: 9, 
                        name: 'Milo', 
                        breed: 'Pomeranian', 
                        age: 10, 
                        ageCategory: 'puppy',
                        gender: 'male', 
                        size: 'small',
                        weight: '2-3 kg',
                        personality: 'Aktif & Lucu',
                        description: 'Pomeranian kecil yang sangat aktif dan menggemaskan. Cocok untuk keluarga kecil atau single. Sangat playful.',
                        traits: ['Lucu', 'Aktif', 'Menggemaskan', 'Jinak'],
                        emoji: '🐕'
                    },
                    { 
                        id: 10, 
                        name: 'Rosie', 
                        breed: 'Cocker Spaniel', 
                        age: 28, 
                        ageCategory: 'adult',
                        gender: 'female', 
                        size: 'medium',
                        weight: '12-15 kg',
                        personality: 'Gentle & Sweet',
                        description: 'Cocker Spaniel yang sangat gentle dan manis. Cocok untuk keluarga dengan anak kecil. Sangat patient.',
                        traits: ['Gentle', 'Sweet', 'Patient', 'Family Dog'],
                        emoji: '🐕'
                    },
                    { 
                        id: 11, 
                        name: 'Zeus', 
                        breed: 'Rottweiler', 
                        age: 42, 
                        ageCategory: 'adult',
                        gender: 'male', 
                        size: 'large',
                        weight: '45-50 kg',
                        personality: 'Pemberani & Setia',
                        description: 'Rottweiler yang kuat dan protektif. Sangat setia kepada keluarga. Butuh owner yang berpengalaman.',
                        traits: ['Kuat', 'Protektif', 'Setia', 'Disiplin'],
                        emoji: '🐕'
                    },
                    { 
                        id: 12, 
                        name: 'Coco', 
                        breed: 'Chihuahua', 
                        age: 8, 
                        ageCategory: 'puppy',
                        gender: 'female', 
                        size: 'small',
                        weight: '1-3 kg',
                        personality: 'Berani & Pemberani',
                        description: 'Chihuahua kecil tapi pemberani. Sangat setia kepada owner. Cocok untuk apartemen dan travel.',
                        traits: ['Kecil', 'Berani', 'Portable', 'Setia'],
                        emoji: '🐕'
                    },
                ],
                filteredDogs: [],
                selectedCategory: 'all',
                selectedGender: 'all',
                selectedAge: 'all',
                searchQuery: '',

                init() {
                    this.filterDogs();
                },

                filterByCategory(category) {
                    this.selectedCategory = category;
                    this.filterDogs();
                },

                filterDogs() {
                    let result = [...this.allDogs];

                    // Filter by size category
                    if (this.selectedCategory !== 'all') {
                        result = result.filter(dog => dog.size === this.selectedCategory);
                    }

                    // Filter by gender
                    if (this.selectedGender !== 'all') {
                        result = result.filter(dog => dog.gender === this.selectedGender);
                    }

                    // Filter by age
                    if (this.selectedAge !== 'all') {
                        result = result.filter(dog => dog.ageCategory === this.selectedAge);
                    }

                    // Filter by search query
                    if (this.searchQuery) {
                        const query = this.searchQuery.toLowerCase();
                        result = result.filter(dog => 
                            dog.name.toLowerCase().includes(query) ||
                            dog.breed.toLowerCase().includes(query) ||
                            dog.description.toLowerCase().includes(query)
                        );
                    }

                    // Add computed properties
                    result = result.map(dog => ({
                        ...dog,
                        ageText: this.getAgeText(dog.age),
                        sizeLabel: this.getSizeLabel(dog.size)
                    }));

                    this.filteredDogs = result;
                },

                getAgeText(months) {
                    if (months < 12) {
                        return `${months} bulan`;
                    } else {
                        const years = Math.floor(months / 12);
                        const remainingMonths = months % 12;
                        if (remainingMonths === 0) {
                            return `${years} tahun`;
                        } else {
                            return `${years} tahun ${remainingMonths} bulan`;
                        }
                    }
                },

                getSizeLabel(size) {
                    const labels = {
                        small: 'Kecil',
                        medium: 'Sedang',
                        large: 'Besar'
                    };
                    return labels[size] || size;
                },

                resetFilters() {
                    this.selectedCategory = 'all';
                    this.selectedGender = 'all';
                    this.selectedAge = 'all';
                    this.searchQuery = '';
                    this.filterDogs();
                }
            }
        }
    </script>

</body>
</html>