/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/screens/m0050.js ***!
  \***************************************/
/**
 * ****************************************************************************
 * ANS ASIA
 *
 * 作成日          :   2018/06/22
 * 作成者          :   datnt – datnt@ans-asia.com
 *
 * @package     :   MODULE MASTER
 * @copyright       :   Copyright (c) ANS-ASIA
 * @version     :   1.0.0
 * ****************************************************************************
 */
$(document).ready(function () {
  try {
    initialize();
    initEvents();
  } catch (e) {
    alert('ready' + e.message);
  }
});
/**
 * initialize
 *
 * @author		:	datnt - 2018/06/21 - create
 * @author		:
 * @return		:	null
 * @access		:	public
 * @see			:	init
 */

function initialize() {
  try {} catch (e) {
    alert('initialize: ' + e.message);
  }
}
/*
 * INIT EVENTS
 * @author		:	datnt - 2018/06/21 - create
 * @author		:
 * @return		:	null
 * @access		:	public
 * @see			:	init
 */


function initEvents() {
  try {
    var row=parseInt($('#last-grade').val()) + 1 ;
    // add row
    $(document).on("click", "#add_new_row", function () {
        var new_row = `
        <tr>
          <td><input id="" type="text" data-id="" class="form-control grade" disabled value=${row}></td>
          <td><input id="grade_nm${row}" type="text" data-id="" class="form-control  grade_nm required " maxlength="10"></td>
          <td>
              <button class="btn btn-rm red btn-sm btn_remove">
                <i class="fa fa-remove"></i>
              </button>
          </td>
          <td class="text-center row-hover"><i class="fa fa-arrows" aria-hidden="true"></i></td>
        </tr>
        `
        $('#tl-body').append(new_row);
        row++;
    });
    // delete row
    $(document).on("click", ".btn_remove", function () {
      $(this).closest('tr').remove();
    });
    var el = document.getElementById('tl-body');
    Sortable.create(el);
    // save 
    $(document).on('click','#save-btn',function(){
      clearErrors();
      Message(1,function(){
        var arrs = [];
        $('#tl-body tr').each(function(index, val){  
          arrs.push({
            grade: $(this).find('.grade').val(),
            grade_nm: $(this).find('.grade_nm').val(),
            arrange_order: index+1,
          });
        });
       var data={
         data:JSON.stringify(arrs),
       }
       ajaxSave(data);
      })
     
    })
   
  } catch (e) {
    alert('initEvents: ' + e.message);
  }
}
/******/ })()
;

/*
 * function   : ajaxSave -- post data
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/07/14
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function ajaxSave(data){
  $.ajax({
    type: 'post',
    url:  '/m0050/save',
    dataType: 'json',
    data:data,
    success: function (res) {
      console.log(res);
      switch (res['status']) {
        // success
        case OK:
          Message(2,function(e){
            window.location.reload();
          })
          break;
        // error
        case NG:
          if (res['errors'] !== undefined && res['errors'] !== null) {
              setErrors(res['errors']);
              let tr = $('.tooltip_error').closest('tr');
              tr.find('td').css('vertical-align','top');
          } 
          break;
        // Exception
        case EX:
          // jError(res['Exception']);
              alert('Exception');
          break;
        default:
          break;
        }
    }
  })
}