<form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="creation-page__input-row-article">
        <input type="text" class="dark-input" placeholder="Название" name="title" maxlength="60">
        <input type="text" class="dark-input" placeholder="Краткое описание" name="shortDescription" maxlength="525">
        <label class="creation-page__main-imgupload" for="inputImg">
            <div class="creation-page__main-upper">
                <svg class="mainImg-icon"><use xlink:href="#mainImg"></use></svg>
                <div class="creation-page__main-text">
                    <h1>Обложка статьи</h1>
                    <h2>главная фотография</h2>
                    <input accept="image/*" id="inputImg" type="file" name="image">
                    <span id="imageName"></span>
                </div>
            </div>
            <p>Загрузить фото...</p>
            <img src="#" alt="" id="mainImg-preview">
        </label>
        <div class="creation-page__desc-input-group">
            <textarea cols="10" rows="7" name="content" placeholder="Содержание статьи" maxlength="25500"></textarea>
        </div>
    </div>
    <div class="creation-page__param-value-group">
        <div class="creation-page__param-value-item">
            <div class="creation-page__param">Тема</div>
            <select class="creation-page__value" name="articletheme_id">

                @foreach($themes as $theme)
                    <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                @endforeach

            </select>
        </div>
        <div class="creation-page__param-value-item">
            <div class="creation-page__param">Версия</div>
            <select class="creation-page__value" name="version_id">

                @foreach($versions as $version)
                    <option value="{{ $version->id }}">{{ $version->name }}</option>
                @endforeach

            </select>
        </div>
    </div>
    <button type="submit" class="button button-attention">Создать</button>
</form>
