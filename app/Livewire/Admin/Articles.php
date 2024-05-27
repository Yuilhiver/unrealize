<?php

namespace App\Livewire\Admin;

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Articles extends Component
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
    public function articles() {
        return Article::latest()
        ->leftjoin('users', 'articles.user_id', '=', 'users.id')
        ->whereAny([
            'users.login',
            'title',
        ], 'LIKE', "%{$this->search}%")
        ->orWhere('articles.id',$this->search)
        ->select('articles.*')
        ->paginate(15);
    }

    public function render()
    {
        return view('livewire.admin.articles');
    }
}
