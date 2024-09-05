<?php

const FILTROS = [
  'string' => FILTER_SANITIZE_STRING,
   'email' => FILTER_SANITIZE_EMAIL,
  'integer' => [
    'filter' => FILTER_SANITIZE_NUMBER_INT,
    'flags' => FILTER_REQUIRE_SCALAR,
],
  'url' => FILTER_SANITIZE_URL,
  'float' => [
    'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
    'flags' => FILTER_FLAG_ALLOW_FRACTION,
  ]
];

function sanitize(array $inputs, array $fields = [], int $default_filter = FILTER_SANITIZE_STRING, array $filters = FILTROS, bool $trim = true): array
{
  if ($fields) {
    $options = array_map(fn($field) => $filters[$field], $fields);
    $data = filter_var_array($inputs, $options);
  } else {
    $data = filter_var_array($inputs, $default_filter);
  }

  return $trim ? trim_data($data) : $data;
}

function trim_data( array $inputs ) : array
{
  return array_map(function ($input) {
    if (is_string($input)) {
      return trim($input);
    } elseif (is_array($input)) {
      return trim_data($input);
    } else
      return $input;
  }, $inputs);
}
