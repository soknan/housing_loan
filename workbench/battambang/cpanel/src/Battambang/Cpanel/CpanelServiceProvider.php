<?php namespace Battambang\Cpanel;

use Illuminate\Support\ServiceProvider;

class CpanelServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('battambang/cpanel', 'battambang/cpanel');
        \Former::framework('TwitterBootstrap3');
        include __DIR__ . '/../../php_settings.php';
        include __DIR__ . '/../../filters.php';
        include __DIR__ . '/../../routes.php';
        include __DIR__ . '/../../events.php';
        include __DIR__ . '/../../form_macros.php';
        include __DIR__ . '/../../menus.php';
        include __DIR__ . '/../../page_headers.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        // Facade for User Session
        $this->app['usersession'] = $this->app->share(
            function ($app) {
                return new Libraries\UserSession;
            }
        );

//        $this->app->booting(
//            function () {
//                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
//                $loader->alias('UserSession', 'Battambang\Cpanel\Facades\UserSession');
//            }
//        );

        // Facade for GetList
        $this->app['getlists'] = $this->app->share(
            function ($app) {
                return new Libraries\GetLists;
            }
        );

        $this->app->booting(
            function () {
                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
                $loader->alias('GetLists', 'Battambang\Cpanel\Facades\GetLists');
            }
        );

        // Facade for Ajax
        $this->app['combo_ajax'] = $this->app->share(
            function ($app) {
                return new Libraries\ComboAjax;
            }
        );

//        $this->app->booting(
//            function () {
//                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
//                $loader->alias('ComboAjax', 'Battambang\Cpanel\Facades\ComboAjax');
//            }
//        );

        // Facade for AutoCode
        $this->app['autocode'] = $this->app->share(
            function ($app) {
                return new Libraries\AutoCode;
            }
        );

//        $this->app->booting(
//            function () {
//                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
//                $loader->alias('AutoCode', 'Battambang\Cpanel\Facades\AutoCode');
//            }
//        );

        // Facade for Action
        $this->app['action'] = $this->app->share(
            function ($app) {
                return new Libraries\Action();
            }
        );

//        $this->app->booting(
//            function () {
//                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
//                $loader->alias('Action', 'Battambang\Cpanel\Facades\Action');
//            }
//        );


//        $this->app->booting(
//            function () {
//                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
//                $loader->alias('Menu', 'Battambang\Cpanel\Facades\Menu');
//            }
//        );

        // Facade for Report
        $this->app['report'] = $this->app->share(
            function ($app) {
                return new Libraries\Report;
            }
        );

//        $this->app->booting(
//            function () {
//                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
//                $loader->alias('Report', 'Battambang\Cpanel\Facades\Report');
//            }
//        );

        // Facade for FormPanel2
        $this->app['form_panel2'] = $this->app->share(
            function ($app) {
                return new Libraries\FormPanel2;
            }
        );

        // Facade for Currency
        $this->app['currency'] = $this->app->share(
            function ($app) {
                return new Libraries\Currency;
            }
        );

        // Facade for FormerAjax
        $this->app['former_ajax'] = $this->app->share(
            function ($app) {
                return new Libraries\FormerAjax;
            }
        );

        // Facade for Select2
        $this->app['select2'] = $this->app->share(
            function ($app) {
                return new Libraries\Select2;
            }
        );

        // Facade for Date Picker
        $this->app['date_picker'] = $this->app->share(
            function ($app) {
                return new Libraries\DatePicker;
            }
        );

        // Facade for BArray
        $this->app['b_array'] = $this->app->share(
            function ($app) {
                return new Libraries\BArray;
            }
        );

        // Facade for Menu
        $this->app['menu'] = $this->app->share(
            function ($app) {
                return new Libraries\Menu\Menu();
            }
        );

        // Page Header
        $this->app['page-header'] = $this->app->share(
            function ($app) {
                return new Libraries\PageHeader\PageHeader();
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}