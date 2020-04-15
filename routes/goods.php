<?php

include_once "content/page_header.php";
include_once "content/nav_bar.php";
?>
<section class="categories">
    
<div class="categories__nav">
    <form action="" method="GET" class="categories__item-all">
        <button type="submit">Всё</button>
        <input type="hidden" name="categories" value="all">
        <input type="hidden" name="link" value="goods">
    </form>
    <!-- all__________Sub categories all__________ -->
    <div class="categories__sub-wrapper">
        <div class="categories__sub-all">
            <form action="" method="GET" class="categories__item-all">
                <button type="submit">Кофе</button>
                <input type="hidden" name="categories" value="coffee">
                <input type="hidden" name="link" value="goods">
            </form>

            <form action="" method="GET" class="categories__item-tea">
                <button type="submit">Чай</button>
                <input type="hidden" name="categories" value="tea">
                <input type="hidden" name="link" value="goods">
            </form>   
        </div>
    </div> 
    <!-- ___________________________________________ -->

    <form action="" method="GET" class="categories__item-tea">
        <button type="submit">Чай</button>
        <input type="hidden" name="categories" value="tea">
        <input type="hidden" name="link" value="goods">
    </form> 
      <!-- all__________Sub categories tea__________ -->
    <div class="categories__sub-wrapper">
        <div class="categories__sub-all">
            <form action="" method="GET" class="categories__item-all">
                <button type="submit">Россия</button>
                <input type="hidden" name="categories" value="tea">
                <input type="hidden" name="link" value="goods">
                <input type="hidden" name="sub__categories" value="ruusa">

            </form>

            <form action="" method="GET" class="categories__item-tea">
                <button type="submit">Прага</button>
                <input type="hidden" name="categories" value="tea">
                <input type="hidden" name="link" value="goods">
                <input type="hidden" name="sub__categories" value="prague">

            </form>   
            <form action="" method="GET" class="categories__item-tea">
                <button type="submit">Америка</button>
                <input type="hidden" name="categories" value="tea">
                <input type="hidden" name="link" value="goods">
                <input type="hidden" name="sub__categories" value="usa">

            </form>  
        </div>
    </div>            
    <!-- ___________________________________________ -->
    <form action="" method="GET" class="categories__item-cofee">
        <button type="submit">Кофе</button>
        <input type="hidden" name="categories" value="coffee">
        <input type="hidden" name="link" value="goods">
    </form>
    <!-- all__________Sub categories cofee__________ -->   
    <div class="categories__sub-wrapper">
        <div class="categories__sub-all">
            <form action="" method="GET" class="categories__item-all">
                <button type="submit">Россия</button>
                <input type="hidden" name="categories" value="coffee">
                <input type="hidden" name="link" value="goods">
                <input type="hidden" name="sub__categories" value="ruusa">

            </form>

            <form action="" method="GET" class="categories__item-tea">
                <button type="submit">Прага</button>
                <input type="hidden" name="link" value="goods">
                <input type="hidden" name="categories" value="coffee">
                <input type="hidden" name="sub__categories" value="prague">

            </form>   
            <form action="" method="GET" class="categories__item-tea">
                <button type="submit">Америка</button>
                <input type="hidden" name="link" value="goods">
                <input type="hidden" name="categories" value="coffee">
                <input type="hidden" name="sub__categories" value="usa">

            </form>  
        </div>
    </div>
    <!-- ___________________________________________ -->
    
      

</section>

<section>
    <h1>Список товаров</h1>
    <div id="goods_wrapper">
    <?php goods_print($connect)?> 
    </div>
</section>
<?php
include_once "content/page_footer.php";
?>