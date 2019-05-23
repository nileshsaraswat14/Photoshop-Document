$(document).ready(function(){
	
	
	var menu_expand_btn = $('.menu_expand');
	menu_expand_btn.attr('href','javascript:void(1)');
var site_menu = $('.nav-menu');


menu_expand_btn.click(function(){//state-active
	site_menu.slideToggle(140, function(){site_menu.removeAttr('style');site_menu.toggleClass('state-active')});
	$(this).toggleClass('active');
	});
	
	//sub menu plus drop
	
	var item_with_children = $('.nav-menu li.menu-item-has-children');
	item_with_children.prepend('<span class="expand_plus"><i></i></span>');
	
	$('.expand_plus').click(function(){
		$(this).toggleClass('active');
		$(this).parent().children('.sub-menu').slideToggle(240, function(){$(this).parent().children('.sub-menu').removeAttr('style'); $(this).parent().children('.sub-menu').toggleClass('active-children');  });
		})
	
	
	

	
	});//DOC ready end
	
	
	
//parallax scrolling
//element  - .f_upper,


	
	
//smooth scroll to div
/* use html as below - 

<a class="searchbychar" href="#" data-target="numeric">0-9 |</a> 


*/

$(document).on('click','.site_menu li a', function(event) {
    event.preventDefault();
    var target = "#" + this.getAttribute('data-target');
    $('html, body').animate({
        scrollTop: $(target).offset().top
    }, 300);
});	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	