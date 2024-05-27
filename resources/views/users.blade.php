@extends('layout.layout', ['title' => 'Авторы'])

@section('content')

    <main class="page">
        <div class="page__container dark-container">
            <div class='page__works works-page margin-header authors-page__container'>

                @livewire('users')

            </div>
        </div>
    </main>

@endsection
