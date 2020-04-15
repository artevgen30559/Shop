<?php


function verify_user ($user_data) {
    if (!isset($user_data)) {
        $fold_path = 'all/';
    } else {
        $fold_path = 'auth/';
    }
        return $fold_path;
}

function verify_path () {
    if($_SERVER['REQUEST_URI'] === '/' ) {
        $path_to_dir = '';
    } else {
        $path_to_dir = '../';
    }
    return $path_to_dir;
}

function get_path_to_page () {
    $folder = verify_user($_SESSION['user_data']);
    $dir = verify_path();
    $link = $_GET['link'];
    if(($link == '') || (!isset($link))) {
        $path_to_page = $folder.'/home.php';
    } elseif((isset($link)) && ($link !== 'exit')) {
        $path_to_page = $folder.$link.'.php';
    } elseif((isset($link)) && ($link === 'exit')) {
        $path_to_page = "all/home.php";
    }
    return $path_to_page;   
}


function page_name () {
    $page_name = $_GET['link'];
    if(isset($page_name) || $page_name === 'home') {
        $page_name = 'Главная страница';
    }elseif($page_name === 'info') {
        $page_name = 'О нас';
    }elseif($page_name === 'contacts') {
        $page_name = 'Контакты';
    }elseif($page_name === 'goods') {
        $page_name = 'Товары';
    }elseif($page_name === 'profile') {
        $page_name = 'Профиль';
    }elseif($page_name === 'admin') {
        $page_name = 'Админ панель';
    }
    return $page_name;
}

function month_ru($month) {
    if($month === 'January') $month = 'Января';
    elseif($month === 'February') $month = 'Февраля';
    elseif($month === 'March') $month = 'Марта';
    elseif($month === 'April') $month = 'Апреля';
    elseif($month === 'May') $month = 'Мая';
    elseif($month === 'June') $month = 'Июня';
    elseif($month === 'July') $month = 'Июля';
    elseif($month === 'August') $month = 'Августа';
    elseif($month === 'September') $month = 'Сентября';
    elseif($month === 'October') $month = 'Октября';
    elseif($month === 'November') $month = 'Нояборья';
    elseif($month === 'December') $month = 'Декабря';
    return $month;

}



function ses_destroy () {
    if($_GET['link'] === 'exit') {
        $_SESSION = [];
        $_GET['link'] = null;
        $_POST = null;
        unset($_COOKIE[session_name()]);
        session_destroy();
        header('Location: /');
    }

}

?>