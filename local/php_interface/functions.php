<?php

function format_price($price) {
    return number_format($price, 0, ".", " ");
}
function getResizeImageSrc($id,$width,$height, $type = BX_RESIZE_IMAGE_PROPORTIONAL, $jpgQuality = 100 ){
    $small = CFile::ResizeImageGet($id,Array("height"=>$height,"width"=>$width), $type, false, false, false, $jpgQuality);
    return $small["src"];
}
function addRequestFromForm($iblockId, $arProps) {
    if(empty($arProps)) $arProps = array();
    CModule::IncludeModule("iblock");
    $res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $iblockId, "ACTIVE" => "Y"), false, false, array());
    $num_req = intval($res->SelectedRowsCount());

    $el = new CIBlockElement;

    $arLoadProductArray = Array(
        "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
        "IBLOCK_ID"      => $iblockId,
        "PROPERTY_VALUES"=> $arProps,
        "NAME"           => "Заявка №".($num_req+1),
        "ACTIVE"         => "Y",
    );

    //writeToFile($arLoadProductArray, "log_form_1.txt");
    if($elementId = $el->Add($arLoadProductArray)){
        return $elementId;
    }
    else
    {
        //writeToFile($el->LAST_ERROR, "log_form_1.txt");
        return false;
    }

}

function writeToString($Data, $str, $i=0)
{
    foreach ($Data as $key=>$item) {

        $str .= str_repeat(" ", $i).$key."\r\n";

        if(is_array($item)) {
            $str = writeToString($item, $str, $i+4);
        }
        else {
            $str .= str_repeat(" ", $i+4).$item."\r\n";
        }
    }
    return $str;
}

function writeToFile($arFields, $file_name = "test_file.txt", $flag = FILE_APPEND)
{
    $str = "\r\n";
    if(is_array($arFields))
    {
        $str = writeToString($arFields, $str);
    }
    else
    {
        $str = $arFields."\r\n";
    }

    if($flag) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/logfolder/" . $file_name, $str, $flag);
    }
    else {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/logfolder/" . $file_name, $str);
    }
}

function pRU ( $arr, $access = 'admin', $break = false ){
    global $USER;

    if( $access == 'admin' ){
        if( $USER->IsAdmin() ){
            echo "<pre>";
            print_r($arr);
            echo "</pre>";
        }
    }
    elseif( $access == 'all' ){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    $break ? die() : '';
}