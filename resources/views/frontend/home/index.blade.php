<x-frontend-layout>

    @push('head')
        <meta name="description" content="---">
        <!-- Title-->
        <title>@lang('mainFrontend.title')</title>
        @livewireStyles
    @endpush


<!-- Header Area-->
    @include('frontend.partials.HeaderArea')

    <div class="page-content-wrapper">

        <!-- Hero Slides-->
    @include('frontend.partials.HeroSlides')

    <!-- Product Categories-->
    @include('frontend.partials.ProductCategories')

    <!-- Flash Sale Slide-->
        @include('frontend.partials.FlashSaleSlide')

        @livewire('frontend.home', ['TopProducts' => $TopProducts,
        'cartProducts' => $cartProducts ])

        <!-- Discount Coupon Card-->
        @include('frontend.partials.DiscountCouponCard')

    <!-- Night Mode View Card-->
        @include('frontend.partials.NightModeViewCard')

    </div>

    <!-- Footer Nav-->
    @include('frontend.partials.footerNav')


    @push('script')
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        @livewireScripts

        @include('frontend.partials.AddToCartNotify')
    @endpush

</x-frontend-layout>
