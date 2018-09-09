function addToWishList(selfObj, pid, type){
	
	if (type == 'delete') {
		swal({
			title: "Are you sure!!",
			text: "Do you want to you want to delete this record?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No"
		}).then(function () {
				var dataString = {
					pid: pid,
				};
				$.ajax({
					url: base_url + 'profile/addToWishList',
					dataType: 'json',
					type: 'POST',
					data: dataString,
					beforeSend: function () {
						showLoader();
					},
					success: function (obj){
						timerAlert('Successful!!', 'Record has been successfully deleted', 'reload');
					},
					error: function () {
						csrfError();
					}
				});

		});
	} else {
		var dataString = {
			pid: pid,
		};
		$(selfObj).find('i').toggleClass('fas far');
		$(selfObj).find('m').text('Added');
		$.ajax({
			url: base_url + 'profile/addToWishList',
			dataType: 'json',
			type: 'POST',
			data: dataString,
			beforeSend: function () {
				showLoader();
			},
			success: function (obj){				
				if(obj.status == 'error'){
					swal("Login Please", "To add this product in your wishlist you must have to login in your account ", "warning");
					$(selfObj).find('i').removeClass('fas').addClass('far');
					$(selfObj).find('m').text('Add');
				}else if(obj.status == 'success'){
					
				}
			},
			error: function () {
				csrfError();
			}
		});
	}
}

$('.navMeg1 > li').mouseenter(function() {
	$(this).find(' > ul').show();
})
.mouseleave(function() {
	$(this).find(' > ul').hide();
});


function validatePassword(val, selfObj) {
	var validate = [];
	var status = true;
	if (val.length < 6) { //Length of password
		validate[0] = 'error';
		status = false;
	} else {
		validate[0] = 'success';
	}

	if (!/[a-z]/.test(val)) { //lowercase letter
		validate[1] = 'error';
		status = false;
	} else {
		validate[1] = 'success';
	}

	if (!/[A-Z]/.test(val)) { //uppercase letter
		validate[2] = 'error';
		status = false;
	} else {
		validate[2] = 'success';
	}

	if (!/\d/.test(val)) { // Number 
		validate[3] = 'error';
		status = false;
	} else {
		validate[3] = 'success';
	}

//	if (!/[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(val)) { //Special Cherector
//		validate[4] = 'error';
//		status = false;
//	} else {
//		validate[4] = 'success';
//	}

	if (selfObj != '') {
		$chkVl0 = validate[0] === 'success' ? 'succCk' : '';
		$chkVl1 = validate[1] === 'success' ? 'succCk' : '';
		$chkVl2 = validate[2] === 'success' ? 'succCk' : '';
		$chkVl3 = validate[3] === 'success' ? 'succCk' : '';
		$chkVl4 = validate[4] === 'success' ? 'succCk' : '';
		var html = '<ul><li class="' + $chkVl0 + '">Be at least 6 characters</li>' +
			'<li class="' + $chkVl1 + '">Include a lowercase letter</li>' +
			'<li class="' + $chkVl2 + '">Include an uppercase letter</li>' +
			'<li class="' + $chkVl3 + '">Include a number</li>' +
			'<li class="' + $chkVl4 + '">Include a special character</li></ul>';
		$(selfObj).closest('td, .posR').find('.passValida').html(html).show();
	} else {
		return status;
	}
}

$(document).on('keypress', '.numericOnly, .percengateOnly, .timeOnly, .alphanumericOnly, .invoicenumberOnly, .numbersonlynegativeOnly, .integersOnly', function(event) {
    if ($(this).hasClass('numericOnly')) {
        return numericOnly(this, event);
    } else if ($(this).hasClass('percengateOnly')) {
        return percengateOnly(this, event);
    } else if ($(this).hasClass('timeOnly')) {
        return timeOnly(this, event);
    } else if ($(this).hasClass('alphanumericOnly')) {
        return alphanumericOnly(this, event);
    } else if ($(this).hasClass('invoicenumberOnly')) {
        return invoicenumberOnly(this, event);
    } else if ($(this).hasClass('numbersonlynegativeOnly')) {
        return numbersonlynegativeOnly(this, event);
    } else if ($(this).hasClass('integersOnly')) {
        return integersOnly(this, event);
    }
});

function numericOnly(t, e) {
    return validateInput(t, e, new RegExp("^[0-9]*([.:][0-9]*)?$"))
}

function percengateOnly(t, e) {
    var i = new RegExp("^[0-9]{0,2}(\\.[0-9]*)?$|^1?0{0,2}(\\.0*)?$");
    return validateInput(t, e, i)
}

function timeOnly(t, e) {
    return validateInput(t, e, new RegExp("^[0-9]*([.:][0-9]{0,2})?$"))
}

function alphanumericOnly(t, e) {
    return validateInput(t, e, new RegExp("^[0-9a-zA-Z]*$"))
}

function invoicenumberOnly(t, e) {
    return validateInput(t, e, new RegExp("^[A-Za-z0-9 #,./:_-]*$"))
}

function numbersonlynegativeOnly(t, e) {
    return validateInput(t, e, new RegExp("^-?[0-9]*([.][0-9]*)?$"))
}

function integersOnly(t, e) {
    return validateInput(t, e, new RegExp("^[0-9]*$"))
}

function validateInput(t, e, i) {
    var n = t.value;
    $(t).unbind("paste.validateInput"), $(t).bind("paste.validateInput", function() {
        setTimeout(function() {
            i.test(t.value) ? n = t.value : $(t).val(n)
        }, 10)
    });
    var r = jQuery.event.fix(e || window.event);
    if (!isPrintableKey(r)) return !0;
    var a = getFinalValue(t, r);
    return i.test(a);
}
function isPrintableKey(t) {
    if (t.ctrlKey || t.metaKey) return !1;
    var e = t.which;
    return 32 > e || 144 == e ? !1 : !0
}

function getFinalValue(t, e) {
    var i = TextSelection.startPos(t),
        n = TextSelection.endPos(t),

        r = t.value,
        a = String.fromCharCode(e.which),
        s = r.substring(0, i),
        o = r.substring(n, r.length);
    return s + a + o
}

var TextSelection = {
    current: function() {
        return document.getSelection ? document.getSelection().toString() : document.selection ? document.selection.createRange().text : void 0
    },
    selectedValue: function(t) {
        return void 0 !== t.selectionStart ? t.value.substring(t.selectionStart, t.selectionEnd) : document.selection ? document.selection.createRange().text : void 0
    },
    startPos: function(t) {
        if (void 0 !== t.selectionStart) return t.selectionStart;
        if (document.selection) {
            var e = document.selection.createRange();
            return e.moveEnd("character", t.value.length), t.value.length - e.text.length
        }
    },
    endPos: function(t) {
        if (void 0 !== t.selectionEnd) return t.selectionEnd;
        if (document.selection) {
            var e = document.selection.createRange();
            return e.moveStart("character", -t.value.length), e.text.length
        }
    }
};

//function work for form validation 
function validateForm(targetFlag) {
    var isValidForm = true;
    $('#' + targetFlag).attr('novalidate', 'novalidate');
    $('#' + targetFlag + ' [required]').each(function() {
        if ($(this).is("select") && $(this).val() == '') {
            $(this).closest('div').addClass('errorDropdown');
            isValidForm = false;
        } else if ($(this).is(":file") && $(this).val() == '') {
            $(this).addClass('errorFileType');
            isValidForm = false;
        } else if ($(this).is("textarea") && $(this).val() == '') {
            $(this).addClass('errorTextArea');
            isValidForm = false;
        } else if ($(this).is(":checkbox") && $(this).is(":not(:checked)")) {
            $(this).closest('label').addClass('errorCheckBox');
            isValidForm = false;
        } else if ($(this).is("input:radio")) {
            var radioBtnName = $(this).attr('name');
            if ($("input[name=" + radioBtnName + "]:checked").length <= 0) {
                $(this).closest('div').parent('div').addClass('errorRadio');
                isValidForm = false;
            } else if ($(this).is(":not(:checked)") && !radioBtnName) {
                $(this).closest('div').parent('div').addClass('errorRadio');
                isValidForm = false;
            }
        } else if ($(this).val() == '') {
            $(this).addClass('errorInput');
            isValidForm = false;
        }
    });
    return isValidForm;
}

function createCookie(name, value, duration) {
	var expires;

	if (duration) {
		var date = new Date();
		date.setTime(date.getTime() + (duration));
		expires = "; expires=" + date.toGMTString();
	} else {
		expires = "";
	}
	document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
	var nameEQ = encodeURIComponent(name) + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) === ' ')
			c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) === 0)
			return decodeURIComponent(c.substring(nameEQ.length, c.length));
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name, "", -1);
}


function validateEmail(email) {
	 var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  	 return emailReg.test( email );
}

$('.validateEmail').on('blur', function(){
	var email = $(this).val();
	if(!validateEmail(email) && email){
			swal({
				title: 'Sorry!!',
				text: 'You have entered a invalid email. Please reenter.',
				confirmButtonColor: '#FF9494',
				type: 'warning'
			});		
			
			$('.validateEmail').val('');
	}
});


$(document).on("submit", "#forgetpassword", function (e) {
	e.preventDefault();
	var email = $('#forgetpassword input[name="email"]').val();
	if (email) {
		$.ajax({
			url: admin_url + 'login/forgetpassword',
			type: 'POST',
			dataType: 'json',
			data: new FormData(this),
			processData: false,
			contentType: false,
			beforeSend: function () {
				showLoader()
			},
			success: function (data) {
				if (data.status == 'error') {
					swal('Oops...!!', 'This email ID is not registered with us.', 'error');
				} else {
					timerAlert('Successful!!', 'Request for password change has been successfully sent via email', admin_url + 'resetpassword');
				}
			},
			error: function () {
				csrfError();
			}
		});
	} else {
		swal('Oops...', 'Please fill your registered email id', 'error');
	}
});

$(document).on("submit", "#validateforgetPassword", function (e) {
	e.preventDefault();
	var email = $('#validateforgetPassword input[name="email"]').val();
	var otp = $('#validateforgetPassword input[name="token"]').val();
	if (!email || !otp) {
		swal('Oops...', 'Please fill all fields', 'error');
		return false;
	}
	$.ajax({
		url: admin_url + 'login/validateforgetPassword',
		type: 'POST',
		dataType: 'json',
		data: new FormData(this),
		processData: false,
		contentType: false,
		beforeSend: function () {
			showLoader()
		},
		success: function (data) {
			if (data.status == 'error') {
				swal('Oops...!!', 'Please enter valid OTP or regenerate OTP.', 'error');
			} else if (data.status == 'expired') {
				swal('Oops...!!', 'The OTP has been expired. You need to regenerate a new OTP to change your password.', 'error');
			} else {
				$('#updateFinalPass input[name=id]').val(data[0].id);
				$('#updateFinalPass input[name=token]').val(data[0].token);
				$('#updateFinalPass input[name=val]').val(data[0].val);
				$('.widget-box.visible').removeClass('visible');
				$('#resetPasswordFinal').addClass('visible');
			}
		},
		error: function () {
			csrfError();
		}
	});
});


$(document).on("submit", "#userPassword", function (e) {
	e.preventDefault();
	var oPassword = $('.oPassword').val();
	var nPassword = $('.nPassword').val();
	var cPassword = $('.cPassword').val();
	if (!oPassword || !nPassword || !cPassword) {
		swal('Oops...', 'Please fill all fields', 'error');
		return false;
	}
	if (!validatePassword(nPassword, '')) {
		swal('Oops...', 'Please include atleast 6 characters, a lowercase letter, a uppercase letter, a number and a special character', 'error');
		return false;
	}

	if (oPassword || nPassword) {
		if (!cPassword) {
			swal('Oops...', 'To change your password please enter Confirm New Password', 'error');
			return false;
		}
		if (cPassword != nPassword) {
			swal('Oops...', 'Your new password and confirmation password do not match, please retype', 'error');
			return false;
		}
	}
	$.ajax({
		url: admin_url + 'process/resetPassword',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (data) {
			if (data.status == 'sucess') {
				swal("Update!", "Your password has been updated.", "success");
			} else if (data.status == 'oldError') {
				swal('Oops...!!', 'The old password you have entered is incorrect', 'error');
			} else if (data.status == 'passRequre') {
				swal('Oops...!!', 'Please enter your old password', 'error');
			}
			$('.oPassword').val('');
			$('.nPassword').val('');
			$('.cPassword').val('');
		},
		error: function () {
			csrfError();
		}
	});
});

$(document).on("submit", "#register_customer", function (e) {
	e.preventDefault();
	if (!validateForm('register_customer')) return false; 
	$.ajax({
		url: base_url + 'login/register',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (obj) {
			if (obj.status == 'mobile-error') {
				swal("Sorry!", "This This phone number is not available, choose a different phone number.", "error");
			} else if (obj.status == 'email-error') {
				swal("Sorry!", "This email address is not available, choose a different email address.", "error");
			} else if (obj.status == 'success') {
				swal("Successfull !!", "Your account has been successfully created. An verification mail has been sent to your email and also please enter OTP here to verify your mobile", "success");
				$('#register_customer').remove();
				$('#confirmOTP_customer').show();
			}else{
				csrfError();
			}
			
		},
		error: function () {
			csrfError();
		}
	});
});

$(document).on("submit", "#login_customer", function (e) {
	e.preventDefault();
	if (!validateForm('login_customer')) return false; 
	$.ajax({
		url: base_url + 'login/check',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (obj) {
			if (obj.status == 'error') {
				swal({
					title: 'Invalid Login',
					html: 'The email/username or password you entered is not valid',
					confirmButtonColor: '#FF9494',
					type: 'warning'
				});
			} else if (obj.status == 'pending') {
				 $('#confirmOTP_customer input[name="otpMobile"]').val(obj.mobile);
				$('#login_customer').remove();
				$('#confirmOTP_customer').show();
			}else if (obj.status == 'success') {
				var redictURL = window.location.hash.substring(1);
				redictURL = redictURL ? redictURL : base_url;
				timerAlert('Login Successfully!', 'Successfully Logged in', redictURL);
			}else{
				csrfError();
			}
		},
		error: function () {
			csrfError();
		}
	});
});

function updateCitySelect(selfObj, id){
	var dataString = {
		id: id,
	};
	$.ajax({
		url: base_url + 'home/updateCitySelect',
		dataType: 'json',
		type: 'POST',
		data: dataString,
		beforeSend: function () {
			showLoader();
		},
		success: function (data) {
			//alert($(selfObj).text());
			timerAlert('Successful!!', 'You have selected '+$(selfObj).text(), 'reload');
		},
		error: function () {
			csrfError();
		}
	});
}
$('.viewAllCities').on('click',function(){
	$('.allCityList, .otdcityLbl').slideDown();
	$(this).remove();
	$('#changeCity .modal-body').animate({
		scrollTop: $('#popularDelCities').offset().top
	}, 2000);
});
function filterCity(element) {
	//$('.allCityList, .otdcityLbl').slideDown();
	//$('.viewAllCities').remove();
	var value = $(element).val();
	$(".allCityList li, .popularCityList li").each(function() {
		if ($(this).text().search(new RegExp(value, "i")) > -1) {
			$(this).show();
		} else {
			$(this).hide();
		}
	});
}

$(".numberOnly").keydown(function (e) {
	if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
		(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
		(e.keyCode >= 35 && e.keyCode <= 40)) {
		return;
	}
	if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
	}
});

function goBack() {
	window.history.back();
}

function gotoPage(url) {
	if (url == 'reload') {
		location.reload();
	} else {
		window.location.href = url;
	}
}

function showLoader() {
	$('#preloader').show();
}

function hideLoader() {
	$('#preloader').hide();
}

$(document).ajaxStop(function () {
	processTooltip();
	$('.selectpicker').selectpicker('refresh');
	hideLoader()
});

var filterData = {};

function ajaxTbl(targeT, fn) {
	$('.' + targeT).DataTable({
		responsive: true,
		"bDestroy": true,
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": base_url + 'ajaxDataTable/' + fn,
			"type": 'POST',
			"data": {
				filterData,
			},
		},
	});
}

function ajaxPageTarget(targeT, page, fn) {
	$('.' + targeT).DataTable({
		responsive: true,
		"bDestroy": true,
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": base_url + page + '/' + fn,
			"type": 'POST',
			"data": {
				filterData
			},
		},
	});
}
function timerAlert(sub, msg, target) {
	swal({
		title: sub,
		text: msg,
		timer: 1000,
		onOpen: function () {
			swal.showLoading();
		}
	}).then(
		function () {},
		function (dismiss) {
			if (dismiss === 'timer') {
				if (target) {
					if (target == 'reload') {
						gotoPage('');
					} else {
						gotoPage(target);
					}
				}
			}
		}
	);
}

function csrfError() {
	swal("Oops!!", "Something went wrong please refresh your page.", "error");
	hideLoader();
}

function processTooltip() {
	$('.tooltip.fade').removeClass('in');
	$('[data-tooltip="tooltip"], [data-toggle="tooltip"]').tooltip({
		container: 'body',
		html: true
	});
}
$(document).ready(function(){

	//$(".sticky").sticky({topSpacing:0});
	
	
	if($('.productSlider').length > 0){
		var productSlider = $('.productSlider');
		productSlider.owlCarousel({
			items : 6,
			autoplay:true,
			loop:true,
			margin: 30,
			autoplayTimeout:5000,
			autoplayHoverPause:true,
			navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
			lazyLoad:true,
			dots: false,
			nav: true,
			responsive:{
				0:{
					items:2,
				},
				600:{
					items:3,
				},
				1000:{
					items:4,
				},
				1200:{
					items:6,
				}
			},
			animateOut: 'fadeOut'
		});
		$('.playProductSlide').on('click', function() {
			productSlider.trigger('play.owl.autoplay', [2000])
		});
		$('.stopProductSlide').on('click', function() {
			productSlider.trigger('stop.owl.autoplay')
		});
	}
	
	
	
	
	$("#testimonial-slider").owlCarousel({ 
		items : 3,
		autoplay:true,
		loop:true,
		margin: 10,
		autoplayTimeout:5000,
		autoplayHoverPause:true,
		navText: ["",""],
		lazyLoad:true,
		nav: true,
		dots: false,
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:2,
			},
			1000:{
				items:3,
			},
			1200:{
				items:3,
			}
		},
		animateOut: 'fadeOut'       
	});

	var wow = new WOW({
		boxClass:     'animate',      // animated element css class (default is wow)
		animateClass: 'animated', 	// animation css class (default is animated)
		offset:       100,          // distance to the element when triggering the animation (default is 0)
		mobile:       false        // trigger animations on mobile devices (true is default)
	});

	wow.init();
});

//By Jai from Creamy Roses
function gotoPageView(url) {
	if (url == 'login') {
		window.location.href = base_url + 'login';
	}else if(url == 'registration'){
		window.location.href = base_url + 'registration';
	}
}

function insertOtpMobile(mobile){
	$('input[name="otpMobile"]').val(mobile);
}

function getPriceByWeight(weightId,selfObj){
	var dataString = {
		id: weightId,
	};
	$.ajax({
		url: base_url + 'process/getPrice',
		dataType: 'json',
		type: 'POST',
		data: dataString,
		beforeSend: function () {
			showLoader();
		},
		success: function (obj) {
			var finalPrice, pSymbol, rSymbol, discountedPrice = '';
			finalPrice = pSymbol = rSymbol = '';
			
			var price		 = obj[0].product_price;
			var discountVal	 = obj[0].discount;
			var discountType = obj[0].discount_type;
			var quantity 	 = obj[0].quantity;
			var quantity_type= obj[0].quantity_type;			
			
			if(discountType == 'F'){
				finalPrice = price - discountVal;
				rSymbol = '<i class="fas fa-rupee-sign"></i>';
			}else if(discountType == 'P'){
				finalPrice = price - (price*discountVal/100);
				pSymbol = '%';				
							
			}
			$('.before_discount').html(price);	
			$('.final_price').html(finalPrice.toFixed(2));
			$('.discount_type m').html(rSymbol+' '+discountVal+''+pSymbol);
			$(selfObj).addClass('active').siblings().removeClass('active');
			
			if(discountVal){
				$('.js-price1-discount, .js-discount-type').css('display','inline-block');
			}else{
				finalPrice = discountVal;
				$('.js-price1-discount, .js-discount-type').hide();
			}
			
		},
		error: function () {
			csrfError();
		}
	});

}

$(document).on("submit", "#confirmOTP_customer", function (e) {
	e.preventDefault();
	if (!validateForm('confirmOTP_customer')) return false; 
	$.ajax({
		url: base_url + 'login/checkOtp',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (obj) {
			if (obj.status == 'otp-error') {
				swal("Sorry!", "Enter correct otp.", "error");
				//$('.register_customer').remove();
				//$('.confirmOTP_customer').show();

			}else if (obj.status == 'success') {
				timerAlert('Successfull !!', 'Your account has been verify successfully. Login your account!', base_url + 'login', 3000);
			}else{
				csrfError();
			}
			
		},
		error: function () {
			csrfError();
		}
	});
});

$(document).on("submit", "#editNewAddress", function (e) {
	e.preventDefault();
		if (!validateForm('editNewAddress')) return false; 

	var id = $('input[name="cid"]').val();
	if (id != '') {
		var msg = 'updated';
	} else {
		var msg = 'added';
	}
	$.ajax({
		url: base_url + 'profile/editNewAddress',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (data) {
			var url = base_url+'address-book';
			timerAlert('Successfull!', 'Successfully ' + msg, url);
		},
		error: function () {
			csrfError();
		}
	});
});

function setDefaultAddress(selfObj, aid, cid) {
	var dataString = {
		aid: aid,
		cid: cid
	};
	$.ajax({
		url: base_url + 'profile/setDefaultAddress',
		dataType: 'json',
		type: "POST",
		data: dataString,
		beforeSend: function () {
			showLoader();
		},
		success: function (data) {
			$('.boxAddressDis').removeClass('defaultAdsULI');
			$(selfObj).closest('.boxAddressDis').addClass('defaultAdsULI');
		},
		error: function () {
			csrfError();
		},
	});
}

function deleteAddress(selfObj, aid) {
	var adress = '<ul>' + $('.addressULLI').html() + '</ul>';
	swal({
		title: "Confirm Deletion!!",
		html: "<div class='confrmDletMs'>" + adress + "<br><br>Please note: Deleting this address will not delete any pending orders being shipped to this address. To ensure uninterrupted fulfillment of future orders, please update any wishlists, subscribe and save settings and periodical subscriptions using this address.</div>",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes",
		cancelButtonText: "No"
	}).then(function () {
		var dataString = {
			id: aid,
		};
		$.ajax({
			url: base_url + 'profile/deleteAddress',
			dataType: 'json',
			type: "POST",
			data: dataString,
			beforeSend: function () {
				showLoader();
			},
			success: function (data) {
				if (data.status == 'child') {
					if (type == 'state') {
						var msg = 'You cannot delete this state until the city of this state get deleted. So, please delete all cities of this state first';
					} else if (type == 'city') {
						var msg = 'You cannot delete this city until the area of this city get deleted. So, please delete all areas of this city first';
					} else if (type == 'area') {

					}
					swal("Oops!!", msg, "error");
				} else if (data.status == 'success') {
					timerAlert('Successful!!', 'Record has been deleted Successfully');
					$(selfObj).closest('.col-sm-4').fadeOut('slow');
				}
			},
			error: function () {
				csrfError();
			},
		});

	});
}

$(document).on("submit", "#customerAddEdit", function (e) {
	e.preventDefault();
	if (!validateForm('customerAddEdit')) return false; 

	var msg = 'updated';
	$.ajax({
		url: base_url + 'profile/customerAddEdit',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (data) {
			if (data.status == 'user-error') {
				swal("Sorry!", "This phone number is not available, choose a different phone number.", "error");
			} else if (data.status == 'email-error') {
				swal("Sorry!", "This email address is not available, choose a different email address.", "error");
			} else {
				$('input[name="id"]').val(data.cid);
				timerAlert('Successfull!', 'Information has been successfully ' + msg);
				$('.titleAre').text('Customer');
				$('.mangAdresBtn').show();
				manageAddressPan();
			}
		},
		error: function () {
			csrfError();
		}
	});
});

function checkPinCode(){
	var pincode = $('#pincode').val();	
	var dataString = {
		pincode: pincode,
	};
	if(pincode!=''){
		$.ajax({
			url: base_url + 'process/getPincode',
			dataType: 'json',
			type: "POST",
			data: dataString,
			beforeSend: function () {
				showLoader();
			},
			success: function (data) {
				if(data.result == 'error'){
					$('#errormsg').removeClass('pinValiMsg');
					$('#pincode').val('');
				}
			},
			error: function () {
				csrfError();
			},
		});
	}else{
		swal("Sorry!", "Enter valid pincode.", "error");
	}
}
