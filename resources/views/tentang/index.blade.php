<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Tentang - SIDENI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        @keyframes spin-slow {
            from {
                transform: rotate(0deg)
            }

            to {
                transform: rotate(360deg)
            }
        }

        @keyframes pulse-core {

            0%,
            100% {
                r: 38
            }

            50% {
                r: 42
            }
        }

        @keyframes spike-glow {

            0%,
            100% {
                opacity: 0.7
            }

            50% {
                opacity: 1
            }
        }

        .ring1-anim {
            animation: spin-slow 18s linear infinite;
            transform-origin: 90px 90px;
        }

        .spike-anim {
            animation: spike-glow 2.5s ease-in-out infinite;
        }

        .spike-anim:nth-child(2n) {
            animation-delay: 0.4s
        }

        .spike-anim:nth-child(3n) {
            animation-delay: 0.8s
        }

        .core-anim {
            animation: pulse-core 3s ease-in-out infinite;
        }
    </style>
    @livewireStyles
</head>

<body class="sideni-body">
    @include('partials.header',['auth'=>true])
    <main>
        <div class="tentang-hero">
            <img src="{{ asset('images/banner-tentang.png') }}" alt="Tentang SIDENI" class="tentang-hero-img">
        </div>
        <div class="tentang-main">
            <div class="tentang-wrap">
                <div class="breadcrumb-bar">
                    <a href="{{ route('beranda') }}" class="bc-link">Beranda</a>
                    <span class="bc-sep">›</span><span>Tentang</span>
                </div>

                <div class="tentang-content">
                    {{-- LOGO VIRUS HTML --}}
                    <div class="tentang-logo-wrap">
                        <svg width="220" height="220" viewBox="0 0 180 180" xmlns="http://www.w3.org/2000/svg">
                            <g class="ring1-anim">
                                <circle cx="90" cy="20" r="5" fill="#8b0000" opacity="0.25" />
                                <circle cx="148" cy="48" r="4" fill="#8b0000" opacity="0.2" />
                                <circle cx="160" cy="110" r="5" fill="#8b0000" opacity="0.25" />
                                <circle cx="130" cy="162" r="4" fill="#8b0000" opacity="0.2" />
                                <circle cx="65" cy="168" r="5" fill="#8b0000" opacity="0.25" />
                                <circle cx="22" cy="138" r="4" fill="#8b0000" opacity="0.2" />
                                <circle cx="18" cy="75" r="5" fill="#8b0000" opacity="0.25" />
                                <circle cx="44" cy="26" r="4" fill="#8b0000" opacity="0.2" />
                            </g>
                            <circle cx="90" cy="90" r="72" fill="none" stroke="#8b0000" stroke-width="1" stroke-dasharray="5 8" opacity="0.18" />
                            <circle cx="90" cy="90" r="54" fill="none" stroke="#8b0000" stroke-width="1.5" opacity="0.12" />
                            <g class="spike-anim">
                                <line x1="90" y1="90" x2="90" y2="30" stroke="#8b0000" stroke-width="2.5" stroke-linecap="round" opacity="0.7" />
                                <circle cx="90" cy="27" r="6" fill="#8b0000" opacity="0.85" />
                            </g>
                            <g class="spike-anim">
                                <line x1="90" y1="90" x2="148" y2="52" stroke="#8b0000" stroke-width="2.5" stroke-linecap="round" opacity="0.7" />
                                <circle cx="151" cy="50" r="6" fill="#8b0000" opacity="0.85" />
                            </g>
                            <g class="spike-anim">
                                <line x1="90" y1="90" x2="148" y2="128" stroke="#8b0000" stroke-width="2.5" stroke-linecap="round" opacity="0.7" />
                                <circle cx="151" cy="130" r="6" fill="#8b0000" opacity="0.85" />
                            </g>
                            <g class="spike-anim">
                                <line x1="90" y1="90" x2="90" y2="150" stroke="#8b0000" stroke-width="2.5" stroke-linecap="round" opacity="0.7" />
                                <circle cx="90" cy="153" r="6" fill="#8b0000" opacity="0.85" />
                            </g>
                            <g class="spike-anim">
                                <line x1="90" y1="90" x2="32" y2="128" stroke="#8b0000" stroke-width="2.5" stroke-linecap="round" opacity="0.7" />
                                <circle cx="29" cy="130" r="6" fill="#8b0000" opacity="0.85" />
                            </g>
                            <g class="spike-anim">
                                <line x1="90" y1="90" x2="32" y2="52" stroke="#8b0000" stroke-width="2.5" stroke-linecap="round" opacity="0.7" />
                                <circle cx="29" cy="50" r="6" fill="#8b0000" opacity="0.85" />
                            </g>
                            <g class="spike-anim" style="animation-delay:.6s">
                                <line x1="90" y1="90" x2="122" y2="36" stroke="#8b0000" stroke-width="1.8" stroke-linecap="round" opacity="0.5" />
                                <circle cx="124" cy="33" r="4.5" fill="#8b0000" opacity="0.6" />
                            </g>
                            <g class="spike-anim" style="animation-delay:1s">
                                <line x1="90" y1="90" x2="156" y2="82" stroke="#8b0000" stroke-width="1.8" stroke-linecap="round" opacity="0.5" />
                                <circle cx="159" cy="82" r="4.5" fill="#8b0000" opacity="0.6" />
                            </g>
                            <g class="spike-anim" style="animation-delay:1.4s">
                                <line x1="90" y1="90" x2="58" y2="36" stroke="#8b0000" stroke-width="1.8" stroke-linecap="round" opacity="0.5" />
                                <circle cx="56" cy="33" r="4.5" fill="#8b0000" opacity="0.6" />
                            </g>
                            <g class="spike-anim" style="animation-delay:1.8s">
                                <line x1="90" y1="90" x2="24" y2="82" stroke="#8b0000" stroke-width="1.8" stroke-linecap="round" opacity="0.5" />
                                <circle cx="21" cy="82" r="4.5" fill="#8b0000" opacity="0.6" />
                            </g>
                            <g class="spike-anim" style="animation-delay:.3s">
                                <line x1="90" y1="90" x2="24" y2="108" stroke="#8b0000" stroke-width="1.8" stroke-linecap="round" opacity="0.5" />
                                <circle cx="21" cy="109" r="4.5" fill="#8b0000" opacity="0.6" />
                            </g>
                            <g class="spike-anim" style="animation-delay:.9s">
                                <line x1="90" y1="90" x2="156" y2="108" stroke="#8b0000" stroke-width="1.8" stroke-linecap="round" opacity="0.5" />
                                <circle cx="159" cy="109" r="4.5" fill="#8b0000" opacity="0.6" />
                            </g>
                            <circle cx="90" cy="90" r="38" fill="#8b0000" opacity="0.08" class="core-anim" />
                            <circle cx="90" cy="90" r="34" fill="#8b0000" opacity="0.14" />
                            <circle cx="90" cy="90" r="27" fill="#8b0000" opacity="0.9" />
                            <circle cx="82" cy="85" r="3" fill="#fff" opacity="0.35" />
                            <circle cx="90" cy="90" r="3" fill="#fff" opacity="0.25" />
                            <circle cx="98" cy="95" r="3" fill="#fff" opacity="0.35" />
                            <circle cx="84" cy="98" r="2.5" fill="#fff" opacity="0.2" />
                            <circle cx="96" cy="82" r="2.5" fill="#fff" opacity="0.2" />
                        </svg>
                    </div>

                    <div class="tentang-text">
                        <h2 class="tentang-section-title">Apa Itu <span class="text-red">SIDENI</span> ?</h2>
                        <p><strong>SIDENI (Sistem Deteksi Dini HIV/AIDS)</strong> merupakan sebuah proyek inovatif berbasis web yang dikembangkan oleh mahasiswa semester 4 program studi manajemen informasi kesehatan, politeknik negeri jember, sebagai bentuk kontribusi nyata di bidang teknologi kesehatan.</p>
                        <p>SIDENI dirancang sebagai alat skrining awal yang membantu masyarakat dalam mengidentifikasi risiko infeksi HIV/AIDS berdasarkan gejala yang dialami serta faktor risiko yang dimiliki pengguna.</p>
                        <p>Aplikasi ini bertujuan untuk meningkatkan kesadaran masyarakat terhadap pentingnya deteksi dini HIV/AIDS, sehingga pengguna yang terindikasi berisiko dapat segera mengambil langkah lanjutan dengan melakukan pemeriksaan medis di fasilitas kesehatan terdekat. SIDENI tidak menggantikan diagnosis dokter, melainkan berfungsi sebagai langkah awal yang mendorong masyarakat untuk lebih peduli terhadap kesehatan diri sendiri.</p>
                    </div>
                </div>

                {{-- PROFIL TEAM --}}
                <h2 class="tentang-team-title">Profil Team</h2>
                <div class="tentang-team-grid">
                    @php
                    $team = [
                    ['foto'=>'team1.jpeg','nama'=>'Reny Diah Pujiastuti','nim'=>'G41241543'],
                    ['foto'=>'team2.jpeg','nama'=>'Zaskia Putri R.P','nim'=>'G41241272'],
                    ['foto'=>'team3.jpeg','nama'=>'Anita Setyowati','nim'=>'G41241509'],
                    ['foto'=>'team4.jpeg','nama'=>'Shafira Maharani A','nim'=>'G41241223'],
                    ['foto'=>'team5.jpeg','nama'=>'Dhieta Ayu Larasati','nim'=>'G41241295'],
                    ];
                    @endphp
                    @foreach($team as $index => $t)
                    @if($index == 3)
                    <div class="team-row-bottom">
                        @endif

                        <div class="team-card">
                            <div class="team-photo-wrap">
                                <img src="{{ asset('images/'.$t['foto']) }}" alt="{{ $t['nama'] }}" class="team-photo">
                            </div>
                            <div class="team-name">{{ $t['nama'] }}</div>
                            <div class="team-nim">{{ $t['nim'] }}</div>
                        </div>

                        @if($index == 4)
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    @include('partials.footer')
    @include('partials.logout-modal')
    @livewireScripts
</body>

</html>