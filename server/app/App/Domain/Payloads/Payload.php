<?php

namespace App\App\Domain\Payloads;

abstract class Payload
{
    protected $data = null;
    protected $status = 200;
    /**
     * setting the passed data and status to local variables
     * @param type|null $data
     * @param type|null $status
     * @return type
     */
    public function __construct($data = null, $status = null)
    {
        if (isset($data)) {
            $this->data = $data;
        }
        if (isset($status)) {
            $this->status = $status;
        }
    }
    public function getData()
    {
        return $this->data;
    }
    public function getStatus()
    {
        return $this->status;
    }
}
