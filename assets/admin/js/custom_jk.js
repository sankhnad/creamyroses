
$(document).on("submit", "#editNewState", function (e) {
	e.preventDefault();
	var id = $('input[name="sid"]').val();
	if (id != '') {
		var msg = 'updated';
	} else {
		var msg = 'added';
	}
	$.ajax({
		url: admin_url + 'location/addEditState',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		beforeSend: function () {
				showLoader();
		},
		success: function (data) {
			timerAlert('Successfull!', 'Successfully ' + msg, 'reload');
		},
		error: function () {
			csrfError();
		}
	});
});

$(document).on("submit", "#editNewCity", function (e) {
	e.preventDefault();
	var id = $('input[name="cid"]').val();
	if (id != '') {
		var msg = 'updated';
	} else {
		var msg = 'added';
	}
	$.ajax({
		url: admin_url + 'location/addEditCity',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (data) {
			timerAlert('Successfull!', 'Successfully ' + msg, 'reload');
		},
		error: function () {
			csrfError();
		}
	});
});

$('#locationAddEdit').on('hide.bs.modal', function () {
	$('input[name="name"], input[name="sid"], input[name="cid"], select[name="sid"], select[name="cid"]').val('');
	$('.cityLisingModel').hide();
	$('.cityLisingModel select').html('');
	$('#locationAddEdit form')[0].reset();
	$('div [class*=colBoxArPIN]').not('.colBoxArPIN1').remove();
	$('.selectpicker').selectpicker('refresh');
});

function deleteLocation(selfObj, id, type) {
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
			id: id,
			type: type
		};
		$.ajax({
			url: admin_url + 'location/deleteData',
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
					$(selfObj).closest('tr').remove();
				}
			},
			error: function () {
				csrfError();
			},
		});

	});
}

function editLocation(selfObj, id, type) {
	var dataString = {
		id: id,
		type: type
	};

	$.ajax({
		url: admin_url + 'location/getData',
		dataType: 'json',
		type: "POST",
		data: dataString,
		beforeSend: function () {
			showLoader();
		},
		success: function (data) {
			if (type == 'state') {
				$('input[name="sid"]').val(id);
				$('input[name="name"]').val(data.stateName);
			} else if (type == 'city') {
				$('select[name="sid"]').val(data.sid);
				$('input[name="cid"]').val(id);
				$('input[name="name"]').val(data.cityName);
			} else if (type == 'area') {
				var k = 1;
				$.each(data, function (key, value) {
					if (k != '1') {
						var numAdd = addMoreLocaPIN('add');
					} else {
						var numAdd = 1;
					}
					$('.colBoxArPIN' + numAdd + ' input[name*="name"]').val(value.fld_areaName);
					$('.colBoxArPIN' + numAdd + ' input[name*="pin"]').val(value.fld_pin);
					k++;
				});
				$('input[name="aid"]').val(id);
				$('select[name="sid"]').val(data[0].fld_sid);
				getLocationData(data[0].fld_sid, 'city', '', data[0].fld_cid);
			}

			$('button[data-target="#locationAddEdit"]').click();
		},
		error: function () {
			csrfError();
		},
	});
}

function changeLocationStatus(selfObj, id, type) {
	var msg = '';
	var dataString = {
		id: id,
		type: type,
	};

	if ($(selfObj).find('input').is(':checked')) {
		dataString.value = '0';
		isCheck = false;
		msg = 'Do you want to mark this '+type+' as inactive?';
	} else {
		dataString.value = '1';
		isCheck = true;
		msg = 'Do you want to mark this '+type+' as active?';
	}

	swal({
		title: "Are you sure?",
		text: msg,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, I am sure!",
		cancelButtonText: "No, cancel it!"
	}).then(function () {
		$.ajax({
			url: admin_url + 'location/changeStatus',
			type: "POST",
			dataType: 'json',
			data: dataString,
			beforeSend: function () {
				showLoader();
			},
			success: function () {
				$('div[data-statusid="'+id+'"]').find('input').prop('checked', isCheck);
			},
			error: function () {
				csrfError();
			}
		});
	});
	processTooltip();
}

$('.validateEmail').on('blur', function(){
	var email = $(this).val();
	if(!validateEmail(email) && email){
		$('.emailErrorMsg').slideDown();
	}else{
		$('.emailErrorMsg').slideUp();
	}
});




function updateCustomerStatus() {
	var cid = $('.t_CID').val()
	var dataString = {
		id: cid,
		type: 'user',
		value: $('input[name="isActivate"]').val()
	};
	if ($('input[name="isActivate"]').val() == '1') {
		var msg = 'Do you want to mark this customer active without sending any confirmation?';
		isCheck = true;
	} else {
		var msg = 'Do you want to mark this customer inactive without sending any confirmation?';
		isCheck = false;
	}
	swal({
		title: "Are you sure?",
		text: msg,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, I am sure!",
		cancelButtonText: "No, cancel it!"
	}).then(function () {
		$.ajax({
			url: admin_url + 'process/changeStatus/',
			type: "POST",
			data: dataString,
			beforeSend: function () {
				showLoader()
			},
			success: function (data) {
				swal("Update!", "Record has been updated.", "success");
				$('#customerCustmMsgSMS').modal('hide');
				var isPendKycID = $('.isPendKycID').val()
				if(isPendKycID){					
					$('.finalCmnt'+isPendKycID).closest('tr').fadeOut( function(){
						$('.finalCmnt'+isPendKycID).closest('tr').remove();
					});
				}else{
					$('div[data-cide="' + cid + '"]').find('input').prop('checked', isCheck);
				}
			},
			error: function () {
				csrfError();
			}
		});
	});
	processTooltip();
}

$(document).on("submit", ".smsCustomrFrm, .emailCustomrFrm", function (e) {
	e.preventDefault();
	var type = $(this).find('input[name="type"]').val();
	var isActivate = $(this).find('input[name="isActivate"]').val();
	var isCheck = isActivate == '1' ? true : false;
	var cid = $('.t_CID').val();
	
	if (type == '2') {
		var msgTyp = 'Email';
		var msgTypSub = 'email';
	} else {
		var msgTyp = 'Text SMS';
		var msgTypSub = 'text SMS';
	}
	$.ajax({
		url: admin_url + 'customers/sendMessageToCust',
		type: 'POST',
		dataType: 'json',
		data: new FormData(this),
		processData: false,
		contentType: false,
		beforeSend: function () {
			showLoader();
		},
		success: function (data) {
			if (data.status == 'error') {
				swal('Oops...!!', 'Something went wrong. Please try after sometime.', 'error');
			} else if (data.status == 'error_data') {
				swal('Oops...!!', 'You need to fill all the required fields to send ' + msgTypSub, 'error');
			} else if (data.status == 'success') {
				
				$('div[data-cide="' + cid + '"]').find('input').prop('checked', isCheck);
				
				swal({
					title: msgTyp + ' Sent',
					text: 'Record has been updated and also an ' + msgTypSub + ' has been successfully sent. Do you want to continue to send more Email/SMS?',
					type: "success",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes please",
					cancelButtonText: "No, close it"
				}).then(function () {
					if (isActivate == '1') {
						var toolTipMsgsndBtnSE = 'Send more confirmation';
						var btnLblsndBtnSE = 'Send Now';
					} else {
						var toolTipMsgsndBtnSE = 'Send more confirmation';
						var btnLblsndBtnSE = 'Send Now';
					}
					$('.actBtnCA').addClass('hide_now');
					$('.sndBtnSE span').html(btnLblsndBtnSE);
					$('.sndBtnSE').attr('title', toolTipMsgsndBtnSE).tooltip('fixTitle');
				}, function (dismiss) {
					if (dismiss === 'cancel') {
						$('#customerCustmMsgSMS').modal('hide');
					}
				});
				var isPendKycID = $('.isPendKycID').val()
				if(isPendKycID){					
					$('.finalCmnt'+isPendKycID).closest('tr').fadeOut( function(){
						$('.finalCmnt'+isPendKycID).closest('tr').remove();
					});
				}
			} else {
				csrfError();
			}
		},
		error: function () {
			csrfError();
		}
	});
});

$(document).on("submit", "#sendMessageToCust", function (e) {
	e.preventDefault();
	var type = $('#sendMessageToCust input[name="type"]').val();
	if (type == '2') {
		var msgTyp = 'Email';
		var msgTypSub = 'email';
	} else {
		var msgTyp = 'Text SMS';
		var msgTypSub = 'text SMS';
	}
	$.ajax({
		url: admin_url + 'customers/sendMessageToCust',
		type: 'POST',
		dataType: 'json',
		data: new FormData(this),
		processData: false,
		contentType: false,
		beforeSend: function () {
			showLoader();
		},
		success: function (data) {
			if (data.status == 'error') {
				swal('Oops...!!', 'Something went wrong. Please try after sometime.', 'error');
			} else if (data.status == 'error_data') {
				swal('Oops...!!', 'You need to fill all the required fields to send ' + msgTypSub, 'error');
			} else if (data.status == 'success') {
				timerAlert(msgTyp + ' Sent', 'You ' + msgTypSub + ' has been successfully sent.', '', 3000);
				$('#customMessage').modal('hide');
			} else {
				csrfError();
			}
		},
		error: function () {
			csrfError();
		}
	});
});

function refreshTemplateList(type) {
	var dataString = {
		type: type,
	};
	$.ajax({
		url: admin_url + 'others/refreshTemplateList',
		dataType: 'json',
		type: "POST",
		data: dataString,
		beforeSend: function () {
			showLoader();
		},
		success: function (obj) {
			var defaultListing = '<option value="add" data-icon="glyphicon-plus">  Add more template</option><option value="0" data-icon="glyphicon-pencil">  Custom text</option>' + obj.result;
			if (type == '2') {
				$('.sendCustmEml input[name="subject"]').val('');
				$('.sendCustmEml textarea[name="message"]').summernote("code", '');
				$('.sendCustmEml select.selectpicker').html(defaultListing);
			} else {
				$('.sendCustmSMS input[name="subject"]').tagsinput('removeAll');
				$('.sendCustmSMS textarea[name="sms"]').val('');
				$('.sendCustmSMS select.selectpicker').html(defaultListing);
			}
		},
		error: function () {
			csrfError();
		}
	});

}

function getCustomEmailSMSTemplate(id, type) {
	if (id == 'add') {
		if (type == '2') {
			var tabU = 'add-email';
		} else {
			var tabU = 'add-sms';
		}
		var url = admin_url + 'others/templates/' + type + '?tab=' + tabU;
		window.open(url);
		return false;
	}

	if (id == '0') {
		if (type == '2') {
			$('.sendCustmEml input[name="subject"]').val('');
			$('.sendCustmEml textarea[name="message"]').summernote("code", '');
		} else {
			$('.sendCustmSMS input[name="subject"]').tagsinput('removeAll');
			$('.sendCustmSMS textarea[name="sms"]').val('');
		}
		return false;
	}

	var dataString = {
		id: id,
	};
	$.ajax({
		url: admin_url + 'others/getEmailSMSTemplate',
		dataType: 'json',
		type: "POST",
		data: dataString,
		beforeSend: function () {
			showLoader();
		},
		success: function (obj) {
			if (type == '2') {
				$('.sendCustmEml input[name="subject"]').val(obj.subject);
				$('.sendCustmEml textarea[name="message"]').summernote("code", obj.message);
			} else {
				$('.sendCustmSMS input[name="subject"]').tagsinput('removeAll');
				$('.sendCustmSMS input[name="subject"]').tagsinput('add', obj.subject);
				$('.sendCustmSMS textarea[name="sms"]').val(obj.message);
			}
			emailTempID = $("selected.selectPiEamil").val();
			smsTempID = $("selected.selectPiSMS").val();
		},
		error: function () {
			csrfError();
		}
	});
}

function getEmailSMSTemplate(id) {
	//emailTempID
	//smsTempID
	//isTempUpdT
	var type = $('#sendMessageToCust input[name="type"]').val();
	if (id == 'add') {
		if (type == '2') {
			var tabU = 'add-email';
		} else {
			var tabU = 'add-sms';
		}
		var url = admin_url + 'others/templates/' + type + '?tab=' + tabU;
		window.open(url);
		return false;
	}

	if (id == '0') {
		$('#sendMessageToCust input[name="title"]').val('');
		$('#sendMessageToCust input[name="subject"]').val('');

		if (type == '2') {
			$('#sendMessageToCust textarea[name="message"]').summernote("code", '');
		} else {
			$('#sendMessageToCust textarea[name="sms"]').html('');
		}
		return false;
	}
	var dataString = {
		id: id,
	};
	$.ajax({
		url: admin_url + 'others/getEmailSMSTemplate',
		dataType: 'json',
		type: "POST",
		data: dataString,
		beforeSend: function () {
			showLoader();
		},
		success: function (obj) {
			$('#sendMessageToCust input[name="subject"]').val(obj.subject);
			if (obj[0].type == '2') {
				$('#sendMessageToCust textarea[name="message"]').summernote("code", obj.message);
			} else {
				$('#sendMessageToCust textarea[name="sms"]').html(obj.message);
			}
			emailTempID = $("selected.selectPiEamil").val();
			smsTempID = $("selected.selectPiSMS").val();
		},
		error: function () {
			csrfError();
		}
	});
}

function modelCustomSMS(type) {
	$('.emailSubBtn, .smsSubBtn').hide();
	if (type == '2') {
		$('.emailSubBtn').show();
		$('.sendTypeLbl').html('Email');
	} else {
		$('.smsSubBtn').show();
		$('.sendTypeLbl').html('Text SMS');
	}
	$('#sendMessageToCust input[name="type"]').val(type);
	$('#customMessage').modal({
		backdrop: 'static',
		keyboard: false
	})
	processTooltip();
	return false;

	var dataString = {
		id: id,
	};
	$.ajax({
		url: admin_url + 'contact/contactQuickView/',
		dataType: 'json',
		type: "POST",
		data: dataString,
		beforeSend: function () {
			showLoader();
		},
		success: function (obj) {
			if (obj.requestStatus == 'error') {
				swal("Sorry!", "No record found.", "error");
			} else {
				$('.qEmail span').html(obj.email);
				$('.qPhone span').html(obj.phone);
				$('.qIp span').html(obj.ip);
				$('.qStatus span').html(obj.status);
				$('.qCreated span').html(obj.created_on);
				$('.qSubCon').html(obj.subject);
				$('.qMsgCon').html(obj.message);
				$('.replyModb').attr('href', 'mailTo:' + obj.emailOnly);
				$('#contactQuickView').modal();
			}
		},
		error: function () {
			csrfError();
		}
	});
}

function contactQuickView(id) {
	var dataString = {
		id: id,
	};
	$.ajax({
		url: admin_url + 'contact/contactQuickView/',
		dataType: 'json',
		type: "POST",
		data: dataString,
		beforeSend: function () {
			showLoader();
		},
		success: function (obj) {
			if (obj.requestStatus == 'error') {
				swal("Sorry!", "No record found.", "error");
			} else {
				$('.qEmail span').html(obj.email);
				$('.qPhone span').html(obj.phone);
				$('.qIp span').html(obj.ip);
				$('.qStatus span').html(obj.status);
				$('.qCreated span').html(obj.created_on);
				$('.qSubCon').html(obj.subject);
				$('.qMsgCon').html(obj.message);
				$('.replyModb').attr('href', 'mailTo:' + obj.emailOnly);
				$('#contactQuickView').modal();
			}
		},
		error: function () {
			csrfError();
		}
	});
}

function markNotiasReadUnread(selfObj, id) {
	var notiCnt = parseInt($('.newmsgcnt').data('newmsgcnt'));
	if (id != 'all') {
		var isread = $(selfObj).attr('data-isread');
		var procs = true;
		if (isread == '1') {
			$(selfObj).attr('data-isread', '0');
			$(selfObj).attr('title', 'Mark as Unread');
			$(selfObj).attr('data-original-title', 'Mark as Unread');
			$(selfObj).removeClass('green').addClass('grey');
			$(selfObj).html('<i class="far fa-envelope-open"></i>');
			notiCnt--;
		} else {
			$(selfObj).attr('data-isread', '1');
			$(selfObj).attr('title', 'Mark as Read');
			$(selfObj).attr('data-original-title', 'Mark as Read');
			$(selfObj).removeClass('grey').addClass('green');
			$(selfObj).html('<i class="far fa-envelope"></i>');
			notiCnt++;
		}
	} else {
		var acnBtn = $('.fa-envelope, .fa-envelope-open');
		$(acnBtn).attr("data-isread", "0");
		$(acnBtn).data("isread", "0");
		$(acnBtn).attr('title', 'Mark as Unread');
		$(acnBtn).attr('data-original-title', 'Mark as Unread');
		$(acnBtn).closest('a').removeClass('green').addClass('grey');
		$(acnBtn).removeClass('fa-envelope').addClass('fa-envelope-open');
		notiCnt = 0;
	}

	$('.newmsgcnt').data('newmsgcnt', notiCnt);
	if (notiCnt) {
		$('.newmsgcnt')
			.attr('title', notiCnt + ' Unread Message')
			.tooltip('fixTitle');
		$('.newmsgcnt, .btnmarkAll').show();
	} else {
		$('.newmsgcnt, .btnmarkAll').hide();
	}

	var dataString = {
		type: $(selfObj).attr('data-isread'),
		id: id
	};
	$.ajax({
		type: "POST",
		url: admin_url + "contact/markReadUnread",
		data: dataString,
		cache: false,
		success: function (data) {
			if (id == 'all') {
				$('.acnBt').attr('data-isread', '1');
				$('.acnBt').attr('title', 'Mark as Unread');
				$('.acnBt').attr('data-original-title', 'Mark as Unread');
				$('.acnBt').removeClass('btn-success').addClass('btn-default');
				$('.acnBt').html('<i class="fa fa-envelope-o"></i>');
			}
		},
		error: function () {
			csrfError();
		},
	});
	processTooltip();
}

$(document).on("submit", "#contactUsMsgForm", function (e) {
	e.preventDefault();
	var email = $('input[name="email"]').val();
	if(!validateEmail(email) && email){
		$('.emailErrorMsg').slideDown();
		swal('Oops...!!', 'Please enter a valid email', 'error');
		return false;
	}else{
		$('.emailErrorMsg').slideUp();
	}
	
	if ($('#contactUsMsgForm textarea').val().length < 20) {
		swal('Oops...!!', 'You must enter at least 50 character in message', 'error');
		return false;
	}
	$.ajax({
		url: admin_url + 'contact/store_message',
		type: 'POST',
		dataType: 'json',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (data) {
			if (data.status == 'error') {
				swal('Oops...!!', 'You must must fill all the required fields', 'error');
			} else {
				timerAlert('Message Sent', 'You message has been successfully sent. We will get back to your soon', admin_url, 3000);
			}
		},
		error: function () {
			csrfError();
		}
	});
});

function deleteCommon(selfObj, id, type) {
	var dataString = {
		id: id,
		type: type
	};
	swal({
		title: "Are you sure?",
		text: "Do you want to delete this record?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, I am sure!",
		cancelButtonText: "No, cancel it!"
	}).then(function () {
		$.ajax({
			url: admin_url + 'process/deleteCommon/',
			dataType: 'json',
			type: "POST",
			data: dataString,
			beforeSend: function () {
				showLoader();
			},
			success: function () {
				timerAlert('Deleted!', 'record has been deleted');
				$(selfObj).closest('tr').remove();
			},
			error: function () {
				csrfError();
			}
		});
	}, function (dismiss) {
		if (dismiss === 'cancel') {
			swal("Cancelled", "Nothing happned :)", "error");
		}
	});
}

$(document).on("submit", "#userProfileAddEdit", function (e) {
	e.preventDefault();
	var email = $('input[name="email"]').val();
	if(!validateEmail(email) && email){
		$('.emailErrorMsg').slideDown();
		swal('Oops...!!', 'Please enter a valid email', 'error');
		return false;
	}else{
		$('.emailErrorMsg').slideUp();
	}
	
	$.ajax({
		url: admin_url + 'process/userProfileAddEdit',
		type: 'POST',
		dataType: 'json',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (data) {
			if (data.status == 'username-error') {
				swal("Sorry!", "This username is not available, choose a different username.", "error");
			} else if (data.status == 'email-error') {
				swal("Sorry!", "This email address is not available, choose a different email address.", "error");
			} else {
				timerAlert('Updated', 'Updated Successfully!!', admin_url + 'others/manage_users');
			}
		},
		error: function () {
			csrfError();
		}
	});
});

function adminQuickView(aid) {
	var dataString = {
		aid: aid,
	};
	$.ajax({
		url: admin_url + 'others/adminQuickView/',
		dataType: 'json',
		type: "POST",
		data: dataString,
		beforeSend: function () {
			showLoader();
		},
		success: function (obj) {
			if (obj.requestStatus == 'error') {
				swal("Sorry!", "No record found.", "error");
			} else {
				$('.qName span').html(obj.fname + ' ' + obj.lname);
				$('.qUsername span').html(obj.username);
				$('.qEmail span').html(obj.email);
				$('.qPhone span').html(obj.phone);
				$('.qRole span').html(obj.role);
				$('.qStatus span').html(obj.status);
				$('.qCreated span').html(obj.created_date);
				$('.qLastLogin span').html(obj.lastLogin);
				$('.qUAAvtar').attr('src', obj.avtar);
				$('.editModb').attr('href', admin_url + 'others/manage_users/edit/' + aid);
				$('#profileQuickView').modal();
			}
		},
		error: function () {
			csrfError();
		}
	});
}

function customerQuickView(cid) {
	var dataString = {
		cid: cid,
	};
	$.ajax({
		url: admin_url + 'customers/customerQuickView/',
		dataType: 'json',
		type: "POST",
		data: dataString,
		beforeSend: function () {
			showLoader();
		},
		success: function (obj) {
			if (obj.requestStatus == 'error') {
				swal("Sorry!", "No record found.", "error");
			} else {
				if (obj.kycStatus == '0') {
					obj.kycStatus = 'Rejected';
					var kycStCls = 'badge-danger';
					obj.comment = 'Reason: ' + obj.comment;
				} else if (obj.kycStatus == '1') {
					obj.kycStatus = 'Verified';
					var kycStCls = 'badge-success';
					obj.comment = 'KYC status is Verified'
				} else if (obj.kycStatus == '2') {
					obj.kycStatus = 'Pending';
					var kycStCls = 'badge-warning';
					obj.comment = 'KYC status is Pending Verification';
				}

				if (obj.custStatus == '0') {
					obj.custStatus = 'Inactive';
					var custStCls = '';
				} else if (obj.custStatus == '1') {
					obj.custStatus = 'Active';
					var custStCls = 'badge-success';
				}

				$('.cuName').html(obj.fname + ' ' + obj.lname);
				$('.cuLastLogin').html(obj.lastLogin);
				$('.cuUsername').html(obj.username);
				$('.cuEmail').html(obj.email);
				$('.cuCustStatus span').html(obj.custStatus).addClass(custStCls);
				$('.cuRegDate').html(obj.registrationDate);
				$('.cuGender').html(obj.gender);
				$('.cuPhone').html(obj.phone);
				$('.cuProfileType').html(obj.profileType);
				$('.cuProfileID').html(obj.profileID);
				$('.cuAccountNo').html(obj.accountNo);
				$('.cuKYCType').html(obj.kycType);
				$('.cuKYCID').html(obj.idNumber);
				$('.cuKYCStatus span').attr('title', obj.comment).tooltip('fixTitle').html(obj.kycStatus).addClass(kycStCls);
				$('.viewModbC').attr('href', admin_url + 'customers/view/' + cid);
				$('#customerQuickVwTbl').modal();
			}
		},
		error: function () {
			csrfError();
		}
	});
}

function restoreDefaltTemplt(selfObj, id) {
	var dataString = {
		id: id,
	};
	$.ajax({
		url: admin_url + 'others/restoreDefault/',
		dataType: 'json',
		type: "POST",
		data: dataString,
		beforeSend: function () {
			showLoader();
		},
		success: function (obj) {
			$(selfObj).closest('form').find('input[name="title"]').val(obj[0].default_title);
			$(selfObj).closest('form').find('input[name="subject"]').val(obj[0].default_subject);
			$(selfObj).closest('form').find('textarea[name="message"]').summernote("code", obj[0].default_msg);
		},
		error: function () {
			csrfError();
		}
	});
}

function deleteTemplate(id, tab) {
	var dataString = {
		id: id,
		type: 'template'
	};
	swal({
		title: "Are you sure?",
		text: "Do you want to delete this template?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, I am sure!",
		cancelButtonText: "No, cancel it!"
	}).then(function () {
		$.ajax({
			url: admin_url + 'process/changeStatus/',
			dataType: 'json',
			type: "POST",
			data: dataString,
			beforeSend: function () {
				showLoader();
			},
			success: function () {
				timerAlert('Deleted!', 'Template has been deleted', admin_url + 'others/templates/' + tab);
			},
			error: function () {
				csrfError();
			}
		});
	}, function (dismiss) {
		if (dismiss === 'cancel') {
			swal("Cancelled", "Nothing happned :)", "error");
		}
	});
}

$(document).on("submit", "form[class*=msgSMSTemplFrm]", function (e) {
	e.preventDefault();
	$.ajax({
		url: admin_url + 'others/storeTemplate',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (data) {
			if (data.status == 'updated') {
				swal("Update!", "Template has been updated.", "success");
			} else if (data.status == 'error') {
				swal('Oops...', 'Please fill all fields', 'error');
			} else {
				timerAlert('Created!', 'New Template has been created', admin_url + 'others/templates/' + data.type + '/' + data.status);
			}
		},
		error: function () {
			csrfError();
		}
	});
});

$(document).on("click", ".kycacptDecFn", function () {
	var type = $(this).data('type');
	var kycid = $(this).data('kycid');
	var isModelV = $(this).data('model');

	var dataString = {
		id: kycid,
		type: 'kyc',
		value: type
	};

	if (type) {
		var msg = 'Do you want to Accept KYC for this customer?';
		var status = '<span data-toggle="tooltip" title="KYC has been verified" class="badge badge-success">Verified</span>';
	} else {
		if (isModelV) {
			$('#rejectReasonMod').modal();
			$('#rejectReasonMod .kycacptDecFn').attr('data-kycid', kycid);
			return false;
		} else {
			if ($('#rejectReasonMod textarea').val().length < 20) {
				swal('Oops...!!', 'You must enter rejections reason at least 20 character', 'error');
				return false;
			}
		}
		dataString.data = $('#rejectReasonMod textarea').val();
		var msg = 'Do you want to Reject KYC for this customer?';
		var status = '<span data-toggle="tooltip" title="Rejected:</br>' + $('#rejectReasonMod textarea').val() + '" class="badge badge-danger">Rejected</span>';
	}
	swal({
		title: "Are you sure?",
		text: msg,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, I am sure!",
		cancelButtonText: "No, cancel it!"
	}).then(function () {
		$.ajax({
			url: admin_url + 'process/changeStatus/',
			dataType: 'json',
			type: "POST",
			data: dataString,
			beforeSend: function () {
				showLoader();
			},
			success: function (data) {
				if ($('.isDetailPage').val()) {
					timerAlert('Update!', 'Record has been updated.', admin_url + 'customers/kyc');
				} else {
					swal("Update!", "Record has been updated.", "success");
					$('.statKY' + data.status).closest('td').html(status);
					$('#rejectReasonMod').modal('hide');
					var totlPnd = $('.tooltipPendNav').data('pendingkyc');
					totlPnd--;
					$('.tooltipPendNav').data('pendingkyc', totlPnd);
					if (totlPnd) {
						$('.tooltipPendNav')
							.attr('title', totlPnd + ' Pending KYC')
							.tooltip('fixTitle');
					} else {
						$('.tooltipPendNav').remove();
					}
					if ($('.customerDetailPage').val()) {
						$('.boxInfoKycP').toggleClass('col-sm-6 col-sm-9');
						$('.customerDetailPage').closest('.col-sm-3').remove();
						$('.kycPenIcn').remove();

						if (type) {
							var resonCls = 'badge-success';
							var resonLbl = 'Approved';
						} else {
							var resonCls = 'badge-danger';
							var resonLbl = 'Rejected';
							$('.comntPnlCus').removeClass('hide_now');
							$('.comntPnlCus .profile-info-value').html($('#rejectReasonMod textarea').val());
						}
						$('.stsIcKc').removeClass('badge-warning').addClass(resonCls).html(resonLbl);
					}
				}
			},
			error: function () {
				csrfError();
			}
		});
	}, function (dismiss) {
		if (dismiss === 'cancel') {
			swal("Cancelled", "Nothing happned :)", "error");
		}
	});
});

$(document).on("submit", "#customerUpdateProfile", function (e) {
	e.preventDefault();
	if ($('.aid').val()) {
		var subj = '';
		var msg = '';
	} else {
		var subj = 'Created Successfully!';
		var msg = 'New user has been created';
	}
	$.ajax({
		url: admin_url + 'customers/customerUpdateProfile',
		type: 'POST',
		dataType: 'json',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (data) {
			if (data.status == 'username_error') {
				swal("Sorry!", "This username is not available, choose a different username.", "error");
			} else if (data.status == 'email_error') {
				swal("Sorry!", "This email address is not available, choose a different email address.", "error");
			} else if (data.status == 'error') {
				csrfError();
			} else if (data.status == 'data_error') {
				swal("Sorry!", "This email address is not available, choose a different email address.", "error");
			} else {
				timerAlert('Updated !!', 'Customer Profile has been updated successfully', 'reload');
			}
		},
		error: function () {
			csrfError();
		}
	});
});

$(document).on("submit", "#customerUpdatePassword", function (e) {
	e.preventDefault();
	var nPassword = $('.custnPassword').val();
	var cPassword = $('.custcPassword').val();
	if (!nPassword || !cPassword) {
		swal('Oops...', 'Please fill all fields', 'error');
		return false;
	}
	if (!validatePassword(nPassword, '')) {
		swal('Oops...', 'Please include atleast 6 characters, a lowercase letter, a uppercase letter, a number and a special character', 'error');
		return false;
	}

	if (cPassword != nPassword) {
		swal('Oops...', 'Your new password and confirmation password do not match, please retype', 'error');
		return false;
	}
	$.ajax({
		url: admin_url + 'customers/customerUpdatePassword',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (data) {
			if (data.status == 'data_error') {
				swal('Oops...', 'Please fill all fields', 'error');
			} else if (data.status == 'error') {
				csrfError();
			} else {
				swal("Update!", "Your password has been updated.", "success");
				$('#custChangePassMod').modal('hide');
			}
			$('.custnPassword').val('');
			$('.custcPassword').val('');
		},
		error: function () {
			csrfError();
		}
	});
});

$(document).on("submit", "#adminUpdatePas", function (e) {
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
				$('#adminUpdatePas button[data-dismiss="modal"]').click();
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

$(document).on("submit", "#assignAdminGroup", function (e) {
	e.preventDefault();
	$.ajax({
		url: admin_url + 'groups/assignAdminGroup',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		beforeSend: function () {
			showLoader()
		},
		success: function (data) {
			timerAlert('Successful!!', 'New admin has been updated.', 'reload');
		},
		error: function () {
			csrfError();
		}
	});
});

function getgroupMemberOnlyList() {
	$.ajax({
		url: admin_url + 'groups/getmembersonly/' + $('.filter_id').val(),
		type: "POST",
		dataType: 'json',
		beforeSend: function () {
			showLoader()
		},
		success: function (obj) {
			var htmlTml = '';
			$.each(obj, function (key, value) {
				var isAdmin = value.isAdmin == '1' ? 'checked' : '';
				htmlTml += '<tr>' +
					'<td><a target="_blank" href="' + admin_url + 'customers/view/' + value.user_id + '">' + value.first_name + ' ' + value.last_name + '</a></td>' +
					'<td>' + value.profile_id + '</td>' +
					'<td>' +
					'<div onClick="assignAdminGroupModl(this)" class="swithAraBoxBefre">' +
					'<label class="switchS switchSCuStatus"><input ' + isAdmin + ' value="' + value.profile_id + '" name="groupMemAry[]" class="switchS-input" type="checkbox" />' +
					'<span class="switchS-label" data-on="Admin" data-off="Member"></span>' +
					'<span class="switchS-handle"></span>' +
					'</label>' +
					'</div>' +
					'</td>' +
					'</tr>';
			});
			$('.boxMemAsiAr').html(htmlTml);
			$('#groupAdminMod').modal();
		},
		error: function () {
			csrfError();
		}
	});
}

function changeGroupStatus(selfObj, id, type) {
	var msg, action = '';
	var dataString = {
		id: id,
		type: type,
	};

	if ($(selfObj).find('input').is(':checked')) {
		dataString.value = '0';
		var isActivate = 0;
		var isCheck = false;
		var emailTyp = 17;
		var smsTyp = 18;
		var msg = 'Do you want to mark this group as inactive?';
	} else {
		dataString.value = '1';
		var isActivate = 1;
		var isCheck = true;
		var emailTyp = 19;
		var smsTyp = 20;
		var msg = 'Do you want to mark this group as active?';
	}
	$('.idBxTemp').val(id);
	$('.isActivateBoxTemp').val(isActivate);

	swal({
		title: "Are you sure?",
		text: msg,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, I am sure!",
		cancelButtonText: 'No, cancel it!'
	}).then(function () {
		if (!isCheck) {
			$('#suspendReasonMod input[name="groupID"]').val(id);
			$('#suspendReasonMod').modal();
			return false;
		}
	}, function (dismiss) {
		if (dismiss === 'cancel') {

		}
	});
	processTooltip();
}

function getGroupEmailModal() {
	var id = $('.idBxTemp').val();
	var isActivate = $('.isActivateBoxTemp').val();

	var emailTyp = $('.emailTypID').val();
	var smsTyp = $('.smsTypID').val();
	if (isActivate == '1') {
		var toolTipMsgsndBtnSE = 'Activate this group <br> <b>with</b> confirmation';
		var btnLblsndBtnSE = 'Activate group and send';

		var toolTipMsgactBtnCA = 'Activate this group <br> <b>witout</b> confirmation';
		var btnLblactBtnCA = 'Activate group';
	} else {
		var toolTipMsgsndBtnSE = 'Inactivate this group <br> <b>with</b> confirmation';
		var btnLblsndBtnSE = 'Suspend group and send';

		var toolTipMsgactBtnCA = 'Inactivate this group <br> <b>witout</b> confirmation';
		var btnLblactBtnCA = 'Suspend group';
	}
	$('.sndBtnSE span').html(btnLblsndBtnSE);
	$('.actBtnCA span').html(btnLblactBtnCA);
	$('.sndBtnSE').attr('title', toolTipMsgsndBtnSE).tooltip('fixTitle');
	$('.actBtnCA').attr('title', toolTipMsgactBtnCA).tooltip('fixTitle').removeClass('hide_now');
	$('.actBtnCA').attr('onclick', 'updateGroupStatus()');
	$('input[name="isActivate"]').val(isActivate);
	$('.t_CID').val(id);
	getCustomEmailSMSTemplate(emailTyp, 2);
	getCustomEmailSMSTemplate(smsTyp, 1);
	$('.sendCustmEml .toEmal, .sendCustmSMS .toSMS').tagsinput('removeAll');

	$.ajax({
		url: base_url + 'admin/groups/getmembersonly/' + id + '/false' + '/1',
		type: "POST",
		dataType: 'json',
		success: function (obj) {
			var htmlTml = '';
			$.each(obj, function (key, value) {
				$('.sendCustmEml .toEmal').tagsinput('add', value.email);
				$('.sendCustmSMS .toSMS').tagsinput('add', value.msisdn);
			});
		},
		error: function () {
			csrfError();
		}
	});

	$('.sendCustmEml').addClass('emailGroupFrm');
	$('.sendCustmSMS').addClass('smsGroupFrm');
	$('.sendCustmEml select.selectpicker').val(emailTyp);
	$('.sendCustmSMS select.selectpicker').val(smsTyp);
	$('.selectpicker').selectpicker('refresh');
	$('#customerCustmMsgSMS').modal({
		backdrop: 'static',
		keyboard: false
	});
}



function changeGroupMemberStatus(selfObj, id, type, email, msisd) {
	var msg, action, isCheck = '';
	var dataString = {
		id: id,
		type: type,
	};

	$('.activeMemEml').val(email);
	$('.activeMemSms').val(msisd)

	var k = 0;
	$('.swithAraBoxBefre').each(function () {
		if ($(this).data('isadmin') == '1') {
			k++;
		}
	});

	if (k == '1' && $(selfObj).find('input').is(':checked') && $(selfObj).data('isadmin') == '1') {
		swal({
			title: "Oops!!",
			text: 'This member is an group admin. Please assign another member as a admin for this group before inactivating this member',
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Assign new admin",
			cancelButtonText: "No, cancel it!"
		}).then(function () {
			getgroupMemberOnlyList();
		});
		return false;
	}
	var canBtnLBl = 'No, cancel it!';
	var isYes = false;
	if ($(selfObj).find('input').is(':checked')) {
		dataString.value = '0';
		var isActivate = 0;
		isCheck = false;
		var emailTyp = 13;
		var smsTyp = 14;
		var msg = 'Do you want to mark this group member as inactive?';
	} else {
		dataString.value = '1';
		var isActivate = 1;
		isCheck = true;
		var emailTyp = 15;
		var smsTyp = 16;
		var msg = 'Do you want to mark this group member as active?';
	}
	$('.emailTypID').val(emailTyp);
	$('.smsTypID').val(smsTyp);
	$('.idBxTemp').val(id);
	$('.isActivateBoxTemp').val(isActivate);
	swal({
		title: "Are you sure?",
		text: msg,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, I am sure!",
		cancelButtonText: canBtnLBl
	}).then(function () {
		if (!isCheck) {
			$('#suspendReasonMod input[name="mid"]').val(id);
			$('#suspendReasonMod').modal();
			return false;
		}
		getMemberEmailModal();
	}, function (dismiss) {
		if (dismiss === 'cancel') {

		}
	});
	processTooltip();
}

$(document).on("submit", "#suspendGroupMemberReason", function (e) {
	e.preventDefault();
	$.ajax({
		url: admin_url + 'groups/suspendGroupMemberReason',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		beforeSend: function () {
			showLoader();
		},
		success: function (data) {
			$('#suspendReasonMod').modal('hide');
			if ($('input[name="groupID"]').val()) {
				var groupMdl = true;
			} else {
				var groupMdl = false;
			}
			$(suspendGroupMemberReason)[0].reset();
				updateGroupStatus($('input[name="groupID"]').val());
			},
		error: function () {
			csrfError();
		}
	});
});

function updateGroupStatus(gid) {
	var dataString = {
		id: gid,
		type: 'group',
		value: $('input[name="isActivate"]').val()
	};
	if ($('input[name="isActivate"]').val() == '1') {
		var msg = 'Do you want to mark this group active without sending any confirmation?';
		isCheck = true;
	} else {
		var msg = 'Do you want to mark this group inactive without sending any confirmation?';
		isCheck = false;
	}
	swal({
		title: "Are you sure?",
		text: msg,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, I am sure!",
		cancelButtonText: "No, cancel it!"
	}).then(function () {
		$.ajax({
			url: admin_url + 'process/changeStatus/',
			type: "POST",
			data: dataString,
			beforeSend: function () {
				showLoader()
			},
			success: function (data) {
				swal("Update!", "Record has been updated.", "success");
				$('#customerCustmMsgSMS').modal('hide');
				$('div[data-gide="' + gid + '"]').find('input').prop('checked', isCheck);
			},
			error: function () {
				csrfError();
			}
		});
	});
	processTooltip();
}


function getMemberEmailModal() {
	var id = $('.idBxTemp').val();
	var isActivate = $('.isActivateBoxTemp').val();

	var emailTyp = $('.emailTypID').val();
	var smsTyp = $('.smsTypID').val();
	if (isActivate == '1') {
		var toolTipMsgsndBtnSE = 'Activate this customer <br> <b>with</b> confirmation';
		var btnLblsndBtnSE = 'Activate member and send';

		var toolTipMsgactBtnCA = 'Activate this customer <br> <b>witout</b> confirmation';
		var btnLblactBtnCA = 'Activate member';
	} else {
		var toolTipMsgsndBtnSE = 'Inactivate this customer <br> <b>with</b> confirmation';
		var btnLblsndBtnSE = 'Suspend member and send';

		var toolTipMsgactBtnCA = 'Inactivate this customer <br> <b>witout</b> confirmation';
		var btnLblactBtnCA = 'Suspend member';
	}
	$('.sndBtnSE span').html(btnLblsndBtnSE);
	$('.actBtnCA span').html(btnLblactBtnCA);
	$('.sndBtnSE').attr('title', toolTipMsgsndBtnSE).tooltip('fixTitle');
	$('.actBtnCA').attr('title', toolTipMsgactBtnCA).tooltip('fixTitle').removeClass('hide_now');
	$('.actBtnCA').attr('onclick', 'updateGroupMemberStatus()');
	$('input[name="isActivate"]').val(isActivate);
	$('.t_CID').val(id);
	getCustomEmailSMSTemplate(emailTyp, 2);
	getCustomEmailSMSTemplate(smsTyp, 1);
	$('.sendCustmEml .toEmal, .sendCustmSMS .toSMS').tagsinput('removeAll');

	if (isActivate == '1') {
		$('.sendCustmEml .toEmal').tagsinput('add', $('.activeMemEml').val());
		$('.sendCustmSMS .toSMS').tagsinput('add', $('.activeMemSms').val());
	}

	$('.emailListing').each(function () {
		if ($(this).data('mstatus') == '1') {
			$('.sendCustmEml .toEmal').tagsinput('add', $(this).html());
		}
	});
	$('.phoneListing').each(function () {
		if ($(this).data('mstatus') == '1') {
			$('.sendCustmSMS .toSMS').tagsinput('add', $(this).html());
		}
	});

	$('.sendCustmEml').addClass('emailMemberFrm');
	$('.sendCustmSMS').addClass('smsMemberFrm');
	$('.sendCustmEml select.selectpicker').val(emailTyp);
	$('.sendCustmSMS select.selectpicker').val(smsTyp);
	$('.selectpicker').selectpicker('refresh');
	$('#customerCustmMsgSMS').modal({
		backdrop: 'static',
		keyboard: false
	});
}

function updateGroupMemberStatus() {
	var cid = $('.t_CID').val()
	var dataString = {
		id: cid,
		type: 'group_member',
		value: $('input[name="isActivate"]').val()
	};
	if ($('input[name="isActivate"]').val() == '1') {
		var msg = 'Do you want to mark this member active without sending any confirmation?';
		isCheck = true;
	} else {
		var msg = 'Do you want to mark this member inactive without sending any confirmation?';
		isCheck = false;
	}
	swal({
		title: "Are you sure?",
		text: msg,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, I am sure!",
		cancelButtonText: "No, cancel it!"
	}).then(function () {
		$.ajax({
			url: admin_url + 'process/changeStatus/',
			type: "POST",
			data: dataString,
			beforeSend: function () {
				showLoader()
			},
			success: function (data) {
				swal("Update!", "Record has been updated.", "success");
				$('#customerCustmMsgSMS').modal('hide');
				$('div[data-cide="' + cid + '"]').find('input').prop('checked', isCheck);
			},
			error: function () {
				csrfError();
			}
		});
	});
	processTooltip();
}


function changeCustomerStatus(selfObj, id, type, value) {
	var msg, action, isCheck = '';
	var dataString = {
		id: id,
		type: type,
		value: value
	};
	var kycstat = $(selfObj).data('kycstat');
	var canBtnLBl = 'No, cancel it!';
	var isYes = false;
	var isCoomentNeeded = false;
	var kid = $(selfObj).data('kid');
	var iEmail = $(selfObj).data('email');
	var iSMS = $(selfObj).data('sms');
	if ($(selfObj).find('input').is(':checked')) {
		dataString.value = '0';
		var isActivate = '0';
		var emailTyp = 7;
		var smsTyp = 8;
		if (type == 'user') {
			var msg = 'Do you want to mark this customer as inactive?';
		}
	} else {
		dataString.value = '1';
		var isActivate = '1';
		var emailTyp = 5;
		var smsTyp = 6;
		if (type == 'user') {
			if (kycstat == '2') {
				var msg = "This customer's KYC is still pending for approval. If you want to proceed for activation, Please choose 'Yes, I am sure!' or 'Verify KYC'";
				canBtnLBl = 'Verify KYC';
				isYes = true;
				var isCoomentNeeded = true;
			} else {
				var msg = 'Do you want to mark this customer as active?';
			}
		}
	}
	swal({
		title: "Are you sure?",
		text: msg,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, I am sure!",
		cancelButtonText: canBtnLBl
	}).then(function () {
		if (isCoomentNeeded) {
			$('.activateActpPending')[0].reset();
			$('.selectpicker').selectpicker('refresh');
			$('.activateActpPending input[name="kycID"]').val(kid);
			$('.activateActpPending .isActiveate').val(isActivate);
			$('.activateActpPending .cID').val(id);
			$('.activateActpPending .emailTyp').val(emailTyp);
			$('.activateActpPending .smsTyp').val(smsTyp);
			$('.activateActpPending .iEmail').val(iEmail);
			$('.activateActpPending .iSMS').val(iSMS);
			$('#activeReasonMod').modal();
			return;
		}
		getCustomerEmailModal(isActivate, id, emailTyp, smsTyp, iEmail, iSMS);
	}, function (dismiss) {
		if (dismiss === 'cancel') {
			if (kycstat == '2' && isYes) {
				timerAlert('Redirecting', 'Page will redirect to KYC Details Page', admin_url + 'customers/kyc/' + id + '/' + kid);
			} else {
				//swal("Cancelled", "Nothing happned :)", "error");
			}
		}
	});
	processTooltip();
}

function getCustomerEmailModal(isActivate, id, emailTyp, smsTyp, iEmail, iSMS) {
	if (isActivate == '1') {
		var toolTipMsgsndBtnSE = 'Activate this customer <br> <b>with</b> confirmation';
		var btnLblsndBtnSE = 'Activate and send';

		var toolTipMsgactBtnCA = 'Activate this customer <br> <b>witout</b> confirmation';
		var btnLblactBtnCA = 'Activate only';
	} else {
		var toolTipMsgsndBtnSE = 'Inactivate this customer <br> <b>with</b> confirmation';
		var btnLblsndBtnSE = 'Inactivate and send';

		var toolTipMsgactBtnCA = 'Inactivate this customer <br> <b>witout</b> confirmation';
		var btnLblactBtnCA = 'Inactivate only';
	}

	$('.sndBtnSE span').html(btnLblsndBtnSE);
	$('.actBtnCA span').html(btnLblactBtnCA);
	$('.sndBtnSE').attr('title', toolTipMsgsndBtnSE).tooltip('fixTitle');
	$('.actBtnCA').attr('title', toolTipMsgactBtnCA).tooltip('fixTitle').removeClass('hide_now');
	$('input[name="isActivate"]').val(isActivate);
	$('.t_CID').val(id);
	getCustomEmailSMSTemplate(emailTyp, 2);
	getCustomEmailSMSTemplate(smsTyp, 1);
	$('.sendCustmEml .toEmal, .sendCustmSMS .toSMS').tagsinput('removeAll');
	$('.sendCustmEml .toEmal').tagsinput('add', iEmail);
	$('.sendCustmSMS .toSMS').tagsinput('add', iSMS);
	$('.sendCustmEml select.selectpicker').val(emailTyp);
	$('.sendCustmSMS select.selectpicker').val(smsTyp);
	$('.selectpicker').selectpicker('refresh');

	$('.sendCustmEml').addClass('emailCustomrFrm');
	$('.sendCustmSMS').addClass('smsCustomrFrm');

	$('#customerCustmMsgSMS').modal({
		backdrop: 'static',
		keyboard: false
	});
}

function newCaptcha() {
	$.ajax({
		url: admin_url + 'login/newCaptcha',
		dataType: 'json',
		type: "POST",
		processData: false,
		contentType: false,
		success: function (obj) {
			$('.imgCpatch').html(obj.result);
		},
		error: function () {
			csrfError();
		},
	});
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

c_idleTime = 60 * 20;
c_idleMax = 60;
$(document).ready(function () {
	createCookie('logoutCookie', c_idleTime);
	if(typeof isEnableTimerCnt === "undefined") {
		var idleInterval = setInterval("timerIncrement()", 1000);
		$(this).mousemove(function (e) {
			createCookie('logoutCookie', c_idleTime);
		});
		$(this).keypress(function (e) {
			createCookie('logoutCookie', c_idleTime);
		});
	}
});

function timerIncrement() {
	u_idleTime = parseInt(readCookie('logoutCookie'));
	u_idleTime--;
	createCookie('logoutCookie', u_idleTime);
	if (u_idleTime == c_idleMax) {
		swal({
			title: "Session Timeout!!",
			text: "Please click Okay to stay loggedin or elase you will be get loggedout within 1 minut",
			type: "warning",
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Keep Logged-in",
		})
	}
	if (u_idleTime < 0) {
		var reURL = window.location.href;
		$(location).attr('href', admin_url + "logout?ulr=" + reURL);
	}
}

function viewProfleUser(id) {
	showLoader();
	$.ajax({
		url: admin_url + 'process/viewProfleUser/' + id,
		dataType: 'json',
		type: 'POST',
		processData: false,
		contentType: false,
		success: function (data) {
			$('.nameV, .emlV, .unameV, .phonV, .blkV, .dstV, .sttV, .utypV, ildV').html('');
			$('input[name="uid"]').val(id);
			$('.userEdVi').attr('onClick', 'userEdit("' + id + '")');
			$('.nameV').html(data.name);
			$('.emlV').html(data.email);
			$('.unameV').html(data.username);
			$('.phonV').html(data.number);
			$('.blkV').html(data.blockName);
			$('.dstV').html(data.districtName);
			$('.sttV').html(data.stateName);
			if (!data.blockName) {
				$('.blKViL').hide();
			} else {
				$('.blKViL').show();
			}
			if (!data.districtName) {
				$('.disViL').hide();
			} else {
				$('.disViL').show();
			}
			if (!data.stateName) {
				$('.sttViL').hide();
			} else {
				$('.sttViL').show();
			}
			$('.utypV').html(data.userType);
			$('.ildV').html(data.empID);
			$('#viewUserModal').modal();
		},
		error: function () {
			csrfError();
		}
	});
}

function userEdit(id) {
	showLoader();
	$('.btnAcion').html('Update Details');
	$('.passTemp, .smDMg').hide();
	$('.chgPasRqst').show();
	$('input[name="username"], select[name="userType"]').prop('disabled', true);
	$.ajax({
		url: admin_url + 'process/getEditUser/' + id,
		dataType: 'json',
		type: 'POST',
		processData: false,
		contentType: false,
		success: function (data) {
			$('select[name="userType"]').val(data.userType);
			$('select[name="userState"]').val(data.stateCode);
			$('select[name="userDist"]').html(data.districtLst);
			$('select[name="userBlock"]').html(data.blockLst);
			$('input[name="uid"]').val(id);
			$('input[name="name"]').val(data.name);
			$('input[name="email"]').val(data.email);
			$('input[name="username"]').val(data.username);
			$('input[name="number"]').val(data.number);
			$('input[name="empID"]').val(data.empID);
			var read_only = data.read_only == '1' ? true : false;
			$('input[name="readOnly"]').bootstrapSwitch('state', read_only);
			$('#addEditUserModal').modal();
		},
		error: function () {
			csrfError();
		}
	});
}

function timerAlert(sub, msg, target, duration) {
	var timer = duration ? duration : 1000;
	swal({
		title: sub,
		text: msg,
		timer: timer,
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

$(document).on("submit", "#adminlogin", function (e) {
	e.preventDefault();
	$.ajax({
		url: admin_url + 'login/validate',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (data) {
			if (data['trigger'] == 'suspended') {
				swal({
					title: 'Suspended!!',
					text: 'Your account has been suspended due to multiple attempt of failed login. You need to reset your password to login',
					confirmButtonColor: '#FF9494',
					type: 'error'
				});
			} else if (data['error'] == 'error') {
				if (data['trigger'] != '') {
					swal({
						title: 'Invalid Login',
						html: 'The email/username or password you entered is not valid. <br> <span class="text-danger">You have attempted ' + data['trigger'] + ' failed login<span>',
						confirmButtonColor: '#FF9494',
						type: 'error'
					});
				} else {
					swal({
						title: 'Invalid Login',
						html: 'The email/username or password you entered is not valid.',
						confirmButtonColor: '#FF9494',
						type: 'error'
					});
				}
			} else if (data['error'] == 'inactive') {
				swal({
					title: 'Suspended!!',
					text: 'You account has been suspended by the site owner. You need to contact site admin to for further assistance',
					confirmButtonColor: '#FF9494',
					type: 'warning'
				});
			} else if (data['error'] == 'captcha') {
				swal({
					title: 'Sorry!!',
					text: 'You have entered a invalid captcha. Please reenter.',
					confirmButtonColor: '#FF9494',
					type: 'warning'
				});
				newCaptcha();
			} else {
				var redictURL = window.location.hash.substring(1);
				redictURL = redictURL ? redictURL : admin_url;
				timerAlert('Login Successfully!', 'Successfully Logged in', redictURL);
			}
		},
		error: function () {
			csrfError();
		}
	});
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

$(document).on("submit", "#updateFinalPass", function (e) {
	e.preventDefault();
	var nPassword = $('#updateFinalPass input[name=nPassword]').val();
	var cPassword = $('#updateFinalPass input[name=cPassword]').val();
	if (!nPassword || !cPassword) {
		swal('Oops...', 'Please fill all fields', 'error');
		return false;
	}
	if (!validatePassword(nPassword, '')) {
		swal('Oops...', 'Please include atleast 6 characters, a lowercase letter, a uppercase letter, a number and a special character', 'error');
		return false;
	}
	if (cPassword != nPassword) {
		swal('Oops...', 'Your new password and confirmation password do not match, please retype', 'error');
		return false;
	}
	$.ajax({
		url: admin_url + 'login/updateFinalPass',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (data) {
			if (data.status == 'error') {
				csrfError();
			} else if (data.status == 'invalid') {
				swal('Oops...!!', 'The OTP has been expired. You need to regenerate a new OTP to change your password.', 'error');
			} else {
				$('#updateFinalPass input[name=nPassword]').val('');
				$('#updateFinalPass input[name=cPassword]').val('');
				timerAlert('Successful!!', 'Your new assword change has been successfully updated', admin_url + 'login');
			}
		},
		error: function () {
			csrfError();
		}
	});
});

$(document).on("submit", ".userRegistraion", function (e) {
	e.preventDefault();
	if ($('.aid').val()) {
		var subj = 'Updated Successfully!';
		var msg = 'User has been updated';
	} else {
		var subj = 'Created Successfully!';
		var msg = 'New user has been created';
	}
	$.ajax({
		url: admin_url + 'process/userRegistraion',
		type: 'POST',
		dataType: 'json',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (data) {
			if (data.status == 'user-error') {
				swal("Sorry!", "This username is not available, choose a different username.", "error");
			} else if (data.status == 'email-error') {
				swal("Sorry!", "This email address is not available, choose a different email address.", "error");
			} else {
				timerAlert(subj, msg, 'reload');
			}
		},
		error: function () {
			csrfError();
		}
	});
});

function checkUserEmailAvlb(data, type) {
	var postVal = "data=" + data;
	postVal += "&type=" + type;
	postVal += "&aid=" + $('input[name="aid"]').val();
	$.getJSON(admin_url + "process/isUserEmailAvailble", postVal, function (data) {
		if (type == 'email') {
			$clsNme = '.eEror';
		} else if (type == 'username') {
			$clsNme = '.uEror';
		}
		if (data.status == 'error') {
			$($clsNme).slideDown();
		} else {
			$($clsNme).slideUp();
		}

	});
}

$(document).on("submit", "#adminProfile", function (e) {
	e.preventDefault();
	$.ajax({
		url: admin_url + 'process/updateProfile',
		type: 'POST',
		dataType: 'json',
		data: new FormData(this),
		processData: false,
		contentType: false,
		success: function (data) {
			if (data.status == 'username-error') {
				swal("Sorry!", "This username is not available, choose a different username.", "error");
			} else if (data.status == 'email-error') {
				swal("Sorry!", "This email address is not available, choose a different email address.", "error");
			} else {
				timerAlert('Updated', 'Updated Successfully!!', 'reload');
			}
		},
		error: function () {
			csrfError();
		}
	});
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

function validateImage(selfObj) {
	var iSize = $(selfObj)[0].files[0].size;
	var imgPath = $(selfObj)[0].value;
	var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	iSize = (iSize / 1024) / 1000;
	if (iSize > 2) {
		return false;
	}

	if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg" || extn == "GIF" || extn == "PNG" || extn == "JPG" || extn == "JPEG") {
		if (typeof (FileReader) == "undefined") {
			return false;
		}
		return true;
	} else {
		swal("Sorry!", "Pls select only images.", "error");
		return false;
	}
}

$(document).on('change', '.previewPrf', function (e) {
	var countFiles = $(this)[0].files.length;
	for (var i = 0; i < countFiles; i++) {
		if (validateImage(this)) {
			updateAdminImage(this, '.previewPrf');
		}
	}
});

function updateAdminImage(selfObj, inputTarget) {
	var fdata = new FormData();
	var myform = $(inputTarget); // specify the form element
	var idata = myform.serializeArray();
	var fileName = $(selfObj)[0].files[0];
	fdata.append('fileData', fileName);
	$.each(idata, function (key, input) {
		fdata.append(input.name, input.value);
	});
	var url = admin_url + "process/uploadProfileImg";
	$.ajax({
		url: url,
		type: "POST",
		dataType: 'json',
		data: fdata,
		processData: false,
		contentType: false,
		beforeSend: function () {
			showLoader()
		},
		success: function (data) {
			if (data.status == "error") {
				swal("Sorry!", "Something wrong with this image. Please select any other image.", "error");
			} else {
				swal("Update!", "Image has been updated.", "success");
				$('.nav-user-photo').attr('src', admin_url + 'uploads/profile/thumb/' + data.status);
			}
		},
		error: function () {
			csrfError();
		}
	});
}

$(document).on('change', '#uploadImage', function () {
	var countFiles = $(this)[0].files.length;
	var imgPath = $(this)[0].value;
	var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

	if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg" || extn == "GIF" || extn == "PNG" || extn == "JPG" || extn == "JPEG") {
		if (typeof (FileReader) != "undefined") {
			for (var i = 0; i < countFiles; i++) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('.previewImgSrc').attr('src', e.target.result);
				}
				reader.readAsDataURL($(this)[0].files[i]);
			}
		}
	} else {
		swal("Sorry!", "Please select only images.", "error");
	}
});

function userActiveDeactiv(selfObj, id, type) {
	if ($(selfObj).hasClass('btn-success')) {
		if (type == 'user') {
			var msg = 'This user will not be able to login untill your reactivate';
		} else if (type == 'indic') {
			var msg = 'No one will be able to view this option to there relevent form.';
		}
		var action = '0';
	} else {
		if (type == 'user') {
			var msg = 'This user will be able to login after this action';
		} else if (type == 'indic') {
			var msg = 'People will be able to view this option to there relevent form.';
		}
		var action = '1';
	}
	swal({
		title: "Are you sure?",
		text: msg,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, I am sure!",
		cancelButtonText: "No, cancel it!"
	}).then(function () {
		$.ajax({
			url: admin_url + 'process/changeStatus/' + id + '/' + action + '/' + type,
			dataType: 'json',
			type: 'POST',
			success: function (data) {
				swal("Update!", "Record has been updated.", "success");
				if ($(selfObj).hasClass('btn-success')) {
					$(selfObj).removeClass('btn-success');
				} else {
					$(selfObj).addClass('btn-success');
				}
			},
			error: function () {
				csrfError();
			}
		});

	}, function (dismiss) {
		if (dismiss === 'cancel') {
			swal("Cancelled", "Nothing happned :)", "error");
		}
	});
	processTooltip();
}

$(document).ready(function () {
	processTooltip();
	$('.dataTables_length select').addClass('cstmTblSelcp').selectpicker({
		width: 'fit'
	});
	if($('.filter_date').length > 0){
		iniDateRange();
	}
});

function iniDateRange(){
	$('.filter_date').daterangepicker({
		'applyClass' : 'btn-sm btn-success',
		'cancelClass' : 'btn-sm btn-info',
		'autoUpdateInput':false,
		locale: {
			applyLabel: 'Apply',
			cancelLabel: 'Clear'
		}
	})
	.prev().on(ace.click_event, function(){
		$(this).next().focus();
	});
	$('.filter_date').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
	});
	$('.filter_date').on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});
}

function processTooltip() {
	$('.tooltip.fade.in').remove();
	$('[data-toggle="tooltip"], [data-tooltip="true"], [data-tooltip="tooltip"]').tooltip({
		container: 'body',
		html: true
	});
	$('.popover.fade.right.in').removeClass('in');
	$('[data-popover="popover"], [data-popover="true"], [data-toggle="popover"]').popover({
		container: 'body',
		html: true,

	});
	$('.popover.fade.right.in').removeClass('in');
}

function resetFilterRecord(isReload) {
	$('.filterPanL input, .filterPanL select').val('');
	$('.selectpicker').selectpicker('refresh');
	processTooltip();
	if(isReload){
		filterRecord();
	}
}

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
	hideLoader();
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
			"url": admin_url + 'ajaxDataTable/' + fn,
			"type": 'POST',
			"data": {
				filterData
			},
		},
	});
}

function ajaxPageTarget(tblName, page, fn) {
	$('.' + tblName).DataTable({
		responsive: true,
		"bDestroy": true,
		"processing": true,
		"serverSide": true,
		"order": [],
		"language": {
			"emptyTable": "No record found"
		},
		"ajax": {
			"url": admin_url + page + '/' + fn,
			"type": 'POST',
			"data": {
				filterData
			},
		},
	});
}

// customer group form submit
$(document).on("submit", "#editNewGroup", function (e) {
	e.preventDefault();
	var id = $('input[name="cgid"]').val();
	if (id != '') {
		var msg = 'updated';
	} else {
		var msg = 'added';
	}
	$.ajax({
		url: admin_url + 'groups/addEditGroup',
		dataType: 'json',
		type: 'POST',
		data: new FormData(this),
		processData: false,
		contentType: false,
		beforeSend: function () {
				showLoader();
		},
		success: function (data) {
			timerAlert('Successfull!', 'Successfully ' + msg, 'reload');
		},
		error: function () {
			csrfError();
		}
	});
});


function editGroup(selfObj, id, type) {
	var dataString = {
		id: id,
		type: type
	};

	$.ajax({
		url: admin_url + 'groups/getData',
		dataType: 'json',
		type: "POST",
		data: dataString,
		beforeSend: function () {
			showLoader();
		},
		success: function (data) {
			if (type == 'groups') {
				$('#editNewGroup h4').html('Edit Group');
				$('input[name="cgid"]').val(id);
				$('input[name="name"]').val(data.name);
				
				var isdefault = $(selfObj).data('isdefault');
				if (isdefault == 1) {
					$('input[name="default"]').prop('checked', true);
				} else {
					$('input[name="default"]').prop('checked', false);
				}
			} 
				$('button[data-target="#groupAddEdit"]').click();


		},
		error: function () {
			csrfError();
		},
	});
}


function changeStatus(selfObj, id, type, target) {
	
	if(target == 'groups'){
		var titleTxt = 'Group';
	}
	
	var dataString = {
		id: id,
		status: status,
		type: type,
		target: target,
	};
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
			
		$.ajax({
			url: base_url + 'admin/process/changeStatus',
			dataType: 'json',
			type: "POST",
			data: dataString,
			beforeSend: function () {
				showLoader();
			},
			success: function (data) {
					timerAlert('Successful!!', 'Record has been deleted Successfully');
					$(selfObj).closest('tr').remove();
			},
			error: function () {
				csrfError();
			},
		});

	});
		
		
		
		
	} else {
		
		
		if ($(selfObj).find('input').is(':checked')) {
			isCheck = false;
			msg = 'Do you want to mark this '+type+' as inactive?';
		} else {
			isCheck = true;
			msg = 'Do you want to mark this '+type+' as active?';
		}
	
		
		if ($(selfObj).find('input').is(':checked')) {
			var status = 0;
			var isCheck = false;
			var msg = 'Do you want to mark this '+titleTxt+' as active?';
	
	
		} else {
			var status = 1;
			var isCheck = true;
			var msg = 'Do you want to mark this group as active?';
	
	
		}
		
		
		
		swal({
			title: "Are you sure?",
			text: msg,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, I am sure!",
			cancelButtonText: "No, cancel it!"
		}).then(function () {
			$.ajax({
				url: base_url + 'admin/process/changeStatus',
				type: "POST",
				dataType: 'json',
				data: dataString,
				beforeSend: function () {
					showLoader();
				},
				success: function () {
					$('div[data-statusid="'+id+'"]').find('input').prop('checked', isCheck);
				},
				error: function () {
					csrfError();
				}
			});
		});
		processTooltip();
		
	}
}
