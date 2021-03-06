<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Cipen\PersonalBundle\CipenPersonalBundle(),
            new Cipen\InternacionBundle\CipenInternacionBundle(),
            new Cipen\ObraSocialBundle\CipenObraSocialBundle(),
            new Cipen\PacienteBundle\CipenPacienteBundle(),
            new Cipen\PrestacionBundle\CipenPrestacionBundle(),
            new Cipen\DiagnosticoBundle\CipenDiagnosticoBundle(),
            new Cipen\MedicamentoBundle\CipenMedicamentoBundle(),            
            new Comun\ComunBundle\ComunComunBundle(),
            new Genemu\Bundle\FormBundle\GenemuFormBundle(),
            new Cipen\FacturaBundle\CipenFacturaBundle(),
            new Ps\PdfBundle\PsPdfBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Cipen\UsuarioBundle\CipenUsuarioBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
