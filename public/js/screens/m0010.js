/**
 ***************************************************************************
 * ANS ASIA
 *
 * 作成日          :   2022/06/21
 * 作成者          :   manhnd – manhnd@ans-asia.com
 *
 * @package         :   
 * @copyright       :   Copyright (c) ANS-ASIA
 * @version         :   1.0.0
 ***************************************************************************
 */

 let _mode = 1;

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
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/06/30
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/

function initialize() {
  try {
    // Focus to input office_nm
    $('#office_nm').focus();
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  } catch (e) {
      alert('initEvents: ' + e.message);
  }
}
/*
* initEvents
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/06/30
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/
function initEvents() {
  try {
    // Click on add-new-btn => show dialog confirm
    $(document).on('click', '#add-new-btn', function () {
      // Create screen to add new record
      Message(5,function(){
        window.location.reload();
      });
    });

    // Click on item of list-search => refer data
    $(document).on('click', '#list-search .list-item', function (event) {
      // Clear errors
      clearErrors();
      // Change mode => edit
      _mode = 2; 
      // Add class list-item-active
      let items = $('#list-search .list-search-content').find('.list-item');
      removeClassItemActive(items);
      $(event.target).addClass('list-item-active');
      // Declare variables
      let params = {};
      let company_cd_data = $(event.target).attr('company_cd_data');
      let office_cd_data = $(event.target).attr('office_cd_data');
      let inputs = $('#rightcontent input[type=text]');
      params['company_cd'] = company_cd_data;
      params['office_cd'] = office_cd_data;
      // Call ajax
      $.ajax({
        type: "POST",
        url: "/m0010/refer",
        dataType: "json",
        data: params,
        success: function (res) {
          // Loop 1
          for (const input of inputs) {
            let input_id = $(input).attr('id');
            // Loop 2
            for (const prop in res[0][0]) {
              if (input_id == prop) {
                $('#' + input_id).val(`${res[0][0][prop]}`);
              }
            }
          }
          // Format zipcode from 0000000 => 000-0000
          let text = $('#zip_cd').val();
          if (text != '') {
            text = text.substring(0,3) + '-' + text.substring(3,7);
            $('#zip_cd').val(text);
          }
          //
          $('#rightcontent .inner #employee_nm').val(res[1][0]['employee_nm']);
          $('#rightcontent .inner #responsible_cd').val(res[1][0]['employee_cd']);
        }
      });
    });

    // Click on save-btn => show dialog confirm and save
    $(document).on('click','#save-btn',function(e){
      try {
        // Clear errors
        clearErrors();
        // Declare obj
        let obj = {};
        // Build obj
        let inputs_text = $('#rightcontent input[type="text"]:not(:disabled)');
        let inputs_hidden = $('#rightcontent input[type="hidden"]');
        // Loop 1
        for (const input of inputs_text) {
          let value = input.value;
          let id = $(input).attr('id');
          if (id == "employee_nm") {
            continue;
          }
          else {
            obj[id] = value;
          }
        }
        // Loop 2
        for (const input of inputs_hidden) {
          let value = input.value;
          let id = $(input).attr('id');
          if (id == "office_cd") {
            obj[id] = `${parseInt(value) + 1}`;
          }
          else {
            obj[id] = value;
          }
        }
        // Get company_cd
        let company_cd = $('.list-search-content .list-item').first().attr('company_cd_data');
        obj['company_cd'] = company_cd;
        obj['zip_cd'] = obj['zip_cd'].split('-').join('');
        Message(1,function(){
          // Check mode
          if (_mode == 1) { // Add new mode
            // Call ajax add new
            $.ajax({
              type: "POST",
              url: "/m0010/add",
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
          }
          else if (_mode == 2) { // Edit mode
            let office_cd = $('.list-search-content .list-item-active').attr('office_cd_data');
            let employee_nm = $('#rightcontent .inner #employee_nm').val();
            obj['office_cd'] = office_cd;
            if (employee_nm == '') {
              obj['responsible_cd'] = '';
            }
            // Call ajax edit
            $.ajax({
              type: "POST",
              url: "/m0010/edit",
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
          }
        });
      } catch (e) {
        console.log('#save-btn'+e.message);
      }
    })

    // Click on delete-btn => delete record
    $(document).on('click', '#delete-btn', function () {
      let obj = {};
      let office_cd = $('.list-search-content .list-item-active').attr('office_cd_data');
      let company_cd = $('.list-search-content .list-item-active').attr('company_cd_data');
      if (office_cd == undefined) {
        Message(21,function(){});
      }
      else {
        Message(3,function(){
          // Build obj to delete
          obj['office_cd'] = office_cd;
          obj['company_cd'] = company_cd;
          // Call ajax delete record
          $.ajax({
            type: "POST",
            url: "/m0010/delete",
            data: obj,
            dataType: "json",
            success: function (res) {
              switch (res['status']) {
                case OK:
                    Message(4,function(e){
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
      }
    });

    // Click page-index => refer this page's data
    $(document).on('click', '#paging #datatable_flextime_paginate .paginate_button', function (event) {
      // Declare params
      let obj = {};
      let page_index = $(event.target).attr('page');
      obj['page_index'] = `${page_index}`;
      obj['search_string'] = '';
      // Call function 
      searchData(obj);
    }); 

    // Press Enter when focus input_search => refer data
    $(document).on('keyup', '#search_key', function (event) {
      let key_code = event.which;
      let search_string = $(event.target).val(); 
      if (key_code == '13') {
        // Declare params
        let obj = {};
        obj['search_string'] = search_string;
        // Call function
        searchData(obj);
        $('#search_key').val(search_string);
      }
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
* removeClassItemActive
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/01
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/
function removeClassItemActive(items) {
  for (const item of items) {
    let check_class = $(item).hasClass('list-item-active');
    if (check_class == true) {
      $(item).removeClass('list-item-active');
    }        
  }
}

/*
* searchData
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/05
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/
function searchData(obj) {
  // Call ajax
  $.ajax({
    type: "POST",
    url: "/m0010/search",
    data: obj,
    async: false,
    dataType: "html",
    success: function (res) {
      $('#leftcontent .inner').empty();
      $('#leftcontent .inner').html(res);
    }
  });
}