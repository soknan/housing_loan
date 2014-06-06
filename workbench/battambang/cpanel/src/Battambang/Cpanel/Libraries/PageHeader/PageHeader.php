<?php
namespace Battambang\Cpanel\Libraries\PageHeader;

use Closure;

class PageHeader
{
    protected $header = array();

    public function make($name, Closure $callback)
    {
        $builder = new PageHeaderItem();
        $callback($builder);
        $this->header[$name] = $builder->get();
    }

    public function get($name = null)
    {
        if (is_null($name)) {
            $name = \Route::current()->getName();
        }

        if (array_key_exists($name, $this->header)) {
            return $this->header[$name];
        }
        return 'No Page Header!';
    }

} 