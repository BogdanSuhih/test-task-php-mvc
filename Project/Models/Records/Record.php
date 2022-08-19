<?php

namespace Project\Models\Records;

use Project\Models\AbstractActiveRecord;

class Record extends AbstractActiveRecord
{
    protected $userId;
    protected $title;
    protected $body;
    protected $camelCaseName;
    
    public static function createNewRecord(array $data): bool
    {
        $columns = '`user_id`, `title`, `body`, `button`, `user_role`';
        $values = ':userId, :title, :body, :button, :userRole';
        $params = [
            ':userId' =>  $data['user_id'],
            ':title' => $data['title'],
            ':body' => $data['body'],
            ':button' => $data['button'],
            ':userRole' => $data['user_role'],
        ];
        return self::createRecord($columns, $values, $params);
    }
    
    protected static function getTableName(): string
    {
        return 'records';
    }
}
