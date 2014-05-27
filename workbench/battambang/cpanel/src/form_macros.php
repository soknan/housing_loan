<?php

// Date Picker
Form::macro(
    'datePicker',
    function ($name, $label = null, $value = null, $required = true, $datAttributes = array()) {
        $errors = Session::get('errors', new \Illuminate\Support\MessageBag());

        // Check errors message
        $hasError = '';
        $msgError = '';
        if ($errors->first($name)) {
            $hasError = ' has-error';
            $msgError = '<span class="help-block" >' . $errors->first($name) . '</span >';
        }

        // check required
        $supRequired = '';
        if ($required) {
            $supRequired = '<sup>*</sup>';
            $required = ' required';
        }
        $form = '<div class="form-group' . $required . $hasError . '" >
            <label for="' . $name . '" class="control-label col-lg-2 col-sm-4" >' . $label . $supRequired . '</label >
            <div class="col-lg-10 col-sm-8" >
                <div class="input-group" >';
        $form .= '<input class="form-control"' . $required . ' placeholder = " dd-mm-yyyy" id = "' . $name . '" type = "text"
                           name = "' . $name . '" value = "' . Input::old($name, $value) . '" >
                    <span class="input-group-addon" >
                        <i class="glyphicon glyphicon-calendar"></i>
                    </span >
                </div >
                ' . $msgError . '
            </div >
        </div >';

        return $form . DatePicker::make($name);
    }
);