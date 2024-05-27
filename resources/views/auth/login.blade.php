@extends('layout.layout', ['title' => 'Вход'])

@section('content')

            <main class="page">
                <div class="page__container logreg-filter-bg">
                    <div class='page__logreg logreg-page'>
                        <form action="{{ route('login') }}" method="post" class="logreg-page__container logreg-container">
                            @csrf
                            <span class="logreg-input-container">
                                <svg class="email-icon log-reg-icon"><use xlink:href="#email"></use></svg>
                                <input type="text" class="logreg-container__input" name="email" placeholder="Email">
                            </span>
                            <span class="logreg-input-container">
                                <svg class="lock log-reg-icon"><use xlink:href="#lock"></use></svg>
                                <input type="password" class="logreg-container__input" name="password" placeholder="Пароль">
                            </span>
                            @if($errors->any())
                                @include('shared.error-message')
                            @endif
                            <button type="submit" class="button button-attention" name="submit">Войти</button>
                            <div class="logreg-page__message">Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></div>
                        </form>
                        <img src="{{ asset('assets/img/log-bg.webp') }}">
                    </div>
                </div>
            </main>

@endsection
