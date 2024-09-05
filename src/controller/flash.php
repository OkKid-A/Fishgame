<?php

const FLASH = 'MENSAJE_FLASH';
const FLASH_ERROR = 'error';
const FLASH_SUCCESS = 'exito';
const FLASH_WARNING = 'advertencia';
const FLASH_INFO = 'informacion';

function flash(string $name = '', string $message = '', string $type = ''): void
{
  if ($name !== '' && $message !== '' && $type !== '') {
    flash_message($name, $message, $type);
  } elseif ($name !== '' && $message === '' && $type === '') {
    show_flash_message($name);
  } elseif ($name === '' && $message === '' && $type === '') {
    show_all_flash_messages();
  }
}

function flash_message(string $message, string $name, string $type) :void
{
  if (isset($_SESSION[FLASH][$name])) {
    unset($_SESSION[FLASH][$name]);
  }

  $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];
}

function format_message(array $message):string
{
  return sprintf('<div class=<"alert alert-%s">%s</div>', $message['type'], $message['message']);
}

function show_flash_message(string $name) :void
{
  if (!isset($_SESSION[FLASH][$name])) {
    return;
  }
  $flash = $_SESSION[FLASH][$name];
  unset($_SESSION[FLASH][$name]);
  echo format_message($flash);
}

function show_all_flash_messages() :void
{
  if (!isset($_SESSION[FLASH])) {
    return;
  }
  $flash = $_SESSION[FLASH];
  unset($_SESSION[FLASH]);
  foreach ($flash as $flash_message) {
    echo format_message($flash_message);
  }
}
