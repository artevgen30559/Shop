<header>
    <div id = "header_wrapper">
        <div id = "log_bar">
            <div id = "log_bar_wrapper">
                <?php include_once "login_reg.php" ?>

            </div>
            
        </div>
    <din id = "nav_bar">
            <form action="" method="POST">
                <button type="submit">Главная</button>
                <input type="hidden" name="link" value="home">
            </form>
            <form action="" method="POST">
                <button type="submit">Информация</button>
                <input type="hidden" name="link" value="info">
            </form>
            <form action="" method="POST">
                <button type="submit">Контакты</button>
                <input type="hidden" name="link" value="contacts">
            </form>
        </din>
    </div>
</header> 