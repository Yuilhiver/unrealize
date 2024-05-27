@extends('layout.layout', ['title' => 'UNREALIZE'])

@section('content')

<main class="page">
    <div class="page__container">
        <div class='page__body body-page scroll-container'>
            <div class="body-page__navigation-scroll nav-main">
                <div class="nav-main__links nav-links">
                    <div class="nav-links__item nav-item active">
                        <a href="#main-screen" class="nav-item__link">Главная</a>
                    </div>
                    <div class="nav-links__item nav-item">
                        <a href="#works-screen" class="nav-item__link">Работы</a>
                    </div>
                    <div class="nav-links__item nav-item">
                        <a href="#collabs-screen" class="nav-item__link">Коллабы</a>
                    </div>
                    <div class="nav-links__item nav-item">
                        <a href="#aboutus-screen" class="nav-item__link">О нас</a>
                    </div>
                </div>
                <div class="nav-main__line nav-line">
                    <div class="nav-line__active"></div>
                </div>
            </div>
            <section id="main-screen" class="body-page__logo-container logo-container scroll-item">
                <div class="logo-container__logotype logotype-desc">
                    <p class="logotype-desc__desc">Сообщество Unreal Engine</p>
                    <div class="logotype-desc__logo">
                        <div class="logo-font">UNREALIZE<div class="logo-font__shadow">UNREALIZE</div>
                        </div>
                    </div>
                </div>
                <video class="logo-container__video-bg" src="{{ asset('assets/img/main-bg-video.mp4') }}" autoplay
                    muted loop></video>
                <img src="{{ asset('assets/img/background-main.webp') }}" loading="lazy" class="logo-container__bg-img"
                    alt="">
            </section>
            <section id="works-screen" class="body-page__works best-works-page index-block scroll-item">

                @foreach ($bestWorks as $work)
                    <img loading="lazy" src="{{ asset($work->getMedia('works')->last()->getUrl('medium')) }}" alt="best work"
                    class="best-works-page__image {{ $bestWorks[0] == $work ? 'active' : '' }}">
                @endforeach

                <div class="best-works-page__container">
                    <div class="best-works-page__headers best-works-headers">
                        <h1 class="best-works-headers__header">ЛУЧШИЕ РАБОТЫ</h1>
                        <a href="{{ route('works.index') }}" class="watch-more">БОЛЬШЕ<svg class="fullarrow-icon">
                                <use xlink:href="#fullarrow"></use>
                            </svg></a>
                    </div>
                    <div class="best-works-page__bottom-container">

                        @foreach ($bestWorks as $work)
                            <a href="{{ route('works.show',$work->id) }}" class="best-works-page__work-headers best-work-header {{ $bestWorks[0] == $work ? 'active' : '' }}">
                                <h1 class="best-work-header__header">{{ $work->title }}</h1>
                                <p class="best-work-header__desc">{{ $work->workgenre->name.' - '.$work->user->login }}</p>
                            </a>
                        @endforeach

                        <div class="best-works-page__buttons best-work-buttons">
                            <button aria-label="Другая работа" type=button
                                class="best-work-buttons__el active"></button>
                            <button aria-label="Другая работа" type=button class="best-work-buttons__el"></button>
                            <button aria-label="Другая работа" type=button class="best-work-buttons__el"></button>
                        </div>
                    </div>
                </div>
            </section>
            <section id="collabs-screen" class="body-page__collabs collabs-page index-block scroll-item">
                <div class="colabs-page__container">
                    <div class="collabs-page__header header-collabs">
                        <h1 class="header-collabs__header">УЗНАВАЙТЕ О НОВЫХ <span
                                class="red-colored-txt">КОЛЛАБОРАЦИЯХ</span></h1>
                        <a href="collaborations" class="watch-more">БОЛЬШЕ<svg class="fullarrow-icon">
                                <use xlink:href="#fullarrow"></use>
                            </svg></a>
                    </div>
                    <div class="collabs-page__works works-container">

                        @foreach ($collaborations as $collaboration)
                            <a href="{{ route('collaborations.show',$collaboration->id) }}" class="works-container__item work-element stealth">
                                <div class="work-element__header-author header-author-works">
                                    <h1 class="header-author-works__header">{{ $collaboration->title }}</h1>
                                    <p class="header-author-works__author">{{ $collaboration->user->login }}</p>
                                </div>
                                <img loading="lazy" class="work-element__img" src="{{ asset($collaboration->getMedia('collaborations')->last()->getUrl()) }}"
                                    alt="коллаборация">
                            </a>
                        @endforeach

                    </div>
                </div>
            </section>
            <section id="aboutus-screen" class="body-page__about about-page scroll-item">
                <div class="about-page__container">
                    <div class="about-page__img-desc img-desc-about">
                        <img loading="lazy" class="img-desc-about__img" alt="ue logo"
                            src="{{ asset('assets/img/ue-logo.png') }}"></img>
                        <div class="img-desc-about__desc desc-about">
                            <div class="desc-about__red-logo">UNREALIZE</div>
                            <div class="desc-about__header">НАША МИССИЯ</div>
                            <p class="desc-about__paragraph">Наша миссия - обеспечить уникальное пространство
                                для обмена знаний, навыков и творческой энергии в мире игровой разработки.</p>
                            <div class="desc-about__contants contacts-about">
                                <div class="contacts-about__phone"><svg class="phone-icon">
                                        <use xlink:href="#phone"></use>
                                    </svg>
                                    <p>+7 922 535 23 23</p>
                                </div>
                                <div class="contacts-about__mail"><svg class="email-icon">
                                        <use xlink:href="#email"></use>
                                    </svg>
                                    <p>info@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="about-page__decorative-elements">
                        <p>UNREALIZE</p>
                        <p>UNREALIZE</p>
                        <p>UNREALIZE</p>
                    </div>
                </div>
            </section>
@endsection
