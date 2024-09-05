<?php

function retrive_tropics(): array
{
  $sql = 'SELECT id, nombre,jerarquia FROM trofico';

  $statement = connectDB()->prepare($sql);
  $statement->execute();

 return $statement->fetchAll();
}

function  retrieve_single_tropic(int $id) : array
{
  $sql = 'SELECT id, nombre, jerarquia FROM trofico WHERE id = :id';
  $statement = connectDB()->prepare($sql);
  $statement->bindValue('id', $id);
  $statement->execute();

  return $statement->fetchAll();
}

function retrieve_categories(int $tropic) : array
{
    $sql = 'SELECT id,nombre, tipo FROM categoria_parte WHERE nivel = :id';
    $statement = connectDB()->prepare($sql);
    $statement->bindValue('id', $tropic, PDO::PARAM_INT);
    $statement->execute();


  return $statement->fetchAll();
}

function retrieve_parts(int $id_user, int $categoryID) : array
{
    $sql = 'SELECT id, nombre, imagen
FROM parte p
INNER JOIN parte_usuario u
ON p.id = u.parte
WHERE u.usuario = :id AND p.categoria = :id2';
    $statement = connectDB()->prepare($sql);
    $statement -> bindValue('id', $id_user, PDO::PARAM_INT);
    $statement->bindValue('id2', $categoryID, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
}
