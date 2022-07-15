<?php

namespace Composer\CustomDirectoryInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class PluginPlugin implements PluginInterface
{
  private $installer;

  public function activate (Composer $composer, IOInterface $io)
  {
    $this->installer = new PluginInstaller($io, $composer);
    $composer->getInstallationManager()->addInstaller($this->installer);
  }
}