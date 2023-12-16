<section class="py-5">
    <div class="container px-5">
        <h2 class="fw-bolder fs-5 mb-4 text-center">Новини</h2>

        <?php if($data['isUserIsAdmin'] == true) {?>
            <a class="btn btn-success w-100 mb-2" href="/blog/createPost" role="button">Створити новину</a>
        <?php } ?>

        <!-- Блок новостей -->
        <div class="row gx-5">
<!-- ШАБЛОН ОДНОЙ НОВОСТИ ------------------------------------------------------------------------------------------------------------- -->
<?php
    foreach ($data['posts'] as $p) {
?>
            <div class="col-lg-4 mb-5">
                <div class="card h-100 shadow border-0">
                    <img class="card-img-top" src="<?= $p['imageLink']?>" alt="..." height="200"/>
                    <div class="card-body p-4">
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?= $p['category']?></div>
                        <a class="text-decoration-none link-dark stretched-link" href="/blog/post?id=<?= $p['Id']?>">
                            <div class="h5 card-title mb-3"><?= $p['title']?></div>
                        </a>
                        <p class="card-text mb-0">
                            <?= mb_strimwidth($p['content'], 0, 65, "..."); ?>
                        </p>
                    </div>
                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                        <div class="d-flex align-items-end justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="small">
                                    <div class="fw-bold">Філатов</div>
                                    <div class="text-muted"><?= $p['dateOfCreation']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
            }
?>
            <!-- КОНЕЦ_______ШАБЛОН ОДНОЙ НОВОСТИ ------------------------------------------------------------------------------------------------------------- -->

        </div>

 <!-- PAGINATION-->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
        <!-- Первая страница навигации -->
            <?php if($data['postIndex'] -1 >= 0) { ?>
                <li class="page-item">
                    <a class="page-link" href="/blog/getposts?page=0">
                        <span aria-hidden="true">Начало</span>
                    </a>
                </li>
            <?php } else {?>
                <li class="page-item disabled">
                    <a class="page-link" href="/blog/getposts?page=0">
                        <span aria-hidden="true">Начало</span>
                    </a>
                </li>
            <?php
            }
            ?>
        <!-- КОНЕЦ Первая страница навигации -->
        <!-- Предыдущая страница навигация -->
                <?php
                    if($data['postIndex'] -1 >= 0) { ?>
                        <li class="page-item"><a class="page-link" href="/blog/getposts?page=<?=$data['postIndex'] -1 ?>">&laquo;</a></li>
                    <?php } else {?>
                        <li class="page-item disabled"><a class="page-link" href="">&laquo;</a></li>
                    <?php
                    }
                ?>
        <!-- КОНЕЦ Предыдущая страница навигация -->

        <!-- Текущее положение в пагинации -->
                <li class="page-item disabled"><a class="page-link" href="" aria-disabled="true"><?= $data['postIndex']."/".$data['countPages'] ?></a></li>
        <!-- КОНЕЦ Текущее положение в пагинации -->

        <!-- Следующая страница навигация -->
                <?php
                if($data['postIndex'] + 1 <= $data['countPages']) { ?>
                    <li class="page-item"><a class="page-link" href="/blog/getposts?page=<?=$data['postIndex'] + 1 ?>">»</a></li>
                <?php } else {?>
                    <li class="page-item disabled"><a class="page-link" href="">»</a></li>
                    <?php
                }
                ?>
        <!-- КОНЕЦ Следующая страница навигация -->

        <!-- Последняя страница навигации -->

                <?php if($data['postIndex'] + 1 <= $data['countPages']) { ?>
                    <li class="page-item">
                        <a class="page-link" href="/blog/getposts?page=<?= $data['countPages']; ?>">
                            <span aria-hidden="true">Конец</span>
                        </a>
                    </li>
                <?php } else {?>
                    <li class="page-item disabled">
                        <a class="page-link" href="/blog/getposts?page=<?= $data['countPages']; ?>">
                            <span aria-hidden="true">Конец</span>
                        </a>
                    </li>
                    <?php
                }
                ?>
        <!-- КОНЕЦ Последняя страница навигации -->


            </ul>
        </nav>
<!-- КОНЕЦ___PAGINATION-->
   </div>
</section>
