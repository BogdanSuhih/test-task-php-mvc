<?php

namespace Project\Controllers;

use Project\Models\Records\Record;
use Project\Controllers\AbstractController;
use Project\Exceptions\RouteException;

class RecordController extends AbstractController
{
    public function addRecord()
    {
        if (!$this->user) {
            throw new RouteException('Такого адреса не существует');
        }
        $records = $_POST['records'];
        foreach ($records as $record) {
            $record['user_id'] = $this->user->getId();
            $record['user_role'] = $this->user->getRole();
            Record::createNewRecord($record);
        }
    }
}
