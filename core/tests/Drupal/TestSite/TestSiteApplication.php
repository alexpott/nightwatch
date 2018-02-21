<?php

namespace Drupal\TestSite;

use Drupal\TestSite\Commands\TestSiteInstallCommand;
use Drupal\TestSite\Commands\TestSiteReleaseLockCommand;
use Drupal\TestSite\Commands\TestSiteTearDownCommand;
use Symfony\Component\Console\Application;

/**
 * Application wrapper for test site commands.
 *
 * In order to see what commands are available and how to use them run
 * "php core/scripts/test-site.php" from command line and use the help system.
 *
 * @internal
 */
class TestSiteApplication extends Application {

  /**
   * {@inheritdoc}
   */
  protected function getDefaultCommands() {
    // Even though this is a single command, keep the HelpCommand (--help).
    $default_commands = parent::getDefaultCommands();
    $default_commands[] = new TestSiteInstallCommand();
    $default_commands[] = new TestSiteTearDownCommand();
    $default_commands[] = new TestSiteReleaseLockCommand();
    return $default_commands;
  }

}
