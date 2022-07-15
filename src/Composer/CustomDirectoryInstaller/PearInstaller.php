<?php

namespace Composer\CustomDirectoryInstaller;

use Composer\Package\PackageInterface;
use Composer\Installer\PearInstaller as BasePearInstaller;

class PearInstaller extends BasePearInstaller
{
  public function getInstallPath(PackageInterface $package)
  {
    $path = PackageUtils::getPackageInstallPath($package, $this->composer);

    if(!empty($path))
    {
      return $path;
    }

    return parent::getInstallPath($package);
  }
}