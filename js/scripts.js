	$(document).ready(function(e) {
		var s_saver;
		height=$(window).height()-86;
		$('.body').css('min-height',height+'px');
		$('body').mousemove(function() {
			clearTimeout(s_saver);
			myVideo = document.getElementById('video');
			s_saver = setTimeout(function(){
				$('#screensaver').fadeIn(900);
				//myVideo.play(); 
			}, 30000);
			//myVideo.pause == true;
			$('#screensaver').fadeOut(100);
		});
		$('body').bind('touchend',function() {
			clearTimeout(s_saver);
			myVideo = document.getElementById('video');
			s_saver = setTimeout(function(){
				$('#screensaver').fadeIn(900);
				//myVideo.play(); 
			}, 30000);
			//myVideo.pause == true;
			$('#screensaver').fadeOut(100);
		});
		$('nav#menu-left').mmenu();
		$(document).ajaxComplete(function(event, XMLHttpRequest, ajaxOptions) {
			$('.overlay').click(function(){
				$('.overlay').fadeOut();			
			});
        });
		$(document).ajaxError(function(event, jqXHR, ajaxOptions, thrownError) {
			console.log("Error, la página no existe o no pudo ser accesada. Posible falla de la red");
			$('.overlay').fadeOut();			
        });
		 if (!window.console) console = {log: function() {}};
		 
		//Setup del ajax para no guardar cache, evita fallos en el get de ajax principalmente en IE9	
		$.ajaxSetup({ 
			cache: false,
		});
		var flipped = "";
		var flipping = false;
		$(".item").click(function(){
			if(!flipping){
				flipping=true;
				flipped = $(this);
				if(flipped.hasClass('flipped')){
					flipped.removeClass('flipped');
					flipped.flippyReverse();
				}else{
					flipped.addClass('flipped');
					flipped.flippy({
						verso: flipped.find('.item_detail').html(),
						noCSS: true,
						color_target :'#192653',
						light: 0,
						duration: 250,
						onFinish: function(){
							flipped.find('.item_button').click(function(e) {
								e.stopPropagation();
								if($(this).parent().hasClass('selected')){
									$(this).parent().removeClass('selected');
								}else{
									$(this).parent().addClass('selected');
								}
								if($('.item.selected').length>0){
									$('.checkout').show();
									$('#checkout').animate({bottom:0},'fast');
								}else{
									$('#checkout').animate({bottom:'-100px'},'fast');
									$('.checkout').hide();
								}
								$(this).parent().click();
							});
							flipped.attr('style','');
						},
						onReverseFinish: function(){
							flipped.attr('style','');
						}
					});
				}
				if(flipped.hasClass('selected')){
					flipped.removeClass('selected');
					setTimeout(function(){flipped.addClass('selected');},300);
				}
				setTimeout(function(){flipping=false;},300);
			}
		});
/*		$(".item").bind("taphold",function(){
			$(this).find('.options_overlay').animate({top:0},'slow');
			$(this).unbind('click');
			setTimeout(function(){
				$(".item").click(function(){
					flipped = $(this);
					flipped.flippy({
					  duration: "500"
					});
				});
			},500);
		});*/
		$('#menu-left ul li').click(function(){
			$('.body').hide();
			$('div[data-role="page"]').scrollTop(0);
			target = $(this).attr('target');
			$('#'+target).show();
		});
		$('.accept').click(function(e) {
			/*$.ajax({
				dataType: "json",
				url: "https://rest.nexmo.com/sms/json",
				type: "POST",
				data: "api_key=994bb2cf&api_secret=efc190a6&from=NEXMO&to=522222620315&text=Nuevo+mensaje",
				context: document.body,
				success: function(responseText){
					console.log(responseText);
				},
				error:function(e,f){
					console.log(e);
					console.log(f);
				}
			});*/
        });
    });
	function loadjscssfile(filename, filetype){
		if (filetype=="js"){ //if filename is a external JavaScript file
			var fileref=document.createElement('script')
			fileref.setAttribute("type","text/javascript")
			fileref.setAttribute("src", filename)
		}
		else if (filetype=="css"){ //if filename is an external CSS file
			var fileref=document.createElement("link")
			fileref.setAttribute("rel", "stylesheet")
			fileref.setAttribute("type", "text/css")
			fileref.setAttribute("href", filename)
		}
		if (typeof fileref!="undefined")
			document.getElementsByTagName("head")[0].appendChild(fileref)
	}
/*	$(window).resize(function(){
		carousel.init();
		height=$(window).height()-86;
		$('.body').css('min-height',height+'px');
	});*/