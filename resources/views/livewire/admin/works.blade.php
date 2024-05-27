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

            @foreach ($this->works as $work)
                <tr>
                    <th>{{ $work->id }}</th>
                    <th>{{ $work->user->login }}</th>
                    <th>{{ $work->title }}</th>
                    <th>{{ $work->created_at->toDateString() }}</th>
                    <th>
                        <a href="{{ route('works.show',$work->id) }}" class="stealth">Просмотр</a>
                    </th>
                </tr>
            @endforeach

        </table>
    </div>
    <div class="admin-pagination">
        {{ $this->works->withQueryString()->links('pagination::tailwind') }}
    </div>
</div>
