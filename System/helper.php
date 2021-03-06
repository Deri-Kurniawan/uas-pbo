<?php
require_once APPPATH . 'Configs/App.php';
require_once APPPATH . 'common.php';

$GLOBALS['base_url'] = App::$BaseUrl;

if (!function_exists('addComponent')) {
  /**
   * include view file for templating system
   * it can be used on based App/Controller/$1 and App/Views/$1 file
   */
  function addComponent($view_file, $title = 'Title not set!')
  {
    include APPPATH . 'Views/' . pathFilter($view_file) . '.php';
  }
}

if (!function_exists('pathFilter')) {
  /**
   * Filter Path '.' and Replace To Directory Separator'/'
   */
  function pathFilter($string)
  {
    return str_replace('.', '/', $string);
  }
}

if (!function_exists('base_url')) {
  /**
   * Get you BaseUrl on App Configuration
   * @return String
   */
  function base_url(String $urlAfterBaseUrl = '')
  {
    $str = $GLOBALS['base_url'] . $urlAfterBaseUrl;
    return $str;
  }
}

if (!function_exists('public_url')) {
  /**
   * Get your Public path for your assets
   * @return String
   */
  function public_path(String $urlAfterPublicUrl = '')
  {
    $str = $GLOBALS['base_url'] . PUBLICPATH . $urlAfterPublicUrl;
    return $str;
  }
}

if (!function_exists('included')) {

  /**
   * @var folder value = 'c' | based on Controllers
   * @var folder value = 'm' | based on Models
   * @var folder value = 'v' | based on Views
   */
  function included(String $file, String $folder = "v", $title = '')
  {
    $folder = strtolower($folder);

    if ($folder == 'c') {
      include APPPATH . 'Controllers/' . pathFilter($file) . '.php';
    } else
        if ($folder == 'm') {
      include APPPATH . 'Models/' . pathFilter($file) . '.php';
    }
    if ($folder == 'v') {
      include APPPATH . 'Views/' . pathFilter($file) . '.php';
    }
  }
}

if (!function_exists('redirect')) {
  /**
   * Redirect to $url on you application based on your BaseUrl Config
   */
  function redirect($url)
  {
    return header('location:' . $GLOBALS['base_url'] . $url);
  }
}

if (!function_exists('redirectOut')) {
  /**
   * Redirect Out Of Your Page Application
   */
  function redirectOut($url)
  {
    return header('location:' . $url);
  }
}

if (!function_exists('goBack')) {
  /**
   * Go To Previous Page
   */
  function goBack()
  {
    return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $GLOBALS['base_url'];
  }
}

if (!function_exists('view')) {
  /**
   * Show Views
   */
  function view($file, $data = [])
  {
    extract($data);

    require_once APPPATH . 'Views/' . pathFilter($file) . '.php';
  }
}

if (!function_exists('d')) {
  /**
   * Dump Data
   */
  function d($data)
  {
    var_dump($data);
  }
}

if (!function_exists('dd')) {
  /**
   * Dump Data and Die
   */
  function dd($data)
  {
    var_dump($data);
    die;
  }
}

/**
 * Escaped data use htmlspecialchars function
 */
if (!function_exists('esc')) {
  function esc($data)
  {
    return htmlspecialchars($data);
  }
}