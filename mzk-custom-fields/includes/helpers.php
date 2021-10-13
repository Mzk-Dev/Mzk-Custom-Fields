<?php 
if (!function_exists('header200')) {
  function header200()
  {
    header('HTTP/1.1 200 OK');
  }
}

if (!function_exists('header400')) {
  function header400()
  {
    header('HTTP/1.1 400 Bad Request');
  }
}

if (!function_exists('header403')) {
  function header403()
  {
    header('HTTP/1.1 403 Forbidden');
  }
}

if (!function_exists('header404')) {
  function header404()
  {
    header('HTTP/1.1 404 Not Found');
  }
}

if (!function_exists('header_json')) {
  function header_json()
  {
    header('Content-Type: application/json');  }
}

