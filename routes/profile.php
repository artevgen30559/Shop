<?php

include_once "content/page_header.php";
include_once "content/nav_bar.php";

?>
<section>
    <h1>Профель</h1>
    <div class="profile_content">
        <p class="profile_content_p"><b>Логин: </b><?php echo$_SESSION['user_data']['user_login']; ?></p>
        <p class="profile_content_p"><b>Баланс </b><?php echo check_balans($connect); ?></p>
        <p class="profile_content_p"><b>Дата регистрации: </b><?php echo$_SESSION['user_data']['dtat_regist']; ?></p>

    </div>
    <div><h2> Список приобритеных товаров: </h2>
        <?php goods_list($connect);?>
    </div>
</section>
<?php
include_once "content/page_footer.php";

?>