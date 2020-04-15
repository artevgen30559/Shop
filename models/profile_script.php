<?php


function check_balans($connect){
    $balance_query = "SELECT user_balance FROM users WHERE user_id = '".$_SESSION['user_data']['user_id']."'";
    $result = mysqli_fetch_assoc(mysqli_query($connect,$balance_query));
    return $result['user_balance'];
}

function goods_list($connect) {
    $goods_query = "SELECT * FROM tread WHERE user_id = '".$_SESSION['user_data']['user_id'] ."'";
    $result = mysqli_query($connect,$goods_query);
    $result_arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $i = 1;
    foreach ($result_arr as $key => $value) {
        echo "<p class =\"goods_list_row\">";
        echo "<b>$i</b>&nbsp;";
        $i++;
        good_cat ($result_arr[$key],$connect);
        echo '</p>';
    }
}

function good_cat ($aray, $connect) {
    foreach ($aray as $k => $v)
        if($k === 'prise_id') {
            $query = "SELECT * FROM prise WHERE id = '".$v."'";
            $result = mysqli_fetch_assoc(mysqli_query($connect, $query));
            echo "<b> Наименования товара:<b>&nbsp;{$result['name']}&nbsp;";
        }elseif($k === 'prise_value'){
            echo "<b>Количество товара:</b>&nbsp;{$v};&nbsp;";
        }elseif($k === 'tread_const'){
            echo "<b>Стоимось покупки:</b>&nbsp;{$v};&nbsp;";
        }elseif($k === 'tread_data'){
           echo "<b>Дата покупки:</b>&nbsp;".date('d-', strtotime($v)).month_ru(date('F', strtotime($v))).date('-Y в H:i:s', strtotime($v)).";&nbsp;";
        }
}
?>