/**
 ***************************************************************************
 * ANS ASIA
 *
 * 作成日          :   2022/07/22
 * 作成者          :   manhnd – manhnd@ans-asia.com
 *
 * @package         :   
 * @copyright       :   Copyright (c) ANS-ASIA
 * @version         :   1.0.0
 ***************************************************************************
 */

 let hide_cols_mode = 0;

 $(function() {
  try {
      initEvents();
      initialize();
  } catch (e) {
      alert('initialize: ' + e.message);
  }
});
/*
* initialize
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/22
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/

function initialize() {
  try {
    scrollX();
    $('.main-content #employee_cd').focus();
  } catch (e) {
      alert('initEvents: ' + e.message);
  }
}
/*
* initEvents
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/22
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/
function initEvents() {
  try {
    // Click page-index => refer this page's data
    $(document).on('click', '.main-content #paging #datatable_flextime_paginate .paginate_button', function (event) {
      // Declare params
      let obj = {};
      let page_index = $(event.target).attr('page');
      obj['page_index'] = `${page_index}`;
      // Get value of checkbox 
      let inputs_checkbox = $('.main-content #check_authority').is(":checked");
      if (inputs_checkbox == true ) {
        obj['check_config'] = '1';
      }
      else {
        obj['check_config'] = '0';
      }
      // Get value of input
      let inputs_text = $('.main-content input[type=text]');
      for (const input of inputs_text) {
        let input_id = $(input).attr('id');
        let input_value = input.value;
        obj[input_id] = input_value;
      }
      // Get value of combobox
      let selects = $('.main-content select');
      for (const item of selects) {
        let select_el_id = $(item).attr('id');
        let select_el_nm = $(item).attr('name');
        let select_el_value = $(`#${select_el_id}`).val();
        if (select_el_value == -1) {
          select_el_value = '';
        }
        obj[select_el_nm] = select_el_value;
      }
      // Call function 
      searchData(obj);
    }); 

    // Click search-btn => refer data 
    $(document).on('click', '.main-content #search-btn', function (event) {
      // Declare obj
      let obj = {};
      // Get value of input
      let inputs_text = $('.main-content input[type=text]');
      for (const input of inputs_text) {
        let input_id = $(input).attr('id');
        let input_value = input.value;
        obj[input_id] = input_value;
      }
      // Get value of checkbox 
      let inputs_checkbox = $('.main-content #check_authority').is(":checked");
      if (inputs_checkbox == true ) {
        obj['check_config'] = '1';
      }
      else {
        obj['check_config'] = '0';
      }
      // Get value of combobox
      let selects = $('.main-content select');
      for (const item of selects) {
        let select_el_id = $(item).attr('id');
        let select_el_nm = $(item).attr('name');
        let select_el_value = $(`#${select_el_id}`).val();
        if (select_el_value == -1) {
          select_el_value = '';
        }
        obj[select_el_nm] = select_el_value;
      }
      // Get page index
      let page_index = $(event.target).attr('page');
      obj['current_page'] = page_index;
      // Call ajax
      searchData(obj);
    });

    // Click show-btn
    $(document).on('click', '.main-content #show-btn', function () {
      controlHideCols();
    });

    // Click checkbox in thead => set checked for all checkbox in tbody
    $(document).on('click', '.main-content #check-box-all', function () {
      let checkbox_all_value = $('.main-content #check-box-all').is(":checked");
      // List checkbox in tbody
      let checkboxs = $('.main-content #table tbody input[type=checkbox]');
      if (checkbox_all_value == true) {
        for (const item of checkboxs) {
          $(item).prop('checked', true);
        } 
      }
      else if (checkbox_all_value == false) {
        for (const item of checkboxs) {
          $(item).prop('checked', false);
        } 
      }
    });

    // Click checkbox in tbody 
    $(document).on('click', '.main-content #table tbody input[type=checkbox]', function (event) {
      let count = 0;
      // List checkbox in tbody
      let checkboxs = $('.main-content #table tbody input[type=checkbox]');
      let length = $(checkboxs).length;
      // Loop
      for (const item of checkboxs) {
        let item_val = $(item).is(":checked");
        if (item_val == true) {
          count++;
        }
      }
      let value = $(event.target).is(":checked");
      switch (value) {
        case false:
          $('.main-content #check-box-all').prop('checked', false);
          break;
        case true:
          if (count == length) {
            $('.main-content #check-box-all').prop('checked', true);
          }
          break;
        default:
          break;
      }
    });
    
    // Click save-btn
    $(document).on('click', '.main-content #save-btn', function () {
      try {
        // Clear errors
        clearErrors();
        // Declare obj
        let obj = {};
        // Build obj
        obj['mode'] = '0';
        // Get value of authority_cd
        obj['authority_cd'] = $('.main-content #authority_cd').val();
        if (obj['authority_cd'] == -1) {
          obj['authority_cd'] = '';
        }
        else {
          obj['authority_cd'] = $('.main-content #authority_cd').val();
        }
        // Get value of checkbox in table
        let temp = [];
        // List checkbox in tbody
        let checkboxs = $('.main-content #table tbody input[type=checkbox]:checked');
        for (const item of checkboxs) {
          let temp_obj = {};
          let employee_cd = $(item).parents('tr').find('td[employee_cd]').attr('employee_cd');
          let authority_cd = obj['authority_cd'];
          temp_obj.employee_cd = employee_cd;
          temp_obj.authority_cd = authority_cd;
          temp.push(temp_obj);
        }
        obj['json'] = temp;
        // Call ajax
        Message(1,function(){
          $.ajax({
            type: "POST",
            url: "/ss0030/edit",
            data: obj,
            dataType: "json",
            success: function (res) {
              switch (res['status']) {
                case OK:
                    Message(2,function(e){
                      window.location.reload();
                    })
                    break;
                case NG:
                  if (res['errors'] !== undefined && res['errors'] !== null) {
                    setErrors(res['errors']);
                  }
                    break;
                case EX:
                    console.log(EX);
                    break;
                default:
                    break;
                };
            }
          });
        });
      } catch (e) {
        console.log('#save-btn'+e.message);
      }
    });

    // Click delete-btn
    $(document).on('click', '.main-content #delete-btn', function () {
      try {
        // Declare obj
        let obj = {};
        // Build obj
        obj['mode'] = '1';
        // Get value of authority_cd
        obj['authority_cd'] = '0';
        // Get value of checkbox in table
        let temp = [];
        // List checkbox in tbody
        let checkboxs = $('.main-content #table tbody input[type=checkbox]:checked');
        for (const item of checkboxs) {
          let temp_obj = {};
          let employee_cd = $(item).parents('tr').find('td[employee_cd]').attr('employee_cd');
          let authority_cd = obj['authority_cd'];
          temp_obj.employee_cd = employee_cd;
          temp_obj.authority_cd = authority_cd;
          temp.push(temp_obj);
        }
        obj['json'] = temp;
        // Call ajax
        Message(43,function(){
          $.ajax({
            type: "POST",
            url: "/ss0030/edit",
            data: obj,
            dataType: "json",
            success: function (res) {
              switch (res['status']) {
                case OK:
                    Message(44,function(e){
                      window.location.reload();
                    })
                    break;
                case NG:
                  if (res['errors'] !== undefined && res['errors'] !== null) {
                    for (let index = 0; index < res['errors'].length; index++) {
                      setErrors(res['errors'][index]);
                    }
                  }
                    break;
                case EX:
                    console.log(EX);
                    break;
                default:
                    break;
                };
            }
          });
        });
      } catch (e) {
        console.log('#save-btn'+e.message);
      }
    });

    // Change employee_cd input
    $(document).on('input', '.main-content #employee_cd', function () {
      let value = $('#employee_cd').val();
      if (value == '') {
        $('.main-content #employee_nm').val('');
      }
    });

    // Change organization-step
    $(document).on('change', '#organization-step1', function () {
      let obj = {};
      obj['organization_cd_1'] = $('#organization-step1 :selected').val();
      $('#organization-step2').empty();
      $('#organization-step3').empty();
      $('#organization-step4').empty();
      $('#organization-step5').empty();
      $('#organization-step2').append('<option value="-1"></option>');
      $('#organization-step3').append('<option value="-1"></option>');
      $('#organization-step4').append('<option value="-1"></option>');
      $('#organization-step5').append('<option value="-1"></option>');
      referOrganizationCbxData(obj, 1,'organization-step2', 'organization_cd_2', 2, obj['organization_cd_1']);
    });
    $(document).on('change', '#organization-step2', function () {
      let obj = {};
      obj['organization_cd_1'] = $('#organization-step1 :selected').val();
      obj['organization_cd_2'] = $('#organization-step2 :selected').val();
      $('#organization-step3').empty();
      $('#organization-step4').empty();
      $('#organization-step5').empty();
      $('#organization-step3').append('<option value="-1"></option>');
      $('#organization-step4').append('<option value="-1"></option>');
      $('#organization-step5').append('<option value="-1"></option>');
      referOrganizationCbxData(obj, 2,'organization-step3', 'organization_cd_3', 3, obj['organization_cd_2']);
    });
    $(document).on('change', '#organization-step3', function () {
      let obj = {};
      obj['organization_cd_1'] = $('#organization-step1 :selected').val();
      obj['organization_cd_2'] = $('#organization-step2 :selected').val();
      obj['organization_cd_3'] = $('#organization-step3 :selected').val();
      $('#organization-step4').empty();
      $('#organization-step5').empty();
      $('#organization-step4').append('<option value="-1"></option>');
      $('#organization-step5').append('<option value="-1"></option>');
      referOrganizationCbxData(obj, 3,'organization-step4', 'organization_cd_4', 4, obj['organization_cd_3']);
    });
    $(document).on('change', '#organization-step4', function () {
      let obj = {};
      obj['organization_cd_1'] = $('#organization-step1 :selected').val();
      obj['organization_cd_2'] = $('#organization-step2 :selected').val();
      obj['organization_cd_3'] = $('#organization-step3 :selected').val();
      obj['organization_cd_4'] = $('#organization-step4 :selected').val();
      $('#organization-step5').empty();
      $('#organization-step5').append('<option value="-1"></option>');
      referOrganizationCbxData(obj, 4,'organization-step5', 'organization_cd_5', 5, obj['organization_cd_4']);
    });

  } catch (e) {
      alert('initEvents: ' + e.message);
  }
}


/*
* referOrganizationCbxData
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/07
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/
function referOrganizationCbxData(obj, current_step, next_organization_id, next_organization_cd, next_step, check_empty) {
  // Check empty
  if (check_empty == -1) {
    switch (current_step) {
      case 1:
        $('#organization-step2').empty();
        $('#organization-step3').empty();
        $('#organization-step4').empty();
        $('#organization-step5').empty();
        $('#organization-step2').append('<option value="-1"></option>');
        $('#organization-step3').append('<option value="-1"></option>');
        $('#organization-step4').append('<option value="-1"></option>');
        $('#organization-step5').append('<option value="-1"></option>');
        break;
      case 2:   
        $('#organization-step3').empty();
        $('#organization-step4').empty();
        $('#organization-step5').empty();
        $('#organization-step3').append('<option value="-1"></option>');
        $('#organization-step4').append('<option value="-1"></option>');
        $('#organization-step5').append('<option value="-1"></option>');
        break;
      case 3:
        $('#organization-step4').empty();
        $('#organization-step5').empty();
        $('#organization-step4').append('<option value="-1"></option>');
        $('#organization-step5').append('<option value="-1"></option>');
        break;
      case 4:
        $('#organization-step5').empty();
        $('#organization-step5').append('<option value="-1"></option>');
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
          $(`#${next_organization_id}`).append(html);
        }
      }
    }
  });    

}

/*
* searchData
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/25
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/
function searchData(obj) {
  // Call ajax
  $.ajax({
    type: "POST",
    url: "/ss0030/search",
    data: obj,
    async: false,
    dataType: "html",
    success: function (res) {
      $('#bottom-table').empty();
      $('#bottom-table').html(res);
      scrollX();
    }
  });
  // Setting show and hide
  let hide_cols =  $('#table .col_hide');
  if (hide_cols_mode == 0) {
    for (const item of hide_cols) {
      $(item).show();
    }
    $('.top-scroll .scroll-div1').css('width','2011px');
  }
  else if (hide_cols_mode == 1) {
    for (const item of hide_cols) {
      $(item).hide();
    }
    $('.top-scroll .scroll-div1').css('width','0px');
  }
  let page_size_selected = $('.main-content #cb_page').attr('data-selected');
  $('.main-content #cb_page').val(page_size_selected);
}

/*
* controlHideCols
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/26
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/
function controlHideCols() {
  let hide_cols =  $('#table .col_hide');
  if (hide_cols_mode == 0) {
    hide_cols_mode = 1;
    for (const item of hide_cols) {
      $(item).hide();
    }
    $('#show-btn .text').text('属性情報表示'); 
    $('#show-btn .icon i').remove();
    $('#show-btn .icon').append('<i class="fa fa-eye" aria-hidden="true"></i>');
    $('.top-scroll .scroll-div1').css('width','0px');
  }
  else if (hide_cols_mode == 1) {
    hide_cols_mode = 0;
    for (const item of hide_cols) {
      $(item).show();
    }
    $('#show-btn .text').text('属性情報非表示'); 
    $('#show-btn .icon i').remove();
    $('#show-btn .icon').append('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
    $('.top-scroll .scroll-div1').css('width','2044px');
  }
}

/*
* scrollX
* @author    : quangnd – quangnd@ans-asia.com - create: 2022/07/28
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/
function scrollX() {
  $(".top-scroll").scroll(function () {
    $("#table").scrollLeft($(".top-scroll").scrollLeft());
  });
  $("#table").scroll(function () {
    $(".top-scroll").scrollLeft($("#table").scrollLeft());
  });
}
