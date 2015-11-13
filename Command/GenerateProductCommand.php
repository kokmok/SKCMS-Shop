<?php
namespace SKCMS\ShopBundle\Command;

use SKCMS\CoreBundle\Command\GenerateEntityCommand;
use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineEntityCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Sensio\Bundle\GeneratorBundle\Command\Validators;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ConfirmationQuestion;
/**
 * Description of GenerateProductCommand
 *
 * @author jona
 */
class GenerateProductCommand extends GenerateEntityCommand
{
    const CLASS_PARENT = '\\SKCMS\\ShopBundle\\Entity\\SKBaseProduct';
    const REPO_PARENT = '\\SKCMS\\ShopBundle\\Entity\\SKBaseProductRepository';
    
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('skcms:generate:product')
            ->setAliases(array('generate:skcms:product'))
            ->setDescription('Generates a new Doctrine entity inside a bundle and prepare it for SKCMS')
            ->addOption('add-to-menu', null, InputOption::VALUE_NONE, 'Whether to add entity to the menu')
            ->addOption('beauty-name', null, InputOption::VALUE_OPTIONAL, 'The beauty name in the menu')
            ->addOption('menu-group', null, InputOption::VALUE_OPTIONAL, 'The menu where it\'s displayed in the admin')
                ;
    }
}
