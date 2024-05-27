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

            @foreach ($this->articles as $article)
                <tr>
                    <th>{{ $article->id }}</th>
                    <th>{{ $article->user->login }}</th>
                    <th>{{ $article->title }}</th>
                    <th>{{ $article->created_at->toDateString() }}</th>
                    <th>
                        <a href="{{ route('articles.show',$article->id) }}" class="stealth">Просмотр</a>
                    </th>
                </tr>
            @endforeach

        </table>
    </div>
    <div class="admin-pagination">
        {{ $this->articles->withQueryString()->links('pagination::tailwind') }}
    </div>
</div>
