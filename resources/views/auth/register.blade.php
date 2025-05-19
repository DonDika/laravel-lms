<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('output.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
        <title>Sign Up - Obito Online Learning Platform</title>
        <meta name="description" content="Obito is an innovative online learning platform that empowers students and professionals with high-quality, accessible courses.">

        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/logos/logo-64.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('assets/images/logos/logo-64.png') }}">

        <!-- Open Graph Meta Tags -->
        <meta property="og:title" content="Obito Online Learning Platform - Learn Anytime, Anywhere">
        <meta property="og:description" content="Obito is an innovative online learning platform that empowers students and professionals with high-quality, accessible courses.">
        <meta property="og:image" content="https://obito-platform.netlify.app/assets/images/logos/logo-64-big.png') }}') }}">
        <meta property="og:url" content="https://obito-platform.netlify.app">
        <meta property="og:type" content="website">
    </head>

    <body>

        <nav id="nav-guest" class="flex w-full bg-white border-b border-obito-grey">
            <div class="flex w-[1280px] px-[75px] py-5 items-center justify-between mx-auto">
                <div class="flex items-center gap-[50px]">
                    <a href="index.html" class="flex shrink-0">
                        <img src="{{ asset('assets/images/logos/logo.svg') }}" class="flex shrink-0" alt="logo">
                    </a>
                    <ul class="flex items-center gap-10">
                        <li class="hover:font-semibold transition-all duration-300">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="hover:font-semibold transition-all duration-300">
                            <a href="pricing.html">Pricing</a>
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

        <main class="relative flex flex-1 h-full">
            <section class="flex flex-1 items-center py-5 px-5 pl-[calc(((100%-1280px)/2)+75px)]">
                 <!-- enctype, digunakan untuk ketika upload form sekaligus image -->
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="flex flex-col h-fit w-[510px] shrink-0 rounded-[20px] border border-obito-grey p-5 gap-4 bg-white">
                    @csrf
                    
                     <!-- Photo -->
                    <h1 class="font-bold text-[22px] leading-[33px]">Upgrade Your Skills</h1>
                    <label class="relative flex items-center gap-3">
                        <button id="upload-photo" type="button" class="relative w-[90px] h-[90px] flex rounded-full overflow-hidden border border-obito-grey focus:ring-obito-green transition-all duration-300">
                            <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 font-semibold text-sm">
                                Add <br>Photo
                            </span>
                            <img id="photo-preview" src="" class="w-full h-full object-cover hidden" alt="photo">
                        </button>
                        <button id="delete-photo" type="button" class="rounded-full w-fit py-[6px] px-[10px] bg-obito-light-red font-bold text-xs text-obito-red hidden">DELETE PHOTO</button>
                        <input id="hidden-input" name="photo" type="file" accept="image/*" class="absolute -z-10 opacity-0">
                    </label>
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />

                     <!-- Name -->
                    <div class="flex flex-col gap-2">
                        <p>Complete Name</p>
                        <label class="relative group">
                            <input name="name" type="text" class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300" 
                                placeholder="Type your complete name">
                            <img src="{{ asset('assets/images/icons/profile.svg') }}" class="absolute size-5 flex shrink-0 transform -translate-y-1/2 top-1/2 left-5" alt="icon">
                        </label>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                     <!-- Occupation -->
                    <div class="flex flex-col gap-2">
                        <p>Occupation</p>
                        <label class="relative group">
                            <input id="occupation" name="occupation" type="text" class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300" 
                                placeholder="Type your ocupation">
                            <img src="{{ asset('assets/images/icons/briefcase.svg') }}" class="absolute size-5 flex shrink-0 transform -translate-y-1/2 top-1/2 left-5" alt="icon">
                        </label>
                        <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
                    </div>

                     <!-- Email -->
                    <div class="flex flex-col gap-2">
                        <p>Email Address</p>
                        <label class="relative group">
                            <input name="email" type="email" class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300" 
                                placeholder="Type your valid email address">
                            <img src="{{ asset('assets/images/icons/sms.svg') }}" class="absolute size-5 flex shrink-0 transform -translate-y-1/2 top-1/2 left-5" alt="icon">
                        </label>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                     <!-- Password -->
                    <div class="flex flex-col gap-2">
                        <p>Password</p>
                        <label class="relative group">
                            <input name="password" type="password" class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300" 
                                placeholder="Type your password">
                            <img src="{{ asset ('assets/images/icons/shield-security.svg') }}" class="absolute size-5 flex shrink-0 transform -translate-y-1/2 top-1/2 left-5" alt="icon">
                        </label>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex flex-col gap-2">
                        <p>Confirm Password</p>
                        <label class="relative group">
                            <input name="password_confirmation" type="password" class="appearance-none outline-none w-full rounded-full border border-obito-grey py-[14px] px-5 pl-12 font-semibold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:border-obito-green transition-all duration-300" 
                                placeholder="Type your password">
                            <img src="{{ asset ('assets/images/icons/shield-security.svg') }}" class="absolute size-5 flex shrink-0 transform -translate-y-1/2 top-1/2 left-5" alt="icon">
                        </label>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit" class="flex items-center justify-center gap-[10px] rounded-full py-[14px] px-5 bg-obito-green hover:drop-shadow-effect transition-all duration-300">
                        <span class="font-semibold text-white">Create My Account</span>
                    </button>

                </form>
            </section>

            <div class="relative flex w-1/2 shrink-0">
                <div id="background-banner" class="absolute flex w-full h-full overflow-hidden">
                    <img src="{{ asset('assets/images/backgrounds/banner-subscription.png') }}" class="w-full h-full object-cover" alt="banner">
                </div>
            </div>

        </main>

        <script src="{{ asset('js/photo-upload.js') }}"></script>
    </body>
</html>