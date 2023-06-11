<?php

namespace Igwen6w\Ddz\Support;

class Node
{
    public string $name;
    public Node $next;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function setNext(Node $node): static
    {
        $this->next = $node;
        return $this;
    }

    public function next(): Node
    {
        return $this->next;
    }


}