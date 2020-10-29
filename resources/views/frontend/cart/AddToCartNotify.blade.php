<script>
    //  Add To Cart Notify
    Livewire.on('productAdded', totalCart => {
        @include('frontend.partials.counterUp')

        $("#Cart").text('(' + totalCart + ')');
        $("#lniCart").removeClass("lni-cart").addClass("lni-cart-full");
        $("body").append("<div class='add2cart-notification animated fadeIn'> @lang('mainFrontend.AddToCartNotify') </div>");
        $(".add2cart-notification").delay(1500).fadeOut();
    })
    //  Remove From Cart Notify
    Livewire.on('productRemoved', totalCart => {
        @include('frontend.partials.counterUp')

        if (totalCart) {
            $("#Cart").text('(' + totalCart + ')');
            $("#lniCart").removeClass("lni-cart").addClass("lni-cart-full");
        } else {
            $("#Cart").text('');
            $("#lniCart").removeClass("lni-cart-full").addClass("lni-cart");
        }
        $("body").append("<div class='add2cart-notification animated fadeIn bg-danger'> @lang('mainFrontend.RemoveFromCart') </div>");
        $(".add2cart-notification").delay(1500).fadeOut();
    })
</script>