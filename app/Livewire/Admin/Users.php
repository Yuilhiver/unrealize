<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
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
    public function users() {
        return User::latest()
        ->whereAny([
            'login',
            'email',
        ], 'LIKE', "%{$this->search}%")
        ->orWhere('id',$this->search)
        ->paginate(15);
    }


    public function render()
    {
        return view('livewire.admin.users');
    }
}
