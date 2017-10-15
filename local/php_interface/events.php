<?php
use Bitrix\Main\EventManager;

EventManager::getInstance()->addEventHandler("form", "onBeforeResultAdd", Array("CEventClassIC", "onBeforeResultAddHandler"));

EventManager::getInstance()->addEventHandler("form", "onAfterResultAdd", Array("CEventClassIC", "onAfterResultAddHandler"));

class CEventClassIC
{
    function onBeforeResultAddHandler($WEB_FORM_ID, &$arFields, &$arrVALUES){
        //writeToFile($arFields, "log_form_1.txt");
        //writeToFile($arrVALUES, "log_form_1.txt");

		$iblockId = MAIN_SECTIONS;
		$needIblockId = false;
		CModule::IncludeModule("iblock");
		$res = CIBlockSection::GetList(array(), array("IBLOCK_ID" => $iblockId, "ACTIVE" => "Y", "UF_FORM" => $WEB_FORM_ID), false, array("UF_REQUEST_TABLE"));
		if($arRes = $res->GetNext()) {
			$needIblockId = $arRes["UF_REQUEST_TABLE"];
		}
		
		if($needIblockId){
			
			$arPropList = array();
			$arProps = array();
			if($needIblockId) {
			   $properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$needIblockId));
			   while ($prop_fields = $properties->GetNext())
			   {
				   $arPropList[crc32($prop_fields["NAME"])] = $prop_fields;
				   $arProps[$prop_fields["ID"]] = "";
			   }
			}

			CModule::IncludeModule("form");

			$arQuestions = array();
			$rsQuestions = CFormField::GetList(
				$WEB_FORM_ID,
				"N",
				$by="s_id",
				$order="desc",
				array(
					"ACTIVE" => "Y",
				),
				$is_filtered
			);
			while ($arQuestion = $rsQuestions->Fetch())
			{
				$arQuestions[crc32($arQuestion["TITLE"])] = $arQuestion["ID"];
			}

            foreach ($arQuestions as $ki=>&$item)
            {
                $rsAnswers = CFormAnswer::GetList(
                    $item,
                    $by="s_id",
                    $order="desc",
                    array(
                        "ACTIVE" => "Y",
                    ),
                    $is_filtered
                );
                if ($arAnswer = $rsAnswers->Fetch())
                {
                    $arQuestions[$ki] = "form_".$arAnswer["FIELD_TYPE"]."_".$arAnswer["ID"];
                }
			}
			unset($item);

            //writeToFile($arPropList, "log_form_1.txt");
            //writeToFile($arProps, "log_form_1.txt");
            //writeToFile($arQuestions, "log_form_1.txt");

			foreach($arQuestions as $kq=>$arQuestion) {
				if(isset($arPropList[$kq]) && isset($arrVALUES[$arQuestion])) {
					$arProps[$arPropList[$kq]["ID"]] = $arrVALUES[$arQuestion];
				}
			}
            //writeToFile($arProps, "log_form_1.txt");
			
			addRequestFromForm($needIblockId, $arProps);
		}

    }
}