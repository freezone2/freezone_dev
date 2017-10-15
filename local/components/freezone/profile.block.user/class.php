<?php

/**
 * Created by PhpStorm.
 * User: kilanoff
 * Date: 06.10.16
 * Time: 11:24
 */
class FreezoneProfileEditBlockComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        $hours = getUserHours();
        $balance = getUserBalance();

        $this->arResult['HOURS'] = $hours;
        $this->arResult['BALANCE'] = $balance;

        $this->includeComponentTemplate();
    }
}