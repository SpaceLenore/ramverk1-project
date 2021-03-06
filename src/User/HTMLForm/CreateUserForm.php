<?php

namespace Lenore\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lenore\User\User;

/**
 * Example of FormModel implementation.
 */
class CreateUserForm extends FormModel
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
                "legend" => "Create user",
            ],
            [
                "Username" => [
                    "type"        => "text",
                    "placeholder" => "Username",
                ],

                "password" => [
                    "type"        => "password",
                    "placeholder" => "password",
                ],

                "password-again" => [
                    "type"        => "password",
                    "placeholder" => "retype password",
                    "validation" => [
                        "match" => "password"
                    ],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Create user",
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
        $username      = $this->form->value("Username");
        $password      = $this->form->value("password");
        $passwordAgain = $this->form->value("password-again");

        if ($password !== $passwordAgain) {
            $this->form->rememberValues();
            $this->form->addOutput("Password did not match.");
            return false;
        }

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->username = $username;
        $user->setPassword($password);
        $user->save();

        // $this->form->addOutput("User was created.");
        $resp = $this->di->get("response");
        $resp->redirect('login');

        // return true;
    }
}
