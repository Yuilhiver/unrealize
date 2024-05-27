<div class="profile-works-view-wrapper">
    <div class="view-menu__view-amout">
        <div class="view-menu__view">
            <h1 class="works-menu__view-header">Вид</h1>
            <div class="works-menu__view-buttons">
                <button aria-label="Первый вид работ" class="works-menu__view-button view-button active" id="1" view-btn>
                    <svg view-btn><use view-btn xlink:href="#view-type-1"></use></svg>
                </button>
                <button aria-label="Второй вид работ" class="works-menu__view-button view-button" id="2" view-btn>
                    <svg view-btn><use view-btn xlink:href="#view-type-2"></use></svg>
                </button>
            </div>
        </div>
        <div class="view-menu__amount">
            <span id="work-amount">{{ $user->works()->count() }}</span>
            {{ $user->getNoun($user->works()->count(), 'работа', 'работы', 'работ') }}
        </div>
    </div>

    @if(count($user->works) < 1 && Auth::id() == $user->id)
        <div class="empty-error">
            <h1>Ничего не найдено</h1>
            <a href="{{ route('creation.index') }}">Создайте свою первую работу</a>
        </div>
    @elseif(count($user->works) < 1)
        <div class="empty-error">
            <h1>Ничего не найдено</h1>
        </div>
    @endif

    <div class="profile-works-wrapper__works works-menu__works">

        @foreach($user->works as $work)
            @include('shared.work-card')
        @endforeach

    </div>
</div>
