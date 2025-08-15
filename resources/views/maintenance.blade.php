<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Segera Kembali - Under Maintenance</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ffffff;
            --secondary-color: #e0e0e0;
            --accent-color: #007bff;
            --background-start: #121212;
            --background-end: #2c3e50;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: var(--primary-color);
            background: linear-gradient(135deg, var(--background-start), var(--background-end));
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            overflow: hidden;
            position: relative;
            padding: 30px; /* Tambahkan padding untuk ruang di sekitar konten */
        }

        /* Efek partikel di background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="70" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="30" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="90" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="80" r="0.5" fill="rgba(255,255,255,0.1)"/></svg>');
            animation: move-particles 25s linear infinite;
            opacity: 0.5;
        }

        @keyframes move-particles {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-50px, -50px); }
        }

        .logo-container {
            margin-bottom: 30px;
            animation: pulse 2s infinite alternate;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        .logo {
            height: 80px; /* Sesuaikan ukuran logo */
        }

        .container {
            position: relative;
            z-index: 1;
            background: rgba(0, 0, 0, 0.25);
            padding: 40px 50px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            max-width: 90%;
            width: 700px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        .icon {
            font-size: 4rem;
            margin-bottom: 20px;
            animation: float 3s ease-in-out infinite;
            display: none; /* Sembunyikan ikon gear jika ada logo */
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0 0 15px 0;
            letter-spacing: 1px;
        }

        p {
            font-size: 1.1rem;
            color: var(--secondary-color);
            margin: 0 0 30px 0;
            font-weight: 300;
        }

        #countdown {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .time-box {
            background: rgba(0, 0, 0, 0.3);
            padding: 15px 20px;
            border-radius: 10px;
            min-width: 80px;
        }

        .time-box span {
            display: block;
        }

        .time-box .number {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .time-box .label {
            font-size: 0.8rem;
            text-transform: uppercase;
            color: var(--secondary-color);
            letter-spacing: 1px;
        }

        .footer-text {
            font-size: 0.9rem;
            font-weight: 400;
            color: var(--secondary-color);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            margin-top: 10px;
        }

        @media (max-width: 600px) {
            h1 { font-size: 2rem; }
            .container { padding: 30px 25px; }
            #countdown { gap: 10px; }
            .time-box { min-width: 60px; padding: 10px; }
            .time-box .number { font-size: 1.8rem; }
            .logo { height: 60px; }
        }
    </style>
</head>
<body>

    <div class="logo-container">
        <img src="{{ asset('storage/upload_files/settings/2507100211_2501020943_pngwing.com (3).png') }}" alt="Logo Speedu" class="logo"/>
    </div>

    <div class="container">
        <div class="icon">⚙️</div>
        <h1>Kami Sedang Melakukan Peningkatan dan Pemeliharaan Server</h1>
        <p>Mohon maaf atas ketidaknyamanannya. Kami sedang bekerja keras untuk memberikan pengalaman yang lebih baik untuk Anda. Terimakasih</p>

        <div id="countdown">
            <div class="time-box">
                <span class="number" id="days">00</span>
                <span class="label">Hari</span>
            </div>
            <div class="time-box">
                <span class="number" id="hours">00</span>
                <span class="label">Jam</span>
            </div>
            <div class="time-box">
                <span class="number" id="minutes">00</span>
                <span class="label">Menit</span>
            </div>
            <div class="time-box">
                <span class="number" id="seconds">00</span>
                <span class="label">Detik</span>
            </div>
        </div>

        <p class="footer-text">
            <b>AKAN KEMBALI AKTIF PADA 07 AGUSTUS 2025 JAM 14:00 WIB</b>
        </p>
    </div>

    <script>
        (function () {
            const targetDate = new Date(Date.UTC(2025, 7, 7, 14 - 7, 0, 0));
            const daysEl = document.getElementById('days');
            const hoursEl = document.getElementById('hours');
            const minutesEl = document.getElementById('minutes');
            const secondsEl = document.getElementById('seconds');

            function updateCountdown() {
                const now = new Date();
                const diff = targetDate - now;

                if (diff <= 0) {
                    daysEl.innerText = '00';
                    hoursEl.innerText = '00';
                    minutesEl.innerText = '00';
                    secondsEl.innerText = '00';
                    clearInterval(timerInterval);
                    return;
                }

                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                const formatTime = (time) => time < 10 ? `0${time}` : time;

                daysEl.innerText = formatTime(days);
                hoursEl.innerText = formatTime(hours);
                minutesEl.innerText = formatTime(minutes);
                secondsEl.innerText = formatTime(seconds);
            }

            const timerInterval = setInterval(updateCountdown, 1000);
            updateCountdown();
        })();
    </script>

</body>
</html>