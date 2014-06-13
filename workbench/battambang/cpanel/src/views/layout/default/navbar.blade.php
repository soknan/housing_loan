<!-- Fixed navbar -->
<div id="top">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-inner">
            <div class="container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{ $package}}
                @if (Auth::check())
                <div class="btn-toolbar topnav">
                    <div>
                        <!--                        <a href="{{ route('cpanel.changepwd.index') }}" class="btn btn-default" rel="tooltip" data-placement="bottom"-->
                        <!--                           data-original-title="Change Password" data-toggle="tooltip">-->
                        <!--                        <i class="glyphicon glyphicon-user"></i>-->
                        <!--                        </a>-->
                        <!--                        <a href="#" class="btn btn-default" rel="tooltip" data-placement="bottom"-->
                        <!--                           data-original-title="New Tap" data-toggle="tooltip"-->
                        <!--                           onclick="window.open(document.location,'_blank');return false;">-->
                        <!--                            <i class="glyphicon glyphicon-folder-open"></i>-->
                        <!--                        </a>-->
                        <!-- <a href="#" class="btn btn-default" rel="tooltip" data-placement="bottom"
                            data-original-title="Refresh" data-toggle="modal" onclick="document.location.reload(true);">
                             <i class="glyphicon glyphicon-repeat"></i>
                         </a>-->
                        &nbsp;
                        <!--                        <a href="#helpModal" class="btn btn-default" rel="tooltip" data-placement="bottom" data-original-title="Help" data-toggle="modal">-->
                        <!--                            <i class="glyphicon glyphicon-question-sign"></i>-->
                        <!--                        </a>-->
                        <a class="btn btn-danger" data-placement="bottom" data-original-title="Logout" rel="tooltip"
                           href="{{ route('cpanel.logout')}}">
                            <i class="glyphicon glyphicon-off"></i>
                        </a>
                    </div>
                </div>
                @endif
                <div class="collapse navbar-collapse">
                    <!--                    <ul class="nav navbar-nav">-->
                    <?php
                    if (UserSession::read()->package) {
                        echo Menu::get(array('home', UserSession::read()->package));
                        //if (UserSession::read()->package == 'loan') {
                            echo Menu::get(array('tool'));
                        //}
                    }
                    ?>
                    <!--                    </ul>-->
                    <ul class="nav navbar-nav navbar-right">
                        {{ isset($hiUser) ? $hiUser : '' }}
                    </ul>
                </div>
                <!--/.nav-collapse -->

            </div>
        </div>
    </div>
</div>
<!-- /Fixed navbar -->