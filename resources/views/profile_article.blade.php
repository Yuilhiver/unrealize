<div class="article-view-wrapper">

    @if(count($user->articles) < 1 && Auth::id() == $user->id)
        <div class="empty-error">
            <h1>Ничего не найдено</h1>
            <a href="{{ route('creation.index') }}">Создайте свою первую статью</a>
        </div>
    @elseif(count($user->articles) < 1)
        <div class="empty-error">
            <h1>Ничего не найдено</h1>
        </div>
    @endif

    @foreach($user->articles as $article)
        @include('shared.article-card')
    @endforeach

</div>
