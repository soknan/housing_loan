<!--<ul class="nav nav-pills">-->
<!--    <li class="active"><a href="#">Home</a></li>-->
<!--    <li><a href="#">Profile</a></li>-->
<!--    <li><a href="#">Messages</a></li>-->
<!--</ul>-->
<?php
if (!empty($actionBtn)) {
    echo '<p>';
    foreach ($actionBtn as $key => $val) {
        echo '<a class="btn btn-sm btn-primary" href="' . $val . '" role="button">' . $key . '</a>';
    }
    echo '</p>';
}
?>
