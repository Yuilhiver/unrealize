<form action="{{ route('collaborations.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="creation-page__input-row-article">
        <input type="text" class="dark-input" placeholder="Название проекта" name="title" maxlength="60">
        <label class="creation-page__main-imgupload" for="inputImg">
            <div class="creation-page__main-upper">
                <svg class="mainImg-icon"><use xlink:href="#mainImg"></use></svg>
                <div class="creation-page__main-text">
                    <h1>Обложка коллаборации</h1>
                    <h2>главная фотография</h2>
                    <input accept="image/*" id="inputImg" type="file" name="image">
                    <span id="imageName"></span>
                </div>
            </div>
            <p>Загрузить фото...</p>
            <img src="#" alt="" id="mainImg-preview">
        </label>
        <div class="creation-page__desc-input-group">
            <textarea id="collabDesc" cols="10" rows="7" placeholder="Описание проекта" maxlength="525" name="shortDescription" class="collab-creation-textarea"></textarea>
        </div>
    </div>
    <div class="creation-page__param-value-group">
        <div class="creation-page__param-value-item">
            <div class="creation-page__param">Тип</div>
            <select class="creation-page__value" name="worktype_id">

                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach

            </select>
        </div>
        <div class="creation-page__param-value-item">
            <div class="creation-page__param">Жанр</div>
            <select class="creation-page__value" name="workgenre_id">

                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
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
        <div class="creation-page__param-value-item">
            <div class="creation-page__param">Роли</div>
            <input type="text" class="dark-input" placeholder="Доступные роли в проекте" name="roles" maxlength="60">
        </div>
    </div>
    <div class="creation-page__contacts">
        <h1 class="creation-page__section-header">Контактная информация</h1>
        <input type="text" class="dark-input" placeholder="Где можно с вами связаться? (например, Discord: exampleds, tg: exampletg, email: example@gmail.com)" name="contacts" maxlength="100">
    </div>
    <button type="submit" class="button button-attention">Создать</button>
</form>
