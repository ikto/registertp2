<?php

namespace IKTO\TestportalEmu\ApiBundle\Response;

use Symfony\Component\HttpFoundation\Response;

class ApiResponse extends Response
{
    public function __construct($content = '', $status = 200, $headers = array())
    {
        $headers['Content-type'] = 'text/html; charset=utf-8';
        parent::__construct($content, $status, $headers);
    }
}
