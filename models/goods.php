<?php

function goods_data($connect) {
    //Лучше сделать на кейсах - безопасность 
    $cat = '';
    if(($_GET['categories'] != 'all') || (!isset($_GET['categories']))){
        $cat = ' WHERE categories=\'' . $_GET['categories'] . '\'';
        if(isset($_GET['sub__categories'])){                                    
            $cat = $cat .' AND underСategories=\'' .$_GET['sub__categories']. '\'';
        }
    }
    else{
        $cat = '';
    }
    $query = 'SELECT * FROM prise' . $cat;

    $result = mysqli_fetch_all(mysqli_query($connect,$query), MYSQLI_NUM);
    return $result;
}

function goods_print($connect) {
    $goods_list = goods_data($connect);
    for ($i = 0; $i < count($goods_list); $i++) { 
         echo 
         "<form class=\"goods_item_wrapper\" action=\"\" method=\"POST\">
         <div id=\"goods_img\">
         <P class=\"goods_img_name\">Фото&nbsp;".$goods_list[$i][4]."</P>
         </div>
         <h3 class=\"goods_name\"><b>".$goods_list[$i][4]."</b>&nbsp;</h3>
         <p class=\"goods_cost\"><b>Цена: </b>".$goods_list[$i][5]."&nbsp;RUB</p>
         <p class=\"goods_value\"><b>Осталось:</b>".$goods_list[$i][6]." штку</p>
         <input type=\"hidden\" name=\"goods_id\" value=\"".$goods_list[$i][0]."\">
         <div class=\"value_of_goods\">
             <p>Укажите количество товара:</p>
             <input type=\"number\" name=\"value_of_goods\" min=\"1\" value=\"1\">
         </div>
         <button type=\"submit\" name=\"buy_goods\" value=\"buy_goods\">Купить</button>
         <button type=\"submit\" name=\"buy_goods\" value=\"basket\">Добавить в корзину</button>
     </form>";
    }
}

function buy_goods($connect) {
    if((isset($_POST['buy_goods'])) && (isset($_POST['goods_id'])) && (isset($_POST['value_of_goods']))) {
        $query = "SELECT * FROM users WHERE user_id = '".$_SESSION['user_data']['user_id']."'";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
        $result = mysqli_fetch_assoc($result);
        $balance = $result['user_balance'];
        $treade_date = date('Y-m-d H:i:s');
        
        $item_query = "SELECT * FROM prise WHERE id = '".$_POST['goods_id']."'";
        $result = mysqli_query($connect, $item_query) or die(mysqli_error($connect));
        $result = mysqli_fetch_assoc($result);
        $cost = $result['cost'];
        $item_value = $result['value'];
        if((isset($_POST['value_of_goods'])) && ($_POST['value_of_goods'] > 0)) {
            $goods_value = (double)$_POST['value_of_goods'];
        }else{
            $goods_value  = 0;
        }
        $tread_cost = $cost * $goods_value;

        if(($goods_value <= $item_value) && ($balance >= $tread_cost) && ($goods_value > 0)) {
            $tread_query = "INSERT INTO tread VALUES (NULL, '".$_SESSION['user_data']['user_id']."','".$_POST['goods_id']."','".$goods_value."','".$tread_cost."','".$treade_date."')";
            $treade_reulte = mysqli_query($connect, $tread_query) or die(mysqli_error($connect));
            $new_user_balanse = $balance - $tread_cost;
            $balance_query = "UPDATE users SET user_balance = '".$new_user_balanse."' WHERE users.user_id = '".$_SESSION['user_data']['user_id']."'";
            $balance_result = mysqli_query($connect, $balance_query) or die(mysqli_error($connect));
            $new_goods_value = $item_value - $goods_value;
            $goods_query = "UPDATE prise SET value = '".$new_goods_value."' WHERE prise.id = '".$_POST['goods_id']."'";
            $goods_result = mysqli_query($connect, $goods_query) or die(mysqli_error($connect));

            unset($_POST['buy_goods']);
            unset($_POST['goods_id']);
            unset($_POST['value_of_goods']);


        }
    }
}

if($_POST['buy_goods'] == 'basket'){
    basket();
}elseif($_POST['basket'] == 'del'){
    dellBasket();
}



function basket(){
    $foo = true;
    $idBasket = $_SESSION['data_user']['basket']['goods_id'];
    $valueBasket = $_SESSION['data_user']['basket']['goods_value'];
    
    if(count($idBasket) == 0){
        echo 'idBasket';
        $idBasket[]= $_POST['goods_id'];
        $valueBasket[] = $_POST['value_of_goods'];
    }else{
        echo 'idBasket1';
        for($i=0; $i <count($idBasket); $i++){
            if($idBasket[$i] == $_POST['goods_id']){
                $foo = false;
                return $valueBasket[$i] = $valueBasket[$i] + $_POST['value_of_goods'];
            }
            if($foo){
                $idBasket[] = $_POST['goods_id'];
                $valueBasket[] = $_POST['value_of_goods'];
            }
        }
    }
}

function dellBasket(){
    echo 'dellBasket';
    unset($_SESSION['data_user']['basket']['goods_id'][intval($_POST['basket__num'])]);
    sort($_SESSION['data_user']['basket']['goods_id']);
    unset($_SESSION['data_user']['basket']['goods_value'][intval($_POST['basket__num'])]);
    sort($_SESSION['data_user']['basket']['goods_value']);

}

function printBasket($connect){
    $idBasket = $_SESSION['data_user']['basket']['goods_id'];
    $valueBasket = $_SESSION['data_user']['basket']['goods_value'];

    $query = 'SELECT * FROM prise WHERE id IN (';

    
    for($i=0; $i<count($idBasket); $i++){
        if($i == count($idBasket) -1){
            $foo = '';
        }else{
            $foo =',';
        }
        $query = $query.$idBasket[$i].$foo;    
    }
    $query = $query.')';
    echo $query;
    $result = mysqli_fetch_all(mysqli_query($connect,$query));
    $sum = 0;
    echo '<table class="tabal__goods" cols="6">
    <tr>
        <td> id </td>
        <td> Названия </td>
        <td> Катигория </td>
        <td> Цена </td>
        <td> Кол-во </td>
        <td> Итог </td>
        <td></td>
    </tr>';


    for ($i = 0; $i < count($result); $i++) { 
        echo 
        '      
        <tr>
        <td> '.$result[$i][0].'</td>
        <td> '.$result[$i][4].'</td>
        <td> '.$result[$i][2].'</td>
        <td> '.$result[$i][5].'</td>
        <td> '.$valueBasket[$i].'</td>
        <td> '.$result[$i][5] * $valueBasket[$i].'</td>
        
        <td>
          <form method="POST">
            <input type="hidden" name="basket__num" value="'.$i.'">   
            <button class="red-btn" style="width: 100%;" type="submit" name="basket" value="del">Удалить</button>
          </form>
        </td>
      </tr>
      ';

      $sum = $sum + $result[$i][5] * $valueBasket[$i];
    }
    echo '
    <tr>
    <td colspan="6" align="right">
        Итог:'.$sum.'
    </td>
    <td colspan="1" align="center">
      <form method="POST">
        <button class="green-btn" type="submit" name="basket" value="bay">Купиь</button>
      </form> 
      </td>
    </tr>
    </table>';
}

?>