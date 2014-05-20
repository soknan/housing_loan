<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($rpt_title) ? $rpt_title : 'Microfis'; ?></title>
    <?php echo HTML::style('packages/battambang/cpanel/theme/report.css'); ?>
</head>
<body>

<table class="landscape">
    <tr class="header">
        <td>
            <span class="company-name"><?php echo $company_name; ?></span><br>
            <?php echo $rpt_branch; ?><br>
            <?php echo $rpt_name; ?><br>
            <?php echo isset($rpt_date) ? 'Date: ' . $rpt_date . '<br>' : ''; ?>
            <hr class="thin">
        </td>
    </tr>
    <tr>
        <td>
            <table class="page-head-foot">
                <tr>
                    <?php
                    if (isset($rpt_header)) {
                        foreach ($rpt_header as $lists) {
                            echo '<td>';
                            foreach ($lists as $key => $value) {
                                echo $key . ': ' . $value . '<br>';
                            }
                            echo '</td>';
                        }
                    }
                    ?>

                    @yield('rpt_header')

                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>

            @yield('content')

            <!--            <table class="content">-->
            <!--                <thead class="content-head">-->
            <!--                <tr>-->
            <!--                    <td>No</td>-->
            <!--                    <td>Name</td>-->
            <!--                    <td>Sex</td>-->
            <!--                    <td>Salary</td>-->
            <!--                </tr>-->
            <!--                </thead>-->
            <!---->
            <!--                <tbody class="content-body">-->
            <!--                <tr>-->
            <!--                    <td>1</td>-->
            <!--                    <td>Theara</td>-->
            <!--                    <td>Male</td>-->
            <!--                    <td>100</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>1</td>-->
            <!--                    <td>សុខណា</td>-->
            <!--                    <td>Male</td>-->
            <!--                    <td>100</td>-->
            <!--                </tr>-->
            <!--                </tbody>-->
            <!---->
            <!--            </table>-->

        </td>
    </tr>
    <tr>
        <td>
            <table class="page-head-foot">
                <tr>
                    <?php
                    if (isset($rpt_footer)) {
                        foreach ($rpt_footer as $lists) {
                            echo '<td>';
                            foreach ($lists as $key => $value) {
                                echo $key . ': ' . $value . '<br>';
                            }
                            echo '</td>';
                        }
                    }
                    ?>

                    @yield('rpt_footer)'

                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <p></p>
            <table class="footer">
                <tr>
                    <td>
                        Approved By<br><br><br><br><br>
                        __________________<br>
                    </td>
                    <td>
                        Prepared By<br><br><br><br><br>
                        __________________<br>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>