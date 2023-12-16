<!--Page header & Title-->
<section id="page_header">
    <div class="page_title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title text-center">Сторінка авторизації</h2>
                    <p class="text-center">до <?= $data['options']['title']['value']?> кабінету</p>
                </div>
            </div>
<!-- Форма авторизації-->
            <div class="row mb-1 justify-content-center">
                <div class="col-md-5">
                    <form method="post" action="/account/checkuser">
                        <div class="mb-3">
                            <label for="email" class="form-label">Електронна пошта</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Запам'ятати мене</label>
                        </div>
                        <button type="submit" class="btn btn-info w-100 mb-1" value="Auth">Увійти</button>
                        <a href="/account/register"><button type="button" class="btn btn-primary w-100 mb-1">Не маєш акаунта? - зарееструватись</button> </a>
                        <a href="#"><button type="button" class="btn btn-primary w-100">Забув пароль?</button> </a>
                    </form>
                </div>
            </div>
<!-- КІНЕЦЬ Форма авторизації-->

        </div>
    </div>
</section>


