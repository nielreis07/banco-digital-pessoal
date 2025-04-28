<?php

namespace App\Http\UseCases;

abstract class BaseUseCase
{
    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    abstract public function execute(mixed $input): array|object|null;
}
