<div class="cols-view-wrapper">

    @if(count($user->collaborations) < 1 && Auth::id() == $user->id)
        <div class="empty-error">
            <h1>Ничего не найдено</h1>
            <a href="{{ route('creation.index') }}">Создайте свою первую коллаборацию</a>
        </div>
    @elseif(count($user->collaborations) < 1)
        <div class="empty-error">
            <h1>Ничего не найдено</h1>
        </div>
    @endif

    @foreach($user->collaborations as $collaboration)
        @include('shared.collaboration-card')
    @endforeach

</div>
