<!DOCTYPE html>
<html lang="id" translate="no">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Membantu casis POLRI, TNI, CPNS dan Kedinasan dalam berlatih agar lebih siap menghadapi tes yang sebenarnya"/>
        <meta name="author" content="{{ $setting->app_name ?? '' }}" />
        <title>Home</title>
        <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png" />
        <link href="{{ asset('assets/landing-page/theme_1/css/styles.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/landing-page/theme_1/css/aos.css') }}" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
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

    </head>
    <body>
        <div id="layoutDefault">
            <div id="layoutDefault_content">
                <main>
                    <!-- Navbar-->
                    <nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
                        <div class="container px-5">
                            <a class="navbar-brand text-primary" href="{{ url('/') }}">
                                <img src="{{ asset('storage/upload_files/settings/2507051123_2501020943_pngwing.com (3).png') }}" style="height:40px;"/>
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto me-lg-5">
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                                    {{-- <li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Tim</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Artikel</a></li> --}}
                                </ul>
                                <a class="btn fw-500 ms-lg-4 btn-outline-primary" href="{{ route('login') }}">
                                    Login
                                </a>
                                <a class="btn fw-500 ms-lg-4 btn-primary" href="{{ route('register') }}">
                                    Daftar
                                    <i class="ms-2" data-feather="arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </nav>
                    <!-- Page Header-->
                    <header class="page-header-ui page-header-ui-light bg-white">

                        <div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;">
                            <canvas id="nodes"></canvas>
                        </div>
                        <div class="page-header-ui-content" style="position:relative; left: 0px; top: 0px; width: 100%; height: 100%;">
                            <div class="container px-5">
                                <div class="row gx-5 justify-content-center">
                                    <div class="col-xl-8 col-lg-10 text-center mb-4" data-aos="fade">
                                        <h1 class="page-header-ui-title text-white">Platform Sistem Computer Assisted Test (CAT)</h1>
                                        <p class="page-header-ui-text text-white">Membantu anda #NGEBUTLATIHAN PERSIAPAN SEKOLAH KEDINASAN</p>
                                        <a class="btn btn-primary fw-500 me-2" href="{{ route('login') }}">Mulai Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <section class="bg-light pb-10 pt-1">
                        <div class="container px-5">
                            <div class="device-laptop text-gray-200 mt-n10" data-aos="fade-up">
                                <svg class="device-container" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="83.911 298.53 426.962 243.838"><path d="M474.843 516.208V309.886c0-6.418-4.938-11.355-11.354-11.355H131.791c-6.417 0-11.354 4.938-11.354 11.355v206.816H83.911v13.326c4.938 7.896 31.098 12.34 40.969 12.34h345.024c10.366 0 36.526-4.936 40.969-12.34v-13.326h-36.03v-.494zM134.26 313.341h326.762v203.361H134.26V313.341z"></path></svg>
                                <img class="device-screenshot" src="{{ asset('assets\\images\\Screenshot 2025-07-06 040203.png') }}" />
                            </div>
                        </div>
                    </section>
                    {{-- <section class="bg-white py-10">
                        <div class="container px-5">
                            <div class="row gx-5 text-center">
                                <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                                    <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i data-feather="layers"></i></div>
                                    <h3>Dibuat khusus seperti aslinya</h3>
                                    <p class="mb-0">Sistem dibuat mirip dengan tes aslinya agar anda tidak perlu banyak beradaptasi, sehingga anda tetap fokus dan menghindari dari masalah teknis yang tidak diinginkan.</p>
                                </div>
                                <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
                                    <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i data-feather="smartphone"></i></div>
                                    <h3>Modern responsive design</h3>
                                    <p class="mb-0">Menampilkan komponen mobile-first yang dibuat dengan sangat elegan, aplikasi akan berfungsi dengan baik di perangkat apa pun seperti laptop, tablet ataupun smartphone!</p>
                                </div>
                                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                                    <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4"><i data-feather="code"></i></div>
                                    <h3>Dokumentasi Lengkap</h3>
                                    <p class="mb-0">Semua tata letak, bagian halaman, komponen, dan utilitas sepenuhnya tercakup dalam dokumen lengkap agar memudahkan user ketika menggunakan aplikasi CAT {{ $setting->app_name ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="bg-light py-10">
                        <div class="container px-5">
                            <div class="row gx-5 justify-content-center">
                                <div class="col-lg-6">
                                    <div class="text-center">
                                        <div class="text-xs text-uppercase-expanded text-primary mb-2">Feature Aplikasi</div>
                                        <h2 class="mb-5">Kami memiliki solusi sederhana untuk masalah yang kompleks</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-5">
                                <div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up">
                                    <a class="card text-center text-decoration-none h-100 lift">
                                        <div class="card-body py-5">
                                            <div class="icon-stack icon-stack-lg bg-green-soft text-green mb-4"><i data-feather="layers"></i></div>
                                            <h5>Peminatan Lengkap</h5>
                                            <p class="card-text small">Terdiri dari tes TNI, POLRI, Kedinasan dan CPNS yang didalamnya terdapat banyak kategori yang akan diujikan.</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="100">
                                    <a class="card text-center text-decoration-none h-100 lift">
                                        <div class="card-body py-5">
                                            <div class="icon-stack icon-stack-lg bg-red-soft text-red mb-4"><i data-feather="tool"></i></div>
                                            <h5>Sistem Penilaian</h5>
                                            <p class="card-text small">Sistem penilaian untuk kategori peminatan sesuai dengan sistem yang sebenarnya, sehingga siswa dapat mengetahui ambang batas nilai di kategori tersebut.</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="150">
                                    <a class="card text-center text-decoration-none h-100 lift">
                                        <div class="card-body py-5">
                                            <div class="icon-stack icon-stack-lg bg-yellow-soft text-yellow mb-4"><i data-feather="layout"></i></div>
                                            <h5>Peringkat Nilai</h5>
                                            <p class="card-text small">Siswa dapat melihat ranking dari masing-masing Try Out yang telah diikuti sehingga siswa tahu dimana posisi dia dibanding dengan siswa lainnya.</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0" data-aos="fade-up">
                                    <a class="card text-center text-decoration-none h-100 lift">
                                        <div class="card-body py-5">
                                            <div class="icon-stack icon-stack-lg bg-purple-soft text-purple mb-4"><i data-feather="book"></i></div>
                                            <h5>Pembahasan Materi</h5>
                                            <p class="card-text small">Pembahasan materi disajikan dalam bentuk dokumentasi tertulis atau video, baik itu pembahasan untuk masing-masing soal, atau materi yang disampaikan sesuai dengan judul bahasan.</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                                    <a class="card text-center text-decoration-none h-100 lift">
                                        <div class="card-body py-5">
                                            <div class="icon-stack icon-stack-lg bg-blue-soft text-blue mb-4"><i data-feather="code"></i></div>
                                            <h5>Webinar</h5>
                                            <p class="card-text small">Siswa dapat mengikuti webinar via Zoom Meeting yang bertujuan untuk mengevaluasi kegiatan pembelajaran</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
                                    <a class="card text-center text-decoration-none h-100 lift">
                                        <div class="card-body py-5">
                                            <div class="icon-stack icon-stack-lg bg-orange-soft text-orange mb-4"><i data-feather="package"></i></div>
                                            <h5>Affiliate Program</h5>
                                            <p class="card-text small">Selain bermanfaat bagi diri sendiri, siswa dapat mengajakan teman-teman lainnya kedalam sistem {{ $setting->app_name ?? '' }}, dan siswa tersebut akan mendapatkan komisi ketika siswa baru mengikuti link nya dan melakukan transaksi.</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="bg-white py-10">
                        <div class="container px-5">
                            <div class="row gx-5 justify-content-center">
                                <div class="col-lg-6">
                                    <div class="text-center">
                                        <div class="text-xs text-uppercase-expanded text-primary mb-2">Gambaran Aplikasi</div>
                                        <h2 class="mb-5">Gambaran Aplikasi CAT {{ $setting->app_name ?? '' }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12" data-aos="fade-up">
                                    <div class="card">
                                        <img src="{{ asset('assets/landing-page/theme_1/image_tenant/'.$setting->app_name.'/image_1.png') }}" class="card-img-top" alt="{{ $setting->app_name }}"/>
                                        <div class="card-body">
                                            <h5 class="card-title">Kategori Peminatan</h5>
                                            <p class="card-text">
                                                Tampilan halaman kategori peminatan, menampilkan kategori untuk TNI, POLRI, CPNS dan Kedinasan
                                            </p>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-6 col-md-12" data-aos="fade-up">
                                    <div class="card">
                                        <img src="{{ asset('assets/landing-page/theme_1/image_tenant/'.$setting->app_name.'/image_2.png') }}" class="card-img-top" alt="{{ $setting->app_name }}"/>
                                        <div class="card-body">
                                            <h5 class="card-title">Halaman Try Out</h5>
                                            <p class="card-text">
                                                Tampilan halaman Try Out dengan soal matematika. menampilkan nomor soal serta navigasi soal agar siswa tahu soal mana saja yang sudah dijawab.
                                            </p>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-6 col-md-12" data-aos="fade-up">
                                    <div class="card">
                                        <img src="{{ asset('assets/landing-page/theme_1/image_tenant/'.$setting->app_name.'/image_3.png') }}" class="card-img-top" alt="{{ $setting->app_name }}"/>
                                        <div class="card-body">
                                            <h5 class="card-title">Detail Penilaian</h5>
                                            <p class="card-text">
                                                Tampilan detail penilaian. Menampikan kategori penilaian yang ada didalam tes yang sudah dikerjakan, sehingga siwa tahu mana yang harus dievaluasi.
                                            </p>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-6 col-md-12" data-aos="fade-up">
                                    <div class="card">
                                        <img src="{{ asset('assets/landing-page/theme_1/image_tenant/'.$setting->app_name.'/image_4.png') }}" class="card-img-top" alt="{{ $setting->app_name }}"/>
                                        <div class="card-body">
                                            <h5 class="card-title">Tes Kecermatan POLRI</h5>
                                            <p class="card-text">
                                                Menampilkan soal tanpa nomor dan navigasi, ketika klik jawaban, soal otomatis berpindah. ada 10 kolom dalam tes ini, tiap kolom terdiri dari 50 soal.
                                            </p>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </section> --}}

                    <section class="py-5">
                        <div class="container px-5">
                            <div class="text-center mb-5">
      <h2 class="display-4 fw-bolder" style="color: #0061d3;">
        PROMO SPESIAL <span style="color: #1f2937;">#NGEBUTBELAJAR</span>
      </h2>
      <p class="lead text-muted mx-auto" style="max-width: 600px;">
        Wujudkan mimpimu lulus Sekolah Kedinasan! Kuota terbatas,
        jangan sampai ketinggalan promo terbaik kami.
      </p>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div id="countdown-wrapper" class="text-white text-center p-4 p-md-5 rounded-3 shadow-lg">
          <h3 class="h4 fw-bold mb-2">
             <span style="position: relative; display: inline-block; width: 12px; height: 12px;">
                <span class="animate-ping" style="position: absolute; display: inline-flex; height: 100%; width: 100%; border-radius: 50%; background-color: #ef4444; opacity: 0.75;"></span>
                <span style="position: relative; display: inline-flex; border-radius: 50%; height: 12px; width: 12px; background-color: #dc2626;"></span>
            </span>
            WAKTU PROMO TERBATAS!
          </h3>
          <p style="color: #facc15;" class="mb-3">Promo berakhir dalam:</p>
          <div id="main-countdown" class="display-4 fw-bold" data-tujuan="2025-07-11T23:59:59">
                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
</section>

<style>
  #countdown-wrapper {
    background: linear-gradient(-45deg, #00336e, #0061d3, #0d1a2e, #00336e);
    background-size: 400% 400%;
    animation: shimmer-background 15s ease infinite;
    border: none;
  }

  @keyframes shimmer-background {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  #main-countdown .countdown-segment {
      display: inline-block;
      margin: 0 10px;
  }

  #main-countdown .countdown-number {
      font-size: 2.5rem;
      font-family: 'tabular-nums', sans-serif;
  }

  #main-countdown .countdown-label {
      font-size: 1rem;
      display: block;
      font-weight: normal;
      color: #d1d5db; /* light gray */
  }

  @keyframes ping {
    75%, 100% {
        transform: scale(2);
        opacity: 0;
    }
  }

  .animate-ping {
      animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
  }

</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
  function startCountdown() {
    const countdownElement = document.getElementById("main-countdown");
    if (!countdownElement) return;

    const targetDate = new Date(
      countdownElement.dataset.tujuan
    ).getTime();

    const interval = setInterval(() => {
      const now = new Date().getTime();
      const distance = targetDate - now;

      if (distance < 0) {
        clearInterval(interval);
        countdownElement.innerHTML = '<div class="h4 fw-bold" style="color: #ef4444;">PROMO TELAH BERAKHIR!</div>';
        return;
      }

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor(
        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
      );
      const minutes = Math.floor(
        (distance % (1000 * 60 * 60)) / (1000 * 60)
      );
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      countdownElement.innerHTML = `
        <div class="countdown-segment">
            <span class="countdown-number">${String(days).padStart(2,"0")}</span>
            <span class="countdown-label">Hari</span>
        </div>
        <div class="countdown-segment">
            <span class="countdown-number">${String(hours).padStart(2,"0")}</span>
            <span class="countdown-label">Jam</span>
        </div>
        <div class="countdown-segment">
            <span class="countdown-number">${String(minutes).padStart(2,"0")}</span>
            <span class="countdown-label">Menit</span>
        </div>
        <div class="countdown-segment">
            <span class="countdown-number">${String(seconds).padStart(2,"0")}</span>
            <span class="countdown-label">Detik</span>
        </div>
      `;
    }, 1000);
  }

  startCountdown();
});
</script>

                    <section id="program-kami" class="bg-light pt-10">
  <div class="container px-5">
    <div class="text-center mb-5">
      <h2 class="display-5 fw-bolder">Program Unggulan Kami</h2>
      <p class="lead">
        Wujudkan mimpimu lulus tes CPNS & Sekolah Kedinasan! Pilih paket
        terbaikmu di bawah ini.
      </p>
    </div>

    <div class="mb-5">
      <h3 class="text-center fw-bolder mb-4">
        Program Unggulan Bimbel SKD
      </h3>
      <div class="row gx-5 justify-content-center">
        <div class="col-lg-4 mb-5">
          <div class="card h-100 shadow border-0">
            <div class="card-body p-4">
              <div class="badge bg-primary bg-gradient rounded-pill px-3 py-2 mb-2">
                #NGEBUTBELAJAR
              </div>
              <h5 class="card-title fw-bolder">Kelas SKD Online Eksklusif</h5>
              <p class="card-text text-muted">
                <span class="text-decoration-line-through">Rp 850.000</span>
              </p>
              <h3 class="fw-bolder">Rp 500.000</h3>
              <p class="lead fw-normal text-muted mb-3">/15 Sesi</p>
              <div class="alert alert-primary">
                <strong>KELAS EKSKLUSIF - HANYA 10 ORANG!</strong>
                                            </div>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Pengajar Profesional >2 thn</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Rekaman Belajar & Grup Diskusi</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Bebas Konsultasi WhatsApp</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span><strong>GRATIS 5x Try Out SKD</strong></li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Monitoring Progress Belajar</li>
                                            </ul>
                                        </div>
            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
              <div class="d-grid">
                <a class="btn btn-primary" href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode('Hai Kak, saya sangat tertarik dengan program *Kelas SKD Online Eksklusif* dari Bimbel Speedu. Saya ingin mendaftar dan melanjutkan ke proses pembayaran. Mohon informasinya, terima kasih!') }}">Daftar Sekarang</a>
              </div>
                                        </div>
                                    </div>
                                </div>

        <div class="col-lg-4 mb-5">
          <div class="card h-100 shadow border-warning border-2">
            <div class="card-body p-4">
              <div class="badge bg-warning bg-gradient rounded-pill px-3 py-2 mb-2 text-dark">
                Recommended
              </div>
              <h5 class="card-title fw-bolder">Kelas SKD Online Prima</h5>
              <p class="card-text text-muted">
                <span class="text-decoration-line-through">Rp 1.500.000</span>
              </p>
              <h3 class="fw-bolder">Rp 800.000</h3>
              <p class="lead fw-normal text-muted mb-3">/15 Sesi</p>
               <div class="alert alert-warning">
                <strong>KELAS PRIMA - HANYA 5 ORANG!</strong>
                                            </div>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Pengajar Profesional >2 thn</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Rekaman Belajar & Grup Diskusi</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Bebas Konsultasi WhatsApp</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span><strong>GRATIS 5x Try Out SKD</strong></li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Monitoring Progress Belajar</li>
                                            </ul>
                                        </div>
             <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
              <div class="d-grid">
                <a class="btn btn-warning" href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode('Hai Kak, saya sangat tertarik dengan program *Kelas SKD Online Prima* dari Bimbel Speedu. Saya ingin mendaftar dan melanjutkan ke proses pembayaran. Mohon informasinya, terima kasih!') }}">Ambil Kelas Prima</a>
                                    </div>
                                </div>
                            </div>
                        </div>

        <div class="col-lg-4 mb-5">
          <div class="card h-100 shadow border-0">
            <div class="card-body p-4">
               <div class="badge bg-primary bg-gradient rounded-pill px-3 py-2 mb-2">
                #NGEBUTBELAJAR
              </div>
              <h5 class="card-title fw-bolder">Kelas SKD Privat Offline</h5>
               <p class="card-text text-muted">
                <span class="text-decoration-line-through">Rp 2.300.000</span>
              </p>
              <h3 class="fw-bolder">Rp 1.800.000</h3>
              <p class="lead fw-normal text-muted mb-3">/10 Sesi</p>
               <div class="alert alert-info">
                <strong>AREA TANGERANG!</strong> Guru datang ke rumah.
              </div>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span><strong>Bertemu Langsung</strong> Pengajar</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Materi Super Intensif & Personal</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Bebas Konsultasi WhatsApp</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span><strong>GRATIS 5x Try Out SKD</strong></li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Monitoring Progress Belajar</li>
              </ul>
            </div>
             <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
              <div class="d-grid">
                <a class="btn btn-primary" href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode('Hai Kak, saya sangat tertarik dengan program *Kelas SKD Privat Offline* dari Bimbel Speedu. Saya ingin mendaftar dan melanjutkan ke proses pembayaran. Mohon informasinya, terima kasih!') }}">Daftar Privat</a>
              </div>
            </div>
                        </div>
                                        </div>
                                    </div>
                                </div>

    
    
    <div class="mb-5">
      <h3 class="text-center fw-bolder mb-4">
        Program Unggulan Bimbel SKB STMKG
      </h3>
      <div class="row gx-5 justify-content-center">
        <div class="col-lg-4 mb-5">
          <div class="card h-100 shadow border-0">
            <div class="card-body p-4">
              <div class="badge bg-primary bg-gradient rounded-pill px-3 py-2 mb-2">
                #NGEBUTBELAJAR
              </div>
              <h5 class="card-title fw-bolder">Kelas Online SKB STMKG Eksklusif</h5>
              <p class="card-text text-muted">
                <span class="text-decoration-line-through">Rp 800.000</span>
              </p>
              <h3 class="fw-bolder">Rp 525.000</h3>
              <p class="lead fw-normal text-muted mb-3">/15 Sesi</p>
              <div class="alert alert-primary">
                <strong>KELAS EKSKLUSIF - HANYA 10 ORANG!</strong>
              </div>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Pengajar Profesional >2 thn</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Rekaman Belajar & Grup Diskusi</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Bebas Konsultasi WhatsApp</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span><strong>GRATIS Try Out SKB</strong></li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Monitoring Progress Belajar</li>
              </ul>
            </div>
            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
              <div class="d-grid">
                <a class="btn btn-primary" href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode('Hai Kak, saya sangat tertarik dengan program *Kelas Online SKB STMKG Eksklusif* dari Bimbel Speedu. Saya ingin mendaftar dan melanjutkan ke proses pembayaran. Mohon informasinya, terima kasih!') }}">Daftar Sekarang</a>
              </div>
                                        </div>
                                    </div>
                                </div>

        <div class="col-lg-4 mb-5">
          <div class="card h-100 shadow border-warning border-2">
            <div class="card-body p-4">
              <div class="badge bg-warning bg-gradient rounded-pill px-3 py-2 mb-2 text-dark">
                Recommended
              </div>
              <h5 class="card-title fw-bolder">Kelas Online SKB STMKG Prima</h5>
              <p class="card-text text-muted">
                <span class="text-decoration-line-through">Rp 1.000.000</span>
              </p>
              <h3 class="fw-bolder">Rp 825.000</h3>
              <p class="lead fw-normal text-muted mb-3">/15 Sesi</p>
               <div class="alert alert-warning">
                <strong>KELAS PRIMA - HANYA 5 ORANG!</strong>
              </div>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Pengajar Profesional >2 thn</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Rekaman Belajar & Grup Diskusi</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Bebas Konsultasi WhatsApp</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span><strong>GRATIS Try Out SKB</strong></li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Monitoring Progress Belajar</li>
              </ul>
            </div>
             <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
              <div class="d-grid">
                <a class="btn btn-warning" href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode('Hai Kak, saya sangat tertarik dengan program *Kelas Online SKB STMKG Prima* dari Bimbel Speedu. Saya ingin mendaftar dan melanjutkan ke proses pembayaran. Mohon informasinya, terima kasih!') }}">Ambil Kelas Prima</a>
              </div>
                                        </div>
                                    </div>
                                </div>

        <div class="col-lg-4 mb-5">
          <div class="card h-100 shadow border-0">
            <div class="card-body p-4">
               <div class="badge bg-primary bg-gradient rounded-pill px-3 py-2 mb-2">
                #NGEBUTBELAJAR
              </div>
              <h5 class="card-title fw-bolder">Kelas Privat Offline SKB STMKG</h5>
               <p class="card-text text-muted">
                <span class="text-decoration-line-through">Rp 2.500.000</span>
              </p>
              <h3 class="fw-bolder">Rp 2.000.000</h3>
              <p class="lead fw-normal text-muted mb-3">/10 Sesi</p>
               <div class="alert alert-info">
                <strong>AREA TANGERANG!</strong> Guru datang ke rumah.
              </div>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span><strong>Bertemu Langsung</strong> Pengajar</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Materi Super Intensif & Personal</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Bebas Konsultasi WhatsApp</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span><strong>GRATIS Try Out SKB</strong></li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Monitoring Progress Belajar</li>
              </ul>
            </div>
             <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
              <div class="d-grid">
                <a class="btn btn-primary" href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode('Hai Kak, saya sangat tertarik dengan program *Kelas Privat Offline SKB STMKG* dari Bimbel Speedu. Saya ingin mendaftar dan melanjutkan ke proses pembayaran. Mohon informasinya, terima kasih!') }}">Daftar Privat</a>
              </div>
            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
    <div class="mb-5">
      <h3 class="text-center fw-bolder mb-4">
        Paket Try Out
      </h3>
      <div class="row gx-5 justify-content-center">
        <div class="col-lg-4 mb-5">
          <div class="card h-100 shadow border-0">
            <div class="card-body p-4">
              <div class="badge bg-danger bg-gradient rounded-pill px-3 py-2 mb-2">
                #NGEBUTLATIHAN
              </div>
              <h5 class="card-title fw-bolder">5x Try Out SKD</h5>
              <p class="card-text text-muted">
                <span class="text-decoration-line-through">Rp 40.000</span>
              </p>
              <h3 class="fw-bolder">Rp 25.000</h3>
              <p class="lead fw-normal text-muted mb-3">Untuk 30 Pendaftar Pertama</p>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Bisa dikerjakan kapanpun</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Soal FR terupdate</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Pembahasan dapat diunduh</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Join Grup Diskusi</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Perankingan Peserta</li>
              </ul>
            </div>
             <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
              <div class="d-grid">
                <a class="btn btn-outline-primary" href="{{ route('register') }}">Daftar Try Out</a>
              </div>
                                </div>
                            </div>
                        </div>
        
        <div class="col-lg-4 mb-5">
          <div class="card h-100 shadow border-warning border-2">
            <div class="card-body p-4">
              <div class="badge bg-danger bg-gradient rounded-pill px-3 py-2 mb-2">
                #NGEBUTLATIHAN
              </div>
              <h5 class="card-title fw-bolder">8x Try Out SKD</h5>
              <p class="card-text text-muted">
                <span class="text-decoration-line-through">Rp 64.000</span>
              </p>
              <h3 class="fw-bolder">Rp 37.000</h3>
              <p class="lead fw-normal text-muted mb-3">Untuk 30 Pendaftar Pertama</p>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Bisa dikerjakan kapanpun</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Soal FR terupdate</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Pembahasan dapat diunduh</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Join Grup Diskusi</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Perankingan Peserta</li>
              </ul>
            </div>
             <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
              <div class="d-grid">
                <a class="btn btn-warning" href="{{ route('register') }}">Daftar Try Out</a>
                        </div>
                                                </div>
                                            </div>
                                        </div>
        
        <div class="col-lg-4 mb-5">
          <div class="card h-100 shadow border-0">
            <div class="card-body p-4">
              <div class="badge bg-danger bg-gradient rounded-pill px-3 py-2 mb-2">
                #NGEBUTLATIHAN
              </div>
              <h5 class="card-title fw-bolder">3x Try Out SKB STMKG</h5>
              <p class="card-text text-muted">
                <span class="text-decoration-line-through">Rp 45.000</span>
              </p>
              <h3 class="fw-bolder">Rp 30.000</h3>
              <p class="lead fw-normal text-muted mb-3">Untuk 30 Pendaftar Pertama</p>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Mencakup MTK, Fisika, B. Inggris</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Soal FR terupdate</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Pembahasan dapat diunduh</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Join Grup Diskusi</li>
                <li><span class="fa-li"><i class="fas fa-check text-primary"></i></span>Perankingan Peserta</li>
              </ul>
            </div>
             <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
              <div class="d-grid">
                <a class="btn btn-outline-primary" href="{{ route('register') }}">Daftar Try Out</a>
                                </div>
                                                </div>
                                            </div>
                                        </div>
        
      </div>
                                </div>
                            </div>
  <div class="svg-border-rounded text-dark">
    
  </div>
</section>

                    <section class="bg-white pb-10">
                        <div class="container px-5">
                            <div class="row gx-5 align-items-center">
                                <div class="col-lg-12 mt-2 text-center">
                                    <br>
                                    <h1>AYO BERGABUNG SEKARANG! KOUTA TERBATAS!</h1> <br>
                                    <br>
                                    <a target="_blank" href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode('Hallo, Admin. saya ingin bergabung dengan '.$setting->app_name.' ....') }}" class="btn btn-success">Hubungi Admin</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
            <div id="layoutDefault_footer">
                <footer class="footer pt-10 pb-5 mt-auto bg-dark footer-dark">
                    <div class="container px-5">
                        <div class="row gx-5 align-items-center">
                            <div class="col-md-6 small">© 2022 {{ $setting->app_name ?? '' }}</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="{{ asset('assets/landing-page/theme_1/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/landing-page/theme_1/js/scripts.js') }}"></script>
        <script src="{{ asset('assets/landing-page/theme_1/js/aos.js') }}"></script>
        <script>
            AOS.init({
                disable: 'mobile',
                duration: 600,
                once: true,
            });
        </script>

        <script type="text/javascript" src="{{ asset('assets/landing-page/theme_1/js/nodes.js') }}"></script>
        <script type="text/javascript">
            var nodesjs = new NodesJs({
                id: 'nodes',
                width: window.innerWidth,
                height: window.innerHeight,
                particleSize: 3,
                lineSize: 1,
                particleColor: [255, 255, 255, 0.3],
                lineColor: [255, 255, 255],
                backgroundFrom: [10, 25, 100],
                backgroundTo: [25, 50, 150],
                backgroundDuration: 4000,
                nobg: false,
                number: window.hasOwnProperty('orientation') ? 30: 100,
                speed: 20
            });
        </script>

        <script type="text/javascript">
            window.onresize = function () {
                nodesjs.setWidth(window.innerWidth);
                nodesjs.setHeight(window.innerHeight);
            };
        </script>

        <script defer src="{{ asset('assets/landing-page/theme_1/js/vaafb692b2aea4879b33c060e79fe94621666317369993.js') }}" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"7632a878ecd1898e","token":"6e2c2575ac8f44ed824cef7899ba8463","version":"2022.10.3","si":100}' crossorigin="anonymous"></script>
    </body>
</html>
