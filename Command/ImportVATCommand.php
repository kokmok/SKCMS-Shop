<?php
namespace SKCMS\ShopBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use SKCMS\ShopBundle\Entity\VAT;

class ImportVATCommand extends ContainerAwareCommand 
{
    
    const JSON_FILE = '/../Resources/public/vat.json';
    
    
    protected function configure()
    {
        $this
            ->setName('skcms:import:vat')
            ->setDescription('Import vat from json file')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
        $nombrePays = $this->createVAT();
        $output->writeln($nombrePays.' vat successfully added');
    }
    
    public function createVAT()
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $jsonVAT = json_decode(file_get_contents(__DIR__.self::JSON_FILE),true);
        
        
        
        foreach ($jsonVAT as $jsonVAT)
        {
            $vat = new VAT();
            
            $vat->setName($jsonVAT['name']);
            $vat->setValue($jsonVAT['value']);
            $em->persist($vat);
        }
        
        $em->flush();
        
        return count($jsonVAT);
        
    }
}
