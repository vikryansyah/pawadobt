<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roger - Detail Hewan Adopsi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* Header */
        header {
            background-color: white;
            padding: 20px 80px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        nav {
            display: flex;
            gap: 40px;
        }

        nav a {
            text-decoration: none;
            color: #666;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #ff6b35;
        }

        /* Back Button */
        .back-button {
            padding: 40px 80px 20px;
        }

        .back-button a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: gap 0.3s;
        }

        .back-button a:hover {
            gap: 12px;
        }

        /* Main Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px 80px 60px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        /* Image Gallery */
        .image-section {
            position: relative;
        }

        .main-image {
            width: 100%;
            height: 600px;
            object-fit: cover;
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .discount-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #4ade80;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
        }

        .thumbnail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .thumbnail {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 12px;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s;
        }

        .thumbnail:hover {
            border-color: #667eea;
            transform: scale(1.05);
        }

        /* Info Section */
        .info-section {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .pet-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
        }

        .pet-title h1 {
            font-size: 42px;
            color: #333;
            margin-bottom: 10px;
        }

        .pet-rating {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
        }

        .stars {
            color: #fbbf24;
            font-size: 20px;
        }

        .reviews {
            color: #999;
        }

        .favorite-big {
            width: 60px;
            height: 60px;
            background-color: #fff;
            border: 2px solid #e0e0e0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .favorite-big:hover {
            background-color: #ff6b35;
            color: white;
            border-color: #ff6b35;
            transform: scale(1.1);
        }

        /* Quick Info Cards */
        .quick-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .info-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .info-card .label {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 8px;
        }

        .info-card .value {
            font-size: 20px;
            font-weight: bold;
        }

        /* Description */
        .description {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 16px;
        }

        .description h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
        }

        .description p {
            color: #666;
            line-height: 1.8;
            font-size: 16px;
        }

        /* Characteristics */
        .characteristics {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 16px;
        }

        .characteristics h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .char-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .char-item {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background: white;
            border-radius: 10px;
        }

        .char-label {
            color: #666;
            font-weight: 500;
        }

        .char-value {
            color: #333;
            font-weight: 600;
        }

        /* Health Info */
        .health-info {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: white;
            padding: 25px;
            border-radius: 16px;
        }

        .health-info h3 {
            font-size: 20px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .health-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .health-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
        }

        /* Shelter Info */
        .shelter-info {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .shelter-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
        }

        .shelter-details h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 5px;
        }

        .shelter-details p {
            color: #666;
            font-size: 14px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            flex: 1;
            padding: 18px;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 107, 53, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }

        /* Similar Pets */
        .similar-section {
            margin-top: 60px;
            padding: 40px;
            background: white;
            border-radius: 20px;
        }

        .similar-section h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 30px;
        }

        .similar-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .similar-card {
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .similar-card:hover {
            transform: translateY(-5px);
        }

        .similar-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .similar-info {
            padding: 15px;
        }

        .similar-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .similar-details {
            font-size: 14px;
            color: #666;
        }

        @media (max-width: 1024px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .container, header, .back-button {
                padding-left: 20px;
                padding-right: 20px;
            }

            .similar-grid {
                grid-template-columns: 1fr;
            }

            .quick-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">🐾 Hewan Siap Adopsi</div>
        <nav>
            <a href="index.html">ALL</a>
            <a href="anjing.html">ANJING</a>
            <a href="kucing.html">KUCING</a>
        </nav>
    </header>

    <!-- Back Button -->
    <div class="back-button">
        <a href='/' >← Kembali ke Daftar Anjing</a>
    </div>

    <!-- Main Container -->
    <div class="container">
        <div class="detail-grid">
            <!-- Image Section -->
            <div class="image-section">
                <span class="discount-badge">🎉 Promo -30%</span>
                <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=800&h=800&fit=crop" alt="Roger" class="main-image" id="mainImage">
                <div class="thumbnail-grid">
                    <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=300&h=300&fit=crop" alt="Roger 1" class="thumbnail" onclick="changeImage(this.src)">
                    <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=300&h=300&fit=crop" alt="Roger 2" class="thumbnail" onclick="changeImage(this.src)">
                    <img src="https://images.unsplash.com/photo-1583511666407-5f06533f2113?w=300&h=300&fit=crop" alt="Roger 3" class="thumbnail" onclick="changeImage(this.src)">
                    <img src="https://images.unsplash.com/photo-1583511655826-05700d7f7e15?w=300&h=300&fit=crop" alt="Roger 4" class="thumbnail" onclick="changeImage(this.src)">
                </div>
            </div>

            <!-- Info Section -->
            <div class="info-section">
                <div class="pet-header">
                    <div class="pet-title">
                        <h1>Roger</h1>
                        <div class="pet-rating">
                            <span class="stars">★★★★★</span>
                            <span>4.5</span>
                            <span class="reviews">(12 ulasan)</span>
                        </div>
                    </div>
                    <div class="favorite-big">♡</div>
                </div>

                <!-- Quick Info -->
                <div class="quick-info">
                    <div class="info-card">
                        <div class="label">Usia</div>
                        <div class="value">2 Tahun</div>
                    </div>
                    <div class="info-card">
                        <div class="label">Gender</div>
                        <div class="value">Jantan</div>
                    </div>
                    <div class="info-card">
                        <div class="label">Ukuran</div>
                        <div class="value">Kecil</div>
                    </div>
                </div>

                <!-- Description -->
                <div class="description">
                    <h2>📝 Tentang Roger</h2>
                    <p>Roger adalah anjing kecil yang sangat ramah dan aktif. Dia sangat suka bermain dan cocok untuk keluarga dengan anak-anak. Roger sudah terlatih untuk buang air di tempat yang benar dan mengerti beberapa perintah dasar. Dia adalah teman yang sempurna untuk Anda yang mencari sahabat setia yang penuh energi!</p>
                </div>

                <!-- Characteristics -->
                <div class="characteristics">
                    <h2>🎯 Karakteristik</h2>
                    <div class="char-grid">
                        <div class="char-item">
                            <span class="char-label">Ras</span>
                            <span class="char-value">French Bulldog</span>
                        </div>
                        <div class="char-item">
                            <span class="char-label">Warna</span>
                            <span class="char-value">Coklat Muda</span>
                        </div>
                        <div class="char-item">
                            <span class="char-label">Berat</span>
                            <span class="char-value">8 kg</span>
                        </div>
                        <div class="char-item">
                            <span class="char-label">Energi</span>
                            <span class="char-value">Tinggi</span>
                        </div>
                        <div class="char-item">
                            <span class="char-label">Ramah Anak</span>
                            <span class="char-value">Ya</span>
                        </div>
                        <div class="char-item">
                            <span class="char-label">Terlatih</span>
                            <span class="char-value">Ya</span>
                        </div>
                    </div>
                </div>

                <!-- Health Info -->
                <div class="health-info">
                    <h3>✅ Status Kesehatan</h3>
                    <div class="health-list">
                        <div class="health-item">✓ Sudah divaksinasi lengkap</div>
                        <div class="health-item">✓ Sudah disterilisasi</div>
                        <div class="health-item">✓ Bebas kutu dan penyakit</div>
                        <div class="health-item">✓ Pemeriksaan kesehatan rutin</div>
                    </div>
                </div>

                <!-- Shelter Info -->
                <div class="shelter-info">
                    <div class="shelter-icon">🏠</div>
                    <div class="shelter-details">
                        <h3>Hubungi Shelter</h3>
                        <p>Shelter Harapan Hewan Jakarta</p>
                        <p>📍 Jakarta Selatan</p>
                        <p>📞 +62 812-3456-7890</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="btn btn-primary" onclick="adoptPet()">🐾 Ajukan Adopsi</button>
                    <button href="/anjing" class="btn btn-secondary"  onclick="contactShelter()">💬 Hubungi Shelter</button>
                </div>
            </div>
        </div>

        <!-- Similar Pets Section -->
        <div class="similar-section">
            <h2>🐕 Anjing Lain yang Mungkin Anda Suka</h2>
            <div class="similar-grid">
                <div class="similar-card" onclick="window.location.href='lily-detail.html'">
                    <img src="https://images.unsplash.com/photo-1552053831-71594a27632d?w=400&h=300&fit=crop" alt="Lily" class="similar-image">
                    <div class="similar-info">
                        <div class="similar-name">Lily</div>
                        <div class="similar-details">4 tahun • Betina • Beagle</div>
                    </div>
                </div>
                <div class="similar-card">
                    <img src="https://images.unsplash.com/photo-1558788353-f76d92427f16?w=400&h=300&fit=crop" alt="James" class="similar-image">
                    <div class="similar-info">
                        <div class="similar-name">James</div>
                        <div class="similar-details">4 tahun • Betina • Golden Retriever</div>
                    </div>
                </div>
                <div class="similar-card">
                    <img src="https://images.unsplash.com/photo-1477884213360-7e9d7dcc1e48?w=400&h=300&fit=crop" alt="Max" class="similar-image">
                    <div class="similar-info">
                        <div class="similar-name">Max</div>
                        <div class="similar-details">3 tahun • Jantan • Labrador</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeImage(src) {
            document.getElementById('mainImage').src = src.replace('w=300&h=300', 'w=800&h=800');
        }

        function adoptPet() {
            alert('Terima kasih atas minat Anda untuk mengadopsi Roger! Kami akan menghubungkan Anda dengan shelter untuk proses adopsi lebih lanjut.');
        }

        function contactShelter() {
            alert('Membuka WhatsApp untuk menghubungi Shelter Harapan Hewan Jakarta...');
        }

        // Toggle favorite
        document.querySelector('.favorite-big').addEventListener('click', function() {
            if (this.innerHTML === '♡') {
                this.innerHTML = '♥';
                this.style.color = '#ff6b35';
            } else {
                this.innerHTML = '♡';
                this.style.color = 'inherit';
            }
        });
    </script>
</body>
</html>