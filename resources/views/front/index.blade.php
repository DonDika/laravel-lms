<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('output.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
        <title>Obito Online Learning Platform - Learn Anytime, Anywhere</title>
        <meta name="description" content="Obito is an innovative online learning platform that empowers students and professionals with high-quality, accessible courses.">

        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="32x32" href="assets/images/logos/logo-64.png">
        <link rel="apple-touch-icon" href="assets/images/logos/logo-64.png">

        <!-- Open Graph Meta Tags -->
        <meta property="og:title" content="Obito Online Learning Platform - Learn Anytime, Anywhere">
        <meta property="og:description" content="Obito is an innovative online learning platform that empowers students and professionals with high-quality, accessible courses.">
        <meta property="og:image" content="https://obito-platform.netlify.app/assets/images/logos/logo-64-big.png">
        <meta property="og:url" content="https://obito-platform.netlify.app">
        <meta property="og:type" content="website">
    </head>
    <body>
        <nav id="nav-guest" class="flex w-full bg-white border-b border-obito-grey">
            <div class="flex w-[1280px] px-[75px] py-5 items-center justify-between mx-auto">
                <div class="flex items-center gap-[50px]">
                    <a href="{{ route('front.index') }}" class="flex shrink-0">
                        <img src="{{ asset('assets/images/logos/logo.svg') }}" class="flex shrink-0" alt="logo">
                    </a>
                    <ul class="flex items-center gap-10">
                        <li class="hover:font-semibold transition-all duration-300 font-semibold">
                            <a href="{{ route('front.index') }}">Home</a>
                        </li>
                        <li class="hover:font-semibold transition-all duration-300">
                            <a href="{{ route('front.pricing') }}">Pricing</a>
                        </li>
                        <li class="hover:font-semibold transition-all duration-300">
                            <a href="#">Features</a>
                        </li>
                        <li class="hover:font-semibold transition-all duration-300">
                            <a href="#">Testimonials</a>
                        </li>
                    </ul>
                </div>
                <div class="flex items-center gap-5 justify-end">
                    <a href="#" class="flex shrink-0">
                        <img src="{{ asset('assets/images/icons/device-message.svg') }}" class="flex shrink-0" alt="icon">
                    </a>
                    <div class="h-[50px] flex shrink-0 bg-obito-grey w-px"></div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('register') }}" class="rounded-full border border-obito-grey py-3 px-5 gap-[10px] bg-white hover:border-obito-green transition-all duration-300">
                            <span class="font-semibold">Sign Up</span>
                        </a>
                        <a href="{{ route('login') }}" class="rounded-full py-3 px-5 gap-[10px] bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                            <span class="font-semibold text-white">My Account</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <main class="flex flex-1 items-center py-[70px]">
            <div class="w-full flex gap-[77px] justify-between items-center pl-[calc(((100%-1280px)/2)+75px)]">
                <div class="flex flex-col max-w-[500px] gap-[50px]">
                    <div class="flex flex-col gap-[30px]">
                        <p class="flex items-center gap-[6px] w-fit rounded-full py-2 px-[14px] bg-obito-light-green">
                            <img src="{{ asset('assets/images/icons/crown-green.svg') }}" class="flex shrink-0 w-5" alt="icon">
                            <span class="font-bold text-sm">TRUSTED BY 500 FORTUNE ANGGA COMPANIES</span>
                        </p>
                        <div>
                            <h1 class="font-extrabold text-[50px] leading-[65px]">Upgrade Skills, <br>Get Higher Salary</h1>
                            <p class="leading-7 mt-[10px] text-obito-text-secondary">Materi terbaru disusun oleh professional dan perusahaan besar agar lebih sesuai kebutuhan dan anda lorem dolorsi.</p>
                        </div>
                        <div class="flex items-center gap-[18px]">
                            <a href="{{ route('register') }}" class="flex items-center rounded-full h-[67px] py-5 px-[30px] gap-[10px] bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                                <span class="text-white font-semibold text-lg">Get Started</span>
                            </a>
                            <a href="#" class="flex items-center rounded-full h-[67px] border border-obito-grey py-5 px-[30px] bg-white gap-[10px] hover:border-obito-green transition-all duration-300">
                                <img src="{{ asset('assets/images/icons/play-circle-fill.svg') }}" class="size-8 flex shrink-0" alt="icon">
                                <span class="font-semibold text-lg">How It Works</span>
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center gap-[14px]">
                        <img src="{{ asset('assets/images/photos/group.png') }}" class="flex shrink-0 h-[50px]" alt="group photo">
                        <div>
                            <div class="flex gap-1 items-center">
                                <div class="flex">
                                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0 w-5" alt="star">
                                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0 w-5" alt="star">
                                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0 w-5" alt="star">
                                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0 w-5" alt="star">
                                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="flex shrink-0 w-5" alt="star">
                                </div>
                                <span class="font-bold">5.0</span>
                            </div>
                            <p class="font-bold mt-1">Join Millions Developer</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex shrink-0 h-[590px] w-[666px] justify-end">
                <img src="{{ asset('assets/images/backgrounds/hero-image.png') }}" alt="hero-image">
            </div>
        </main>
    </body>
</html>