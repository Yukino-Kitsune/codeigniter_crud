<div class="container auth">
    <?php
    if ($session->has('msg')):?>
        <h3 class="alert <?=$session->get('msg_type');?> text-center"><?=$session->get('msg');?></h3>
        <?php $session->remove('msg');
    endif?>
    <h1 class="text-center">Авторизация</h1>
    <form action="<?= site_url('/users/login'); ?>" method="POST">
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="login" name="login">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Войти</button>
            <a href="<?= site_url('/users/reg'); ?>" class="btn btn-primary">Регистрация</a>
        </div>
    </form>
</div>

