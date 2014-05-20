<?php namespace Battambang\Cpanel\Services\Validators;

use Input;
use Validator;

abstract class ValidatorService
{

    /**
     * Validation rules
     * @var array
     */
    public static $rules = array();
    /**
     * custom error messages
     * @var array
     */
    public static $messages = array();
    /**
     * Data to validate
     * @var array
     */
    protected $data;
    /**
     * Validation Errors
     * @var \Illuminate\Support\MessageBag
     */
    private $errors;

    /**
     * [__construct description]
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param  array $data
     */
    public function __construct($data = null)
    {
        $this->data = $data ? : Input::all();
    }

    /**
     * Do the validation
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @return Bool
     */
    public function passes()
    {
        $validation = Validator::make($this->data, static::$rules, static::$messages);

        if ($validation->passes()) return true;

        $this->errors = $validation->messages();

        return false;
    }

    public function fails()
    {
        $validation = Validator::make($this->data, static::$rules, static::$messages);

        if ($validation->fails()) {
            $this->errors = $validation->messages();
            return true;
        }

        return false;
    }

    /**
     * Get the validation errors
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * get the validated data
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

}