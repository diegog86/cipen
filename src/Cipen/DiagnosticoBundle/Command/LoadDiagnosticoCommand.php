<?php

namespace Cipen\DiagnosticoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Cipen\DiagnosticoBundle\Entity\Diagnostico;

class LoadDiagnosticoCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cipen:diagnostico:load-diagnostico')
            ->setDescription('Crea nuevos diagnósticos')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        $output->writeln('');
        $output->writeln('');
        $output->writeln('Iniciando proceso***********');

        
        $diagnosticosTxt = getcwd()."/web/datos/diagnosticos.txt";
        $p = fopen($diagnosticosTxt, "r");
        $diagnosticosTxt = fread($p,filesize($diagnosticosTxt));
        $diagnosticos = explode("\n", $diagnosticosTxt);
        

        
        $entity = array();
        $j=0;
        foreach($diagnosticos as $diagnostico){
            $campo = explode("@", $diagnostico);
            
            if (isset($campo[1])) {
                $output->writeln($j."->Nombre: ".$campo[1]."->Codigo: ".$campo[2]);
                
                $entity[$j] = new Diagnostico();
                $entity[$j]->setCodigo($this->formatear($campo[2]));
                $entity[$j]->setNombre($this->formatear($campo[1]));
                $entity[$j]->setDescripcion("Cargado automáticamente...");
                $em->persist($entity[$j]);
                $j++;
                
            }           
            
        }
        
        $em->flush();
        fclose($p);
        
        $output->writeln('...OK***********');
        $output->writeln('*****************************FIN****************************************');   
        $output->writeln('');
        
    }
    
    private function formatear($texto){
        
        // formateo texto para limpiar espacios, etc
        $texto = preg_replace('/[\s]+/',' ',$texto);
        $texto = trim($texto);    
        $texto = strip_tags($texto);
        
        return strtoupper($texto) ;
    }
    
}
