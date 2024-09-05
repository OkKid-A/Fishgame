<?php

function find_user_by_name(string $username)
{
  $sql = 'SELECT id, username, password FROM user WHERE username = :username';

  $statement = connectDB()->prepare($sql);
  $statement-> bindValue(':username', $username, PDO::PARAM_STR);
  $statement->execute();

  return $statement->fetch(PDO::FETCH_ASSOC);
}
