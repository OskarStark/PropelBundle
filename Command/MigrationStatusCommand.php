<?php

/**
 * This file is part of the PropelBundle package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace Propel\PropelBundle\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;

use Propel\Generator\Command\MigrationStatusCommand as BaseMigrationCommand;

/**
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
class MigrationStatusCommand extends AbstractCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('propel:migration:status')
            ->setDescription('Get migration status')

            ->addOption('connection',       null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL, 'Connection to use. Example: default, bookstore')
            ->addOption('migration-table',  null, InputOption::VALUE_REQUIRED,  'Migration table name', BaseMigrationCommand::DEFAULT_MIGRATION_TABLE)
            ->addOption('output-dir',       null, InputOption::VALUE_OPTIONAL,  'The output directory')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function createSubCommandInstance()
    {
        return new \Propel\Generator\Command\MigrationStatusCommand();
    }

    /**
     * {@inheritdoc}
     */
    protected function getSubCommandArguments(InputInterface $input)
    {
        $defaultOutputDir = $this->getApplication()->getKernel()->getRootDir().'/propel/migrations';

        return array(
            '--connection'      => $this->getConnections($input->getOption('connection')),
            '--migration-table' => $input->getOption('migration-table'),
            '--output-dir'      => $input->getOption('output-dir') ?: $defaultOutputDir,
        );
    }
}
