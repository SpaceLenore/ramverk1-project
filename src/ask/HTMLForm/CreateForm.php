<?php

namespace Lenore\ask\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lenore\ask\Ask;
use Lenore\ask\TagMannager;
use Lenore\ask\TagBinder;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
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
                "legend" => "Ask your question here",
            ],
            [
                "title" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "placeholder" => "what if...?",
                ],

                "question" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                    "placeholder" => "Question description, text or information",
                ],

                "tags" => [
                    "type" => "text",
                    "placeholder" => "comma,separated,tag,list"
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Create item",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $s = $this->di->get("session");
        if ($s->has("login")) {
            $ask = new Ask();
            $ask->setDb($this->di->get("dbqb"));
            $ask->title = $this->form->value("title");
            $ask->question = $this->form->value("question");
            $ask->askerId = $s->get("login");
            $ask->created = time();
            $ask->save();

            $newAsk = new Ask();
            $newAsk->setDb($this->di->get("dbqb"));
            $newAsk->findByQuestion($this->form->value("question"));

            $tagString = $this->form->value("tags");
            $taglist = explode(",", $tagString);

            $qid = $newAsk->id;

            for ($i=0; $i < count($taglist); $i++) {
                $tm = new TagMannager();
                $tm->setDb($this->di->get("dbqb"));
                $tm->PostId = $qid;
                $tm->TagName = $taglist[$i];
                $tm->save();
            }
            return true;
        } else {
            return false;
        }
    }



    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("ask")->send();
    }



    // /**
    //  * Callback what to do if the form was unsuccessfully submitted, this
    //  * happen when the submit callback method returns false or if validation
    //  * fails. This method can/should be implemented by the subclass for a
    //  * different behaviour.
    //  */
    // public function callbackFail()
    // {
    //     $this->di->get("response")->redirectSelf()->send();
    // }
}
