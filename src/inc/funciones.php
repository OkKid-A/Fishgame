<?php
function ver_inc(string $file, array $data= [] ): void{
  foreach ($data as $key => $value) {
        $$key = $value;
    }
  require_once __DIR__ . '/../inc/' . $file . '.php';
}

function es_un_post():bool
{
  return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}

function es_un_get():bool
{
  return strtoupper($_SERVER['REQUEST_METHOD']) === 'GET';
}

function error_class(array $errors, string $field): string
{
  return isset($errors[$field]) ? 'error' : '';
}

function go_to(string $url): void
{
 header('Location:' . $url);
 exit;
}

function redirect_with(string $url, array $data): void
{
  foreach ($data as $key => $value) {
    $_SESSION[$key] = $value;
  }
  go_to($url);
}

function redirect_and_flash(string $url, string $message, string $type = FLASH_SUCCESS): void
{
 flash('flash_'.uniqid(), $message, $type);
 go_to($url);
}

function session_then_flash(...$args): array
{
  $data = [];
  foreach ($args as $arg) {
    if (isset($_SESSION[$arg])) {
      $data[] = $_SESSION[$arg];
      unset($_SESSION[$arg]);
    } else {
      $data[] = [];
    }
  }
  return $data;
}
