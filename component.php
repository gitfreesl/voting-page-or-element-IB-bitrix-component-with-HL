<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
 
\Bitrix\Main\Loader::includeModule('highloadblock');

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

// id HLB
$hlblock_id = 1;
            
$hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();



   if($arParams['TYPE']){ // type like - Page
      if($arParams['OBJECT'])
		 $obj = $arParams['OBJECT'];
	  else $obj = $APPLICATION->GetCurDir(); // if no value then cur dir
	  $filter = array('UF_PAGE' => $obj);
	  $arResult["OBJECT_TYPE"] = 'PAGE';
	  
   }else{// type like  - Element IB
	   $arResult["OBJECT_TYPE"] = 'ELEMENT';
	   $obj = $arParams['OBJECT'];
	   if(!$obj) $obj = $APPLICATION->GetCurDir(); // if no value then cur dir
	   $filter = array('UF_ID_NEWS' => $obj);
   }
   $arResult['COMMENT_OBJECT'] = $obj;
   
   $rsData = $entity_data_class::getList(array(
   "select" => array("*"),
   //"order" => array("ID" => "ASC"),
   "filter" => $filter
   ));
   
   $arResult['LIKE_COUNT'] = 0; 
   $arResult['UNLIKE_COUNT'] =0;
   
   while($arData = $rsData->Fetch()) // count like and unlike
   {
	  if($arData['UF_LIKE'])
		$arResult['LIKE_COUNT'] ++;
      elseif($arData['UF_UNLIKE'])	
        $arResult['UNLIKE_COUNT'] ++;
   } 
  
   
   //can or not vote
   
   $filter[] = array('UF_IP' => $_SERVER['REMOTE_ADDR']);
   $rsData = $entity_data_class::getList(array(
   "select" => array("*"),
   //"order" => array("ID" => "ASC"),
   "filter" => $filter
   ));
   
   if($arData = $rsData->Fetch())
      $arResult['CAN_VOTE'] = 'N';
   else 
      $arResult['CAN_VOTE'] = 'Y'; 	

 
  if($USER->IsAuthorized())  // $user
	$arResult['USER_NAME'] = $USER->GetFormattedName(false);
  else 
    $arResult['USER_NAME'] = 'Guest';
  

$arResult['PATH'] = $this->GetPath();
//prnt($arResult);
$this->IncludeComponentTemplate();
?>