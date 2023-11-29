<?php

namespace App\ValueObjects\Preferences;

class PreferredSource
{
    private $id;
    private $name;

    public function __construct(string|int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int|string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
