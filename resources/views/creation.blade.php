@extends('layout.layout', ['title' => 'Создание'])

@section('content')
    <main class="page">
        <div class="page__container dark-container creation-page margin-header">
            <div class="creation-page__container dark-container-section">
                <div class="creation-page__mode">
                    <h1 class="active" name="ajaxChange" data-ajax="{{ route('work_creation') }}">Создание работы</h1>
                    <span>/</span>
                    <h1 name="ajaxChange" data-ajax="{{ route('article_creation') }}">Создание статьи</h1>
                    <span>/</span>
                    <h1 name="ajaxChange" data-ajax="{{ route('collab_creation') }}">Создание коллаборации</h1>
                </div>
                @if($errors->any())
                    @include('shared.error-message')
                @endif
                <div id="active-section">

                </div>
            </div>
        </div>
    </main>
@endsection
