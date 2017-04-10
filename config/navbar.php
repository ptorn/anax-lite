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
        "session" => [
            "text" => "Session",
            "route" => "session",
        ],
        "calendar" => [
            "text" => "Kalender",
            "route" => "calendar",
        ],
        "report" => [
            "text" => "Redovisning",
            "route" => "report",
        ],
        "test" => [
            "text" => "Test",
            "route" => "test",
            "submenu" => [
                "items" => [
                    "test2" => [
                        "text" => "Test2",
                        "route" => "test",
                    ],
                    "test3" => [
                        "text" => "Test3",
                        "route" => "test",
                    ],
                ]
            ]
        ]
    ]
];
