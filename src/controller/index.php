<?php
invalid_login();




$inputs = [];
$errors = [];

if (es_un_post()){
  [$inputs, $errors] = filter($_POST,[
    'username' => 'string |required | min:3 | max:45',
    'trofico' => 'integer |required',
  ]);
}
