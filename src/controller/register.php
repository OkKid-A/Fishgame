<?php

if (is_logged_in()) {
  go_to('index.php');
}

$errors = [];
$inputs = [];

if ( $_SERVER['REQUEST_METHOD'] === 'POST') {
  $fields = [
    'username' => 'string | required | alphanumeric | unique:user, username',
    'email' => 'email | required | email | unique:user, correo',
    'age' => 'integer | required  | min:2 | max: 3',
    'password' => 'string | required ',
    'password2' => 'string | required | same: password',
  ];

  $messages = [
    'username' => [
      'required' => 'Por favor ingresa un nombre de usuario'
    ],
    'email' => [
      'required' => 'Correo requerido'
    ],
    'age' => [
      'required' => 'Edad requerida',
      'min' => 'Debes tener más de 10'
    ],
    'password' => [
      'required' => 'Por favor ingresa una contraseña.'
    ],
    'password2' => [
      'required' => 'Por favor ingresa de nuevo la contraseña.',
      'same' => 'Por favor ingresa la misma contraseña.'
    ]
  ];

  [$inputs, $errors] = filter($_POST, $fields, $messages);

  if ($errors){
    redirect_with('register.php',[
      'inputs' => $inputs,
      'errors' => $errors
    ]);
  }

  if (register_user($inputs['username'], $inputs['password'], $inputs['email'], $inputs['age'])) {
    redirect_and_flash(
      'login.php',
      'Tu cuenta ha sido registrada con exito.'
    );

  }

} elseif ( $_SERVER['REQUEST_METHOD'] === 'GET'){
  [$inputs, $errors] = session_then_flash('inputs', 'errors');
}
?>
