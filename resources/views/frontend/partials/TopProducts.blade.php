<div class="top-products-area clearfix py-3">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">@lang('mainFrontend.TopProducts')</h6>
            <a class="btn btn-primary btn-sm" href="shop-grid.html">@lang('mainFrontend.ViewAll')</a>
        </div>
        <div class="row g-3">
            <!-- Single Top Product Card-->
            @foreach($TopProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card top-product-card">
                        <div class="card-body"><span class="badge badge-warning">HOT</span>
                            <a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a>

                            <a class="product-thumbnail d-block mb-2" href="#">
                                <x-product-img :product=$product></x-product-img>
                            </a>
                            <a class="product-title d-block" href="#">{{$product->title}}</a>
                            <p class="sale-price"><span
                                    class="@if(!$product->discount_price)text-decoration-none @endif "> {{number_format($product->price)}} </span>
                                {{$product->discount_price?number_format($product->discount_price):''}} @lang('mainFrontend.Currency')
                            </p>
                            <div class="product-rating">
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-half"></i>
                                <i class="lni lni-star-empty"></i>
                            </div>
                            @if(!in_array($product->id, $cartProducts))
                                <a wire:click="addToCart({{ $product->id }})" style="width: 25px; height: 25px;"
                                   class="btn badge-success text-white"><i class="lni lni-cart"></i>
                                </a>
                            @else
                                <a wire:click="removeFromCart({{ $product->id }})" style="width: 25px; height: 25px;"
                                   class="btn badge-danger text-white"><i class="lni lni-cart-full"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>