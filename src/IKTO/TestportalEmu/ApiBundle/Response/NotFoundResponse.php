<?php

namespace IKTO\TestportalEmu\ApiBundle\Response;

class NotFoundResponse extends ApiResponse
{
    public function setContentByAttributes($year, $number, $pin)
    {
        $this->setContent(implode('$$', array($year, $number, $pin, '<не знайдено>')));
    }
}
