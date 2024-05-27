<?php

namespace App\Livewire\Admin;

use App\Models\Work;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Works extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    #[On('search')]
    public function updateSearch($search) {
        $this->search = $search;
        $this->resetPage();
    }

    #[Computed()]
    public function works() {
        return Work::latest()
        ->join('users', 'works.user_id', '=', 'users.id')
        ->whereAny([
            'users.login',
            'title',
        ], 'LIKE', "%{$this->search}%")
        ->orWhere('works.id',$this->search)
        ->paginate(15);
    }

    public function render()
    {
        return view('livewire.admin.works');
    }
}
