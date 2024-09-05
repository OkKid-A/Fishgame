<?php

function filter(array $data, array $filters, array $messages = []) : array{
  $sanitization_rules = [];
  $validation_rules = [];
  foreach ($filters as $field=>$rules) {
    if (strpos($rules,'|')){
      [$sanitization_rules[$field],$validation_rules[$field]] = explode('|',$rules,2);
    } else {
      $sanitization_rules[$field] = $rules;
    }
  }
  $inputs = sanitize($data,$sanitization_rules);
  $errors = validate($inputs,$validation_rules,$messages);
  return [$inputs,$errors];

}
