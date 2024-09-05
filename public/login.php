<?php

require __DIR__ . '/../src/controller/store.php';
require __DIR__ . '/../src/controller/login.php';
?>

<?php ver_inc('header', ['title' => 'Inicio de Sesion'])?>

<?php if (isset($errors['login'])) : ?>
  <div class="alert alert-error">
    <?= $errors['login'] ?>
  </div>
<?php endif ?>
  <div class="container">
    <form action="login.php" method="post">
      <h1>Inicio de Sesion</h1>
      <div>
        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" id="username" value="<?= $inputs['username'] ?? '' ?>"
               class="<?= error_class($errors, 'username') ?>">
        <small><?= is_null($errors['username']) ?   ''  : implode(" ",$errors['username']) ?></small>
      </div>
      <div>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">
        <small><?= is_null($errors['password']) ?   ''  : implode(" ",$errors['password']) ?></small>
      </div>
      <section>
        <button type="submit">Iniciar Sesion</button>
        <a href="register.php">Registrarse</a>
      </section>
    </form>
  </div>

<?php ver_inc('footer');?>
