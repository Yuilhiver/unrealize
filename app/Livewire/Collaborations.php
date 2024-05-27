<?php

namespace App\Livewire;

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
    #[Url()]
    public $version = '';
    #[Url()]
    public $workgenre = '';
    #[Url()]
    public $worktype = '';

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
    public function collaborations() {
        return Collaboration::with('user','version','workgenre','worktype','media')
            ->orderBy('collaborations.created_at', 'desc')
            ->join('users', 'users.id', '=', 'user_id')
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
            ->select('collaborations.*')
            ->paginate(15);
    }

    public function render()
    {
        return view('livewire.collaborations');
    }
}
