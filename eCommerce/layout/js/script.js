$(document).ready(function() {

	// SideBar
	$('#category-menu').click(function() {
		$('.ui.sidebar').sidebar('toggle');
	});

	// semantic modal sign in
	$('#signin-modal').click(function () {
		$('.small.modal.sign-in-modal').modal('show');
	});
	// semantic modal sign up
	$('#regest-modal').click(function () {
		$('.ui.modal.sign-up-modal').modal('show');
	});

	// Accourdion
	$('.ui.accordion').accordion();

	// hover dropdown
	$('.dropdown-btn').mouseenter(function (){
		$('.sub-menu').css('display','block');
	});
	$('.dropdown-btn').mouseleave(function (){
		$('.sub-menu').css('display','none');
	});


	// HEADER owl carousel
	$('.header-carousel').owlCarousel({
	    rtl:false,
	    loop:true,
	    margin:0,
	    nav:false,
		autoplay:true,
		autoplayTimeout:4000,
		autoplayHoverPause:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	})

	// OFFERS owl carousel
	$('.offers-carousel').owlCarousel({
	    rtl:false,
	    loop:true,
	    margin:11,
	    nav:false,
		autoplay:true,
		autoplayTimeout:4000,
		autoplayHoverPause:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:2
	        },
	        1000:{
	            items:4
	        }
	    }
	})

	//most recent carousel
	$('.most-recent-carousel').owlCarousel({
	    rtl:false,
	    loop:true,
	    margin:11,
	    nav:false,
		autoplay:true,
		autoplayTimeout:4000,
		autoplayHoverPause:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:2
	        },
	        1000:{
	            items:4
	        }
	    }
	})



// Verify Validation

	$('#myform').validate({
			rules: {
				first_name: "required",
				last_name: "required",
				user_name: {
					required : true,
					minlength: 2
				},
				password: {
					required : true,
					minlength: 5
				},
				confirm_password: {
					required : true,
					minlength: 5,
					equalTo: "#password"
				},
				email: {
					required : true,
					email: true
				},
				national_id:{
					required: true,
					minlength: 14
				},
				phone:{
					required: true,
					minlength: 10
				}
				
			},

			messages: {
				first_name:"your first name is required",
				last_name : "your last name  is required",
				
				user_name: {
					required: "username  is required",
					minlength: "Your username must consist of at least 2 characters"
				},
				password: {
					required: "password  is required",
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				email:{
					required: "email address  is required",
					email : "Please Enter a valid email Address"
				},
				national_id: {
					required: "National ID is required",
					minlength: "Your National ID must be Equal 14 number"
				},
				phone: {
					required: "your Phone is required",
					minlength: "Your Phone must be at least 10 number"	
				}

			}
		});


 });
