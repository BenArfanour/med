<?php

namespace AuthentificationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AuthentificationBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }
}
