
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-3">
                <div class="d-flex align-items-center mt-lg-5 mb-4">
                    <img class="img-fluid rounded-circle" src="/static/img/main/filatov.png" alt="..." />
                    <div class="ms-3">
                        <div class="fw-bold">Філатов</div>
                        <div class="text-muted"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1"><?= $data['post'][0]['title'] ?></h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2"><?= $data['post'][0]['dateOfCreation'] ?></div>
                        <!-- Post categories-->
                        <a class="badge bg-secondary text-decoration-none link-light" href=""><?= $data['post'][0]['category'] ?></a>

                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" src="<?= $data['post'][0]['imageLink'] ?>" alt="..." /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4">
                            <?= $data['post'][0]['content'] ?>
                        </p>
                      </section>
                </article>

            </div>
        </div>
        <a class="btn btn-primary w-100 mb-2" href="javascript:history.back()" role="button">Повернутись</a>

        <?php if($data['isUserIsAdmin'] == true) {?>
            <a class="btn btn-warning w-100 mb-2" href="/blog/editPost?id=<?= $data['post'][0]['Id']?>" role="button">Редагувати запис</a>
            <a class="btn btn-danger w-100 mb-2" href="/blog/deletePost?id=<?= $data['post'][0]['Id']?>" role="button">Видалити запис</a>
        <?php } ?>

    </div>

</section>

