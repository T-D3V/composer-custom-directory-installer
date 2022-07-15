<?php

namespace Composer\CustomDirectoryInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class PearPlugin implements PluginInterface
{
  public function activate(Composer $composer, IOInterface $io)
  {
    if(!class_exists('Composer\ComposerInstaller\PearInstaller'))
    {
      return;
    }

    $installer = new PearInstaller($io, $composer);
    $composer->getInstallationManager()->addInstaller($installer);
  }
}