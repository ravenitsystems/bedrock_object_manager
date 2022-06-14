<?php

namespace ravenitsystems\bedrock_object_manager;

interface IStorage
{
    public function get(string $name): object|callable|string;
    public function set(string $name, object|callable|string $object): void;
    public function has(string $name): bool;
    public function del(string $name): object|callable|string;
    public function all(): array;
    public function objectList(): array;
    public function moduleList(): array;
    public function instance(?string $instance = null): ?string;
    public function module(?string $module = null): ?string;

}