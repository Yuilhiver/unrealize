<div>
    <div class="admin-page__right-list works-page__works-menu">
        <table>
            <tr>
                <th>ID</th>
                <th>Логин</th>
                <th>Email</th>
                <th>Дата создания</th>
                <th>#</th>
            </tr>

            @foreach ($this->users as $user)
                <tr>
                    <th>{{ $user->id }}</th>
                    <th>{{ $user->login }}</th>
                    <th>{{ $user->email }}</th>
                    <th>{{ $user->created_at->toDateString() }}</th>
                    <th>
                        <a href="{{ route('users.show',$user->id) }}" class="stealth">Просмотр</a>
                    </th>
                </tr>
            @endforeach

        </table>
    </div>
    <div class="admin-pagination">
        {{ $this->users->withQueryString()->links('pagination::tailwind') }}
    </div>
</div>
