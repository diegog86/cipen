<?php

namespace Cipen\PersonalBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Cipen\PersonalBundle\Entity\Tipo;

class LoadTipoCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cipen:personal:load-tipo')
            ->setDescription('Crea nuevos tipos de personal no almacenados actualmente en la db')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        $output->writeln('');
        $output->writeln('');
        $output->writeln('Iniciando proceso***********');

        //niveles cargados
        $tiposCargados = $em->getRepository("CipenPersonalBundle:Tipo")->findAll();
        $arrayTiposCargados = array();
        foreach($tiposCargados as $tiposCargados){
            $arrayTiposCargados[] = $tiposCargados->getCodigo();
        }

        $tipos[0] = array('MÉDICO',"TÉCNICO RADIOLOGO","BIOQUÍMICO");
        
        $tipos[1][0] = array(
            "ALERGIA E INMUNOLOGIA",
            "ANATOMIA PATOLOGICA",
            "ANESTESIOLOGIA",
            "ANGIOLOGIA GENERAL Y HEMODINAMIA",
            "CARDIOLOGIA",
            "CARDIOLOGO INFANTIL",
            "CIRUGIA CARDIOVASCULAR	",
            "CIRUGIA DE CABEZA Y CUELLO",
            "CIRUGIA DE TORAX (CIRUGIA TORACICA)",
            "CIRUGIA GENERAL",
            "CIRUGIA INFANTIL (CIRUGIA PEDIATRICA)",
            "CIRUGIA PLASTICA Y REPARADORA",
            "CIRUGIA VASCULAR PERIFERICA",
            "CLINICA MEDICA",
            "COLOPROCTOLOGIA",
            "DERMATOLOGIA",
            "DIAGNOSTICO POR IMÁGENES",
            "ENDOCRINOLOGIA",
            "ENDOCRINOLOGO INFANTIL",
            "ESPECIALIDADES ODONTOLOGICAS",
            "ESPECIALIDAD DE ENDODONCIA",
            "ESPECIALIDAD DE ODONTOPEDIATRIA",
            "ESPECIALIDAD DE PERIODONCIA",
            "ESPECIALIDAD EN ANATOMIA PATOLOGICA BUCALMAXILOFACIAL",
            "ESPECIALIDAD EN CIRUGIA Y TRAUMATOLOGIA BUCO MAXILO FACIAL",
            "ESPECIALIDAD EN CLINICA ESTOMATOLOGICA",
            "ESPECIALIDAD EN ODONTOLOGIA LEGAL",
            "ESPECIALIDAD EN ORTODONCIA Y ORTOPEDIA MAXILAR",
            "ESPECIALIDAD EN PROTESIS DENTOBUCOMAXILAR",
            "ESPECIALIZACION EN DIAGNOSTICO POR IMAGENES BUCOMAXILOFACIAL",
            "FARMACOLOGIA CLINICA",
            "FISIATRIA (MEDICINA FISICA Y REHABILITACION)",
            "GASTROENTEROLOGIA",
            "GASTROENTEROLOGO INFANTIL.",
            "GENETICA MEDICA",
            "GERIATRIA",
            "GINECOLOGIA",
            "HEMATOLOGIA",
            "HEMATOLOGO INFANTIL.",
            "HEMOTERAPIA E INMUNOHEMATOLOGIA",
            "INFECTOLOGIA",
            "INFECTOLOGO INFANTIL",
            "MEDICINA DEL DEPORTE",
            "MEDICINA DEL TRABAJO",
            "MEDICINA GENERAL y/O MEDICINA DE FAMILIA",
            "MEDICINA LEGAL",
            "MEDICINA NUCLEAR",
            "NEFROLOGIA",
            "NEFROLOGO INFANTIL.",
            "NEONATOLOGIA",
            "NEUMONOLOGIA",
            "NEUMONOLOGO INFANTIL.",
            "NEUROCIRUGIA",
            "NEUROLOGIA",
            "NEUROLOGO INFANTIL.",
            "NUTRICION",
            "OBSTETRICIA",
            "OFTALMOLOGIA",
            "ONCOLOGIA",
            "ONCOLOGO INFANTIL.",
            "ORTOPEDIA Y TRAUMATOLOGIA",
            "OTORRINOLARINGOLOGIA",
            "PEDIATRIA",
            "PSIQUIATRIA",
            "PSIQUIATRIA INFANTO JUVENIL",
            "RADIOTERAPIA O TERAPIA RADIANTE",
            "REUMATOLOGIA",
            "REUMATOLOGO INFANTIL.",
            "TERAPIA INTENSIVA",
            "TERAPISTA INTENSIVO INFANTIL",
            "TOCOGINECOLOGIA",
            "TOXICOLOGIA",
            "UROLOGIA",
            "OTRA ESPECIALIDAD"
        );
        
        $output->writeln('');
        $output->writeln('****Creando primer nivel***********');
        $tiposNivel_0 = array();
        foreach ($tipos[0] as $keyNivel_0 => $dataNivel_0){
            $output->write("********".$dataNivel_0);
            if (!in_array($this->formatearCodigo($dataNivel_0), $arrayTiposCargados)) {
                $output->writeln("...SI");
                $tiposNivel_0[$keyNivel_0] = new Tipo();
                $tiposNivel_0[$keyNivel_0]->setNombre(strtoupper($dataNivel_0));
                $tiposNivel_0[$keyNivel_0]->setCodigo($this->formatearCodigo($dataNivel_0));
                $em->persist($tiposNivel_0[$keyNivel_0]);
            }else{
                $output->writeln("...NO");
            }
        }
        $output->writeln('');
        
        $output->writeln('****Creando segundo nivel***********');
        $tiposNivel_1 = array();
        $j = 0;
        for($i=0;$i<count($tipos[0]);$i++){
            if (isset($tipos[1][$i])){
                foreach ($tipos[1][$i] as $dataNivel_1){
                    $output->write("********".$dataNivel_1);
                    if (!in_array($this->formatearCodigo($dataNivel_0), $arrayTiposCargados)) { 
                        $output->writeln("...SI");
                        $tiposNivel_1[$j] = new Tipo();
                        $tiposNivel_1[$j]->setNombre(strtoupper($dataNivel_1));
                        $tiposNivel_1[$j]->setCodigo($this->formatearCodigo($dataNivel_1));
                        $tiposNivel_1[$j]->setParent($tiposNivel_0[$i]);
                        $em->persist($tiposNivel_1[$j]);
                        $j++;
                    }else{
                        $output->writeln("...NO");
                    }
                }
            }
        }
        
        

        $output->writeln('');
        $output->write('Guardando');        
        $em->flush();
        $output->writeln('...OK***********');
        $output->writeln('*****************************FIN****************************************');   
        $output->writeln('');
        
    }
    
    private function formatearCodigo($codigo){
        
        // formateo texto para limpiar espacios, etc
        $codigo = preg_replace('/[\s]+/','_',$codigo);
        $codigo = trim($codigo);
        $codigo = preg_replace ("/á/", "a", $codigo);        
        $codigo = preg_replace ("/é/", "e", $codigo);
        $codigo = preg_replace ("/í/", "i", $codigo);
        $codigo = preg_replace ("/ó/", "o", $codigo);
        $codigo = preg_replace ("/ú/", "u", $codigo);
        $codigo = preg_replace ("/Á/", "a", $codigo);        
        $codigo = preg_replace ("/É/", "e", $codigo);
        $codigo = preg_replace ("/Í/", "i", $codigo);
        $codigo = preg_replace ("/Ó/", "o", $codigo);
        $codigo = preg_replace ("/Ú/", "u", $codigo);        
        $codigo = strip_tags($codigo);
        
        return strtolower ($codigo) ;
    }
    
}
