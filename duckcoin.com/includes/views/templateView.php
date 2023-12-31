<!DOCTYPE html>
<html lang="<?= $data['options']['lang']['value'] ?>">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="<?= $data['options']['description']['value'] ?>" />
    <meta name="author" content="<?= $data['options']['author']['value'] ?>" />
    <title><?= $data['options']['title']['value'] ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/static/assets/coin.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/static/css/styles.css" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body class="d-flex flex-column h-100">
<main class="flex-shrink-0">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="/"><?= $data['options']['title']['value'] ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php
                    foreach ($data['navigate'] as $index => $oneNavRow) {
                        if (count($oneNavRow['childs']) > 0) {
                            $childs = $oneNavRow['childs'];
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="<?= $oneNavRow['href'] ?>"
                                   id="navbarDropdown" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $oneNavRow['title'] ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php
                                    foreach ($childs as $indChild => $oneChild) { ?>
                                        <li><a class="dropdown-item"
                                               href="<?= $oneChild['href'] ?>"><?= $oneChild['title'] ?></a></li>
                                    <?php }
                                    ?>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                   href="<?= $oneNavRow['href'] ?>"><?= $oneNavRow['title'] ?></a>
                            </li>
                        <?php }
                    }
                    ?>
                    <?php
                        if(\App\UserAutorization::isAutuh()) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/account/logout">Вийти з "<?= $_SESSION['login'] ?>"</a>
                    </li> <?php } ?>
                </ul>
            </div>
        </div>
    </nav>





<?php
if (!empty($data['error'])) {
    echo "<div class='alert alert-danger text-center' role='alert'>" . $data['error'] . "</div>";
}
if (!empty($data['succsess'])) {
    echo "<div class='alert alert-success text-center' role='alert'>" . $data['succsess'] . "</div>";
}
if (!empty($data['warning'])) {
    echo "<div class='alert alert-warning text-center' role='alert'>" . $data['warning'] . "</div>";
}
require_once $contentView;
?>
</main>
<!-- Footer-->
<footer class="bg-dark py-4 mt-auto">
    <div class="container px-5">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; <?= $data['options']['title']['value'] ?> 2023</div></div>
            <div class="col-auto">
                <a class="link-light small" href="#!">Privacy</a>
                <span class="text-white mx-1">&middot;</span>
                <a class="link-light small" href="#!">Terms</a>
                <span class="text-white mx-1">&middot;</span>
                <a class="link-light small" href="/about/contactus">Написати нам</a>
            </div>
        </div>
    </div>
</footer>


<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


<!-- Core theme JS-->
<script src="/static/js/scripts.js"></script>
</body>
</html>
