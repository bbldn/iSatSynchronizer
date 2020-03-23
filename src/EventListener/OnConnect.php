<?php

namespace App\EventListener;

use  Doctrine\DBAL\Event\ConnectionEventArgs;

class OnConnect
{
    /**
     * @param ConnectionEventArgs $event
     * @throws \Doctrine\DBAL\DBALException
     */
    public function postConnect(ConnectionEventArgs $event)
    {
        $event->getConnection()->executeQuery("SET NAMES UTF8");
    }
}