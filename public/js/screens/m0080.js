/**
 ***************************************************************************
 * ANS ASIA
 *
 * 作成日          :   2022/07/13
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
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/13
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/
function initialize() {
  try {
    // Focus to input item_nm
    $('#item_nm').focus();
  } catch (e) {
      alert('initEvents: ' + e.message);
  }
}

/*
* initEvents
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/12
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/

function initEvents() {
  try {
    // Click on the page number => display the page's data
    $(document).on('click', '#leftcontent #paging .paginate_button', function (event) {
      let obj = {};
      let page_index = $(event.target).attr('page');
      // Set value 
      obj['page_index'] = page_index;
      // Call function refer data
      referData(obj);
    });

    // Press enter when in search input => search by position_nm
    $(document).on('keyup', '#search_key', function (event) {
      let key_code = event.which;
      let search_string = $(event.target).val(); 
      if (key_code == '13') {
        // Declare params
        let obj = {};
        obj['search_string'] = search_string;
        // Call function refer data
        referData(obj);
      }
    });

    // Click search icon in search input => search by position_nm
    $(document).on('click', '#leftcontent #search-button', function () {
      let search_string = $('#search_key').val(); 
      // Declare params
      let obj = {};
      obj['search_string'] = search_string;
      // Call function refer data
      referData(obj);    
    });


    // Click item of list data in left_view => refer this item's data
    $(document).on('click', '#leftcontent .list-search-content .list-item', function (event) {
      // Clear errors
      clearErrors();
      // Remove readonly
      $('#item_digits').prop('readonly', false);
      // Change mode => edit
      _mode = 2; 
      let current_row = $(event.target).parents('.list-item');
      // Add class list-item-active
      let items = $('#leftcontent .list-search-content').find('.list-item');
      removeClassItemActive(items);
      $(current_row).addClass('list-item-active');
      // Declare variables
      let obj = {};
      obj['item_cd'] = $(current_row).attr('item_cd');
      // Call ajax refer data
      $.ajax({
        type: "POST",
        url: "/m0080/refer",
        data: obj,
        dataType: "json",
        success: function (res) {
          let inputs = $('#rightcontent input').not('.td-input');
          let right_table_inputs = $('#table-right input[type=checkbox]');
          let selects = $('#rightcontent select');
          let checkbox_elements = $('#rightcontent input[type=checkbox]');
          // SET VALUE INPUT TEXT
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
          let check_item_digits = $('#item_digits').val();
          if (check_item_digits == 0) {
            $('#item_digits').val('');
            $('#item_digits').prop('readonly', true);
          }
          // SET VALUE SELECTS 
          // Loop 1
          for (const item of selects) {
            let select_id = $(item).attr('id');
            // Loop 2
            for (const prop in res[0][0]) {
              if (select_id == prop) {
                $('#' + select_id).val(`${res[0][0][prop]}`);
              }
            }
          }
          // SET VALUE INPUT CHECKBOX IN TABLE-RIGHT
          // Loop 1
          for (const input of right_table_inputs) {
            let input_authority_cd = $(input).attr('authority_cd');
            let input_id = $(input).attr('id');
            // Loop 2
            for (const prop of res[2]) {
              if (input_authority_cd == prop['authority_cd']) {
                $('#' + input_id).val(`${prop['browsing_kbn']}`);
              }
            }
          }
          // SET CHECKED FOR INPUT CHECKBOX HAS VALUE = 1
          for (const item of checkbox_elements) {
            let value = $(item).val();
            if (value == 1) {
              $(item).attr('checked', true);
            }
            else {
              $(item).attr('checked', false);
            }
          }
          // IF RES[1] = [] => HIDE TABLE DETAIL, ELSE => SHOW TABLE DETAIL AND REFER DATA
          if (typeof res[1] !== 'undefined' && res[1].length > 0) {
            // Show table
            $('#table-left').show();
            // Clear content
            $('#table-left tbody').empty();
            // Build content
            for (let index = 0; index < res[1].length; index++) {
              const item = res[1][index];
              let tr = $(`<tr index="${index}">
                              <td>
                                <span class="control-span">
                                    <div class="num-length w-100">
                                        <input id="detail_no-${index}" type="text" value="${item['detail_no']}" class="form-control required detail_no td-input" autocomplete="off" maxlength="3">
                                    </div>
                                </span>
                              </td>
                              <td>
                                  <span class="control-span">
                                      <div class="num-length w-100">
                                          <input id="detail_nm-${index}" type="text" value="${item['detail_name']}" class="form-control required detail_nm td-input" autocomplete="off" maxlength="50">
                                      </div>
                                  </span>
                              </td>
                              <td>
                                <div>
                                  <button class="btn btn-sm remove-row-btn">
                                      <i class="fa fa-remove"></i>
                                  </button>
                                </div>
                              </td>
                        </tr>`);
              
              $('#table-left tbody').append(tr);
            }
          } 
          else {
            $('#table-left').hide();
          }
        }
      });
    });

    // Change option of combobox #item_kind => hide or show detail-table by conditions
    $(document).on('change', '#item_kind', function () {
      let item_kind = $('#item_kind :selected').val();
      switch (item_kind) {
        case '1':
          $('#item_digits').prop('readonly', false);
          $('#table-left').hide();
          $('#item_digits').val('');
          break;
        case '2':
          $('#item_digits').prop('readonly', false);
          $('#table-left').hide();
          $('#item_digits').val('');
          break;
        case '3':
          $('#item_digits').prop('readonly', true);
          $('#table-left').hide();
          $('#item_digits').val('');
          break;
        case '4':
          $('#item_digits').prop('readonly', true);
          $('#table-left').show();
          $('#item_digits').val('');
          break;
        case '5':
          $('#item_digits').prop('readonly', true);
          $('#table-left').show();
          $('#item_digits').val('');
        break;
        default:
          break;
      }
    });

    // Focus out to input item_digits => check digits_length
    $(document).on('blur', '#item_digits', function () {
      let item_kind_value = $('#item_kind :selected').val();
      let item_digits_value = $('#item_digits').val();
      switch (item_kind_value) {
        case '1':
          if (parseInt(item_digits_value) > 200) {
            Message(114,function(){
            });
          }
          break;
        case '2':
          if (parseInt(item_digits_value) > 8) {
            Message(115,function(){
            });
          }
          break;
        default:
          break;
      }
    });

    // Click on add-new-row-btn => add row into detail table
    $(document).on('click', '#add-new-row-btn', function () {
      let total_row = $('#table-left tbody tr').length;
      if (total_row >= 10) {
        Message(113,function(){
        });
      }
      else {
        let default_row = $("#table-left tbody tr").first().clone();
        let next_index = $("#table-left tbody tr").last().attr('index');
        next_index = parseInt(next_index) + 1;
        $("#table-left tbody").append(default_row);
        let last_row = $("#table-left tbody tr").last();
        $(last_row).find('.detail_no').focus();
        $(last_row).find('.detail_no').val('');
        $(last_row).find('.detail_nm').val('');
        $(last_row).attr('index', next_index);
        $(last_row).find('.detail_no').attr('id', `detail_no-${next_index}`);
        $(last_row).find('.detail_nm').attr('id', `detail_nm-${next_index}`);
      }
    });

    // Click on remove-row-btn => remove row from detail table
    $(document).on('click', '.remove-row-btn', function (event) {
      let total_row = $('#table-left tbody tr').length;
      let row = $(event.target).parents('tr');
      if (total_row <= 1) {
        Message(29,function(){
        });
      }
      else {
        $(row).remove();
      }
    });

    // Press input arrange_order => only allow number
    $(document).on('input', '#item_digits', function (event) {
      numbersOnly(event.target);
    });

    // Click on add-new-btn => reload page
    $(document).on('click', '#add-new-btn', function () {
      // Create screen to add new record
      Message(5,function(){
        window.location.reload();
      });
    });

    // Click on save-btn => show dialog confirm and save
    $(document).on('click','#save-btn',function(e){
      try {
        // Clear errors
        clearErrors();
        // Declare m0080_obj, m0081_obj, m0082_obj
        let m0080_obj = {};
        let m0081_obj = [];
        let m0082_obj = [];
        
        // Build m0080_obj
        let inputs = $('#rightcontent input').not('.td-input');
        let checkbox_inputs = $('#rightcontent input[type=checkbox]').not('.td-input');
        let selects = $('#rightcontent select');
        // Get value of inputs checkbox
        for (const input of checkbox_inputs) {
          let input_id = $(input).attr('id');
          let value_checked = $(`#${input_id}`).prop('checked');
          if (value_checked == true) {
            $(`#${input_id}`).val(1);
          }
          if (value_checked == false) {
            $(`#${input_id}`).val(0);
          }
        }
        // Get value of inputs 
        for (const input of inputs) {
          let input_id = $(input).attr('id');
          if (input_id == 'item_cd') {
            let max_item_cd = $('#item_cd').attr('max_item_cd');
            m0080_obj['item_cd'] = parseInt(max_item_cd) + 1;
          }
          else {
            m0080_obj[input_id] = $(input).val();
          }
        }
        // Get value of selects
        for (const item of selects) {
          let input_id = $(item).attr('id');
          let value_selected = $(`#${input_id} option:selected`).val();
          m0080_obj[input_id] = value_selected;
        }

        // Build m0081_obj
        let value_selected = $('#item_kind option:selected').val();
        let total_tr = $('#table-left tbody tr');
        if (value_selected == '4' || value_selected == '5') {
          for (let index = 0; index < total_tr.length; index++) {
            let temp_obj = {};
            let row = total_tr[index];
            let item_cd_value = $('#item_cd').attr('max_item_cd');
            let detail_no = $(row).find('.detail_no').val();
            let detail_nm = $(row).find('.detail_nm').val();
            temp_obj['item_cd']      = parseInt(item_cd_value) + 1;
            temp_obj['detail_no'] = detail_no;
            temp_obj['detail_nm'] = detail_nm;
            m0081_obj.push(temp_obj);
          }
        }

        // Build m0082_obj
        let right_table_inputs = $('#table-right input[type=checkbox]');
        // Get value of checkboxs
        for (const input of right_table_inputs) {
          let input_id = $(input).attr('id');
          let value_checked = $(`#${input_id}`).prop('checked');
          if (value_checked == true) {
            $(`#${input_id}`).val(1);
          }
          if (value_checked == false) {
            $(`#${input_id}`).val(0);
          }
        }
        // Push each obj to array
        for (let index = 0; index < right_table_inputs.length; index++) {
          let temp_obj = {};
          let element = right_table_inputs[index];
          // Get auto item_cd
          let item_cd_value = $('#item_cd').attr('max_item_cd');
          // Get authority_cd 
          let authority_cd = $(element).attr('authority_cd');
          // Get browsing_kbn
          let browsing_kbn = $(element).val();  
          temp_obj['item_cd']      = parseInt(item_cd_value) + 1;
          temp_obj['authority_cd'] = authority_cd;
          temp_obj['browsing_kbn'] = browsing_kbn;
          m0082_obj.push(temp_obj);
        }
        Message(1,function(){
          // Check mode
          if (_mode == 1) { // Add new mode
            // Call ajax add new
            $.ajax({
              type: "POST",
              url: "/m0080/add",
              data: {m0080_obj, m0081_obj, m0082_obj},
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
          }
          else if (_mode == 2) { // Edit mode
            // Set value of item_cd
            let current_item_cd = $('#list-search .list-item-active').attr('item_cd');
            m0080_obj['item_cd'] = current_item_cd;
            for (let index = 0; index < m0081_obj.length; index++) {
              let element = m0081_obj[index];
              element['item_cd'] = current_item_cd;
            }
            for (let index = 0; index < m0082_obj.length; index++) {
              let element = m0082_obj[index];
              element['item_cd'] = current_item_cd;
            }
            // Call ajax edit
            $.ajax({
              type: "POST",
              url: "/m0080/edit",
              data: {m0080_obj, m0081_obj, m0082_obj},
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
          }
        });
      } catch (e) {
        console.log('#save-btn'+e.message);
      }
    })

    // Click on delete-btn => delete record
    $(document).on('click', '#delete-btn', function () {
      let obj = {};
      let item_selected = $('#list-search .list-item-active').attr('item_cd');
      obj['item_cd'] = item_selected;
      if (item_selected == undefined) {
        Message(21,function(){});
      }
      else {
        Message(3,function(){
          // Call ajax delete record
          $.ajax({
            type: "POST",
            url: "/m0080/delete",
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
    })

  } 
  catch (e) {
    alert('initEvents: ' + e.message);
  }
}

/*
* refer data when click or press enter in search input 
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/13
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/
function referData(obj) {
  // Call ajax
  $.ajax({
    type: "POST",
    url: "/m0080/search",
    data: obj,
    async: false,
    dataType: "html",
    success: function (res) {
      $('#leftcontent .inner').empty();
      $('#leftcontent .inner').append(res);
    }
  });
  $('#leftcontent #search_key').val(obj['search_string']);
}

/*
* removeClassItemActive
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/12
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