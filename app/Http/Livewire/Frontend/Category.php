<?php

namespace App\Http\Livewire\Frontend;

use App\Http\Livewire\Frontend\Traits\CartTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use CartTrait;
    use WithPagination;

    public $thisCategory = [];
    public $perPage = 10;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->getPerPageSession();
        $this->getEagerProducts();
    }

    public function render()
    {
        return view('livewire.frontend.category', [
            'categoryProducts' => $this->thisCategory->products()->paginate($this->perPage)
        ]);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        session(['perPageCategory' => $this->perPage]);
    }

    protected function getEagerProducts()
    {
        if (Auth::check()) {
            $this->getProductsData();
        }
    }

    protected function getPerPageSession()
    {
        if ($value = session('perPageCategory')) {
            $this->perPage = $value;
        }
    }
}