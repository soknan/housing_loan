<?php
namespace Battambang\Cpanel\Libraries;

class ComboAjax
{
    public function loader($type, $source, $event, $destination, $url, $defaultValue = null, $withValue = true)
    {
        $script = '';
        $script
            = '<script>
	$(document).ready(function(){
		$(\'[name="' . $source . '"]\').' . $event . '(function(){
			';

        $script
            .= '
			var htmlVsValue;
			if($(\'[name="' . $destination . '"]\').get(0).tagName==\'INPUT\'){
				htmlVsValue= \'value\';
			}else{
				htmlVsValue=\'html\';
			}
			';
        if ($defaultValue != null) {
            $script
                .= 'if($(this).val()!=\'\'){
				
				';

        }

        if ($type == 'after') {
            $script
                .= '
			var loading = $("<span></span>");
			$(loading).html(" Loading...");
			$(\'[name="' . $destination . '"]\').after(loading);';
        } elseif ($type == 'inner') {
            $script
                .= '
			var loading;
			
			if(htmlVsValue==\'value\'){
				loading = "Loading...";
				$(\'[name="' . $destination . '"]\').val(loading);
			}else{
				loading = "Loading...";
				if($(\'[name="' . $destination . '"]\').get(0).tagName==\'SELECT\'){
					loading = "<option>Loading...</option>";
				}
				
				$(\'[name="' . $destination . '"]\').html(loading);
			}
			';
        }
        $script
            .= '
			$(\'[name="' . $destination . '"]\').attr("disabled","disabled");
			$.ajax({	
				url:\'' . $url . '\'' . ($withValue ? '+ (($(this).val()!=\'\')?(\'/\'+$(this).val()):\'\')' : '') . ',
				success:function(data){
					if(htmlVsValue==\'value\'){
						$(\'[name="' . $destination . '"]\').val(data);
					}else{
						$(\'[name="' . $destination . '"]\').html(data);
					}
					
					$(\'[name="' . $destination . '"]\').removeAttr("disabled");';
        if ($type == 'after') {
            $script
                .= '
					$(\'[name="' . $destination . '"]\').next("span").remove();';
        }


        $script
            .= '
				}
			});
		';
        if ($defaultValue != null) {
            $script
                .= '
				
			}else{
			
				if(htmlVsValue==\'value\'){
					$(\'[name="' . $destination . '"]\').val(\'' . $defaultValue . '\');
				}else{
					$(\'[name="' . $destination . '"]\').html(\'' . $defaultValue . '\');
				}
				
			}';
        }
        $script
            .= '
		});
});
</script>';


        return $script;
    }
}

?>