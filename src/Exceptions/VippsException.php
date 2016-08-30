<?php

namespace Vipps\Exceptions;

class VippsException extends \Exception
{
    protected $description;

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
