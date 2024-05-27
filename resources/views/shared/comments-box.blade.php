<div class="work-page__reviews dark-container-section work-reviews" id="comments">
    <h1 class="work-reviews__header">Отзывы</h1>

    @auth()
    @if(Auth::user()->id !== $work->user->id && $work->comments()->where('user_id', Auth::user()->id)->count() == 0)
    <form class="work-reviews__input review-input" action="{{ route('works.comments.store', $entityId) }}" method="post">
        @csrf
        <div class="review-input__avatar">
            <img loading="lazy"

            @if(Auth::user()->getMedia('avatar')->last() != null)
                src="{{
                    asset(Auth::user()->getMedia('avatar')->last()->getUrl('thumb'))
                }}"
            @else
                src="{{
                    asset(Auth::user()->avatar)
                }}"
            @endif

            alt="">
        </div>
        <div class="review-input__group">
            <div class="review-item__stars big-stars">
                <svg class="star-icon active"><use xlink:href="#star"></use></svg>
                <svg class="star-icon active"><use xlink:href="#star"></use></svg>
                <svg class="star-icon active"><use xlink:href="#star"></use></svg>
                <svg class="star-icon active"><use xlink:href="#star"></use></svg>
                <svg class="star-icon active"><use xlink:href="#star"></use></svg>
            </div>
            <input type="hidden" value="5" id="starInput" name="rating">
            <input type="text" class="dark-input review-input__input-block" name="content" placeholder="Напишите свой отзыв" maxlength="255">
            <button type="submit" class="button button-attention">Отправить</button>
        </div>
    </form>
    @endif
    @endauth

    <div class="work-reviews__list reviews-list">

        @foreach($work->comments as $comment)
        <div class="reviews-list__item review-item">
            <a href="{{ route('users.show', $comment->user_id) }}" class="review-item__avatar">
                <img loading="lazy"

                @if($comment->user->getMedia('avatar')->last() != null)
                    src="{{
                        asset($comment->user->getMedia('avatar')->last()->getUrl('thumb'))
                    }}"
                @else
                    src="{{
                        asset($comment->user->avatar)
                    }}"
                @endif

                alt="">
            </a>
            <div class="review-item__main-block">
                <div class="review-item__nickname-date">
                    <a href="#" class="review-item__nickname">{{ $comment->user->login }}</a>
                    <p class="review-item__date">{{ date('d.m.Y', strtotime($comment->created_at)) }}</p>

                    @auth()
                    <form class="popup__container" method="post" action="{{ route('works.comments.destroy', [$comment->id,$work->id]) }}">
                        @csrf
                        @method('delete')
                        @if($comment->user->id == Auth::user()->id)
                            <div class="review-item__delete-btn"><button aria-label="Удалить комметарий" class="delete-comm" type="submit">Удалить</button></div>
                        @endif
                    </form>
                    @endauth

                </div>
                <div class="review-item__stars" id="starDisplay">

                    @for ($i=0;$i<5;$i++)
                        @if ($comment->rating>$i)
                            <svg class="star-icon active">
                                <use xlink:href="#star"></use>
                            </svg>
                        @else
                            <svg class="star-icon">
                                <use xlink:href="#star"></use>
                            </svg>
                        @endif
                    @endfor

                </div>
                <p class="review-item__text">{{ $comment->content }}</p>
            </div>
        </div>
        @endforeach

    </div>
</div>

