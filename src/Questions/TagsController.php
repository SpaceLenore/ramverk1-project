<?php

namespace Lenore\Questions;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class TagsController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    protected function getTagsList()
    {
        $db = $this->di->get("dbqb");
        $db->connect();
        $sql = "SELECT Distinct t.TagName FROM Tags as t;";
        $res = $db->executeFetchAll($sql);
        return $res;
    }

    protected function getPostsOnTag($tag)
    {
        $db = $this->di->get("dbqb");
        $db->connect();
        $sql = "SELECT p.title, p.id FROM Tags as t, Ask as p WHERE t.PostId = p.id AND t.TagName = '" . $tag . "';";
        $res = $db->executeFetchAll($sql);
        return $res;
    }



    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $res = $this->getTagsList();

        $page->add("q/pages/tags", [
                "tags" => $res
            ]);

        return $page->render([
                "title" => "View Tags",
            ]);
    }

    public function browseAction($tagSearch) : object
    {
        $page = $this->di->get("page");
        $res = $this->getTagsList();
        $taggedPosts = $this->getPostsOnTag($tagSearch);

        $page->add("q/pages/browse-tags", [
                "tags" => $res,
                "posts" => $taggedPosts,
            ]);

        return $page->render([
                "title" => "View Tags",
            ]);
    }
}
