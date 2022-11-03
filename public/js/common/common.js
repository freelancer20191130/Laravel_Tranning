/**
 * ****************************************************************************
 * 
 * COMMON.JS
 * 
 * 処理概要		:	
 * 作成日		:	
 * 作成者		:	
 *  
 * @package		:	
 * @copyright	:	Copyright (c) ANS-ASIA
 * @version		:	1.0.0
 * ****************************************************************************
 */
var OK = 200; // OK
var NG = 201; // Not good
var EX = 202; // Exception
var EPT = 203; // Empty
var ULF = 405; // status Upload File False
var PE  = 999; // Not permission
/*
 * @author    : namnth - namnth@ans-asia.com
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function () {
        $('#loading').show();
    },
    complete: function () {
        $('#loading').hide();
    },
});

$(document).ready(function() {
    try {
        initializeCommon();
        initEventsCommon();
    } catch (e) {
        alert('ready' + e.message);
    }
});
/*
 * initialize
 * @author    : manhnd – manhnd@ans-asia.com - create: 2022/06/21
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */

function initializeCommon() {
    try {
    } catch (e) {
        alert('initEvents: ' + e.message);
    }
}
/*
 * init
 * @author    : namnth - namnth@ans-asia.com
 * @author    : manhnd – manhnd@ans-asia.com 
 * @return    : null
 * @access    : public
 * @see       : init
 */
function initEventsCommon() {
    try {
        // Click on close-popup-icon => hide popup has employee information
        $(document).on('click', '#close-popup-icon', function () {
            $('#overlay').hide();
        });
        // Focus input before or after type 
        $(document).on('focus', 'input[type=text]', function (event) {
            let attr = $(this).attr('maxlength');
            if (typeof attr !== 'undefined' && attr !== false) {
                // clearErrors();
                let max_length = $(event.target).attr('maxlength');
                let length = $(event.target).val().length;
                if (length != 0 && length >= max_length) {
                    $(event.target).after('<span class="lg">' + length + '/' + max_length + '</span>');
                    $(event.target).parents().find('.lg').addClass('lg-max');
                }
                else if (length != 0 && length < max_length) {
                    $(event.target).after('<span class="lg">' + length + '/' + max_length + '</span>');
                    $(event.target).parents().find('.lg').removeClass('lg-max');
                }
                else {
                    length = 0;
                    $(event.target).after('<span class="lg">' + length + '/' + max_length + '</span>');
                    $(event.target).parents().find('.lg').removeClass('lg-max');
                }
            }
        });
        // Max-length input
        $(document).on('keyup', 'input[type=text]', function (event) {
            let attr = $(this).attr('maxlength');
            if (typeof attr !== 'undefined' && attr !== false) {
                let max_length = $(event.target).attr('maxlength');
                let length = $(event.target).val().length;
                if (length >= max_length) {
                    $(event.target).parents().find('.lg').text(`${length}/${max_length}`);
                    $(event.target).parents().find('.lg').addClass('lg-max');
                }
                else {
                    $(event.target).parents().find('.lg').text(`${length}/${max_length}`);
                    $(event.target).parents().find('.lg').removeClass('lg-max');
                }
            }
        });
        // Blur input
        $(document).on('blur', 'input[type=text]', function (event) {
            let attr = $(this).attr('maxlength');
            if (typeof attr !== 'undefined' && attr !== false) {
                let span_el = $(event.target).parents().find('.lg');
                $(span_el).remove();
            }
        });
        // Click back-btn => go to menu screen
        $(document).on('click', '#back-btn', function () {
            window.location.href = '/menu';
        });

        // Press input arrange_order => only allow number
        $(document).on('input', '#arrange_order', function (event) {
            numbersOnly(event.target);
        });

        // AUTO FILL ADDRESS BY ZIP_CD --- START
        // Press input zip_cd => only allow number
        $(document).on('input', '#zip_cd', function (event) {
            numbersOnly(event.target);
        });
    
        // Press zip_cd => auto render address1, address2, address3 
        $(document).on('keyup', '#zip_cd', function (event) {
            $('#address1').val('');
            $('#address2').val('');
            $('#address3').val('');
            AjaxZip3.zip2addr(event.target,'','address1','address2', 'address3');
        });
    
        // Blur 
        $(document).on('blur', '#zip_cd', function (event) {
            let value = $('#zip_cd').val();
            value = value.replace('-', '');
            let length_number = value.length;
            if (length_number < 7) {
                $('#zip_cd').val('');
                $('#address1').val('');
                $('#address2').val('');
                $('#address3').val('');
            }
            else {
                // Convert from 0000000 => 000-0000
                value = value.substring(0,3) + '-' + value.substring(3,8);
                $(event.target).val(value);
            }
        });
        // AUTO FILL ADDRESS BY ZIP_CD --- END

        // START EMPLOYEE POPUP
        // Click search-btn => show employee popup
        $(document).on('click', '.show-popup-btn', function (event) {
            let target_element = $(event.target).parents('.show-popup-btn');
            let target_url = $(target_element).attr('target-url');
            let target_width = $(target_element).attr('target-width');
            // Call function show popup
            showPopup(`/popup/${target_url}`, `${target_width}`);
        });
    
        // Change organization-step in popup
        $(document).on('change', '#popup #organization-step1', function () {
            let obj = {};
            obj['organization_cd_1'] = $('#popup #organization-step1 :selected').val();
            $('#popup #organization-step2').empty();
            $('#popup #organization-step3').empty();
            $('#popup #organization-step4').empty();
            $('#popup #organization-step5').empty();
            $('#popup #organization-step2').append('<option value="-1"></option>');
            $('#popup #organization-step3').append('<option value="-1"></option>');
            $('#popup #organization-step4').append('<option value="-1"></option>');
            $('#popup #organization-step5').append('<option value="-1"></option>');
            referOrgCbxPopupData(obj, 1,'organization-step2', 'organization_cd_2', 2, obj['organization_cd_1']);
        });
        $(document).on('change', '#popup #organization-step2', function () {
            let obj = {};
            obj['organization_cd_1'] = $('#popup #organization-step1 :selected').val();
            obj['organization_cd_2'] = $('#popup #organization-step2 :selected').val();
            $('#popup #organization-step3').empty();
            $('#popup #organization-step4').empty();
            $('#popup #organization-step5').empty();
            $('#popup #organization-step3').append('<option value="-1"></option>');
            $('#popup #organization-step4').append('<option value="-1"></option>');
            $('#popup #organization-step5').append('<option value="-1"></option>');
            referOrgCbxPopupData(obj, 2,'organization-step3', 'organization_cd_3', 3, obj['organization_cd_2']);
        });
        $(document).on('change', '#popup #organization-step3', function () {
            let obj = {};
            obj['organization_cd_1'] = $('#popup #organization-step1 :selected').val();
            obj['organization_cd_2'] = $('#popup #organization-step2 :selected').val();
            obj['organization_cd_3'] = $('#popup #organization-step3 :selected').val();
            $('#popup #organization-step4').empty();
            $('#popup #organization-step5').empty();
            $('#popup #organization-step4').append('<option value="-1"></option>');
            $('#popup #organization-step5').append('<option value="-1"></option>');
            referOrgCbxPopupData(obj, 3,'organization-step4', 'organization_cd_4', 4, obj['organization_cd_3']);
        });
        $(document).on('change', '#popup #organization-step4', function () {
            let obj = {};
            obj['organization_cd_1'] = $('#popup #organization-step1 :selected').val();
            obj['organization_cd_2'] = $('#popup #organization-step2 :selected').val();
            obj['organization_cd_3'] = $('#popup #organization-step3 :selected').val();
            obj['organization_cd_4'] = $('#popup #organization-step4 :selected').val();
            $('#popup #organization-step5').empty();
            $('#popup #organization-step5').append('<option value="-1"></option>');
            referOrgCbxPopupData(obj, 4,'organization-step5', 'organization_cd_5', 5, obj['organization_cd_4']);
        });
    
        // Click page-index in popup => refer data 
        $(document).on('click', '#popup #datatable_flextime_paginate .paginate_button', function (event) {
            // Declare obj
            let obj = {};
            // Get value of input
            let inputs = $('#popup input');
            for (const input of inputs) {
            let input_id = $(input).attr('id');
            let input_value = input.value;
            obj[input_id] = input_value;
            }
            // Get value of checkbox retired
            let checkbox_value = $('#popup #company_out_dt_flg').is(":checked");
            if (checkbox_value == true ) {
            obj['company_out_dt_flg'] = '1';
            }
            else {
            obj['company_out_dt_flg'] = '0';
            }
            // Get value of combobox
            let selects = $('#popup select');
            for (const item of selects) {
            let select_el_id = $(item).attr('id');
            let select_el_nm = $(item).attr('name');
            let select_el_value = $(`#popup #${select_el_id}`).val();
            if (select_el_value == -1) {
                select_el_value = '';
            }
            obj[select_el_nm] = select_el_value;
            }
            // Get page index
            obj['current_page'] = $(event.target).attr('page');
            // Get page size 
            let page_size = $('#popup #cb_page').val();
            obj['page_size'] = page_size;
            // Call ajax
            $.ajax({
            type: "POST",
            url: "/popup/refer-table",
            data: obj,
            dataType: "html",
            success: function (res) {
                $('#popup #table-data').empty();
                $('#popup #table-data').append(res);
                let page_size_selected = $('#popup #cb_page').attr('data-selected');
                $('#popup #cb_page').val(page_size_selected);
            }
            });
        }); 
    
        // Click search-btn in popup => refer data 
        $(document).on('click', '#popup #search-btn', function () {
            // Declare obj
            let obj = {};
            // Get value of input
            let inputs = $('#popup input');
            for (const input of inputs) {
            let input_id = $(input).attr('id');
            let input_value = input.value;
            obj[input_id] = input_value;
            }
            // Get value of checkbox retired
            let checkbox_value = $('#popup #company_out_dt_flg').is(":checked");
            if (checkbox_value == true ) {
            obj['company_out_dt_flg'] = '1';
            }
            else {
            obj['company_out_dt_flg'] = '0';
            }
            // Get value of combobox
            let selects = $('#popup select');
            for (const item of selects) {
            let select_el_id = $(item).attr('id');
            let select_el_nm = $(item).attr('name');
            let select_el_value = $(`#popup #${select_el_id}`).val();
            if (select_el_value == -1) {
                select_el_value = '';
            }
            obj[select_el_nm] = select_el_value;
            }
            // Get page index
            obj['current_page'] = '1';
            // Get page size 
            let page_size = $('#popup #cb_page').val();
            obj['page_size'] = page_size;
            // Call ajax
            $.ajax({
            type: "POST",
            url: "/popup/refer-table",
            data: obj,
            dataType: "html",
            success: function (res) {
                $('#popup #table-data').empty();
                $('#popup #table-data').append(res);
                let page_size_selected = $('#popup #cb_page').attr('data-selected');
                $('#popup #cb_page').val(page_size_selected);
            }
            });
        });

        // Click row on table => refer data to input#employee_nm 
        $(document).on('click', '#table-data .table tbody tr', function (event) {
            let obj = {};
            let row = $(event.target).parents('tr');
            obj['employee_nm'] = $(row).attr('employee_nm');
            obj['employee_cd'] = $(row).attr('employee_cd');
            // Close popup
            $('#overlay').hide();
            $('.inner .employee_cd').val(obj['employee_cd']);
            $('.inner .employee_nm').val(obj['employee_nm']);
        });
        // END EMPLOYEE POPUP

    } catch (e) {
        alert('initEvents: ' + e.message);
    }
}

/*
 * numbersOnly: only allow number 
 * @author    : manhnd - 2022/07/06
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function numbersOnly(input){
    let value = input.value;
    let numbers = value.replace(/[^0-9]/g, "");
    input.value = numbers;
}

/*
 * setErrors
 * @author    : 
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function setErrors(error) {
    try {
        //quangnd start
        if (error[0]['error_typ'] == 999) {          
            messErrors('Exception', error[0]['remark']);
        }
        //quangnd end
        var arrs = "";
        $.each(error, function(index, value) {
            if (value.error_typ == 0) {
                $(value.item).addClass('boder-error');
                $(value.item).after(`<div class="tooltip_error">${_text[value.message_no].message}</div>`);
            } else if (value.error_typ == 1) {
                arrs += `<div>${_text[value.message_no].message}</div>`;
                messErrors(_text[value.message_no].message_nm, arrs);
            }
        });
    } catch (e) {
        alert('setError:' + e.message);
    }
}
/*
 * function   : clearErrors - clear errors
 * @author    : tuyendn - tuyendn@ans-asia.com
 * param      : null
 * @return    : null
 * @access    : public
 * @see       : init
 */
function clearErrors() {
    try {
        $(".boder-error").removeClass('boder-error');
        $('.tooltip_error').remove();
    } catch (e) {
        alert('setError: ' + e.message);
    }
}
/*
 * function   : errMessage - message dialog errors
 * @author    : tuyendn - tuyendn@ans-asia.com
 * param      : null
 * @return    : null
 * @access    : public
 * @see       : init
 */

function messErrors(title, text, callBack = () => {}) {
    try {
        dialog('error', title, text, false, '#f27474', callBack)
    } catch (e) {
        alert('messErrors: ' + e.message);
    }
}
/*
 * function   : Message - message dialog
 * @author    : quangnd - quangnd@ans-asia.com
 * param      : null
 * @return    : null
 * @access    : public
 * @see       : init
 */
function Message(mess_no, callBack = () => {}) {
    try {
        // console.log(_text[mess_no].message_nm);
        if (_text[mess_no].message_typ == 1) {
            dialog('question', _text[mess_no].message_nm, _text[mess_no].message, true, '#87adbd', callBack)
        }
        if (_text[mess_no].message_typ == 2) {
            dialog('success', _text[mess_no].message_nm, _text[mess_no].message, false, '#a5dc86', callBack)
        }
        if (_text[mess_no].message_typ == 3) {
            dialog('warning', _text[mess_no].message_nm, _text[mess_no].message, false, '#f8bb86', callBack)
        }
        if (_text[mess_no].message_typ == 4) {
            dialog('error', _text[mess_no].message_nm, _text[mess_no].message, false, '#f27474', callBack)
        }
    } catch (e) {
        alert('Message: ' + e.message);
    }
}

/*
 * function   : dialog -  dialog
 * @author    : quangnd - quangnd@ans-asia.com
 * param      : null
 * @return    : null
 * @access    : public
 * @see       : init
 */
function dialog(icon, title, text, btn, color_btn, callBack) {
    try {
        Swal.fire({
            icon: icon,
            title: title,
            html: text,
            showCancelButton: btn,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonColor: color_btn,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                callBack();
            }
        })
    } catch (e) {
        alert('dialog: ' + e.message);
    }
}

/*
 * function   : showPopup
 * @author    : manhnd - manhnd@ans-asia.com - 2022/06/24 - create
 * param      : null
 * @return    : null
 * @access    : public
 * @see       : init
 */
function showPopup(url , width){
    // Call ajax return popup content
    $.ajax({
        type: "POST",
        url: `${url}`,
        dataType: "html",
        success: function (res) {
            // Show popup
            $('#overlay').css('display', 'block');
            // Clear content            
            $('#main-content').empty();
            // Add new content
            $('#main-content').append(res);
            // Set width
            $('#main-content').css('width', width);
            // Focus on first input[type=text]
            $('#main-content input:not([disabled])').filter(':input:visible:first').focus();
        }
    });
}

/*
* referOrgCbxPopupData 
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/27
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/
function referOrgCbxPopupData(obj, current_step, next_organization_id, next_organization_cd, next_step, check_empty) {
    // Check empty
    if (check_empty == -1) {
      switch (current_step) {
        case 1:
          $('#popup #organization-step2').empty();
          $('#popup #organization-step3').empty();
          $('#popup #organization-step4').empty();
          $('#popup #organization-step5').empty();
          $('#popup #organization-step2').append('<option value="-1"></option>');
          $('#popup #organization-step3').append('<option value="-1"></option>');
          $('#popup #organization-step4').append('<option value="-1"></option>');
          $('#popup #organization-step5').append('<option value="-1"></option>');
          break;
        case 2:   
          $('#popup #organization-step3').empty();
          $('#popup #organization-step4').empty();
          $('#popup #organization-step5').empty();
          $('#popup #organization-step3').append('<option value="-1"></option>');
          $('#popup #organization-step4').append('<option value="-1"></option>');
          $('#popup #organization-step5').append('<option value="-1"></option>');
          break;
        case 3:
          $('#popup #organization-step4').empty();
          $('#popup #organization-step5').empty();
          $('#popup #organization-step4').append('<option value="-1"></option>');
          $('#popup #organization-step5').append('<option value="-1"></option>');
          break;
        case 4:
          $('#popup #organization-step5').empty();
          $('#popup #organization-step5').append('<option value="-1"></option>');
          break;
        default:
          break;
      }
    }
    let html = '';
    // Call ajax
    $.ajax({
      type: "POST",
      url: "popup/refer-organization",
      data: obj,
      dataType: "json",
      success: function (res) {
        // Build HTML
        for (const item of res[1]) {
          if (item['organization_typ'] == next_step) {
            html = `<option value="${item[next_organization_cd]}">${item['organization_nm']}</option>`;
            $(`#popup #${next_organization_id}`).append(html);
          }
        }
      }
    });    
}
