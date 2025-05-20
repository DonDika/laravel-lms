@extends('front.layouts.app')
@section('title','Pricing - LMS DONDIKA')
@section('content')
    <nav id="nav-auth" class="flex w-full bg-white border-b border-obito-grey">
        <div class="flex w-[1280px] px-[75px] py-5 items-center justify-between mx-auto">
            <div class="flex items-center gap-[30px]">
                <a href="index.html" class="flex shrink-0">
                    <img src="{{ asset('assets/images/logos/logo.svg') }}" class="flex shrink-0" alt="logo">
                </a>
                <form action="search-course.html" class="relative ">
                    <label class="group">
                        <input type="text" name="" id="" class="appearance-none outline-none ring-1 ring-obito-grey rounded-full w-[400px]  py-[14px] px-5 bg-white font-bold placeholder:font-normal placeholder:text-obito-text-secondary group-focus-within:ring-obito-green transition-all duration-300 pr-[50px]" placeholder="Search course by name">
                        <button type="submit" class="absolute right-0 top-0 h-[52px] w-[52px] flex shrink-0 items-center justify-center">
                            <img src="{{ asset('assets/images/icons/search-normal-green-fill.svg') }}" class="flex shrink-0 w-10 h-10" alt="">
                        </button>
                    </label>
                </form>
            </div>
            <div class="flex items-center gap-5 justify-end">
                <a href="#" class="flex shrink-0">
                    <img src="{{ asset('assets/images/icons/device-message.svg') }}" class="flex shrink-0" alt="icon">
                </a>
                <a href="catalog-v2.html" class="flex shrink-0">
                    <img src="{{ asset('assets/images/icons/category.svg') }}" class="flex shrink-0" alt="icon">
                </a>
                <a href="#" class="flex shrink-0">
                    <img src="{{ asset('assets/images/icons/notification.svg') }}" class="flex shrink-0" alt="icon">
                </a>
                <div class="h-[50px] flex shrink-0 bg-obito-grey w-px"></div>
                <div id="profile-dropdown" class="relative flex items-center gap-[14px]">
                    <div class="flex shrink-0 w-[50px] h-[50px] rounded-full overflow-hidden bg-obito-grey">
                        <img src="{{ Storage::url($user->photo) }}" class="w-full h-full object-cover" alt="photo">
                    </div>
                    <div>
                        <p class="font-semibold text-lg">{{ $user->name }}</p>
                        <p class="text-sm text-obito-text-secondary">{{ $user->occupation }}</p>
                    </div>
                    <button id="dropdown-opener" class="flex shrink-0 w-6 h-6">
                        <img src="{{ asset('assets/images/icons/arrow-circle-down.svg') }}" class="w-6 h-6" alt="icon">
                    </button>
                    <div id="dropdown" class="absolute top-full right-0 mt-[7px] w-[170px] h-fit bg-white rounded-xl border border-obito-grey py-4 px-5 shadow-[0px_10px_30px_0px_#B8B8B840] z-10 hidden">
                        <ul class="flex flex-col gap-[14px]">
                            <li class="hover:text-obito-green transition-all duration-300">
                                <a href="#">My Courses</a>
                            </li>
                            <li class="hover:text-obito-green transition-all duration-300">
                                <a href="#">Certificates</a>
                            </li>
                            <li class="hover:text-obito-green transition-all duration-300">
                                <a href="my-subscriptions.html">Subscriptions</a>
                            </li>
                            <li class="hover:text-obito-green transition-all duration-300">
                                <a href="#">Settings</a>
                            </li>
                            <li class="hover:text-obito-green transition-all duration-300">
                                <a href="index.html">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div id="path" class="flex w-full bg-white border-b border-obito-grey py-[14px]">
        <div class="flex items-center w-full max-w-[1280px] px-[75px] mx-auto gap-5">
                <a href="#" class="last-of-type:font-semibold">Home</a>
                <div class="h-10 w-px bg-obito-grey"></div>
                <a href="pricing.html" class="last-of-type:font-semibold">Pricing Packages</a>
                <span class="text-obito-grey">/</span>
                <a href="#" class="last-of-type:font-semibold">Checkout Subscription</a>
        </div>
    </div>

    <main class="flex flex-1 justify-center py-5 items-center">
        <div class="flex w-[1000px] !h-fit rounded-[20px] border border-obito-grey gap-[40px] bg-white items-center p-5">
            <form id="checkout-details" action="success-checkout.html" class="w-full flex flex-col gap-5">
                <h1 class="font-bold text-[22px] leading-[33px]">Checkout Pro</h1>
                <section id="give-access-to" class="flex flex-col gap-2">
                    <h2 class="font-semibold">Give Access to</h2>
                    <div class="flex items-center justify-between rounded-[20px] border border-obito-grey p-[14px]">
                        <div class="profile flex items-center gap-[14px]">
                            <div class="flex justify-center items-center overflow-hidden size-[50px] rounded-full">
                                <img src="{{ Storage::url($user->photo) }}" alt="image" class="size-full object-cover" />
                            </div>
                            <div class="desc flex flex-col gap-[3px]">
                                <h3 class="font-semibold">{{ $user->name }}</h3>
                                <p class="text-sm leading-[21px] text-obito-text-secondary">{{ $user->occupation }}</p>
                            </div>
                        </div>
                        <a href="#">
                            <p class="text-sm leading-[21px] hover:underline text-obito-green">Change Account</p>
                        </a>
                    </div>
                </section>
                <section id="transaction-details" class="flex flex-col gap-[12px]">
                    <h2 class="font-semibold">Transaction Details</h2>
                    <div class="flex flex-col gap-[12px]">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon" class="size-5 shrink-0" />
                                <p>Subscription Package</p>
                            </div>
                            <strong class="font-semibold">Rp {{ number_format($pricing->price, 0, '', '.') }}</strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon" class="size-5 shrink-0" />
                                <p>Access Duration</p>
                            </div>
                            <strong class="font-semibold">{{ $pricing->duration }} Months</strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon" class="size-5 shrink-0" />
                                <p>Started At</p>
                            </div>
                            <strong class="font-semibold">{{ $startedAt->format('d M, Y') }}</strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon" class="size-5 shrink-0" />
                                <p>Ended At</p>
                            </div>
                            <strong class="font-semibold">{{ $endedAt->format('d M, Y') }}</strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon" class="size-5 shrink-0" />
                                <p>PPN 11%</p>
                            </div>
                            <strong class="font-semibold">Rp {{ number_format($totalTaxAmount, 0, '', '.') }}</strong>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" alt="icon" class="size-5 shrink-0" />
                                <p class="whitespace-nowrap">Grand Total</p>
                            </div>
                            <strong class="font-bold text-[22px] leading-[33px] text-obito-green">Rp {{ number_format($grandTotalAmount, 0, '', '.') }}</strong>
                        </div>
                    </div>
                </section>
                <div class="grid grid-cols-2 gap-[14px]">
                    <a href="pricing.html">
                        <div class="flex border border-obito-grey rounded-full items-center justify-center py-[10px] hover:border-obito-green transition-all duration-300">
                            <p class="font-semibold">Cancel</p>
                        </div>
                    </a>
                    <button type="submit" class="flex text-white bg-obito-green rounded-full items-center justify-center py-[10px] hover:drop-shadow-effect transition-all duration-300">
                        <p class="font-semibold">Pay Now</p>
                    </button>
                </div>
                <hr class="border-obito-grey" />
                <p class="text-sm leading-[21px] text-center hover:underline text-obito-text-secondary">Pahami Terms & Conditions Platform Kami</p>
            </form>
            <div id="benefits" class="bg-[#F8FAF9] rounded-[20px] overflow-hidden shrink-0 w-[420px]">
                <section id="thumbnails" class="relative flex justify-center h-[250px] items-center overflow-hidden rounded-t-[14px] w-full">
                    <img src="{{ asset('assets/images/thumbnails/checkout.png') }}" alt="image" class="size-full object-cover" />
                </section>
                <section id="points" class="pt-[61px] relative flex flex-col gap-4 px-5 pb-5">
                    <div class="card absolute -top-[47px] left-[30px] right-[30px] flex items-center p-4 gap-[14px] border border-obito-grey rounded-[20px] bg-white shadow-[0px_10px_30px_0px_#B8B8B840]">
                        <img src="{{ asset('assets/images/icons/cup-green-fill.svg') }}" alt="icon" class="size-[50px] shrink-0" />
                        <div>
                            <h3 class="font-bold text-[18px] leading-[27px]">{{ $pricing->name }}</h3>
                            <p class="text-obito-text-secondary">{{ $pricing->duration }} months duration</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon" class="size-6 shrink-0" />
                        <p class="font-semibold">Access 1500+ Online Courses</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon" class="size-6 shrink-0" />
                        <p class="font-semibold">Get Premium Certifications</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon" class="size-6 shrink-0" />
                        <p class="font-semibold">High Quality Work Portfolio</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon" class="size-6 shrink-0" />
                        <p class="font-semibold">Career Consultation 2025</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/images/icons/tick-circle-green-fill.svg') }}" alt="icon" class="size-6 shrink-0" />
                        <p class="font-semibold">Support learning 24/7</p>
                    </div>
                </section>
            </div>
        </div>
    </main>    
@endsection

@push('after-scripts')
    <script src="{{ asset('js/dropdown-navbar.js') }}"></script>
@endpush