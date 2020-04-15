<?php

include_once "content/page_header.php";
include_once "content/nav_bar.php";
include_once "admin/nav_admin.php";
include "script/admin.php";
?>
<div class="table__panel">
<?php

get_fun_to_admin($connect);


?>
</div>
<?php
include_once "content/page_footer.php";

?>