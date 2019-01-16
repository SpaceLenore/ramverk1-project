<?php

namespace Lenore\Questions\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lenore\Questions\Reply;

/**
 * Example of FormModel implementation.
 */
class ReplyForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Leave a reply"
            ],
            [
                "reply" => [
                    "type"        => "textarea",
                    "placeholder" => "Leave your reply here",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Reply",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $replyfromuser = $this->form->value("reply");
        $session = $this->di->get("session");

        if ($session->has("login")) {
            $reply = new Reply();
            $reply->setDb($this->di->get("dbqb"));
            $reply->reply = $replyfromuser;
            $reply->replierId = $session->get("login");
            $reply->responseTo = $session->get("currentPost");
            $reply->created = time();
            $reply->save();
            return true;
        }
        return false;



        // return true;
    }
}
