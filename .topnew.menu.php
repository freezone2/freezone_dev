<?
$aMenuLinks = Array(
	Array(
		"О нас", 
		"/about/", 
		Array(), 
		Array(), 
		"" 
	),
    Array(
        "Тарифы",
        "/rates/",
        Array(),
        Array(
            "AIR" => "Y"
        ),
        ""
    ),
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
		"Новости", 
		"/news/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Контакты", 
		"/contacts/", 
		Array(), 
		Array(), 
		"" 
	),
    Array(
        "Кабинет админа",
        "/cabinet/",
        Array(),
        Array(
            "AIR" => "Y"
        ),
        "\$GLOBALS['USER']->IsAuthorized() && \$GLOBALS['USER']->isAdmin()"
    ),
);
?>