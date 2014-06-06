<?php
namespace Battambang\Cpanel\Libraries\PageHeader;


class PageHeaderItem
{
    protected $header;
    protected $icon = null;

    public function add($title, $subTitle = null)
    {
        $iconItem = '';
        if (!is_null($this->icon) or !empty($this->icon)) {
            $iconItem = '<span class="glyphicon glyphicon-' . $this->icon . '"></span> ';
        }
        $this->header = '<div class="page-header"><h3>' . $iconItem . $title . '</h3>' . $subTitle . '</div>';
    }

    public function icon($name)
    {
        $this->icon = $name;
    }

    public function iconLogin()
    {
        $this->icon = 'log-in';
    }

    public function iconBriefcase()
    {
        $this->icon = 'briefcase';
    }

    public function iconHome()
    {
        $this->icon = 'home';
    }

    public function iconList()
    {
        $this->icon = 'list';
    }

    public function iconPlus()
    {
        $this->icon = 'plus';
    }

    public function iconEdit()
    {
        $this->icon = 'edit';
    }
    public function iconBarcode()
    {
        $this->icon = 'barcode';
    }
    public function iconChevronRight()
    {
        $this->icon = 'chevron-right';
    }
    public function iconFloppyDisk()
    {
        $this->icon = 'floppy-disk';
    }

    public function get()
    {
        return PHP_EOL . $this->header . PHP_EOL;
    }
} 