<?php

namespace App\Service;

class Slugify
{
    const SPECIAL_CHAR= [
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   '_',
        '/[\'\‹\›‚]/u'    =>   '_',
        '/[\"\«\»„]/u'    =>   '_',
        '/ /'           =>   '-',
        '/[\+\*\?\^\$\.\[\]\{\}\(\)\|\/]/' => '',
        '/[\t\n\r\0\v]/' => '',
    ];
    public function generate(string $input): string
    {
        return mb_strtolower(preg_replace(array_keys(self::SPECIAL_CHAR),array_values(self::SPECIAL_CHAR), $input));
    }
}
