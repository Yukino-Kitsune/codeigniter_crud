    <div class="container auth">
        <h2 class="text-center">Регистрация</h2>
        <form action="<?= site_url('/users/store'); ?>" method="POST">
            <div class="mb-3">
                <label for="login" class="form-label">Логин</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="admin_password" class="form-label">Пароль администратора</label>
                <input type="password" class="form-control" id="admin_password" name="admin_password">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
            </div>
        </form>
    </div>
