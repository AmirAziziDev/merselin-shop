<?php

namespace App\Http\Livewire\Frontend;

use App\Facades\Cart as CartFacade;
use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $cartProducts = [];
    public $eagerProducts = [];
    public $productCountValues = [];
    public $totalPrice = 0;

    public function mount()
    {
        $this->getEagerProducts();
    }

    public function addToCart(int $productId)
    {
        CartFacade::add(Product::where('id', $productId)->first());
        $this->cartProducts = CartFacade::get()['products'];
        $this->getEagerProducts();
        $this->emit('productAdded', $this->cartTotal());
    }

    public function removeFromCart($productId, $removeType = 'all')
    {
        $this->typeCheckAndRemove($productId, $removeType);
        $this->cartProducts = CartFacade::get()['products'];
        $this->getEagerProducts();
        $this->emit('productRemoved', $this->cartTotal());
    }

    public function render()
    {
        return view('livewire.frontend.cart');
    }

    protected function cartTotal()
    {
        return count(array_unique($this->cartProducts));
    }

    protected function getEagerProducts()
    {
        $this->eagerProducts = Product::with('medias')->whereIn('id', $this->cartProducts)->get();
        $this->productCountValues = array_count_values($this->cartProducts);
        $this->getTotalPrice();
    }

    protected function getTotalPrice()
    {
        $this->totalPrice = 0;
        foreach ($this->eagerProducts as $product) {
            if ($product->discount_price) {
                $this->totalPrice += $product->discount_price * $this->productCountValues[$product->id];
            } elseif ($product->price) {
                $this->totalPrice += $product->price * $this->productCountValues[$product->id];
            }
        }
    }

    protected function typeCheckAndRemove($productId, $removeType)
    {
        if ($removeType == 'all') {
            CartFacade::remove($productId);
        } else {
            CartFacade::removeSingle($productId);
        }
    }
}
