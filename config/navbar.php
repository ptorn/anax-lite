<?php
return [
    "config" => [
        "navbar-class" => "navbar2"
    ],
    "items" => [
        "me" => [
            "text" => "Start",
            "route" => "",
        ],
        "about" => [
            "text" => "Om",
            "route" => "about",
        ],
        "report" => [
            "text" => "Redovisning",
            "route" => "report",
        ],
        "uppgifter" => [
            "text" => "Uppgifter",
            "route" => "#",
            "submenu" => [
                "items" => [
                    "calendar" => [
                        "text" => "Kalender",
                        "route" => "calendar",
                    ],
                    "session" => [
                        "text" => "Session",
                        "route" => "session",
                    ],
                    "filter" => [
                        "text" => "TestFilter",
                        "route" => "filter",
                    ],
                    "test" => [
                        "text" => "Test",
                        "route" => "test",
                    ],
                    "page" => [
                        "text" => "Sida",
                        "route" => "page/testsida-med-slug",
                    ],
                    "blogpost" => [
                        "text" => "Bloggpost",
                        "route" => "blog/en-bloggpost-som-exempel",
                    ],
                ]
            ]
        ],
        "login" => [
            "text" => "Login",
            "route" => "login",
        ]
    ]
];
