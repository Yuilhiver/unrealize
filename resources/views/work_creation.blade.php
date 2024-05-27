<form method="post" action="{{ route('works.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="creation-page__input-row">
        <div class="creation-page__column">
            <input type="text" class="dark-input" placeholder="Название" name="title" maxlength="25">
            <input type="text" class="dark-input" placeholder="Краткое описание" name="shortDescription" maxlength="130">
            <div class="creation-page__desc-input-group">
                <textarea cols="10" rows="7" name="description" placeholder="Описание работы" maxlength="15500"></textarea>
            </div>
        </div>
        <div class="creation-page__column">
            <label class="creation-page__main-imgupload" for="inputImg">
                <div class="creation-page__main-upper">
                    <svg class="mainImg-icon"><use xlink:href="#mainImg"></use></svg>
                    <div class="creation-page__main-text">
                        <h1>Обложка работа</h1>
                        <h2>главная фотография</h2>
                        <input accept="image/*" id="inputImg" type="file" name="image">
                        <span id="imageName"></span>
                    </div>
                </div>
                <p>Загрузить фото...</p>
                <img src="#" alt="" id="mainImg-preview">
            </label>
            <div class="creation-page__addimag-container">
                <label id="add-img-label" for="add-single-img">+</label>
                <input type="file" id="add-single-img" accept="image/jpeg" />
                <input
                    type="file"
                    id="image-input"
                    name="additionalImgs[]"
                    accept="image/jpeg"
                    multiple
                />
            </div>
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
    </div>
    <button type="submit" class="button button-attention" id="create-work">Создать</button>
</form>
<script type="text/javascript" defer>
    //IMG upload
    const imgInputHelper = document.getElementById("add-single-img");
    const imgInputHelperLabel = document.getElementById("add-img-label");
    const imgContainer = document.querySelector(".creation-page__addimag-container");
    let imgFiles = [];

    const addImgHandler = () => {
    const file = imgInputHelper.files[0];
    if (!file) return;

    // Generate img preview
    const newImg = document.createElement("img");
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
        newImg.src = reader.result;
        imgContainer.insertBefore(newImg, imgInputHelperLabel);
    };

    // Store img file
    imgFiles.push(file);

    if (imgFiles.length > 9) {
        imgInputHelperLabel.style.display = "none";
    }

    newImg.addEventListener('click', () => {
        // Delete img on click
        imgFiles = imgFiles.filter((el) => el !== file);
        newImg.remove();
        if (imgFiles.length <= 9) {
            imgInputHelperLabel.style.display = "flex";
        }
     });

    // Reset image input
        imgSaveHandler();
        imgInputHelper.value = "";
        return;
    };

    const getImgFileList = (imgFiles) => {
        const imgFilesHelper = new DataTransfer();
        imgFiles.forEach((imgFile) => imgFilesHelper.items.add(imgFile));
        return imgFilesHelper.files;
    };

    const imgSaveHandler = () => {
        const firstImgInput = document.getElementById("image-input");
        firstImgInput.files = getImgFileList(imgFiles);
    };

    imgInputHelper?.addEventListener("change", addImgHandler);
</script>
