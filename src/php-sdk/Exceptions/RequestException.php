<?php

namespace Ensembl260\SDK\Exceptions;

class RequestException extends \RuntimeException
{
    private array $trace = [];

    public function getExtTrace(): array
    {
        return $this->trace;
    }

    public function setExtTrace(array $trace): self
    {
        $this->trace = $trace;

        return $this;
    }
}
