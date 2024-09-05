<?php

require __DIR__ . '/user_stmts.php';

function register_user(string $username, string $password, string $email, int $age): bool
{
  $hash = hash('sha256', $password);
  $sql = 'INSERT INTO user (username, password, correo, age) VALUES (:username, :password, :email, :age)';

  $stmt = connectDB()->prepare($sql);
  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
  $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':age', $age, PDO::PARAM_INT);

  return $stmt->execute();
}

function login(string $username, string $password): bool
{
  $user = find_user_by_name($username);
  if ($user && hash('sha256', $password) === $user['password']) {
    session_regenerate_id();

    $_SESSION['username'] = $user['username'];
    $_SESSION['user_id'] = $user['id'];

    return true;
  }
  return false;
}

function get_current_username()
{
  if(is_logged_in()){
    return $_SESSION['username'];
  }
  return null;
}

function get_user_id()
{
  if(is_logged_in()){
    return $_SESSION['user_id'];
  }
  return null;
}

function is_logged_in(): bool
{
  return isset($_SESSION['username']);
}

function invalid_login() :void
{
  if (!is_logged_in()){
    go_to('login.php');
  }
}

function logout() :void
{
  if (is_logged_in()){
    unset($_SESSION['username'], $_SESSION['user_id']);
    session_destroy();
    go_to('login.php');
  }
}


