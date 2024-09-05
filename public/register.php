<?php
require __DIR__ . '/../src/controller/store.php';
require __DIR__ . '/../src/controller/register.php';
?>

<?php ver_inc('header', ['title' => 'Registrarse']); ?>;

<div class="container">
  <form action="register.php" method="post">
    <h1>Fishgame</h1>
    <h2>Registrarse</h2>
    <div>
      <label for="username">Nombre de Usuario:</label>
      <input type="text" name="username" id="username" value="<?= $inputs['username'] ?? '' ?>"
             class="<?= error_class($errors, 'username') ?>">
      <small><?= is_null($errors['username']) ?   ''  : implode(" ",$errors['username']) ?></small>
    </div>
    <div>
      <label for="email">Correo:</label>
      <input type="email" name="email" id="email" value="<?= $inputs['email'] ?? '' ?>"
             class="<?= error_class($errors, 'email') ?>">
      <small><?= is_null($errors['email']) ?   ''  : implode(" ",$errors['email']) ?></small>
    </div>
    <div>
      <label for="age">Edad:</label>
      <input type="number" name="age" id="age" value="<?= $inputs['age'] ?? '' ?>"
             class="<?= error_class($errors, 'age') ?>">
      <small><?= is_null($errors['age']) ?   ''  : implode(" ",$errors['age'])?></small>
    </div>
    <div>
      <label for="password">Contraseña:</label>
      <input type="password" name="password" id="password" value="<?= $inputs['password'] ?? '' ?>"
             class="<?= error_class($errors, 'password') ?>">
      <small><?= is_null($errors['password']) ?   ''  : implode(" ",$errors['password']) ?></small>
    </div>
    <div>
      <label for="password2">Confirmar Contraseña:</label>
      <input type="password" name="password2" id="password2" value="<?= $inputs['password2'] ?? '' ?>"
             class="<?= error_class($errors, 'password2') ?>">
      <small><?= is_null($errors['password2']) ?   ''  : implode(" ",$errors['password2']) ?></small>
    </div>
    <button type="submit">Registrarse</button>
    <footer>Ya eres Miembro? <a href="login.php">Iniciar Sesion</a></footer>
  </form>
</div>
<?php ver_inc('footer');?>


