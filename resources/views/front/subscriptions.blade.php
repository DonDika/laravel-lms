@extends('front.layouts.app')
@section('title', 'Search Courses - LMS DONDIKA')


@section('content')
    <x-navigation-auth />

    <x-navigation-bottom />

    <main class="relative flex flex-1 h-full">
        <div id="background-banner" class="absolute flex w-1/2 shrink-0 h-full overflow-hidden right-0">
            <img src="{{ asset('assets/images/backgrounds/banner-subscription.png') }}" class="w-full h-full object-cover"
                alt="banner">
        </div>

        <section id="subscriptions-list"
            class="relative flex flex-col gap-5 mt-[50px] w-full max-w-[1280px] px-[75px] py-5 mx-auto">
            <h1 class="font-bold text-[28px] leading-[42px]">My Subscriptions</h1>
            <div id="list-container" class="flex flex-col gap-5 max-w-[800px] w-full">

                @forelse ($transactions as $transaction)
                    <div
                        class="subscription-card bg-white border border-obito-grey flex items-center justify-between rounded-[20px] py-5 px-4 gap-8">
                        <div class="flex items-center flex-1 gap-[14px]">
                            <div class="flex shrink-0 size-[50px]">
                                <img src="{{ asset('assets/images/icons/cup-green-fill.svg') }}"
                                    class="flex shrink-0 size-[50px]" alt="icon">
                            </div>
                            <div>
                                <p class="font-bold text-lg">{{ $transaction->pricing->name }}</p>
                                <p class="text-obito-text-secondary">{{ $transaction->pricing->duration }} months duration</p>
                            </div>
                        </div>
                        <div class="flex flex-col w-[100px] shrink-0 gap-1">
                            <div class="flex items-center gap-1">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" class="flex w-5 shrink-0" alt="icon">
                                <p class="text-sm">Price</p>
                            </div>
                            <p class="font-semibold text-sm">
                                Rp {{ number_format($transaction->sub_total_amount, 0, '', '.') }}
                            </p>
                        </div>
                        <div class="flex flex-col w-[150px] shrink-0 gap-1">
                            <div class="flex items-center gap-1">
                                <img src="{{ asset('assets/images/icons/note.svg') }}" class="flex w-5 shrink-0" alt="icon">
                                <p class="text-sm">Started At</p>
                            </div>
                            <p class="font-semibold text-sm">{{ $transaction->started_at->format('d M, Y') }}</p>
                        </div>

                        @if ($transaction->isActive())
                            <div class="flex items-center justify-center w-[75px] shrink-0">
                                <span class="font-bold text-xs text-obito-green badge w-fit rounded-full py-[6px] px-[10px] gap-[6px] bg-obito-light-green">ACTIVE</span>
                            </div>
                        @else
                            <div class="flex items-center justify-center w-[75px] shrink-0">
                                <span class="font-bold text-xs text-obito-red badge w-fit rounded-full py-[6px] px-[10px] gap-[6px] bg-obito-light-red">EXPIRED</span>
                            </div>
                        @endif
                        <a href="{{ route('dashboard.subscription.details', $transactions) }}"
                            class="rounded-full border border-obito-grey py-[10px] px-5 gap-[10px] bg-white hover:border-obito-green transition-all duration-300">
                            <span class="font-semibold">Details</span>
                        </a>
                    </div>
                @empty
                    <p>Belum ada paket yang dibeli</p>
                @endforelse


            </div>
        </section>
    </main>

@endsection
@push('after-scripts')
    <script src="{{ asset('js/dropdown-navbar.js') }}"></script>
@endpush