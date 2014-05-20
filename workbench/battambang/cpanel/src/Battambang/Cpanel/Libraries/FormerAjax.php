<?php
namespace Battambang\Cpanel\Libraries;

/**
 * Created by PhpStorm.
 * User: Theara-CBIRD
 * Date: 3/31/14
 * Time: 2:42 PM
 */
class FormerAjax
{
    private $formID;
    private $selectorId;
    private $event;
    private $url;

//    public function __construct($formId = '', $selectorId = '', $event = '', $url = '')
//    {
//        $this->formID = $formId;
//        $this->selectorId = $selectorId;
//        $this->event = $event;
//        $this->url = $url;
//    }

    /**
     * @param $formId
     * @param $selectorId
     * @param $event
     * @param $url
     * @return $this
     */
    public function make($formId, $selectorId, $event, $url)
    {
        $this->formID = $formId;
        $this->selectorId = $selectorId;
        $this->event = $event;
        $this->url = $url;
        return $this;
//        return new self($formId, $selectorId, $event, $url);
    }

    /**
     * @param array $success
     * @param array $before
     * @param array $after
     * @return string
     */
    public function getChange($success = array(), $before = array(), $after = array())
    {
        // Success Data
        $beforeSendData = '';
        $completeData = '';
        $successData = '';
        foreach ($success as $key => $value) {
            $beforeSendData .= '$("#' . $key . '").css("background-color", "#eee");';
            $completeData .= '$("#' . $key . '").removeAttr("style");';
            $successData .= '$("#' . $key . '").' . str_replace('|', '.', $value) . ';';
        }

        // Before Send Data
        foreach ($before as $key => $value) {
            $beforeSendData .= '$("#' . $key . '").' . str_replace('|', '.', $value) . ';';
        }

        // Complete Data
        foreach ($after as $key => $value) {
            $completeData .= '$("#' . $key . '").' . str_replace('|', '.', $value) . ';';
        }

        return '<script>
            $("#' . $this->selectorId . '").' . $this->event . '(function () {
                $.ajax({
                    type: "POST",
                    url: "' . $this->url . '",
                    data: $("#' . $this->formID . '").serialize(),
                    dataType: "json",
                    beforeSend: function () {
                        ' . $beforeSendData . '
                    },
                    complete: function () {
                        ' . $completeData . '
                    },
                    success: function (data) {
                        ' . $successData . '
                    }
                });
                return false;
            });
        </script>';
    }

    /**
     * @param $alertID
     * @param $alertData
     * @return string
     */
    public function getSave($alertID, $alertData)
    {
        return '<script>
            $("#' . $this->selectorId . '").' . $this->event . '(function () {
                $.ajax({
                    type: "POST",
                    url: "' . $this->url . '",
                    data: $("#' . $this->formID . '").serialize(),
                    dataType: "json",
                    beforeSend: function () {
                        $("div.has-error").attr("class", "form-group");
                        $("span.help-block").remove();
                        $("#' . $alertID . '").css("display", "block");
                    },
                    complete: function () {

                    },
                    success: function (data) {
                        if (data.success == false) {
                            $("#' . $alertID . '").attr("class", "alert alert-danger");
                            $("#' . $alertID . '").' . $alertData . ';
                            var errors = data.errors;
                            $.each(errors, function (index, value) {
                                if (value.length != 0) {
                                    var $selector = $("#" + index);
                                    $selector.after("<span class=\"help-block\">" + value + "</span>");
                                    $selector.parent("div").parent("div").attr("class", "form-group has-error");
                                }
                            });
                        } else {
                            $("#' . $alertID . '").attr("class", "alert alert-success");
                            $("#' . $alertID . '").' . $alertData . ';
                            //$("#' . $this->formID . '")[0].reset();
                        }
                    }
                });
                return false;
            });
        </script>';
    }

    /**
     * @param $alertID
     * @param $alertData
     * @param array $success
     * @param array $before
     * @param array $after
     * @return string
     */
    public function getConfirm($alertID, $alertData, $success = array(), $before = array(), $after = array())
    {
        // Success Data
        $successData = '';
        foreach ($success as $key => $value) {
            $successData .= '$("#' . $key . '").' . str_replace('|', '.', $value) . ';';
        }

        // Before Send Data
        $beforeSendData = '';
        foreach ($before as $key => $value) {
            $beforeSendData .= '$("#' . $key . '").' . str_replace('|', '.', $value) . ';';
        }
        // Complete Data
        $completeData = '';
        foreach ($after as $key => $value) {
            $completeData .= '$("#' . $key . '").' . str_replace('|', '.', $value) . ';';
        }

        return '<script>
            $("#' . $this->selectorId . '").' . $this->event . '(function () {
                $.ajax({
                    type: "post",
                    url: "' . $this->url . '",
                    data: $("#' . $this->formID . '").serialize(),
                    dataType: "json",
                    beforeSend: function () {
                        $("div.has-error").attr("class", "form-group");
                        $("span.help-block").remove();
                        $("#' . $alertID . '").css("display", "block");
                        ' . $beforeSendData . '
                    },
                    complete: function () {

                    },
                    success: function (data) {
                        if (data.success == false) {
                            $("#' . $alertID . '").attr("class", "alert alert-danger");
                            $("#' . $alertID . '").' . $alertData . ';
                            var errors = data.errors;
                            $.each(errors, function (index, value) {
                                if (value.length != 0) {
                                    var $selector = $("#" + index);
                                    $selector.after("<span class=\"help-block\">" + value + "</span>");
                                    $selector.parent("div").parent("div").attr("class", "form-group has-error");
                                }
                            });
                        } else {
                            $("#' . $alertID . '").attr("class", "alert alert-warning");
                            $("#' . $alertID . '").' . $alertData . ';
                            ' . $successData . '
                            ' . $completeData . '
                        }
                    }
                });
                return false;
            });
        </script>';
    }

    /**
     * @param $alertID
     * @param $alertData
     * @param $openUrl
     * @param string $target
     * @return string
     */
    public function getGo($alertID, $alertData, $openUrl, $target = '_self')
    {
        return '<script>
            $("#' . $this->selectorId . '").' . $this->event . '(function () {
                $.ajax({
                    type: "post",
                    url: "' . $this->url . '",
                    data: $("#' . $this->formID . '").serialize(),
                    dataType: "json",
                    beforeSend: function () {
                        $("div.has-error").attr("class", "form-group");
                        $("span.help-block").remove();
                        $("#' . $alertID . '").css("display", "block");
                    },
                    complete: function () {

                    },
                    success: function (data) {
                        if (data.success == false) {
                            $("#' . $alertID . '").attr("class", "alert alert-danger");
                            $("#' . $alertID . '").' . $alertData . ';
                            var errors = data.errors;
                            $.each(errors, function (index, value) {
                                if (value.length != 0) {
                                    var $selector = $("#" + index);
                                    $selector.after("<span class=\"help-block\">" + value + "</span>");
                                    $selector.parent("div").parent("div").attr("class", "form-group has-error");
                                }
                            });
                        } else {
                            window.open("' . $openUrl . '", "' . $target . '");
                        }
                    }
                });
                return false;
            });
        </script>';
    }
}