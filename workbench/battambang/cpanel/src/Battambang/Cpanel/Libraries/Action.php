<?php
namespace Battambang\Cpanel\Libraries;


class Action
{
    private $actionItem = array();

    public static function make()
    {
        return new self;
    }

    /**
     * @param string $url
     * @param bool $output
     * @return $this
     */
    public function edit($url, $validator = true)
    {
        if ($validator) {
            $this->actionItem[] = '<li><a href="' . $url . '">Edit</a></li>';
        }
        return $this;
    }

    /**
     * @param string $url
     * @param string $item
     * @param bool $output
     * @return $this
     */
    public function delete($url, $item = '', $validator = true)
    {
        if ($validator) {
            $this->actionItem[] = '<li><a class="alert-test" href="' . $url . '" data-method="delete" data-modal-text="delete this item' . (empty($item) ? '' : ' [' . $item . ']' ). ' ?">Delete</a></li>';
//            $this->actionItem[] = '<li><a class="alert-test" href="' . $url . '" data-method="delete" data-modal-text="delete ' . empty($item) ? 'item' : $item . '">Delete</a></li>';
        }

        return $this;
    }

    /**
     * @param string $url
     * @param bool $output
     * @return $this
     */
    public function show($url, $validator = true)
    {
        if ($validator) {
            $this->actionItem[] = '<li><a href="' . $url . '">Show</a></li>';
        }
        return $this;
    }

    /**
     * @param string $url
     * @param string $title
     * @param bool $output
     * @param string $icon
     * @param string $attribute
     * @return $this
     */
    public function custom($url, $title, $validator = true)
    {
        if ($validator) {
            $this->actionItem[] = '<li><a href="' . $url . '">' . $title . '</a></li>';
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function divider()
    {
        $this->actionItem[] = '<li class="divider"></li>';
        return $this;
    }

    /**
     * @param $title
     * @return $this
     */
    public function header($title)
    {
        $this->actionItem[] = '<li class="dropdown-header">' . $title . '</li>';
        return $this;
    }

    /**
     * @return string
     */
    public function get()
    {
        if (count($this->actionItem) == 0) {
            return 'No Action';
        }

        $action = '<div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Action
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">';

        foreach ($this->actionItem as $value) {
            $action .= $value;
        }

        $action .= '</ul></div>';

        return $action;
    }

} 