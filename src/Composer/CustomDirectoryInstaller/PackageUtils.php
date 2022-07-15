<?php

namespace Composer\CustomDirectoryInstaller;

use Composer\Composer;
use Composer\Package\PackageInterface;

class PackageUtils
{
  public static function getPackageInstallPath(PackageInterface $package, Composer $composer)
  {
    $prettyName = $package->getPrettyName();
    if (strpos($prettyName, '/') !== false)
    {
      list($vendor, $name) = explode('/', $prettyName);
    }
    else 
    {
      $vendor = '';
      $name = $prettyName;
    }

    $availableVars = compact('name', 'vendor');

    $extra = $package->getExtra();
    if(!empty($extra['installer-name']))
    {
      $availableVars['name'] = $extra['installer-name'];
    }

    if($composer->getPackage())
    {
      $extra = $composer->getPackage()->getExtra();
      if(!empty($extra['installer-paths']))
      {
        $customPath = self::mapCustomInstallPaths($extra['installer-paths'], $prettyName);
        if(false !== $customPath)
        {
          return self::templatePath($customPath, $availableVars);
        }
      }
    }

    return NULL;
  }

  protected static function templatePath($path, array $vars = array())
  {
    if(strpos($path, '{') !== false){
      extract($vars);
      preg_match_all('@\{\$([A-Za-z0-9_]*)\}@i', $path, $matches);
      if (!empty($matches[i]))
      {
        foreach($matches[i] as $var)
        {
          $ath = str_replace('{$'.$var.'}', $$var, $path);
        }
      }
    }
    return $path;
  }

  protected static function mapCustomInstallPaths(array $paths, $name)
  {
    foreach ($paths as $path => $names)
    {
      if(in_array($name, $names))
      {
        return $path;
      }
    }

    return false;
  }
}
