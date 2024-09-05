<?php

require __DIR__ . '/../../model/dbconnect.php';

const ERROR_MESSAGES = [
  'required' => 'Por favor ingresa el %s',
  'email' => 'Este %s no es un correo valido.',
  'between' => 'El %s debe tener entre %s y %s',
  'min' => 'El %s debe tener al menos %s',
  'max' => 'El %s debe tener menos %s',
  'same' => 'El %s debe ser igual a %s',
  'unique' => 'El %s ya se encuentra registrado.',
  'alphanumeric' => 'El %s solo debe contener numeros y letras.'
];

function validate(array $data, array $fields, array $messages = []) : array
{
  $split = fn($str, $separator) => array_map('trim', explode($separator, $str));
  $errors = [];
  $rule_messages = array_filter($messages, fn($message) => is_string($message));
  $validation_errors = array_merge(ERROR_MESSAGES, $rule_messages);
  foreach ($fields as $field => $option) {
    $rules = $split($option,'|');
    foreach ($rules as $rule) {
      $params = [];
      if (strpos($rule, ':')){
        [$rule_name, $param_str] = $split($rule, ':');
        $params = $split($param_str,',');
      } else{
        $rule_name = trim($rule);
      }
      $fn = 'is_' . $rule_name;
      if (is_callable($fn)) {
        $pass = $fn($data, $field, ...$params);
        if (!$pass) {
          $errors[$field] = [sprintf(
            $messages[$field][$rule_name] ?? $validation_errors[$rule_name],$field, ...$params)];
        }
      }
    }
  }
  return $errors;
}

function is_required(array $data, string $field): bool
{
  return isset($data[$field]) && trim($data[$field]) !== '';
}

function is_email(array $data, string $field): bool
{
  if (empty($data[$field])) {
    return true;
  }

  return filter_var($data[$field], FILTER_VALIDATE_EMAIL);
}

function is_min(array $data, string $field, int $min): bool
{
  if (!isset($data[$field])) {
    return true;
  }

  return mb_strlen($data[$field]) >= $min;
}

function is_max(array $data, string $field, int $max): bool
{
  if (!isset($data[$field])) {
    return true;
  }

  return mb_strlen($data[$field]) <= $max;
}

function is_between(array $data, string $field, int $min, int $max): bool
{
  if (!isset($data[$field])) {
    return true;
  }

  $len = mb_strlen($data[$field]);
  return $len >= $min && $len <= $max;
}

function is_alphanumeric(array $data, string $field): bool
{
  if (!isset($data[$field])) {
    return true;
  }

  return ctype_alnum($data[$field]);
}

function is_same(array $data, string $field, string $other): bool
{
  if (isset($data[$field], $data[$other])) {
    return $data[$field] === $data[$other];
  }

  if (!isset($data[$field]) && !isset($data[$other])) {
    return true;
  }

  return false;
}

function is_unique(array $data, string $field, string $table, string $column): bool
{
  if (!isset($data[$field])) {
    return true;
  }

  $sql = "SELECT $column FROM $table WHERE $column = :value";

  $stmt = connectDB()->prepare($sql);
  $stmt->bindValue(":value", $data[$field]);

  $stmt->execute();

  return $stmt->fetchColumn() === false;
}
