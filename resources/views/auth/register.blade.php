@extends('layout.layout', ['title' => 'Регистрация'])

@section('content')

    <main class="page">
        <div class="page__container logreg-filter-bg">
            <div class='page__logreg logreg-page'>
                <form method="post" action="{{ route('register') }}" class="logreg-page__container logreg-container">
                    @csrf
                    <span class="logreg-input-container">
                        <svg class="person log-reg-icon">
                            <use xlink:href="#person"></use>
                        </svg>
                        <input type="text" class="logreg-container__input" name="login" id="login" placeholder="Логин">
                    </span>
                    <span class="logreg-input-container">
                        <svg class="email-icon log-reg-icon">
                            <use xlink:href="#email"></use>
                        </svg>
                        <input type="email" class="logreg-container__input" name="email" id="email" placeholder="Почта">
                    </span>
                    <span class="logreg-input-container">
                        <svg class="lock log-reg-icon">
                            <use xlink:href="#lock"></use>
                        </svg>
                        <input type="password" class="logreg-container__input" name="password" id="password"
                            placeholder="Пароль">
                    </span>
                    <span class="logreg-input-container">
                        <svg class="lock log-reg-icon">
                            <use xlink:href="#lock"></use>
                        </svg>
                        <input type="password" class="logreg-container__input" name="password_confirmation" id="password_confirmation"
                            placeholder="Подтвердите пароль">
                    </span>
                    @if($errors->any())
                        @include('shared.error-message')
                    @endif
                    <button type="submit" class="button button-attention" name="submit">Зарегистрироваться</button>
                    <div class="logreg-page__message">Есть аккаунт? <a href="{{ route('login') }}">Войти</a></div>
                </form>
                <img src="{{ asset('assets/img/log-bg.webp') }}">
            </div>
        </div>
    </main>

@endsection
