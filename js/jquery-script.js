			$(document).ready(function(){
				$("#hufiec").hover(function() {
					$("#menu-lvl-2").slideDown();
				});
				
				$(".lvl-2").hover(function(){
					$(this).children("ul").slideDown();
				});
				$(".social-media").hover(function(){
					$(".sc-lvl-2").addClass("visibility");
				});
				$(".social-media").mouseleave(function(){
					$(".sc-lvl-2").removeClass("visibility");
				});
			    $('.menu').mouseleave(function(){
					$('.menu-lvl-2').slideUp();
				});// mouseleave
				$('.lvl-2').mouseleave(function(){
					$('.menu-lvl-3').slideUp();
				});// mouseleave
				$('.bxslider').bxSlider();
				$('#slider2').bxSlider({
				  auto: true,
				  autoControls: true,
				  pause: 4000,
				  pager: true,
				  pagerType: 'full',
				  controls: true,
				});
			  $('#menu2').slicknav({
				duration: 600,
				label: 'MENU',
				brand: "",
				removeClasses: true,
			  });
				//positioning
	$(window).scroll(function() {

  //fixed menu
    if ($(window).width() > 980){
      var p = $(document).scrollTop();
      var s = $('.menu');
      if (p > 900) {
          s.addClass('fixed');
      } else {
          s.removeClass('fixed');
      }
    }
  });
			});
