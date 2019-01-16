<?php
/**
 * Mount the controller onto a mountpoint.
 */
return [
    "routes" => [
        [
            "info" => "User controller.",
            "mount" => "/",
            "handler" => "\Lenore\User\UserController",
        ],
    ]
];
