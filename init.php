<?php defined('SYSPATH') or die('No direct script access.');

if (!class_exists('FirePHP', false))
{
  // Find the FirePHP vendor class
  $vendor_path = Kohana::find_file('vendor/firephp-core/lib/FirePHPCore','FirePHP.class');

  if ($vendor_path === FALSE)
  {
    /**
     * If the vendor doesn't exist, user probably didn't update submodules so
     * warn him instead of ending up with a fatal error. Updating submodules:
     *
     * 		git submodule update --init
     *
     * (inside of the firephp submodule folder)
     */
    throw new Kohana_Exception('You must update submodules (vendor class) to make FirePHP work with Kohana.');
  }

  require_once $vendor_path;
}

// copy config/firephp.php to application/config/[env]/firephp.php
// and enable it from the configuration or calling Fire::enable(true);
$config = (array)Kohana::$config->load('firephp');
$fire_logger = new Fire_Log($config);

// Attach a Fire_Log writer to Kohana
Kohana::$log->attach($fire_logger);

