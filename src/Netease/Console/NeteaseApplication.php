<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Netease\Console;

use Netease\Console\Command\Breakpoint;
use Netease\Console\Command\Create;
use Netease\Console\Command\Init;
use Netease\Console\Command\ListAliases;
use Netease\Console\Command\Migrate;
use Netease\Console\Command\Rollback;
use Netease\Console\Command\SeedCreate;
use Netease\Console\Command\SeedRun;
use Netease\Console\Command\Status;
use Netease\Console\Command\Test;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Netease console application.
 *
 * @author Rob Morgan <robbym@gmail.com>
 */
class NeteaseApplication extends Application
{
    /**
     * Initialize the Netease console application.
     */
    public function __construct()
    {
        parent::__construct('=====================database migrate============================');

        $this->addCommands([
            new Init(),
            new Create(),
            new Migrate(),
            new Rollback(),
            new Status(),
            new Breakpoint(),
            new Test(),
            new SeedCreate(),
            new SeedRun(),
            new ListAliases(),
        ]);
    }

    /**
     * Runs the current application.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input An Input instance
     * @param \Symfony\Component\Console\Output\OutputInterface $output An Output instance
     * @return int 0 if everything went fine, or an error code
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        // always show the version information except when the user invokes the help
        // command as that already does it
        if (($input->hasParameterOption(['--help', '-h']) !== false) || ($input->getFirstArgument() !== null && $input->getFirstArgument() !== 'list')) {
            $output->writeln($this->getLongVersion());
            $output->writeln('');
        }

        return parent::doRun($input, $output);
    }
}
