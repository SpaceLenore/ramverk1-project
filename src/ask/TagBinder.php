<?php

namespace Lenore\ask;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
Class TagBinder extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "TagBinding";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $TagId;
    public $PostId;
}
