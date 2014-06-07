<header class="head">
    <div class="main-bar">
        <div class="container">
            <div class="row">
                <div class="pull-left">
                    <?php
/*                    if (Auth::check() and UserSession::read()->package == 'loan') {
                        echo '<ol class="breadcrumb">';
                        echo(isset($breadcrumb) ? $breadcrumb : '');
                        echo '</ol>';
                    } else {
*/                        echo Breadcrumbs::render();
//                    }
                    ?>
                </div>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li class="active">{{ isset($nowDate)? $nowDate:'' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</header>
