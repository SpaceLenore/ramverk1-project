<?php

namespace Lenore\ask;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Ask extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Ask";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $title;
    public $question;
    public $askerId;
    public $created;

    public function findByQuestion($q)
    {
        return $this->find("question", $q);
    }

    // public function findPostById($id)
    // {
    //     return $this->findById($id);
    // }

    public function getAllQuestions()
    {
        return $this->findAll();
    }
}
