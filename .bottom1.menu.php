<?
$aMenuLinks = Array(
	Array(
		"Галерея",
		"/gallery/",
		Array(), 
		Array(
		    "AIR" => "Y"
        ),
		"" 
	),
	Array(
		"Оборудование",
		"/equipment/",
		Array(), 
		Array(
            "AIR" => "Y"
        ),
		"" 
	),
	Array(
		"Корпоративы",
		"/corporate/",
		Array(), 
		Array(
            "AIR" => "Y"
        ),
		"" 
	),
    Array(
        "Сертификаты",
        "/certificate/",
        Array(),
        Array(
            "AIR" => "Y"
        ),
        ""
    ),
    Array(
        "Календарь",
        "/personal/order/#left",
        Array(),
        Array(
            "AIR" => "Y"
        ),
        "\$GLOBALS['USER']->IsAuthorized()"
    ),
    Array(
        "Личный кабинет",
        "/personal/",
        Array(),
        Array(
            "AIR" => "Y"
        ),
        "\$GLOBALS['USER']->IsAuthorized()"
    ),
    Array(
        "Конференц зал",
        "/events/",
        Array(),
        Array(
            "AFTER" => "Y"
        ),
        ""
    ),
    Array(
        "Детские праздники",
        "/events/",
        Array(),
        Array(
            "AFTER" => "Y"
        ),
        ""
    ),
    Array(
        "Корпоративы",
        "/equipment/",
        Array(),
        Array(
            "AFTER" => "Y"
        ),
        ""
    ),
    Array(
        "Детская игровая",
        "/events/",
        Array(),
        Array(
            "AFTER" => "Y"
        ),
        ""
    ),
);
?>