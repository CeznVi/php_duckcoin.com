<div class="container">
    <div class="row">
        <h1 class="text-center">Сторінка редагування/створення новини</h1>
    </div>
    <form method="post" action="/blog/saveEditChanges">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group mb-3">
                <!--  Скрите поле айді -->

                <input type="hidden" name="Id" value="<?= $data['post'][0]['Id'] ?>">

                <span class="input-group-text" id="basic-addon-title">Заголовок</span>
                <input type="text" class="form-control" placeholder="Заголовок новини"
                       aria-label="title" aria-describedby="basic-addon-title"
                       value="<?= $data['post'][0]['title'] ?>" required name="title">
            </div>
        </div>
    </div>

    <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupSelectCategory">Категорія</label>
        <select class="form-select" id="inputGroupSelectCategory" name="categoryId" required>

            <?php if($data['post'][0]['categoryId'] != -1) { ?>
            <option selected value="<?= $data['post'][0]['categoryId']?>"><?= $data['post'][0]['category']?></option>
            <?php } ?>

            <?php foreach ($data['categories'] as $cat){ ?>
                <option value="<?= $cat['Id']?>"><?= $cat['category']?></option>
            <?php } ?>
        </select>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon-imageLink">Посилання на картинку</span>
                <input type="text" class="form-control" placeholder="imageLink"
                       aria-label="imageLink" aria-describedby="basic-addon-imageLink"
                       value="<?= $data['post'][0]['imageLink'] ?>" required name="imageLink">
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-text">Тіло новини</span>
                <textarea class="form-control" aria-label="With textarea" required name="content" rows="19"><?= $data['post'][0]['content']?></textarea>
            </div>
        </div>
    </div>

        <button type="submit" class="btn btn-info w-100 mb-1" value="Auth">Зберегти зміни</button>
        <a class="btn btn-primary w-100 mb-2" href="javascript:history.back()" role="button">Відмінити</a>
    </form>

</div>