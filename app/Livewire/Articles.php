<?php

namespace App\Livewire;

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
    #[Url()]
    public $articletheme = '';
    #[Url()]
    public $version = '';

    #[On('search')]
    public function updateSearch($search) {
        $this->search = $search;
        $this->resetPage();
    }
    #[On('articletheme')]
    public function updateArticletheme($articletheme) {
        $this->articletheme = $articletheme;
        $this->resetPage();
    }
    #[On('version')]
    public function updateVersion($version) {
        $this->version = $version;
        $this->resetPage();
    }

    #[Computed()]
    public function articles() {
        return Article::with('user','version','articletheme','media')
            ->orderBy('articles.created_at', 'desc')
            ->join('users', 'users.id', '=', 'user_id')
            ->when($this->search, function ($query) {
                $query->whereAny([
                    'title',
                    'shortDescription',
                    'users.login',
                ], 'LIKE', "%{$this->search}%");
            })
            ->when($this->articletheme, function ($query) {
                $query->where('articletheme_id','=',$this->articletheme);
            })
            ->when($this->version, function ($query) {
                $query->where('version_id','=',$this->version);
            })
            ->select('articles.*')
            ->paginate(15);
    }

    public function render()
    {
        return view('livewire.articles');
    }
}
