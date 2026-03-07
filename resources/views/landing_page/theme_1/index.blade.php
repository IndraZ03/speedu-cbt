<!DOCTYPE html>
<html lang="id" translate="no">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Bimbel Kedinasan SpeedU - Platform Sistem Computer Assisted Test (CAT) untuk persiapan Sekolah Kedinasan"/>
        <meta name="author" content="{{ $setting->app_name ?? '' }}" />
        <meta name="keywords" content="bimbel kedinasan, try out SKD, try out SKB, STMKG, STAN, sekolah kedinasan" />
        <title>{{ $setting->app_name ?? 'SpeedU' }} - Platform CAT Kedinasan</title>
        <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png" />
        <link href="{{ asset('assets/landing-page/theme_1/css/styles.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/landing-page/theme_1/css/aos.css') }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <script data-search-pseudo-elements="" defer="" src="{{ asset('assets/landing-page/theme_1/js/all.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/landing-page/theme_1/js/feather.min.js') }}" crossorigin="anonymous"></script>

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-248878270-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-248878270-1');
        </script>

        <style>
            :root {
                --primary-gradient: linear-gradient(135deg, #0061d3 0%, #00a8ff 100%);
                --dark-gradient: linear-gradient(135deg, #0d1a2e 0%, #1a365d 100%);
                --accent-color: #00d4ff;
                --glass-bg: rgba(255, 255, 255, 0.1);
                --glass-border: rgba(255, 255, 255, 0.2);
            }

            * {
                font-family: 'Inter', sans-serif;
            }

            /* Modern Hero Section */
            .hero-modern {
                position: relative;
                min-height: 100vh;
                background: linear-gradient(135deg, #0a1628 0%, #1a365d 50%, #0d2847 100%);
                overflow: hidden;
            }

            .hero-modern::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -50%;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle, rgba(0, 212, 255, 0.15) 0%, transparent 70%);
                animation: pulse-glow 4s ease-in-out infinite alternate;
                z-index: 3;
            }

            .hero-modern::after {
                content: '';
                position: absolute;
                bottom: -30%;
                left: -30%;
                width: 80%;
                height: 80%;
                background: radial-gradient(circle, rgba(0, 97, 211, 0.2) 0%, transparent 70%);
                animation: pulse-glow 5s ease-in-out infinite alternate-reverse;
                z-index: 3;
            }

            @keyframes pulse-glow {
                0% { transform: scale(1); opacity: 0.5; }
                100% { transform: scale(1.1); opacity: 0.8; }
            }

            .hero-content {
                position: relative;
                z-index: 10;
                padding-top: 80px;
            }

            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: var(--glass-bg);
                backdrop-filter: blur(10px);
                border: 1px solid var(--glass-border);
                padding: 8px 20px;
                border-radius: 50px;
                color: #fff;
                font-size: 0.875rem;
                font-weight: 500;
                margin-bottom: 1.5rem;
                animation: float 3s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }

            .hero-title {
                font-size: 3.5rem;
                font-weight: 800;
                color: #fff;
                line-height: 1.1;
                margin-bottom: 1.5rem;
            }

            .hero-title .gradient-text {
                background: linear-gradient(135deg, #00d4ff, #00ff88);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .hero-subtitle {
                font-size: 1.25rem;
                color: rgba(255, 255, 255, 0.8);
                max-width: 600px;
                margin-bottom: 2rem;
            }

            .btn-glow {
                position: relative;
                padding: 16px 32px;
                font-size: 1rem;
                font-weight: 600;
                border-radius: 12px;
                border: none;
                overflow: hidden;
                transition: all 0.3s ease;
            }

            .btn-glow-primary {
                background: var(--primary-gradient);
                color: #fff;
                box-shadow: 0 4px 20px rgba(0, 97, 211, 0.4);
            }

            .btn-glow-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 30px rgba(0, 97, 211, 0.6);
                color: #fff;
            }

            .btn-glow-outline {
                background: transparent;
                color: #fff;
                border: 2px solid var(--glass-border);
                backdrop-filter: blur(10px);
            }

            .btn-glow-outline:hover {
                background: var(--glass-bg);
                border-color: var(--accent-color);
                color: #fff;
            }

            /* Stats Section */
            .stats-container {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
                margin-top: 3rem;
            }

            .stat-item {
                text-align: center;
                padding: 1.5rem;
                background: var(--glass-bg);
                backdrop-filter: blur(10px);
                border: 1px solid var(--glass-border);
                border-radius: 16px;
                transition: all 0.3s ease;
            }

            .stat-item:hover {
                transform: translateY(-5px);
                background: rgba(255, 255, 255, 0.15);
            }

            .stat-number {
                font-size: 2.5rem;
                font-weight: 800;
                background: linear-gradient(135deg, #00d4ff, #00ff88);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .stat-label {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.875rem;
                margin-top: 0.5rem;
            }

            /* Modern Cards */
            .program-section {
                background: linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%);
                padding: 100px 0;
            }

            .section-title {
                font-size: 2.5rem;
                font-weight: 800;
                color: #1a365d;
                margin-bottom: 0.5rem;
            }

            .section-subtitle {
                font-size: 1.125rem;
                color: #64748b;
                max-width: 600px;
                margin: 0 auto;
            }

            .program-card {
                background: #fff;
                border-radius: 24px;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                height: 100%;
                position: relative;
            }

            .program-card:hover {
                transform: translateY(-12px);
                box-shadow: 0 20px 40px rgba(0, 97, 211, 0.15);
            }

            .program-card.featured {
                border: 3px solid #f59e0b;
            }

            .program-card.featured::before {
                content: '⭐ RECOMMENDED';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                background: linear-gradient(135deg, #f59e0b, #fbbf24);
                color: #1a1a1a;
                text-align: center;
                font-weight: 700;
                font-size: 0.75rem;
                padding: 8px;
                letter-spacing: 1px;
            }

            .program-card.featured .program-card-body {
                padding-top: 3rem;
            }

            .program-card-body {
                padding: 2rem;
            }

            .program-badge {
                display: inline-block;
                padding: 6px 14px;
                border-radius: 50px;
                font-size: 0.75rem;
                font-weight: 600;
                letter-spacing: 0.5px;
                margin-bottom: 1rem;
            }

            .program-name {
                font-size: 1.25rem;
                font-weight: 700;
                color: #1a365d;
                margin-bottom: 1rem;
            }

            .program-price-old {
                font-size: 1rem;
                color: #94a3b8;
                text-decoration: line-through;
            }

            .program-price {
                font-size: 2rem;
                font-weight: 800;
                color: #0061d3;
            }

            .program-duration {
                font-size: 0.875rem;
                color: #64748b;
                margin-bottom: 1rem;
            }

            .program-alert {
                padding: 12px 16px;
                border-radius: 12px;
                font-size: 0.875rem;
                font-weight: 600;
                margin-bottom: 1.5rem;
            }

            .program-features {
                list-style: none;
                padding: 0;
                margin: 0 0 1.5rem 0;
            }

            .program-features li {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                margin-bottom: 10px;
                color: #475569;
                font-size: 0.9rem;
            }

            .program-features li i {
                color: #10b981;
                margin-top: 3px;
            }

            .program-btn {
                display: block;
                width: 100%;
                padding: 14px;
                border-radius: 12px;
                font-weight: 600;
                text-align: center;
                transition: all 0.3s ease;
                text-decoration: none;
            }

            /* Countdown Section */
            .countdown-section {
                background: linear-gradient(135deg, #0a1628 0%, #1a365d 100%);
                padding: 80px 0;
                position: relative;
                overflow: hidden;
            }

            .countdown-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }

            .countdown-wrapper {
                position: relative;
                z-index: 10;
            }

            .countdown-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 1rem;
                max-width: 500px;
                margin: 2rem auto;
            }

            .countdown-item {
                background: var(--glass-bg);
                backdrop-filter: blur(10px);
                border: 1px solid var(--glass-border);
                border-radius: 16px;
                padding: 1.5rem 1rem;
                text-align: center;
            }

            .countdown-number {
                font-size: 2.5rem;
                font-weight: 800;
                color: #fff;
                line-height: 1;
            }

            .countdown-label {
                font-size: 0.75rem;
                color: rgba(255, 255, 255, 0.6);
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-top: 0.5rem;
            }

            /* Testimonials Section */
            .testimonials-section {
                padding: 100px 0;
                background: #f8fafc;
                position: relative;
                overflow: hidden;
            }

            .testimonials-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle at 50% 50%, rgba(0, 97, 211, 0.03) 0%, transparent 60%);
                pointer-events: none;
            }

            .testimonial-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(323px, 1fr));
                gap: 2rem;
                margin-top: 3rem;
                position: relative;
                z-index: 10;
            }

            .testimonial-card {
                background: #ffffff;
                border-radius: 24px;
                overflow: hidden;
                position: relative;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                border: 1px solid rgba(226, 232, 240, 0.8);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .testimonial-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px -5px rgba(0, 97, 211, 0.1);
                border-color: rgba(0, 97, 211, 0.2);
            }

            .testimonial-image-container {
                width: 100%;
                height: 370px;
                background: #f1f5f9;
                overflow: hidden;
                position: relative;
            }

            .testimonial-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.5s ease;
            }

            .testimonial-card:hover .testimonial-image {
                transform: scale(1.05);
            }

            .testimonial-body {
                padding: 2rem;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                min-height: 250px;
            }

            .testimonial-rating {
                display: flex;
                gap: 4px;
                margin-bottom: 1rem;
                color: #f59e0b;
                font-size: 0.9rem;
            }

            .testimonial-content {
                font-size: 1rem;
                color: #334155;
                font-weight: 500;
                line-height: 1.6;
                margin-bottom: 1.5rem;
                flex-grow: 1;
                font-style: italic;
            }

            .testimonial-author {
                display: flex;
                flex-direction: column;
                margin-top: 0;
            }

            .testimonial-info {
                display: flex;
                flex-direction: column;
            }

            .testimonial-name {
                font-weight: 700;
                color: #1e293b;
                font-size: 1.25rem;
                margin-bottom: 2px;
            }

            .testimonial-position {
                font-size: 0.95rem;
                color: #64748b;
                font-weight: 500;
            }

            /* CTA Section */
            .cta-section {
                background: linear-gradient(135deg, #0061d3 0%, #00a8ff 100%);
                padding: 80px 0;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .cta-section::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
                animation: rotate 20s linear infinite;
            }

            @keyframes rotate {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            .cta-content {
                position: relative;
                z-index: 10;
            }

            .cta-title {
                font-size: 2.5rem;
                font-weight: 800;
                color: #fff;
                margin-bottom: 1rem;
            }

            .cta-subtitle {
                font-size: 1.125rem;
                color: rgba(255, 255, 255, 0.9);
                margin-bottom: 2rem;
            }

            .btn-whatsapp {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                background: #25d366;
                color: #fff;
                padding: 16px 32px;
                border-radius: 12px;
                font-weight: 600;
                font-size: 1rem;
                text-decoration: none;
                transition: all 0.3s ease;
                box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            }

            .btn-whatsapp:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 30px rgba(37, 211, 102, 0.6);
                color: #fff;
            }

            /* Footer */
            .modern-footer {
                background: #0a1628;
                padding: 60px 0 30px;
            }

            .footer-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-top: 30px;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                margin-top: 30px;
            }

            .footer-copyright {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.875rem;
            }

            /* Hero Background Canvas */
            #nodes {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 1;
                pointer-events: none;
            }

            /* Floating Particles */
            .particles {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                pointer-events: none;
                z-index: 2;
            }

            .particle {
                position: absolute;
                width: 4px;
                height: 4px;
                background: rgba(255, 255, 255, 0.4);
                border-radius: 50%;
                animation: float-particle 15s infinite linear;
                box-shadow: 0 0 10px rgba(0, 212, 255, 0.5);
            }

            @keyframes float-particle {
                0% { transform: translateY(100vh) translateX(0); opacity: 0; }
                10% { opacity: 1; }
                90% { opacity: 1; }
                100% { transform: translateY(-100vh) translateX(100px); opacity: 0; }
            }

            /* Responsive */
            @media (max-width: 768px) {
                .hero-title {
                    font-size: 2.25rem;
                }

                .stats-container {
                    grid-template-columns: 1fr;
                }

                .countdown-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .testimonial-grid {
                    grid-template-columns: 1fr;
                }

                .cta-title {
                    font-size: 1.75rem;
                }
            }

            /* Navbar Modern */
            .navbar-modern {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            }

            .navbar-modern .nav-link {
                font-weight: 500;
                color: #1a365d !important;
                transition: color 0.3s ease;
            }

            .navbar-modern .nav-link:hover {
                color: #0061d3 !important;
            }

            /* Category Title */
            .category-title {
                font-size: 1.5rem;
                font-weight: 700;
                color: #1a365d;
                margin-bottom: 2rem;
                text-align: center;
                position: relative;
                padding-bottom: 1rem;
            }

            .category-title::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 60px;
                height: 4px;
                background: var(--primary-gradient);
                border-radius: 2px;
            }

            .live-indicator {
                display: inline-flex;
                align-items: center;
                gap: 6px;
            }

            .live-dot {
                width: 10px;
                height: 10px;
                background: #ef4444;
                border-radius: 50%;
                animation: pulse-live 1.5s ease-in-out infinite;
            }

            @keyframes pulse-live {
                0%, 100% { transform: scale(1); opacity: 1; }
                50% { transform: scale(1.3); opacity: 0.7; }
            }
        </style>
    </head>
    <body>
        <div id="layoutDefault">
            <div id="layoutDefault_content">
                <main>
                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg navbar-modern fixed-top">
                        <div class="container px-4">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ asset('storage/upload_files/settings/2507100211_2501020943_pngwing.com (3).png') }}" style="height:40px;"/>
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                                <i data-feather="menu"></i>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ms-auto me-lg-4">
                                    <li class="nav-item"><a class="nav-link" href="#program-kami">Program</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
                                </ul>
                                <div class="d-flex gap-2">
                                    <a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>
                                    <a class="btn btn-primary" href="{{ route('register') }}">
                                        Daftar <i class="ms-1" data-feather="arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>

                    <!-- Hero Section -->
                    <section class="hero-modern">
                        <!-- Background Canvas (Nodes.js) -->
                        <canvas id="nodes"></canvas>
                        
                        <!-- Floating Particles Overlay -->
                        <div class="particles">
                            @for($i = 0; $i < 40; $i++)
                            <div class="particle" style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 15) }}s; animation-duration: {{ rand(12, 28) }}s;"></div>
                            @endfor
                        </div>
                        
                        
                        <div class="hero-content">
                            <div class="container px-4">
                                <div class="row min-vh-100 align-items-center py-5">
                                    <div class="col-lg-7" data-aos="fade-right">
                                        <div class="hero-badge">
                                            <span class="live-indicator">
                                                <span class="live-dot"></span>
                                            </span>
                                            Pendaftaran Dibuka!
                                        </div>
                                        <h1 class="hero-title">
                                            Platform CAT <span class="gradient-text">#1</span> untuk
                                            <span class="gradient-text">Sekolah Kedinasan</span>
                                        </h1>
                                        <p class="hero-subtitle">
                                            Persiapkan dirimu dengan sistem latihan CAT terbaik. Ribuan soal terupdate, pembahasan lengkap, dan simulasi ujian yang mirip dengan aslinya.
                                        </p>
                                        <div class="d-flex flex-wrap gap-3 mb-4">
                                            <a href="{{ route('register') }}" class="btn btn-glow btn-glow-primary">
                                                Mulai Belajar Sekarang
                                            </a>
                                            <a href="#program-kami" class="btn btn-glow btn-glow-outline">
                                                Lihat Program
                                            </a>
                                        </div>

                                        <div class="stats-container">
                                            <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                                                <div class="stat-number">100+</div>
                                                <div class="stat-label">Soal Terupdate</div>
                                            </div>
                                            <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                                                <div class="stat-number">100+</div>
                                                <div class="stat-label">Siswa Lulus</div>
                                            </div>
                                            <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                                                <div class="stat-number">95%</div>
                                                <div class="stat-label">Mirip Soal Asli</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left">
                                        <div class="device-laptop text-gray-200">
                                            <svg class="device-container" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="83.911 298.53 426.962 243.838"><path d="M474.843 516.208V309.886c0-6.418-4.938-11.355-11.354-11.355H131.791c-6.417 0-11.354 4.938-11.354 11.355v206.816H83.911v13.326c4.938 7.896 31.098 12.34 40.969 12.34h345.024c10.366 0 36.526-4.936 40.969-12.34v-13.326h-36.03v-.494zM134.26 313.341h326.762v203.361H134.26V313.341z"></path></svg>
                                            <img class="device-screenshot" src="{{ asset('assets/images/Screenshot 2025-07-06 040203.png') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Countdown Section -->
                    <section class="countdown-section">
                        <div class="container px-4">
                            <div class="countdown-wrapper text-center" data-aos="fade-up">
                                <span class="hero-badge mb-3">
                                    <span class="live-indicator">
                                        <span class="live-dot"></span>
                                    </span>
                                    Promo Terbatas
                                </span>
                                <h2 class="text-white mb-2" style="font-size: 2rem; font-weight: 800;">
                                    PROMO SPESIAL <span class="gradient-text">#NGEBUTBELAJAR</span>
                                </h2>
                                <p class="text-white-50">Penawaran berakhir dalam:</p>
                                
                                <div class="countdown-grid" id="main-countdown" data-tujuan="2026-08-17T23:59:59">
                                    <div class="countdown-item">
                                        <div class="countdown-number" id="days">00</div>
                                        <div class="countdown-label">Hari</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-number" id="hours">00</div>
                                        <div class="countdown-label">Jam</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-number" id="minutes">00</div>
                                        <div class="countdown-label">Menit</div>
                                    </div>
                                    <div class="countdown-item">
                                        <div class="countdown-number" id="seconds">00</div>
                                        <div class="countdown-label">Detik</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Programs Section -->
                    <section id="program-kami" class="program-section">
                        <div class="container px-4">
                            <div class="text-center mb-5" data-aos="fade-up">
                                <h2 class="section-title">Program Unggulan Kami</h2>
                                <p class="section-subtitle">
                                    Pilih paket belajar yang sesuai dengan kebutuhanmu. Semua program dilengkapi dengan materi terlengkap dan pembimbing profesional.
                                </p>
                            </div>

                            @if(isset($programs) && count($programs) > 0)
                                @foreach($programs as $category => $categoryPrograms)
                                <div class="mb-5">
                                    <h3 class="category-title" data-aos="fade-up">{{ $category }}</h3>
                                    <div class="row g-4 justify-content-center">
                                        @foreach($categoryPrograms as $program)
                                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                            <div class="program-card {{ $program->is_featured ? 'featured' : '' }}">
                                                <div class="program-card-body">
                                                    @if($program->badge_text)
                                                    <span class="program-badge bg-{{ $program->badge_color }} {{ in_array($program->badge_color, ['warning', 'light']) ? 'text-dark' : 'text-white' }}">
                                                        {{ $program->badge_text }}
                                                    </span>
                                                    @endif
                                                    <h4 class="program-name">{{ $program->name }}</h4>
                                                    <p class="program-price-old">Rp {{ number_format($program->original_price, 0, ',', '.') }}</p>
                                                    <p class="program-price mb-0">Rp {{ number_format($program->promo_price, 0, ',', '.') }}</p>
                                                    @if($program->duration)
                                                    <p class="program-duration">{{ $program->duration }}</p>
                                                    @endif
                                                    
                                                    @if($program->alert_text)
                                                    <div class="program-alert alert alert-{{ $program->alert_color }}">
                                                        <strong>{{ $program->alert_text }}</strong>
                                                    </div>
                                                    @endif

                                                    @if($program->features && count($program->features) > 0)
                                                    <ul class="program-features">
                                                        @foreach($program->features as $feature)
                                                        <li>
                                                            <i class="fas fa-check"></i>
                                                            <span>{!! $feature !!}</span>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    @endif

                                                    @if($program->action_type === 'register')
                                                    <a href="{{ route('register') }}" class="program-btn btn btn-{{ $program->button_color }}">
                                                        {{ $program->button_text }}
                                                    </a>
                                                    @else
                                                    <a href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode($program->whatsapp_message ?: 'Hai Kak, saya tertarik dengan program '.$program->name.' dari Bimbel Speedu. Mohon informasinya!') }}" 
                                                       class="program-btn btn btn-{{ $program->button_color }}" target="_blank">
                                                        {{ $program->button_text }}
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <!-- Default programs if no data in database -->
                                <div class="mb-5">
                                    <h3 class="category-title" data-aos="fade-up">Paket Try Out</h3>
                                    <div class="row g-4 justify-content-center">
                                        <div class="col-lg-4 col-md-6" data-aos="fade-up">
                                            <div class="program-card">
                                                <div class="program-card-body">
                                                    <span class="program-badge bg-danger text-white">#NGEBUTLATIHAN</span>
                                                    <h4 class="program-name">5x Try Out SKD</h4>
                                                    <p class="program-price-old">Rp 40.000</p>
                                                    <p class="program-price mb-0">Rp 30.000</p>
                                                    <p class="program-duration">Untuk 30 Pendaftar Pertama</p>
                                                    <ul class="program-features">
                                                        <li><i class="fas fa-check"></i><span>Bisa dikerjakan kapanpun</span></li>
                                                        <li><i class="fas fa-check"></i><span>Soal FR terupdate</span></li>
                                                        <li><i class="fas fa-check"></i><span>Pembahasan dapat diunduh</span></li>
                                                        <li><i class="fas fa-check"></i><span>Join Grup Diskusi</span></li>
                                                        <li><i class="fas fa-check"></i><span>Perankingan Peserta</span></li>
                                                    </ul>
                                                    <a href="{{ route('register') }}" class="program-btn btn btn-outline-primary">
                                                        Daftar Try Out
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                                            <div class="program-card featured">
                                                <div class="program-card-body">
                                                    <span class="program-badge bg-danger text-white">#NGEBUTLATIHAN</span>
                                                    <h4 class="program-name">10x Try Out SKD</h4>
                                                    <p class="program-price-old">Rp 80.000</p>
                                                    <p class="program-price mb-0">Rp 50.000</p>
                                                    <p class="program-duration">Untuk 30 Pendaftar Pertama</p>
                                                    <ul class="program-features">
                                                        <li><i class="fas fa-check"></i><span>Bisa dikerjakan kapanpun</span></li>
                                                        <li><i class="fas fa-check"></i><span>Soal FR terupdate</span></li>
                                                        <li><i class="fas fa-check"></i><span>Pembahasan dapat diunduh</span></li>
                                                        <li><i class="fas fa-check"></i><span>Join Grup Diskusi</span></li>
                                                        <li><i class="fas fa-check"></i><span>Perankingan Peserta</span></li>
                                                    </ul>
                                                    <a href="{{ route('register') }}" class="program-btn btn btn-warning text-dark">
                                                        Daftar Try Out
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>

                    <!-- Testimonials Section -->
                    @if(isset($testimonials) && count($testimonials) > 0)
                    <section id="testimoni" class="testimonials-section">
                        <div class="container px-4">
                            <div class="text-center mb-5" data-aos="fade-up">
                                <h2 class="section-title">Apa Kata Mereka?</h2>
                                <p class="section-subtitle">
                                    Ribuan siswa telah merasakan manfaat belajar bersama kami. Ini kata mereka tentang pengalaman belajar di SpeedU.
                                </p>
                            </div>

                            <div class="testimonial-grid">
                                @foreach($testimonials as $testimonial)
                                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                    <!-- Image Top -->
                                    <div class="testimonial-image-container">
                                        @if($testimonial->photo)
                                        <img src="{{ asset('storage/upload_files/testimonials/'.$testimonial->photo) }}" 
                                             alt="{{ $testimonial->name }}" class="testimonial-image">
                                        @else
                                        <div class="testimonial-image d-flex align-items-center justify-content-center bg-light">
                                            <span class="text-muted" style="font-size: 5rem;">
                                                {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Content Body -->
                                    <div class="testimonial-body">
                                        <div class="testimonial-author mb-2">
                                            <div class="testimonial-name">{{ $testimonial->name }}</div>
                                            @if($testimonial->position)
                                            <div class="testimonial-position">{{ $testimonial->position }}</div>
                                            @endif
                                        </div>

                                        <div class="testimonial-rating mb-3">
                                            @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $testimonial->rating ? '' : 'text-muted' }}"></i>
                                            @endfor
                                        </div>
                                        
                                        <p class="testimonial-content">"{{ $testimonial->content }}"</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    @else
                    <!-- Default testimonials if no data -->
                    <section id="testimoni" class="testimonials-section">
                        <div class="container px-4">
                            <div class="text-center mb-5" data-aos="fade-up">
                                <h2 class="section-title">Apa Kata Mereka?</h2>
                                <p class="section-subtitle">
                                    Ribuan siswa telah merasakan manfaat belajar bersama kami. 
                                </p>
                            </div>

                            <div class="testimonial-grid">
                                <div class="testimonial-card" data-aos="fade-up">
                                    <div class="testimonial-image-container">
                                        <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" class="testimonial-image" alt="Ahmad Fauzan">
                                    </div>
                                    <div class="testimonial-body">
                                        <div class="testimonial-author mb-2">
                                            <div class="testimonial-name">Ahmad Fauzan</div>
                                            <div class="testimonial-position">Siswa STMKG 2025</div>
                                        </div>
                                        <div class="testimonial-rating mb-3">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <p class="testimonial-content">
                                            "Alhamdulillah berkat latihan di SpeedU, saya bisa lolos STMKG. Soal-soalnya mirip banget sama yang keluar di ujian!"
                                        </p>
                                    </div>
                                </div>
                                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                                    <div class="testimonial-image-container">
                                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" class="testimonial-image" alt="Siti Nurhaliza">
                                    </div>
                                    <div class="testimonial-body">
                                        <div class="testimonial-author mb-2">
                                            <div class="testimonial-name">Siti Nurhaliza</div>
                                            <div class="testimonial-position">Alumni STAN 2024</div>
                                        </div>
                                        <div class="testimonial-rating mb-3">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <p class="testimonial-content">
                                            "Platform terbaik untuk latihan CAT! Pembahasan lengkap dan mudah dipahami. Sangat recommended!"
                                        </p>
                                    </div>
                                </div>
                                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                                    <div class="testimonial-image-container">
                                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80" class="testimonial-image" alt="Rizky Pratama">
                                    </div>
                                    <div class="testimonial-body">
                                        <div class="testimonial-author mb-2">
                                            <div class="testimonial-name">Rizky Pratama</div>
                                            <div class="testimonial-position">Peserta Try Out SKD</div>
                                        </div>
                                        <div class="testimonial-rating mb-3">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <p class="testimonial-content">
                                            "Fitur ranking peserta bikin saya makin semangat belajar. Bisa lihat progress dan saingan setiap hari!"
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    <!-- CTA Section -->
                    <section class="cta-section">
                        <div class="container px-4">
                            <div class="cta-content" data-aos="fade-up">
                                <h2 class="cta-title">Siap Wujudkan Mimpimu?</h2>
                                <p class="cta-subtitle">
                                    Jangan tunda lagi! Bergabung sekarang dan mulai persiapan terbaikmu untuk Sekolah Kedinasan.
                                </p>
                                <div class="d-flex flex-wrap gap-3 justify-content-center">
                                    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4" style="font-weight: 600;">
                                        Daftar Sekarang
                                    </a>
                                    <a href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode('Hallo, Admin. saya ingin bergabung dengan '.$setting->app_name.' ....') }}" 
                                       class="btn-whatsapp" target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                        Hubungi Admin
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            </div>

            <!-- Footer -->
            <footer class="modern-footer">
                <div class="container px-4">
                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <img src="{{ asset('storage/upload_files/settings/2507100211_2501020943_pngwing.com (3).png') }}" 
                                 style="height: 50px; filter: brightness(0) invert(1);" class="mb-3">
                            <p class="text-white-50">
                                Platform CAT terlengkap untuk persiapan Sekolah Kedinasan. Latihan soal, simulasi ujian, dan pembahasan lengkap.
                            </p>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <h5 class="text-white mb-3">Quick Links</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="#program-kami" class="text-white-50 text-decoration-none">Program</a></li>
                                <li class="mb-2"><a href="#testimoni" class="text-white-50 text-decoration-none">Testimoni</a></li>
                                <li class="mb-2"><a href="{{ route('login') }}" class="text-white-50 text-decoration-none">Login</a></li>
                                <li class="mb-2"><a href="{{ route('register') }}" class="text-white-50 text-decoration-none">Daftar</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <h5 class="text-white mb-3">Hubungi Kami</h5>
                            <p class="text-white-50">
                                <i class="fab fa-whatsapp me-2"></i> {{ $setting->whatsapp_number ?? '-' }}
                            </p>
                            @if($setting->address)
                            <p class="text-white-50">
                                <i class="fas fa-map-marker-alt me-2"></i> {{ $setting->address }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="footer-content">
                        <div class="footer-copyright">
                            © {{ date('Y') }} {{ $setting->app_name ?? 'SpeedU' }}. All rights reserved.
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <script src="{{ asset('assets/landing-page/theme_1/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/landing-page/theme_1/js/scripts.js') }}"></script>
        <script src="{{ asset('assets/landing-page/theme_1/js/aos.js') }}"></script>
        <script>
            AOS.init({
                disable: 'mobile',
                duration: 800,
                once: true,
                easing: 'ease-out-cubic'
            });
        </script>

        <script type="text/javascript" src="{{ asset('assets/landing-page/theme_1/js/nodes.js') }}"></script>
        <script type="text/javascript">
            var nodesjs = new NodesJs({
                id: 'nodes',
                width: window.innerWidth,
                height: window.innerHeight,
                particleSize: 2,
                lineSize: 0.5,
                particleColor: [255, 255, 255, 0.4],
                lineColor: [255, 255, 255],
                backgroundFrom: [10, 22, 40],
                backgroundTo: [26, 54, 93],
                backgroundDuration: 6000,
                nobg: true,
                number: window.hasOwnProperty('orientation') ? 30 : 80,
                speed: 15
            });

            window.onresize = function () {
                nodesjs.setWidth(window.innerWidth);
                nodesjs.setHeight(window.innerHeight);
            };
        </script>

        <!-- Countdown Script -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const countdownElement = document.getElementById("main-countdown");
                if (!countdownElement) return;

                const targetDate = new Date(countdownElement.dataset.tujuan).getTime();

                const updateCountdown = () => {
                    const now = new Date().getTime();
                    const distance = targetDate - now;

                    if (distance < 0) {
                        document.getElementById("days").textContent = "00";
                        document.getElementById("hours").textContent = "00";
                        document.getElementById("minutes").textContent = "00";
                        document.getElementById("seconds").textContent = "00";
                        return;
                    }

                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById("days").textContent = String(days).padStart(2, "0");
                    document.getElementById("hours").textContent = String(hours).padStart(2, "0");
                    document.getElementById("minutes").textContent = String(minutes).padStart(2, "0");
                    document.getElementById("seconds").textContent = String(seconds).padStart(2, "0");
                };

                updateCountdown();
                setInterval(updateCountdown, 1000);
            });
        </script>

        <!-- Smooth scroll -->
        <script>
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        </script>
    </body>
</html>
