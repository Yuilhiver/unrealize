<div>
    <div class="admin-page__right-list works-page__works-menu">
        <table>
            <tr>
                <th>ID</th>
                <th>Автор</th>
                <th>Название</th>
                <th>Дата создания</th>
                <th>#</th>
            </tr>

            @foreach ($this->collaborations as $collaboration)
                <tr>
                    <th>{{ $collaboration->id }}</th>
                    <th>{{ $collaboration->user->login }}</th>
                    <th>{{ $collaboration->title }}</th>
                    <th>{{ $collaboration->created_at->toDateString() }}</th>
                    <th>
                        <a href="{{ route('collaborations.show',$collaboration->id) }}" class="stealth">Просмотр</a>
                    </th>
                </tr>
            @endforeach

        </table>
    </div>
    <div class="admin-pagination">
        {{ $this->collaborations->withQueryString()->links('pagination::tailwind') }}
    </div>
</div>
