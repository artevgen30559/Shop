<?php

include_once "content/page_header.php";
include_once "content/nav_bar.php";

?>
<section>
<?php
if(count($_SESSION['data_user']['basket']['goods_id']) == 0){
    echo 'Корзина пуста';
    echo count($_SESSION['data_user']['basket']['goods_id']);
}else{
    echo count($_SESSION['data_user']['basket']['goods_id']);
    printBasket($connect);
}
for($i=0;$i > count($_SESSION['data_user']['basket']['goods_id']); $i++){
    echo $_SESSION['data_user']['basket']['goods_id'][$i];
    echo $i;
}

?>
</section>
<?php

include_once "content/page_footer.php";
?>