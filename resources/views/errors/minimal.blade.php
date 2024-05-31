@extends('layout.layout', ['title' => 'Ошибка'])

@section('content')
    <main class="page">
        <div class="page__container error-bg">
            <div class="error-page__group">
                <div class="footer-nametxt__logo">
                    @yield('code')
                </div>
                <div class="footer-nametxt__text">
                    @yield('message')
                </div>
                <img src="{{ asset('assets/img/error-page.png') }}">
            </div>
        </div>
    </main>
@endsection
