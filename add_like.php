<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('highloadblock');

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Main\Type\DateTime; 

// id HLB
$hlblock_id = 1;
            
$hlblock = HL\HighloadBlockTable::getById($hlblock_id)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$cur_date = new DateTime();  // date
if($_POST['like']==1){       // like or unlike 
    $like = 1; 
	$unlike =0;
}elseif($_POST['like']==-1){
	$like = 0; 
	$unlike =1;
}
if($_POST['type']=='PAGE'){ // page or element
    $page = $_POST['object'];
	$id_news = '';
}elseif($_POST['type']=='ELEMENT'){
	$page = '';
	$id_news = $_POST['object'];
}


$result = $entity_data_class::add( // add new vote
    array(
        'UF_PAGE' => $page,
        'UF_DATE' => $cur_date,
        'UF_ID_NEWS' => $id_news,
        'UF_IP' => $_SERVER['REMOTE_ADDR'],
		'UF_LIKE' => $like,
		'UF_UNLIKE' => $unlike,
        )
    );	
if ($result->isSuccess()) 
   echo 'success';
else 
   echo 'error';	


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>