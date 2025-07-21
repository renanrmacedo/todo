<?php
class Task
{
    public ?int $id = null;
    public string $description;
    public int $done = 0;

    public function __construct($description, $done, $id = null)
    {
        $this->id = $id;
        $this->description = $description;
        $this->done = $done;
    
        
    }
}                           