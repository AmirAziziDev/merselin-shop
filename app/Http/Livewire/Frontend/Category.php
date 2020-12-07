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
    public $showType = 'grid';
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['removeFromCart' => 'removeFromCart'];

    public function mount()
    {
        $this->getPageSession();
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

    public function showType($show)
    {
        if (in_array($show, ['list', 'grid'])) {
            $this->showType = $show;
            session(['showTypeCategory' => $show]);
        }
    }

    protected function getEagerProducts()
    {
        if (Auth::check()) {
            $this->getProductsData();
        }
    }

    protected function getPageSession()
    {
        if ($value = session('perPageCategory')) {
            $this->perPage = $value;
        }
        if ($value = session('showTypeCategory')) {
            $this->showType = $value;
        }
    }
}
