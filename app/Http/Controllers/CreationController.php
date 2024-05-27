<?php

namespace App\Http\Controllers;

use App\Models\Articletheme;
use App\Models\Version;
use App\Models\Workgenre;
use App\Models\Worktype;

class CreationController extends Controller
{
    public function index(){
        return view('creation');
    }

    public function work_creation(){
        $genres = Workgenre::all();
        $types = Worktype::all();
        $versions = Version::all();

        return view('work_creation',[
            'types' => $types,
            'versions' => $versions,
            'genres' => $genres,
        ]);
    }

    public function article_creation(){
        $themes = Articletheme::all();
        $versions = Version::all();

        return view('article_creation',[
            'themes' => $themes,
            'versions' => $versions,
        ]);
    }

    public function collab_creation(){
        $types = Worktype::all();
        $versions = Version::all();
        $genres = Workgenre::all();

        return view('collab_creation',[
            'types' => $types,
            'versions' => $versions,
            'genres' => $genres,
        ]);
    }
}
