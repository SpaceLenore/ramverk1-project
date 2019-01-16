<?php

namespace Lenore\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lenore\User\HTMLForm\UserLoginForm;
use Lenore\User\HTMLForm\CreateUserForm;
use Lenore\User\HTMLForm\SettingsForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class UserController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var $data description
     */
    //private $data;
    protected function getPost($id)
    {
        $db = $this->di->get("dbqb");
        $db->connect();
        $sql = "SELECT * FROM Ask WHERE askerId IS " . htmlentities($id);
        $res = $db->executeFetchAll($sql);
        return $res;
    }

    protected function getTopPosts()
    {
        $db = $this->di->get("dbqb");
        $db->connect();
        $sql = "SELECT id, title FROM Ask ORDER BY id DESC Limit 3";
        $res = $db->executeFetchAll($sql);
        return $res;
    }

    protected function popularTags()
    {
        $db = $this->di->get("dbqb");
        $db->connect();
        $sql = "SELECT TagName FROM Tags GROUP BY TagName ORDER BY Count(TagName) DESC LIMIT 5";
        $res = $db->executeFetchAll($sql);
        return $res;
    }


    protected function getResponses($id)
    {
        $db = $this->di->get("dbqb");
        $db->connect();
        $sql = "SELECT u.picture, u.username, r.id, r.responseTo, r.reply
                FROM Replies as r JOIN User
                as u ON u.id = r.replierId
                WHERE u.id IS " . htmlentities($id);
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
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $topPosts = $this->getTopPosts();
        $trendingTags = $this->popularTags();
        $page->add("q/pages/welcome", [
            "posts" => $topPosts,
            "trending" => $trendingTags,
        ]);

        return $page->render([
            "title" => "Welcome",
        ]);
    }

    public function aboutAction() : object
    {
        $page = $this->di->get("page");
        $page->add("q/pages/about", []);
        return $page->render([
            "title" => "About The Project",
        ]);
    }

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function loginAction() : object
    {
        $page = $this->di->get("page");
        $form = new UserLoginForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A login page",
        ]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function signupAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateUserForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A create user page",
        ]);
    }

    public function profileAction($proid = "") : object
    {
        $page = $this->di->get("page");
        $session = $this->di->get("session");

        if ($proid == "") {
            if ($session->has("login")) {
                $proid = $session->get("login");
            } else {
                $content = "you need to be logged in to view your profile. <a href='../login'>Logga in</a>";
                $page->add("anax/v2/article/default", [
                    "content" => $content,
                ]);
                return $page->render([
                    "title" => "no profile",
                ]);
            }
        }

        // Questions And replies posted by user
        $usrPosts = $this->getPost($proid);
        if (count($usrPosts) == 0) {
            $usrPosts = "<i>No posts so far...</i>";
        }
        $usrReplies = $this->getResponses($proid);
        if (count($usrReplies) == 0) {
            $usrReplies = "<i>No replies so far...</i>";
        }


        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $res = $user->getUserDataById($proid);
        //show settings
        if ($proid == $session->get("login")) {
            $form = new SettingsForm($this->di, $proid);
            $form->check();
            $page->add("user/profile", [
                "settingsForm" =>  $form->getHTML(),
                "id" => $user->id,
                "username" => $user->username,
                "madePosts" => $usrPosts,
                "madeReplies" => $usrReplies,
            ]);
        } else {
            $page->add("user/profile", [
                "id" => $user->id,
                "username" => $user->username,
                "madePosts" => $usrPosts,
                "madeReplies" => $usrReplies,
            ]);
        }
        return $page->render([
            "title" => "profile",
        ]);
    }

    public function logoutAction() : object
    {
        $response = $this->di->get("response");
        $session = $this->di->get("session");
        $session->destroy();
        $response->redirect("");
    }

    public function usersAction() : object
    {
        $page = $this->di->get("page");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $res = $user->getAllUsers();

        $page->add("q/pages/users", [
            "users" => $res,
        ]);

        return $page->render([
            "title" => "users",
        ]);
    }
}
