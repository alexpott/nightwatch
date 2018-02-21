<?php

namespace Drupal\TestSite\Commands;

use Drupal\Core\Test\TestDatabase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command to release a test site database prefix lock.
 *
 * @internal
 */
class TestSiteReleaseLockCommand extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this->setName('release-lock')
      ->setDescription('Releases all test site locks')
      ->setHelp('The locks ensure test site database prefixes are not reused.')
      ->addArgument('db_prefix', InputArgument::OPTIONAL, 'The database prefix for the test site')
      ->addOption('all', NULL, InputOption::VALUE_NONE, 'Use to release all the test locks')
      ->addUsage('test12345678')
      ->addUsage('--all');
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    if ($input->getOption('all')) {
      TestDatabase::releaseAllTestLocks();
    }
    elseif ($input->getArgument('db_prefix')) {
      $test_db = new TestDatabase($input->getArgument('db_prefix'));
      $test_db->releaseLock();
    }
    else {
      throw new \RuntimeException('The release-lock command should be called with a database prefix or --all');
    }
    $output->writeln("<info>Successfully released all the test database locks</info>");
  }

}
