<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // Here comes the menu items
    "special" => [
        "login" => "login",
        "signup" => "signup",
        "logout" => "logout",
        "profile" => "profile",
    ],
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Questionable",
        ],
        [
            "text" => "Ask a question",
            "url" => "ask",
            "title" => "Ask a question",
        ],
        [
            "text" => "Asked questions",
            "url" => "questions",
            "title" => "already asked questions",
        ],
        [
            "text" => "Tags",
            "url" => "tags",
            "title" => "browse tags",
        ],
        [
            "text" => "Users",
            "url" => "users",
            "title" => "Browse users",
        ],
        [
            "text" => "About",
            "url" => "about",
            "title" => "About this project",
        ],
    ],
];
