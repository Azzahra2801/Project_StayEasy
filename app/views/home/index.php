<?php require_once __DIR__ . '/../layout/Header.php'; ?>

</div>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    .hero-section {
        position: relative;
        height: 600px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    
    .hero-bg-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 800px;
        padding: 0 20px;
    }

    .search-container {
        background: white;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-icon {
        color: #666;
        font-size: 1.2rem;
        padding-left: 10px;
    }

    .search-input {
        border: none;
        flex-grow: 1;
        padding: 10px;
        font-size: 1rem;
        outline: none;
    }
    
    .search-input::placeholder {
        color: #888;
    }

    .search-btn {
        background-color: #1a3c5e; /* Match logo dark blue usually, or standard dark color */
        color: white;
        border: none;
        padding: 10px 30px;
        border-radius: 6px;
        font-weight: 500;
        transition: background 0.3s;
    }

    .search-btn:hover {
        background-color: #132f4a;
    }

    .property-card {
        border: none;
        transition: transform 0.3s ease;
        height: 100%;
    }

    .property-card:hover {
        transform: translateY(-5px);
    }

    .property-img {
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        width: 100%;
    }

    .card-heart {
        position: absolute;
        top: 15px;
        right: 15px;
        color: white;
        background: rgba(0,0,0,0.3);
        padding: 5px;
        border-radius: 50%;
        cursor: pointer;
    }

    .rating-stars {
        color: #ffc107;
        font-size: 0.9rem;
    }

    .location-text {
        color: #666;
        font-size: 0.9rem;
    }
</style>

<div class="hero-section">
    <img src="/Project_StayEasy/public/uploads/images/hotel.png" alt="Hotel Background" class="hero-bg-img">
    <div class="hero-overlay"></div>
    <div class="hero-content" data-aos="fade-up">
        <div class="search-container">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Cari Lokasi, Tanggal, Tamu">
            <button class="search-btn">Search</button>
        </div>
    </div>
</div>

<div class="container my-5">
    <h2 class="mb-4 fw-bold" data-aos="fade-right">Properti Populer</h2>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <!-- kamar 1 -->
        <div class="col" data-aos="fade-up" data-aos-delay="100">
            <div class="card property-card h-100">
                <div class="position-relative">
                    <a href="/Project_StayEasy/public/index.php?controller=kamar&action=index">
                        <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&q=80&w=600" class="property-img" alt="Room 1">
                    </a>
                    <div class="card-heart"><i class="bi bi-heart"></i></div>
                </div>
                <div class="card-body px-0">
                    <a href="/Project_StayEasy/public/index.php?controller=kamar&action=index" class="text-decoration-none text-dark">
                        <h5 class="card-title fw-bold mb-1">Luxury Modern Apartment</h5>
                    </a>
                    <div class="mb-1">
                        <span class="rating-stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </span>
                    </div>
                    <p class="location-text mb-0">2.5 km dari pusat kota</p>
                </div>
            </div>
        </div>

        <!-- kamar 2 -->
        <div class="col" data-aos="fade-up" data-aos-delay="200">
            <div class="card property-card h-100">
                <div class="position-relative">
                    <a href="/Project_StayEasy/public/index.php?controller=kamar&action=index">
                        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&q=80&w=600" class="property-img" alt="Room 2">
                    </a>
                    <div class="card-heart"><i class="bi bi-heart"></i></div>
                </div>
                <div class="card-body px-0">
                    <a href="/Project_StayEasy/public/index.php?controller=kamar&action=index" class="text-decoration-none text-dark">
                        <h5 class="card-title fw-bold mb-1">Cozy Studio Suite</h5>
                    </a>
                    <div class="mb-1">
                        <span class="rating-stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                        </span>
                    </div>
                    <p class="location-text mb-0">1.2 km dari stasiun</p>
                </div>
            </div>
        </div>

        <!-- kamar 3 -->
        <div class="col" data-aos="fade-up" data-aos-delay="300">
            <div class="card property-card h-100">
                <div class="position-relative">
                    <a href="/Project_StayEasy/public/index.php?controller=kamar&action=index">
                        <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?auto=format&fit=crop&q=80&w=600" class="property-img" alt="Room 3">
                    </a>
                    <div class="card-heart"><i class="bi bi-heart"></i></div>
                </div>
                <div class="card-body px-0">
                    <a href="/Project_StayEasy/public/index.php?controller=kamar&action=index" class="text-decoration-none text-dark">
                        <h5 class="card-title fw-bold mb-1">Executive Lounge Room</h5>
                    </a>
                    <div class="mb-1">
                        <span class="rating-stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </span>
                    </div>
                    <p class="location-text mb-0">0.5 km dari bandara</p>
                </div>
            </div>
        </div>

        <!-- kamar 4 -->
        <div class="col" data-aos="fade-up" data-aos-delay="400">
            <div class="card property-card h-100">
                <div class="position-relative">
                    <a href="/Project_StayEasy/public/index.php?controller=kamar&action=index">
                        <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&q=80&w=600" class="property-img" alt="Room 4">
                    </a>
                    <div class="card-heart"><i class="bi bi-heart"></i></div>
                </div>
                <div class="card-body px-0">
                    <a href="/Project_StayEasy/public/index.php?controller=kamar&action=index" class="text-decoration-none text-dark">
                        <h5 class="card-title fw-bold mb-1">Family Garden Villa</h5>
                    </a>
                    <div class="mb-1">
                        <span class="rating-stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </span>
                    </div>
                    <p class="location-text mb-0">5 km dari pantai</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true
  });
</script>

<div class="container my-4">
<?php require_once __DIR__ . '/../layout/Footer.php'; ?>