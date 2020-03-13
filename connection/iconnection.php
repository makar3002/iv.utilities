<?php
namespace Connection;

interface IConnection
{
    public function connect(ConnectionConfiguration $config);

    public function close();

    public function query($query);

    public function prepare($value);

    public function quote($identifier);

    public function startTransaction();

    public function commitTransaction();

    public function rollbackTransaction();
}