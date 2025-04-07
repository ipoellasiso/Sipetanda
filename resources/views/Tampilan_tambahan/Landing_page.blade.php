<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="/landing_page/styles.css">
    <title>SiPETANDA</title>
</head>
<body>
    <nav>
        <div class="nav-container">
            <div class="logo" data-aos="zoom-in" data-aos-duration="1500">
                BPKAD <span>Kota Palu</span>
            </div>
            <div class="links">
                <div class="link" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300"><a href="/login">Login</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="400"><a href="#">Realisasi</a></div>
        </div>
        <i class="fa-solid fa-bars hamburg" onclick="hamburg()"></i>
    </div>
        <div class="dropdown">
            <div class="links">
                <a href="/login">Login</a>
                <a href="#">Realisasi</a>
                <i class="fa-solid fa-xmark cancel" onclick="cancel()"></i>
            </div>
        </div>
    </nav>
    <section>
        <div class="main-container">
            <div class="image" data-aos="zoom-out" data-aos-duration="3000">
                <img src="/landing_page/assets/main.jpg" alt="">
            </div>
            <div class="content">
                <h1 data-aos="fade-left" data-aos-duration="1500" data-aos-delay="700">Hello Selamat <span>Datang di</span></h1>
                <div class="typewriter" data-aos="fade-right" data-aos-duration="1500" data-aos-delay="900"><span class="typewriter-text"></span><label for="">|</label></div>
                <p data-aos="flip-down" data-aos-duration="1500" data-aos-delay="1100">Sistem Informasi ini Bertujuan untuk Mempermudah .....</p>
                <div class="social-links">
                    <a href="#" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1300"><i class="fa-brands fa-github"></i></a>
                    <a href="#" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1400"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1500"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="#" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1600"><i class="fa-brands fa-twitter"></i></a>
                </div>
                <div class="btn" data-aos="zoom-in" data-aos-duration="1500" data-aos-delay="1800">
                    {{-- <button>Login</button> --}}
                </div>
            </div>
        </div>
    </section>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init({offset:0});
    </script>
    <script src="/landing_page/main.js"></script>
</body>
</html>