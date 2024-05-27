<?php

namespace App\Livewire\Admin;

use App\Models\Collaboration;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Collaborations extends Component
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
    public function collaborations() {
        return Collaboration::latest()
        ->join('users','collaborations.user_id','=','users.id')
        ->whereAny([
            'users.login',
            'collaborations.title',
        ], 'LIKE', "%{$this->search}%")
        ->orWhere('collaborations.id',$this->search)
        ->select('collaborations.*')
        ->paginate(15);
    }

    public function render()
    {
        return view('livewire.admin.collaborations');
    }
}
