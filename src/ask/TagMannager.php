<?php

namespace Lenore\ask;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
Class TagMannager extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Tags";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $TagName;

    //Find if tag exists, if not place in taglist
    //take taglist id and match to post id
    public function findTag($tagName)
    {
        return $this->find("TagName", $tagName);
    }

    public function tagByPost($pid)
    {
        return $this->findWhere("postId", $pid);
    }
}
