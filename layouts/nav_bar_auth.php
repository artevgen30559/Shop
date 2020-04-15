<header>
    <div id = "header_wrapper">
        <div id = "log_bar">
        <div id = "log_bar_choice_wrapper">

                <din id = "nav_bar">
                <form action="" method="GET">
                    <button type="submit">Главная</button>
                    <input type="hidden" name="link" value="home">
                </form>
                <form action="" method="GET">
                    <button type="submit">Информация</button>
                    <input type="hidden" name="link" value="info">
                </form>
                <form action="" method="GET">
                    <button type="submit">Контакты</button>
                    <input type="hidden" name="link" value="contacts">
                </form>
                <form action="" method="GET">
                    <button type="submit">Товары</button>
                    <input type="hidden" name="link" value="goods">
                </form>
                <form action="" method="GET">
                    <button type="submit">Корзина</button>
                    <input type="hidden" name="link" value="basket">
                </form>
                <form action="" method="GET">
                    <button type="submit">Профель</button>
                    <input type="hidden" name="link" value="profile">
                </form>

            </din>
            <?php
                if($_SESSION['user_data']['user_status'] == 'admin'){
                ?>
                <form action="" method="GET">
                    <button type="submit">Админ панель</button>
                    <input type="hidden" name="link" value="admin">
                </form>
                <?php
                }
            ?>

            <form action="" method="GET">
                    <button class="submit_button" type="submit">Выход</button>
                    <input type="hidden" name="link" value="exit">
                </form>
            </div>
        </div>
    </div>
</header>