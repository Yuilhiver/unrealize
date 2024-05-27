<?php

namespace App\Livewire;

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
    public $sort = 'desc';
    public $sortBy = 'created_at';
    public function setSort($sort) {
        if($sort === 'desc') {
            $this->sortBy = 'created_at';
            $this->sort = 'desc';
        } else if($sort === 'asc') {
            $this->sortBy = 'created_at';
            $this->sort = 'asc';
        } else if($sort === 'works'){
            $this->sortBy = 'works_count';
            $this->sort = 'desc';
        }
        else {
            $this->sortBy = 'followers_count';
            $this->sort = 'desc';
        }
    }

    #[On('search')]
    public function updateSearch($search) {
        $this->search = $search;
        $this->resetPage();
    }

    #[Computed()]
    public function users() {
        return User::withCount('works', 'followers')
            ->orderBy($this->sortBy, $this->sort)
            ->where('login','like',"%{$this->search}%")
            ->paginate(10);
    }


    public function render()
    {
        return view('livewire.users');
    }
}
