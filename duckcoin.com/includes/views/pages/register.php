<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="title text-center">Сторінка регистрації</h2>
            <p class="text-center">до <?= $data['options']['title']['value']?> спільноти</p>
        </div>
    <form class="row g-3" method="post" action="/account/checkUserRegisterInfo">
        <div class="row justify-content-center text-center">
            <div class="col-md-4 mb-2">
                <label for="email" class="form-label">Електронна пошта</label>
                <input type="email" class="form-control" id="email"  name="email" required>
            </div>
        </div>

        <div class="row justify-content-center text-center">
            <div class="col-md-4 mb-2">
                <label for="login" class="form-label">Логін</label>
                <input type="text" class="form-control" id="login" required name="login">
            </div>
        </div>

        <div class="row justify-content-center text-center">
            <div class="col-md-4 mb-2">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" required name="password">
            </div>
        </div>

        <div class="row justify-content-center text-center">
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Зарееструватись</button>
            </div>
        </div>

    </form>
        </div>
</div>