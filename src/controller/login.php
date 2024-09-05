<?php

if (is_logged_in()) {
  go_to('index.php');
}

$inputs = [];
$errors = [];

if (es_un_post()){
  [$inputs, $errors] = filter($_POST,[
  'username' => 'string |required | min:3 | max:45',
    'password' => 'string |required | min:3 | max:45',
  ]);

  if ($errors){
    redirect_with('login.php', ['errors' => $errors, 'inputs' => $inputs]);
  }

  if (!login($inputs['username'], $inputs['password'])){
    $errors['login'] = 'El nombre de usuario y/o contraseña son incorrectos';
    redirect_with('login.php', ['errors' => $errors, 'inputs' => $inputs]);
  }

  go_to('index.php');
} elseif (es_un_get()){
  [$errors, $inputs] = session_then_flash('errors', 'inputs');
}
