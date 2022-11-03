/**
 ***************************************************************************
 * ANS ASIA
 *
 * 作成日          :   2022/07/12
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
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/12
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/

function initialize() {
  try {
    // Focus to input office_nm
    $('#position_nm').focus();
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
      // Change mode => edit
      _mode = 2; 
      let current_row = $(event.target).parents('.list-item');
      // Add class list-item-active
      let items = $('#leftcontent .list-search-content').find('.list-item');
      removeClassItemActive(items);
      $(current_row).addClass('list-item-active');
      // Declare variables
      let obj = {};
      obj['position_cd'] = $(current_row).attr('position_cd');
      // Call ajax 
      $.ajax({
        type: "POST",
        url: "/m0040/refer",
        data: obj,
        dataType: "json",
        success: function (res) {
          let inputs = $('#rightcontent .inner input');
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
        }
      });
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
        // Declare obj
        let obj = {};
        // Build obj
        let inputs_text = $('#rightcontent input[type="text"]:not(:disabled)');
        // Loop 1
        for (const input of inputs_text) {
          let value = input.value;
          let id = $(input).attr('id');
          obj[id] = value;
        }
        Message(1,function(){
          // Check mode
          if (_mode == 1) { // Add new mode
            // Get position_cd automatically
            let max_position_cd = $('#position_cd').attr('max_position_cd');
            obj['position_cd'] = parseInt(max_position_cd) + 1;
            // Call ajax add new
            $.ajax({
              type: "POST",
              url: "/m0040/add",
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
            let position_cd = $('#list-search .list-search-content .list-item-active').attr('position_cd');
            obj['position_cd'] = position_cd;
            // Call ajax edit
            $.ajax({
              type: "POST",
              url: "/m0040/edit",
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
      let position_cd = $('#list-search .list-search-content .list-item-active').attr('position_cd');
      obj['position_cd'] = position_cd;
      if (position_cd == undefined) {
        Message(21,function(){});
      }
      else {
        Message(3,function(){
          // Call ajax delete record
          $.ajax({
            type: "POST",
            url: "/m0040/delete",
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
  } 
  catch (e) {
    alert('initEvents: ' + e.message);
  }
}

/*
* refer data when click or press enter in search input 
* @author    : manhnd – manhnd@ans-asia.com - create: 2022/07/12
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/
function referData(obj) {
  // Call ajax
  $.ajax({
    type: "POST",
    url: "/m0040/search",
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