<header class="head">
    <div class="main-bar">
        <div class="container">
            <div class="row">
                <div class="pull-left">
<!--                    --><?php //echo Breadcrumbs::render(); ?>
                    <ol class="breadcrumb">
                        <!--<li><a href="#">Home</a></li>
                        <li><a href="#">Library</a></li>
                        <li class="active">Data</li>-->
                        {{ isset($breadcrumb)? $breadcrumb:''}}
                    </ol>
                </div>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li style="color: #999">{{ isset($nowDate)? $nowDate:'' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</header>
