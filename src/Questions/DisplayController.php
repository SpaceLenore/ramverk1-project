<?php

namespace Lenore\Questions;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lenore\ask\HTMLForm\CreateForm;
use Lenore\ask\HTMLForm\EditForm;
use Lenore\ask\HTMLForm\DeleteForm;
use Lenore\ask\HTMLForm\UpdateForm;
use Lenore\ask\Ask;
use Lenore\ask\TagMannager;
use Lenore\Questions\HTMLForm\ReplyForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class DisplayController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var $data description
     */
    //private $data;
    protected function getTags($qid)
    {
        $db = $this->di->get("dbqb");
        $db->connect();
        $sql = "SELECT TagName FROM Tags WHERE PostId IS " . htmlentities($qid);
        $res = $db->executeFetchAll($sql);
        return $res;
    }

    protected function getPerson($id)
    {
        $db = $this->di->get("dbqb");
        $db->connect();
        $sql = "SELECT id, username, picture FROM User WHERE id IS " . htmlentities($id);
        $res = $db->executeFetchAll($sql);
        return $res;
    }

    protected function getPost($id)
    {
        $db = $this->di->get("dbqb");
        $db->connect();
        $sql = "SELECT * FROM Ask WHERE id IS " . htmlentities($id);
        $res = $db->executeFetchAll($sql);
        return $res;
    }

    protected function getResponses($id)
    {
        $db = $this->di->get("dbqb");
        $db->connect();
        $sql = "SELECT r.id, u.picture, u.username, r.reply FROM Replies as r JOIN User
        as u ON u.id = r.replierId WHERE r.responseTo IS " . htmlentities($id);
        $res = $db->executeFetchAll($sql);
        return $res;
    }


    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
    // public function initialize() : void
    // {
    //     ;
    // }



    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $ask = new Ask();
        $ask->setDb($this->di->get("dbqb"));
        $res = $ask->getAllQuestions();
        $allPosts = [];
        for ($i=0; $i < count($res); $i++) {
            array_push(
                $allPosts,
                [
                    "post" => $res[$i],
                    "tags" => $this->getTags($res[$i]->id),
                ]
            );
        }
        $page->add("q/pages/questions", [
                "postdata" => $allPosts
            ]);

        return $page->render([
                "title" => "View Questions",
            ]);
    }

    public function qAction($post)
    {
        $form = new ReplyForm($this->di);
        $form->check();
        $ask = new Ask();
        $ask->setDb($this->di->get("dbqb"));
        $page = $this->di->get("page");
        $session = $this->di->get("session");
        $session->set("currentPost", $post);
        $postres = $this->getPost($post);
        $userres = $this->getPerson($postres[0]->askerId);
        $page->add("q/pages/question", [
                "post" => $postres,
                "user" => $userres,
                "tags" => $this->getTags($postres[0]->id),
                "form" => $form->getHTML(),
                "responses" => $this->getResponses($post),
            ]);

        return $page->render([
                "title" => "View Question",
            ]);
    }
}
