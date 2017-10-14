<?php
    $email    = (isset($this->user)) ? $this->user->email    : 'email';
    $password = (isset($this->user)) ? $this->user->password : 'пароль';
    $checked  = (isset($this->rememberMe)) ? 'checked' : '';
?>
<form class="form-signin" method="post" action="login">
    <h2 class="form-signin-heading">Вход в админ-панель</h2>
    <label for="inputEmail" class="sr-only">Email</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="<?php echo $email; ?>" name="email" value="<?php echo $email; ?>" required autofocus>
    <label for="inputPassword" class="sr-only">Пароль</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="<?php echo $password; ?>" name="password" value="<?php echo $password; ?>" required>
    <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="remember-me" <?php echo $checked; ?> > Запомнить меня
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
</form>
