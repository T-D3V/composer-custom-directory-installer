<?php

namespace Composer\CustomDirectoryInstaller;

use Composer\Composer;
use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller as BaseLibraryInstaller;

class LibraryInstaller extends BaseLibraryInstaller
{
  public function getInstallPath(PackageInterface $package)
  {
    $path = PackageUtils::getPackageInstallPath($package, $this->composer);

    if(!empty($path)){
      return $path;
    }

    return parent::getInstallPath($package);
  }
}