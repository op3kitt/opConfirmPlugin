if(!openpne.apiKey){
	jQuery.noConflict();
	var _tmpObj = $;
	$ = jQuery;
}
var previewWindow;

$(function(){
	if(!openpne.apiKey){
		jQuery.noConflict();
		var _tmpObj = $;
		$ = jQuery;
	}
	previewWindow = $('<div id="opConfirmWindow_contents" class="parts form" style="display:none;margin: 0 auto;"></div>');
	$("form input:submit").click(function(){
		var trs = $(this.form).children("table").children().children();
		if(trs.length && $(this.form).attr("method") == "post"){
			$(this.form).after(previewWindow);
			$(this.form).hide();
			previewWindow.html("<table></table>");
			for(var i = 0;i < trs.length;i++){
				var tr = $("<tr></tr>");
				tr.append($(trs[i]).children("th").clone());
				var ptd = $(trs[i]).children("td");
				var td = $("<td></td>");
				if(ptd.children("input:text").length){
					if(ptd.children("input:text").attr("id") == "profile_op_preset_birthday_value_year"){
						td.text(ptd.children("#profile_op_preset_birthday_value_year").val()+"/"+ptd.children("#profile_op_preset_birthday_value_month").val()+"/"+ptd.children("#profile_op_preset_birthday_value_day").val());
					}else{
						td.text(ptd.children("input:text").val());
					}
				}else if(ptd.children().children().children("input:text").length){
					ptd = ptd.children().children();
					td.text(ptd.children("input:text").val());
				}else if(ptd.children("textarea").length){
					td.html(ptd.children("textarea").val().replace("\n", "<br />"));
				}else if(ptd.children().children().children("textarea").length){
					ptd = ptd.children().children();
					td.html(ptd.children("textarea").val().replace("\n", "<br />"));
				}else if(ptd.children("input:password").length){
					td.text("********");
				}else if(ptd.children().children().children("input:password").length){
					ptd = ptd.children().children();
					td.text("********");
				}else if(ptd.children("input:file").length){
					var img = $('<img style="max-width: 200px;" />');
					if(!ptd.children("input:file")[0].files){
						if(ptd.children("input:file").val()){
							td.text(ptd.children("input:file").val());
						}else if(ptd.children('input:checkbox:checked').length){
							td.text($(checks[j]).next().text());
						}else if(ptd.children().children("img").length){
							img.attr("src", ptd.children().children("img").attr("src"));
							td.append(img);
						}
					}else if(window.URL && window.URL.createObjectURL){
						var file = ptd.children("input:file")[0].files[0];
						if(file){
							img.attr("src", window.URL.createObjectURL(file));
							td.append(img);
						}else if(ptd.children('input:checkbox:checked').length){
							td.text($(checks[j]).next().text());
						}else if(ptd.children().children("img").length){
							img.attr("src", ptd.children().children("img").attr("src"));
							td.append(img);
						}
					}else if(window.webkitURL && window.webkitURL.createObjectURL){
						var file = ptd.children("input:file")[0].files[0];
						if(file){
							img.attr("src", window.webkitURL.createObjectURL(file));
							td.append(img);
						}else if(ptd.children('input:checkbox:checked').length){
							td.text($(checks[j]).next().text());
						}else if(ptd.children().children("img").length){
							img.attr("src", ptd.children().children("img").attr("src"));
							td.append(img);
						}
					}else{
						if(ptd.children("input:file").val()){
							td.text(ptd.children("input:file").val());
						}else if(ptd.children('input:checkbox:checked').length){
							td.text($(checks[j]).next().text());
						}else if(ptd.children().children("img").length){
							img.attr("src", ptd.children().children("img").attr("src"));
							td.append(img);
						}
					}
				}else if(ptd.children().children().children("input:file").length){
					ptd = ptd.children().children();
					var img = $('<img style="max-width: 200px;" />');
					if(!ptd.children("input:file")[0].files){
						if(ptd.children("input:file").val()){
							td.text(ptd.children("input:file").val());
						}else if(ptd.children('input:checkbox:checked').length){
							td.text($(checks[j]).next().text());
						}else if(ptd.children().children("img").length){
							img.attr("src", ptd.children().children("img").attr("src"));
							td.append(img);
						}
					}else if(window.URL && window.URL.createObjectURL){
						var file = ptd.children("input:file")[0].files[0];
						if(file){
							img.attr("src", window.URL.createObjectURL(file));
							td.append(img);
						}else if(ptd.children('input:checkbox:checked').length){
							td.text($(checks[j]).next().text());
						}else if(ptd.children().children("img").length){
							img.attr("src", ptd.children().children("img").attr("src"));
							td.append(img);
						}
					}else if(window.webkitURL && window.webkitURL.createObjectURL){
						var file = ptd.children("input:file")[0].files[0];
						if(file){
							img.attr("src", window.webkitURL.createObjectURL(file));
							td.append(img);
						}else if(ptd.children('input:checkbox:checked').length){
							td.text($(checks[j]).next().text());
						}else if(ptd.children().children("img").length){
							img.attr("src", ptd.children().children("img").attr("src"));
							td.append(img);
						}
					}else{
						if(ptd.children("input:file").val()){
							td.text(ptd.children("input:file").val());
						}else if(ptd.children('input:checkbox:checked').length){
							td.text($(checks[j]).next().text());
						}else if(ptd.children().children("img").length){
							img.attr("src", ptd.children().children("img").attr("src"));
							td.append(img);
						}
					}
				}else if(ptd.children("input:radio").length){
					td.text(ptd.children("input:radio:checked").next().text());
				}else if(ptd.children().children().children("input:radio").length){
					ptd = ptd.children().children();
					td.text(ptd.children("input:radio:checked").next().text());
				}else if(ptd.children("input:checkbox").length){
					var checks = ptd.children("input:checkbox:checked");
					var label = "";
					for(var j = 0;j < checks.length;j++){
						label += $(checks[j]).next().text()+",";
					}
					td.text(label);
				}else if(ptd.children().children().children("input:checkbox").length){
					ptd = ptd.children().children();
					var checks = ptd.children("input:checkbox:checked");
					var label = "";
					for(var j = 0;j < checks.length;j++){
						label += $(checks[j]).next().text()+",";
					}
					td.text(label);
				}else if(ptd.children("select").length){
					td.text(ptd.children("select").children(":selected").text());
				}else if(ptd.children().children().children("select").length){
					ptd = ptd.children().children();
					td.text(ptd.children("select").children(":selected").text());
				}
				tr.append(td);
				$("#opConfirmWindow_contents table").append(tr);
			}
			var operation = $('<div class="operation"></div>');
			var moreInfo = $('<ul class="moreInfo"></ul>');
			var btn = $('<input type="button" class="input_submit" value="確定" />');
			btn.click(function (form){return function(){
					form.submit();
				};
			}(this.form));
			moreInfo.append(btn);
			var btn2 = $('<input type="button" class="input_submit" value="訂正" />');
			btn2.click(function (form){return function(){
					previewWindow.remove();
					$(form).show();
				};
			}(this.form));
			moreInfo.append(btn2);
			operation.append(moreInfo);
			previewWindow.append(operation);
			previewWindow.show();
			return false;
		}
	});
	if(!openpne.apiKey){
		$ = _tmpObj;
	}
});
if(!openpne.apiKey){
	$ = _tmpObj;
}
