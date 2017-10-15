<?php

/**
 * Created by PhpStorm.
 * User: kilanoff
 * Date: 06.10.16
 * Time: 11:24
 */
class FreezoneCabinetCategoryComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        $cat_id = getUserCatId();

        $category = getUserCategory($cat_id);

        $this->arResult['CATEGORY'] = $cat_id;

        $this->arResult['CATEGORY_NAME'] = $category['NAME'];

        $this->includeComponentTemplate();
    }
}