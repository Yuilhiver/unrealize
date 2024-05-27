<?php

namespace App\Livewire;

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
    #[Url()]
    public $version = '';
    #[Url()]
    public $workgenre = '';
    #[Url()]
    public $worktype = '';
    public $sort = 'desc';
    public $sortBy = 'created_at';
    public function setSort($sort) {
        if($sort == 'desc') {
            $this->sortBy = 'created_at';
            $this->sort = 'desc';
        } else if($sort == 'asc') {
            $this->sortBy = 'created_at';
            $this->sort = 'asc';
        } else if($sort == 'rating'){
            $this->sortBy = 'rating';
            $this->sort = 'desc';
        } else {
            $this->sortBy = 'comments_count';
            $this->sort = 'desc';
        }
    }

    #[On('search')]
    public function updateSearch($search) {
        $this->search = $search;
        $this->resetPage();
    }

    #[On('version')]
    public function updateVersion($version) {
        $this->version = $version;
        $this->resetPage();
    }

    #[On('workgenre')]
    public function updateGenre($genre) {
        $this->workgenre = $genre;
        $this->resetPage();
    }

    #[On('worktype')]
    public function updateType($type) {
        $this->worktype = $type;
        $this->resetPage();
    }

    #[Computed()]
    public function works() {
        return Work::with('user','version','workgenre','worktype','media')
            ->orderBy($this->sortBy, $this->sort)
            ->join('users', 'works.user_id', '=', 'users.id')
            ->when($this->search, function ($query) {
            $query->whereAny([
                'title',
                'shortDescription',
                'users.login',
            ], 'LIKE', "%{$this->search}%");
        })
        ->when($this->version, function ($query) {
            $query->where('version_id', '=', $this->version);
        })
        ->when($this->workgenre, function ($query) {
            $query->where('workgenre_id', '=', $this->workgenre);
        })
        ->when($this->worktype, function ($query) {
            $query->where('worktype_id', '=', $this->worktype);
        })
        ->paginate(20);
    }


    public function render()
    {
        return view('livewire.works');
    }
}
