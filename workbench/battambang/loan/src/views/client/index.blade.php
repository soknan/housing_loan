@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
    {{$table}}
@stop
@section('js')
<script>

    $(document).ready(function() {

// Support for AJAX loaded modal window.
// Focuses on first input textbox after it loads the window.
       /* $('[data-toggle="modal"]').click(function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            if (url.indexOf('#') == 0) {
                alert('yes');
                $(url).modal('open');
            } else {
                $.get(url, function(data) {
                    alert(data['table']);
                    //$('<div class="modal fade"><div class="modal-dialog"><div class="modal-content"> <div class="modal-body"><p>'data['table']'</p></div> </div></div>').modal();
                   //data['payload'].append.html;
                }).success(function() {  });
            }
        });*/

        initReplaceContent("<?php echo URL::to('loan.clientModel.index'); ?>");
        function initReplaceContent(url){
            $('[data-toggle="modal"]').click(function(){
                getAjaxContent(url);
                $('#modal1').modal();
            });
        }

        function getAjaxContent(url){
            $.ajax({
                url: url,
                data: '',
                dataType: 'html',
                tryCount:0,//current retry count
                retryLimit:3,//number of retries on fail
                timeout: 2000,//time before retry on fail
                success: function(returnedData) {
                    $('#id_content').html(returnedData['payload']);//put the returned html into the div
                },
                error: function(xhr, textStatus, errorThrown) {
                    if (textStatus == 'timeout') {//if error is 'timeout'
                        this.tryCount++;
                        if (this.tryCount < this.retryLimit) {
                            $.ajax(this);//try again
                            return;
                        }
                    }//try 3 times to get a response from server
                }
            });
        );
    })

    </script>
@stop
