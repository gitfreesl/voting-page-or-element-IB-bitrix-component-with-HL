<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>

<script>
var PathTempl = '<?=$arResult['PATH'];?>'; // path template for script.js
var UserName = '<?=$arResult['USER_NAME'];?>'; // current user name
var ObjType = '<?=$arResult["OBJECT_TYPE"];?>'; // page or element
var ObjComment = '<?=$arResult['COMMENT_OBJECT'];?>'; // object comment
</script>


<p><?//=GetMessage("MFT_COMMENTS")?></p>

<p>
<button class="like <?if($arResult['CAN_VOTE'] == 'N') echo 'novote';?>"><span><?=$arResult['LIKE_COUNT']?></span></button>
<button class="unlike <?if($arResult['CAN_VOTE'] == 'N') echo 'novote';?>"><span><?=$arResult['UNLIKE_COUNT']?></span></button>
</p>


