<?php
/**
 * Created by Samir_H
 */

namespace EasyOauth\src;
use \Symfony\Component\HttpKernel\Bundle\Bundle;

class EasyOauthBundle extends Bundle
{

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

}