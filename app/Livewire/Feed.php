<?php

namespace App\Livewire;

use App\Models\Work;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Feed extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';
    #[Url()]
    public $author = '';

    #[On('search')]
    public function updateSearch($search) {
        $this->search = $search;
        $this->resetPage();
    }

    #[On('author')]
    public function updateVersion($author) {
        $this->author = $author;
        $this->resetPage();
    }

    #[Computed()]
    public function feed() {
        $feed = Work::with('user','media')->latest()
            ->join('users', function (JoinClause $join) {
                $followingsIDs = Auth::user()->followings()->pluck('id');
                $join->on('works.user_id', '=', 'users.id')
                    ->whereIn('user_id', $followingsIDs);
            })
            ->when($this->search, function ($query) {
                $query->whereAny([
                    'title',
                    'shortDescription',
                    'users.login',
                ], 'LIKE', "%{$this->search}%");
            })
            ->when($this->author, function ($query) {
                $query->where('users.id', '=', $this->author);
            });

        return $feed->paginate(15);
    }

    public function render()
    {
        return view('livewire.feed');
    }
}
