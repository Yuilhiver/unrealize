@extends('layout.layout', ['title' => 'Панель администратора'])

@section('content')

    <main class="page">
        <div class="page__container">
            <div class='page__admin admin-page margin-header'>

                @include('admin.shared.admin-menu')

                @livewire('admin.articles')

            </div>
        </div>
    </main>

@endsection
