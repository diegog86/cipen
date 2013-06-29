<?php

namespace Cipen\ObraSocialBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Comun\ComunBundle\Entity\OrganizacionGenerica;

class LoadDestinatariosCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cipen:obra-social:load-destinatario')
            ->setDescription('Creando destinatarios')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        $output->writeln('');
        $output->writeln('');
        $output->writeln('**********Iniciando proceso**********');
        
        $output->writeln('Creando colegio médico..');
        $colegioMedico= new OrganizacionGenerica();
        $colegioMedico ->setTipoGenerica(OrganizacionGenerica::DESTINATARIO_OBRA_SOCIAL)
                       ->setCuit('33-54318762-8')
                       ->setNombre('Colegio Medico Gremial de La Rioja')
                       ->setDireccionCalle('Av. Juan Facundo Quiroga')
                       ->setDireccionNumero('25')
                       ->setProvincia ('La Rioja')
                       ->setCodigoPostal ('5300')
                       ;
        
        $em->persist($colegioMedico);
        
        $em->flush();

        $output->writeln('');        
        $output->writeln('**********Fin**********');   
        $output->writeln('');
        
    }
    
    
}
