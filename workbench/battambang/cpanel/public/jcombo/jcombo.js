$(document).ready(function(e) {
	render_combo($(".select_combo"));
	
});
function render_combo(combo){ 
	
		
	$(combo).mousedown(function(e){//alert("run");
	
		try{
			var tmp = $(this).attr("multiple");
			if(tmp=='multiple'){
				return true;
			}
		}catch(error){
			
		}
		if($(this).attr('readonly')=='readonly'){			
			return false;
		}
		if($(this).nextAll("input").length>0){
			
			$(this).nextAll("input").blur();
			return false;
		}
		
		//alert($(this).nextAll("input").length);
		var each_combo = $(this);		
			
			var txt = $("<input>");
			$(txt).addClass(".txt");
			$(txt).attr({
				type:"text",
				value:$(each_combo).children("option:selected").text()
			});
			$(txt).css({			
				height:$(each_combo).height(),
				width:$(each_combo).width()-22,
				position:'absolute',
				top:$(each_combo).offset().top+1,
				left:$(each_combo).offset().left+1,
				border:'none',
				textIndent:3,
				paddingLeft:3,
				
				
				backgroundColor:$(each_combo).css('backgroundColor'),
				color:$(each_combo).css('color'),
				fontSize:(parseInt($(each_combo).css('fontSize'))-1)+'px',
				fontFamily:$(each_combo).css('fontFamily')
				
			});
			
			
			//add event to textbox
			$(txt).keyup(function(e){
				var str = $(this).val();
				var tmp = $(this).prev(".div_items").children("table"); 
				$(tmp).children("tbody").children("tr").each(function(index, element) {
					if($(element).html().toLowerCase().indexOf(str.toLowerCase())==-1){
						$(this).hide();		
					}else{
						$(this).show();		
					}
				});
			});
			//end add event to textbox
			
			$(each_combo).after(txt);
			
			//add div of items
			var div_items = $("<div>");
			$(div_items).css({
				position:'absolute',
				backgroundColor:'white',
				minWidth:$(each_combo).outerWidth(),
				border:'solid 1px #d1d1d1',
				
				backgroundColor:$(each_combo).css('backgroundColor'),
				color:$(each_combo).css('color'),
				fontSize:$(each_combo).css('fontSize'),
				fontFamily:$(each_combo).css('fontFamily')
				
			});
			
				//generate items from combo
				var table = $("<table>");
				$(table).css({
					width:'100%',
					
				});
				$(table).attr({
					cellpadding:'0',
					cellspacing:'0'
				});
				$(each_combo).children("option").each(function (opt_index,opt){
					
					var tr = $("<tr>");
					
					var opt_text = $(opt).text();
					
					if(opt_text.indexOf("||")>=0){
						while(opt_text.indexOf("||")>=0){
							opt_text = opt_text.replace("|","</u></b></td>");
							opt_text = opt_text.replace("|","<td><b><u>");
						}
						opt_text = "<td><b><u>"+opt_text+"</u></b></td>";
						
					}else{
						if(!(opt_text.indexOf("|")>=0)){
							opt_text = "<td colspan='10'>"+opt_text+"</td>";
						}else{
							var pt = new RegExp("[|]","g");
							opt_text = opt_text.replace(pt,"</td><td>");
							opt_text = "<td>"+opt_text+"</td>";
						}
						
						$(tr).hover(function(){
							$(".item_hover").removeClass("item_hover");
							$(tr).addClass("item_hover")},function(){$(tr).removeClass("item_hover")});
						$(tr).click(function(){
							var val = $(this).attr("value");
							$(each_combo).val(val);						
							$(div_items).remove();
							$(txt).remove();
							$(each_combo).change();
							
						});
					}
					
				
					
					
					$(tr).css({
						width:'100%',
						margin:0,
						padding:0,
					});
					//$(td).text($(opt).text());
					
					
					//$(td).appendTo(tr);
					
					$(tr).attr("value",$(opt).val());
					$(tr).attr("index",opt_index);
					if($(opt).val()==$(each_combo).val()){
						$(tr).addClass("item_hover");
						
					}
					$(tr).append(opt_text);
					$(tr).appendTo(table);
				});
				$(table).appendTo(div_items);
				
				
				//end generate items from combo
			$(div_items).addClass("div_items");
			$(div_items).css({
				left:$(each_combo).offset().left,
			});
			
			
			//alert($(".item_hover").first().html());
			
			
			
			//calculate selectedindex
			
			if(e.pageY+200 > $(document).height()){ 
			
			/*	$(div_items).css({
					top:$(txt).offset().top-200,
				});
			*/
		
			}
			
			
			$(each_combo).after(div_items);
			var scrol = $(each_combo).prop("selectedIndex") * $(".item_hover").outerHeight()
			$(div_items).scrollTop(scrol-$(div_items).scrollTop());
			//end add div of items
			
			
			
			
			$(txt).select();
			var in_area = false;
			$(txt).blur(function(){	
				if(in_area == false){
					$(div_items).remove();
					$(txt).remove();
				}			
				
			});
			$(div_items).hover(function(){in_area=true;},function(){in_area=false;});
		
		//end when div is clicked add textbox
		//$(this).after(div);
		
		return false;
	});
	
	return;
/*	
	var combo = "select";
	$(combo).each(function(index){
	// Overlay with div	
		var each_combo = $(this);
		var div = $("<div>");
		$(div).css({			
			height:$(each_combo).outerHeight(),
			width:$(each_combo).outerWidth(),
			position:'absolute',
			top:$(each_combo).offset().top,
			left:$(each_combo).offset().left,
			opacity:0
		});
		//when div is clicked add textbox
		$(div).click(function(){
			
			var txt = $("<input>");
			$(txt).addClass(".txt");
			$(txt).attr({
				type:"text",
				value:$(each_combo).children("option:selected").text()
			});
			$(txt).css({			
				height:$(each_combo).height(),
				width:$(each_combo).width()-22,
				position:'absolute',
				top:$(each_combo).offset().top,
				left:$(each_combo).offset().left+1,
				border:'none',
				textIndent:3,
				
				
			});
			
			//add event to textbox
			$(txt).keyup(function(e){
				var str = $(this).val();
				var tmp = $(this).prev(".div_items").children("table"); 
				$(tmp).children("tbody").children("tr").each(function(index, element) {
					if($(element).html().toLowerCase().indexOf(str.toLowerCase())==-1){
						$(this).hide();		
					}else{
						$(this).show();		
					}
				});
			});
			//end add event to textbox
			
			$(div).after(txt);
			
			//add div of items
			var div_items = $("<div>");
			$(div_items).css({
				position:'absolute',
				backgroundColor:'white',
				minWidth:$(each_combo).outerWidth(),
				border:'solid 1px #d1d1d1'
				
			});
			
				//generate items from combo
				var table = $("<table>");
				$(table).css({
					width:'100%',
					
				});
				$(table).attr({
					cellpadding:'0',
					cellspacing:'0'
				});
				$(each_combo).children("option").each(function (opt_index,opt){
					var tr = $("<tr>");
					
				
					$(tr).hover(function(){
						$(".item_hover").removeClass("item_hover");
						$(tr).addClass("item_hover")},function(){$(tr).removeClass("item_hover")});
					$(tr).click(function(){
						var val = $(this).attr("value");
						$(each_combo).val(val);						
						$(div_items).remove();
						$(txt).remove();
						$(each_combo).change();
						
					});
					$(tr).css({
						width:'100%',
						margin:0,
						padding:0,
					});
					//$(td).text($(opt).text());
					var opt_text = $(opt).text();
					var pt = new RegExp("[|]","g");
					opt_text = opt_text.replace(pt,"</td><td>");
					opt_text = "<td>"+opt_text+"</td>";
					
					//$(td).appendTo(tr);
					
					$(tr).attr("value",$(opt).val());
					$(tr).attr("index",opt_index);
					if($(opt).val()==$(each_combo).val()){
						$(tr).addClass("item_hover");
						
					}
					$(tr).append(opt_text);
					$(tr).appendTo(table);
				});
				$(table).appendTo(div_items);
				
				
				//end generate items from combo
			$(div_items).addClass("div_items");
			
			//alert($(".item_hover").first().html());
			
			
			
			//calculate selectedindex
			
			
			$(div).after(div_items);
			var scrol = $(each_combo).prop("selectedIndex") * $(".item_hover").outerHeight()
			$(div_items).scrollTop(scrol-$(div_items).scrollTop());
			//end add div of items
			
			
			
			
			$(txt).select();
			var in_area = false;
			$(txt).blur(function(){	
				if(in_area == false){
					$(div_items).remove();
					$(txt).remove();
				}			
				
			});
			$(div_items).hover(function(){in_area=true;},function(){in_area=false;});
		});
		//end when div is clicked add textbox
		$(this).after(div);
		
		
	// End Overlay with div
	
	});*/
	
	
	
}
//Copy css


