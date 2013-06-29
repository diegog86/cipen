<?php

namespace Cipen\UsuarioBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CipenUsuarioBundle extends Bundle
{
    
    public function getParent()
    {
        return 'FOSUserBundle';
    }    
    
}
