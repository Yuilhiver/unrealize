@extends('layout.layout', ['title' => 'Коллаборации'])

@section('content')

    <main class="page">
        <div class="page__container">
            <div class='page__works works-page margin-header'>
                <div class="filters-wrapper">
                    <div class="works-page__filters-block block-filters">
                        <div class="block-filters__header filters-header">
                            <h1 class="filters-header__header">Фильтры</h1>
                            <button aria-label="Очистить фильтры" type="button" ><svg
                                class="trashcan"
                                wire:navigate href="
                                {{ route('collaborations.index') }}">
                                <use xlink:href="#trashcan"></use>
                            </svg></button>
                        </div>

                        @include('shared.search-box')

                        @include('collaborations.collaborations-filter-box')

                    </div>
                </div>

                @livewire('collaborations')

            </div>
        </div>
    </main>

@endsection
