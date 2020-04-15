<?php

function get_fun_to_admin($connect){
if($_POST['admin__panel'] == 'goods'){
    goods__print($connect);
}elseif($_POST['admin__panel'] == 'red'){
    redactPrise($connect);
}elseif($_POST['admin__panel'] == 'add'){
    addPrise($connect);
}elseif($_POST['admin__panel'] == 'users'){
    printUser($connect);
}elseif($_POST['admin__panel'] == 'static'){
    printPeriod($connect);
}

if(isset($_POST['database'])){
  upDdataPrise($connect);
}elseif(isset($_POST['sum__tread'])){
  printSum($connect);
}
}

function database($connect, $table) {

  $query = 'SELECT * FROM '.$table;

  $result = mysqli_fetch_all(mysqli_query($connect,$query), MYSQLI_NUM);
  return $result;
}

function goods__print($connect) {
  $goods_list = database($connect, 'prise');
  echo '<table class="tabal__goods" cols="6">
          <tr>
              <td> id </td>
              <td> # </td>
              <td> Названия </td>
              <td> Катигория </td>
              <td> Подкатигория </td>
              <td> Цена </td>
              <td> Кол-во </td>
              <td>  </td>
              <td></td>
          </tr>';

  for ($i = 0; $i < count($goods_list); $i++) { 
        echo 
        '           
        <tr>
        <td> '.$goods_list[$i][0].'</td>
        <td> '.$goods_list[$i][1].'</td>
        <td> '.$goods_list[$i][4].'</td>
        <td> '.category($goods_list[$i][2]).'</td>
        <td> '.subCategory($goods_list[$i][3]).'</td>
        <td> '.$goods_list[$i][6].'</td>
        <td> '.$goods_list[$i][5].'</td>
        <td>  
          <form method="POST">
              <button class="green-btn" type="submit">Редактировать</button>
              <input type="hidden" name="admin__panel" value="red">
              <input type="hidden" name="goods__id" value="'.$goods_list[$i][0].'">
          </form>
        </td>
        <td>
          <form method="POST">
            <button class="red-btn" style="width: 100%;" type="submit" name="database" value="delsave">Удалить</button>
            <input  type="hidden" name="goods__id" value="'.$goods_list[$i][0].'">
          </form>
        </td>
      </tr>
      ';
    }
    echo '
    <tr>
    <td colspan="9" align="center">
      <form method="POST">
        <button class="green-btn" type="submit" name="admin__panel" value="add">Добавить товар</button>
      </form>
      </td>
    </tr>
    </table>';
}

function category($el){
  if($el == 'tea'){
      $name = 'Чай';
  } else{
      $name = 'Кофе';
  }
  return $name;
}

function subCategory($el){
  if($el == 'ruusa'){
      $name = 'Россия';
  } elseif($el == 'usa'){
      $name = 'Америка';
  }else{
      $name = 'Чехия';
  }
  return $name;
}


function redactPrise($connect){
  $query = 'SELECT * FROM prise WHERE id = \''.$_POST['goods__id'].'\'';
  $result = mysqli_fetch_assoc(mysqli_query($connect, $query));

  echo '<form method="POST">
          <table>
              <input type="hidden" name="admin__panel" value="goods">
              <input type="hidden" name="goods__id" value ="'.$result['id'].'">
            <tr><td>  
              <labal>Называние:</labal>
            </td>
            <td>
              <input type="text" name="goods__name" value="'.$result['name'].'">
            </td></tr>  
             <tr><td>
              <labal>Категория:</labal>
            </td>
            <td>
              <select name="goods__categories">
                  <option '.selected($result['categories'], 'coffee').'value="coffee">Кофе</option>
                  <option '.selected($result['categories'], 'tea').'value="tea">Чай</option>
              </select>
            </td></tr>
            <tr><td>  
              <labal>Странна:</labal>
            </td>
            <td>
              <select name="goods__subCategories">
                  <option '.selected($result['underСategories'], 'usa').'value="usa">Америка</option>
                  <option '.selected($result['underСategories'], 'ruusa').'value="ruusa">Россия</option>
                  <option '.selected($result['underСategories'], 'prague').'value="prague">Чехия</option>
              </select>
            </td></tr><tr><td>  
              <labal>Цена:</labal>
            </td>
            <td>
              <input type="text" name="goods__cost" value="'.$result['cost'].'">
            </td></tr><tr><td>  
              <labal>Кол-во:</labal>
            </td>
            <td>
              <input type="text" name="goods__value" value="'.$result['value'].'">
            </td></tr>

        <table>
        <tfoot>
    
        <button class="red-btn" style="width: 50%;" type="submit" name="database" value="delsave">Удалить</button>
        
        <button  class="green-btn" style="width: 50%;" type="submit" name="database" value="save">Сохранить</button>
        </tfoot>
      </form>';
}

function selected($atr, $value){
  if($atr == $value){
      return ' selected ';
  }
}

function addPrise(){
  echo '<form method="POST">
          <table>
              <tr><td>  
              <labal>Номер товара:</labal>
            </td>
            <td>
              <input type="text" name="goods__num" value="">
            </td></tr>  
              <tr><td>  
              <labal>Называние:</labal>
            </td>
            <td>
              <input type="text" name="goods__name" value="">
            </td></tr>  
             <tr><td>
              <labal>Категория:</labal>
            </td>
            <td>
              <select name="goods__categories">
                  <option value="coffee">Кофе</option>
                  <option value="tea">Чай</option>
              </select>
            </td></tr>
            <tr><td>  
              <labal>Странна:</labal>
            </td>
            <td>
              <select name="goods__subCategories">
                  <option value="usa">Америка</option>
                  <option value="ruusa">Россия</option>
                  <option value="prague">Чехия</option>
              </select>
            </td></tr><tr><td>  
              <labal>Цена:</labal>
            </td>
            <td>
              <input type="text" name="goods__cost" value="">
            </td></tr><tr><td>  
              <labal>Кол-во:</labal>
            </td>
            <td>
              <input type="text" name="goods__value" value="">
            </td></tr>

        <table>
        <tfoot>
        <tr>
        <td>  
        <button  class="green-btn" style="width: 100%;" type="submit"  name="database" value="add">Добавить</button>
        </td>
        </tr>
        </tfoot>
      </form>';
}

function printUser($connect){
   $users = database($connect, 'users');
  echo '<table class="tabal__goods" cols="6">
          <tr>
              <td> id </td>
              <td> Логин </td>
              <td> Баланс </td>
              <td> Статус </td>
              <td></td>
              <td></td>
          </tr>';

  for ($i = 0; $i < count($users); $i++) { 
        echo 
        '           
        <tr>
        <td> '.$users[$i][0].'</td>
        <td> '.$users[$i][1].'</td>
        <td> '.$users[$i][3].'</td>
        <td> '.$users[$i][5].'</td>
        <td>  
          <form method="POST">';
          if($users[$i][5] != 'admin'){
            echo'
              <button class="green-btn" style="width: 100%;" type="submit" name="database" value="delsave">Назначить Админестратором</button>
              <input  type="hidden" name="user__id" value="'.$users[$i][0].'">
              <input  type="hidden" name="database" value="user__res">
              <input  type="hidden" name="admin__panel" value="users">
              <input  type="hidden" name="user__status" value="admin">';
              
              }else{
              echo '<button class="red-btn" style="width: 100%;" type="submit" name="database" value="delsave">Разжаловать</button>
                    <input  type="hidden" name="user__id" value="'.$users[$i][0].'">
                    <input  type="hidden" name="database" value="user__res">
                    <input  type="hidden" name="admin__panel" value="users">
                    <input  type="hidden" name="user__status" value="user">';
                  }
          echo'</form>
        </td>
        <td>
          <form method="POST">';
          
          if($users[$i][5] != 'ban'){
          echo'
            <button class="red-btn" style="width: 100%;" type="submit" name="database" value="delsave">Заблокировать</button>
            <input  type="hidden" name="user__id" value="'.$users[$i][0].'">
            <input  type="hidden" name="admin__panel" value="users">
            <input  type="hidden" name="database" value="user__res">
            <input  type="hidden" name="user__status" value="user">';
            
            }else{
            echo '<button class="green-btn" style="width: 100%;" type="submit" name="database" value="delsave">Разблокировать</button>
                  <input  type="hidden" name="user__id" value="'.$users[$i][0].'">
                  <input  type="hidden" name="database" value="user__res">
                  <input  type="hidden" name="admin__panel" value="users">
                  <input  type="hidden" name="user__status" value="ban">';
                }
          echo '</form>
              </td>
            </tr>
            ';
          }
  echo '<tr>
        <td colspan="6" align="center">
        <form method="POST">
          <button class="green-btn" type="submit" name="admin__panel" value="add">Добавить товар</button>
        </form>
        </td>
      </tr>
      </table>';
  }

function printPeriod($connect){
$query ='SELECT MIN(tread_data),MAX(tread_data) FROM tread';
$result = mysqli_fetch_all(mysqli_query($connect, $query));


$minDate = new DateTime($result[0][0]);
$minDate = $minDate->format('Y-m');
$maxDate = new DateTime($result[0][1]);
$maxDate = $maxDate->format('Y-m');

echo '<form method="POST">
        <input type="hidden" name="admin__panel" value="static">
        <table>
        <tr>
        <td>
        C: <input type="month" name="min__date" max="'.$maxDate.'" min="'.$minDate.'">
        </td>
        <td>
        По: <input type="month" name="max__date" max="'.$maxDate.'" min="'.$minDate.'">
        </td>
        <td>
        <button type="submit" name="sum__tread">Расчитать</button>
        </td>
        </tr>
        </form>
        </table>';

}

function printSum($connect){
  $sum = 0;
  $maxDate = $_POST['max__date'];
  $minDate = $_POST['min__date'];

  if($maxDate == $minDate){
    $minPref = '-00';
    $maxPref = '-32';
  }else{
    $minPref = '-00';
    $maxPref = '-00';
  }

  $query = 'SELECT * FROM tread WHERE tread_data BETWEEN \''.$minDate.$minPref.'\' AND \''.$maxDate.$maxPref.'\'';
  $result = mysqli_fetch_all(mysqli_query($connect, $query));

  echo '
  <table>
  <tr>
  <td>id</td>
  <td>Пользователь</td>
  <td>Товар</td>
  <td>Кол-во</td>
  <td>Цена</td>
  <td>Дата</td>
  <tr>';
  for($i=0; $i < count($result); $i++){
    echo'
    <tr>
    <td>'.$result[$i][0].'</td>
    <td>'.$result[$i][1].'</td>
    <td>'.$result[$i][2].'</td>
    <td>'.$result[$i][3].'</td>
    <td>'.$result[$i][4].'</td>
    <td>'.date('d-', strtotime($result[$i][5])).month_ru(date('F', strtotime($result[$i][5]))).date('-Y в H:i:s', strtotime($result[$i][5])).'</td>
    <tr>';
    $sum = $sum + $result[$i][3] * $result[$i][4];
  }
  echo '
    <tr>

    <td rowspan="4">
    Сумма: 
  '.$sum.'
    </td></tr>
  </table>';

}

function upDdataPrise($сonnect){

    if($_POST['database'] == 'save'){
      $query = 'UPDATE prise 
                SET categories=\''.$_POST['goods__categories'].'\'  ,
                    underСategories=\''.$_POST['goods__subCategories'].'\' ,
                    name=\''.$_POST['goods__name'].' \' ,
                    cost=\''.$_POST['goods__cost'].' \' ,
                    value=\''.$_POST['goods__value']. '\' 
                      WHERE id = \''.$_POST['goods__id'].'\'';
    }elseif($_POST['database'] == 'dell'){
      $query = 'DELETE FROM prise WHERE id = \''.$_POST['goods__id'].'\'';
    }elseif($_POST['database'] == 'add'){
      $query = "INSERT INTO prise VALUES (NULL,'".$_POST['goods__num']."','".$_POST['goods__categories']."','".$_POST['goods__subCategories']."','".$_POST['goods__name']."','".$_POST['goods__cost']."','".$_POST['goods__value']."')";
    }elseif($_POST['database'] == 'user__res'){
      $query = 'UPDATE users 
                  SET user_status =\''.$_POST['user__status'].'\'
                  WHERE user_id = \''.$_POST['user__id'].'\''; 
    }
    mysqli_query($сonnect,$query) or die(mysqli_error($сonnect));  
  
 }

?>