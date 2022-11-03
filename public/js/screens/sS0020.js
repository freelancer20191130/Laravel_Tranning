/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/screens/sS0020.js ***!
  \****************************************/
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
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/06/21
 * @author		:
 * @return		:	null
 * @access		:	public
 * @see       :	init
 */

function initialize() {
  try {} catch (e) {
    alert('initialize: ' + e.message);
  }
}
/*
 * INIT EVENTS
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/06/21
 * @author		: namnth - namnth@ans-asia.com - update 2020/06/27
 * @return		:	null
 * @access		:	public
 * @see			:	init
 */


function initEvents() {
  try {
    //click btn search
    $(document).on('click', '#btn-search', function (e) {
      try {
        e.preventDefault();
          //call funtion ajaxSearch
          let data = {};
          data.keyword = $('#input-search').val();
          ajaxSearch(data);
      } catch (e) {
          alert('#btn-search: ' + e.message);
      }
    });
    //validate number input arrange_order
    $(document).on('keypress','#arrange_order',function(e){
      var charCode = (e.which) ? e.which : event.keyCode    
      if (String.fromCharCode(charCode).match(/[^0-9]/g))    
          return false;   
    })
    //change input search
    $(document).on('change', '#input-search', function (e) {
        try {
            e.preventDefault();
            let data = {};
            data.keyword = $('#input-search').val();
            ajaxSearch(data);
        } catch (e) {
            alert('#btn-search: ' + e.message);
        }
    });
    //click input lable_box
    $(document).on('click', '.lable_box', function (e) {
      try {
        let input = $(this).prev();
        var _this = $(this).closest('.lv-item');
        if(!input.prop('disabled')){
          if(!input.prop('checked')){
            if(_this.hasClass('lv-2')){
              _this.prevAll('.lv-1').first().find('input').prop("checked",true);
            }else if(_this.hasClass('lv-3')){
              _this.prevAll('.lv-1').first().find('input').prop("checked",true);
              _this.prevAll('.lv-2').first().find('input').prop("checked",true);
            }else if(_this.hasClass('lv-4')){
              _this.prevAll('.lv-1').first().find('input').prop("checked",true);
              _this.prevAll('.lv-2').first().find('input').prop("checked",true);
              _this.prevAll('.lv-3').first().find('input').prop("checked",true);
            }else if(_this.hasClass('lv-5')){
              _this.prevAll('.lv-1').first().find('input').prop("checked",true);
              _this.prevAll('.lv-2').first().find('input').prop("checked",true);
              _this.prevAll('.lv-3').first().find('input').prop("checked",true);
              _this.prevAll('.lv-4').first().find('input').prop("checked",true);
            }
          }
          else{
            if(_this.hasClass('lv-1') ){
               let cd_parent = input.attr('cd-1');
               $(`[cd-1= ${cd_parent}]`).prop("checked",false);
            }
            else if(_this.hasClass('lv-2')){
              let cd_parent = input.attr('cd-2');
              input.prop("checked",false);
              $(`[cd-2= ${cd_parent}]`).prop("checked",false);
            }
            else if(_this.hasClass('lv-3')){
              let cd_parent = input.attr('cd-3');
              input.prop("checked",false);
              $(`[cd-3= ${cd_parent}]`).prop("checked",false);
            }
            else if(_this.hasClass('lv-4')){
              let cd_parent = input.attr('cd-4');
              input.prop("checked",false);
              $(`[cd-4= ${cd_parent}]`).prop("checked",false);
            }
            input.prop("checked",true);
          }

        }   
      } catch (e) {
          alert('.lable_box: ' + e.message);
      }
    });
    //click input organization  
    $(document).on('click','#organization',function(e){
      try {
        if($(this).prop('checked')){
          $('.checkbox').attr('disabled','disabled');
          $('.checkbox').prop('checked',false);
          for(let i = 1;i<=5;i++){
            var id = $("[selector='1']").find('input').attr(`cd-${i}`);
            $(`#item_${id}`).find('input').prop('checked',true);
          }
        }else{
          $('.checkbox').prop('checked',false);
          $('.checkbox').removeAttr('disabled');
        }
      } catch (e) {
        alert('' + e.message);
      }
    })
    //save data
    $(document).on('click','#save-btn',function(e){
      try {
        clearErrors();
        Message(1,function(e){
            var arrs = [];
            $('#table-author tbody tr').each(function(index, val){  
                arrs.push({
                    function_id:$(this).find('.function_id').attr('function_id'),
                    authority:$(this).find('.list_authority').val(),
                });
            });
            var arrs_2 = [];
            $('#item-list .lv-item').each(function(index, val){  
              arrs_2.push({
                organization_cd_1:$(this).attr('cd_1'),
                organization_cd_2:$(this).attr('cd_2'),
                organization_cd_3:$(this).attr('cd_3'),
                organization_cd_4:$(this).attr('cd_4'),
                organization_cd_5:$(this).attr('cd_5'),
                authority:$(this).find('input').is( ':checked' ) ? 1: 0
              });
            });
      
            var data = {
                'data':JSON.stringify(arrs),
                'list_organization':JSON.stringify(arrs_2),
                'list_data': [{
                  authority_cd : $('#authority_nm').attr('data-id'),
                  authority_nm : $('#authority_nm').val(),
                  use_typ : $('#use_typ').is( ':checked' ) ? 1: 0,
                  organization : $('#organization').is( ':checked' ) ? 1: 0,
                  arrange_order : $('#arrange_order').val() ? $('#arrange_order').val() : 0 ,
                }],
            };
           
            ajaxSave(data);
        });
      } catch (e) {
        alert('#btn-register'+e.message);
      }
    })
    //new data
    $(document).on('click','#add-new-btn',function(){
      Message(5,function(){
        window.location.reload();
      });
    })
     //click list item refer data 
    $(document).on('click','.card-item',function(){
        clearErrors();
        let data={
          authority_cd:$(this).attr('data-cd')
        };
        ajaxRefer(data);
    })
    //delete data
    $(document).on('click','#delete-btn',function(){
      Message(3,function(){
        let data ={}
        data.authority_cd =$('#authority_nm').attr('data-id');
        ajaxDelete(data);
      })
    })
    //click btn function set multiple select 
    $(document).on('click','#btn-function',function(){
       let value = $('.list-function').val();
       $('.list_authority option').removeAttr('selected');
       $(`.list_authority option[value=${value}]`).attr("selected",true);
    })
     //click btn paginate
    $(document).on('click','.paginate_button',function(){
        let data = {};
        data.keyword = $('#input-search').val();
        data.page_current = $(this).attr('page');
        ajaxSearch(data);
    })
  } catch (e) {
    alert('initEvents: ' + e.message);
  }
}
/******/ })()
;


/*
 * function   : ajaxSearch -- search data
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/06/21
 * @author		: namnth - namnth@ans-asia.com - update 2020/06/27
 * @return    : null
 * @access    : public
 * @see       : init
 */

function ajaxSearch(data){
  $.ajax({
    type: 'post',
    url:  '/ss0020/search',
    dataType: 'html',
    data:data,
    success: function (res) {
      $('#pagi-wap').html(res);
    }
  });
}
/*
 * function   : ajaxSave -- post data
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/06/21
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function ajaxSave(data){
  $.ajax({
    type: 'post',
    url:  '/ss0020/save',
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

/*
 * function   : ajaxRefer -- refer data
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/06/21
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */

function ajaxRefer(data){
  $.ajax({
    type: 'get',
    url:  '/ss0020/refer',
    dataType: 'json',
    data:data,
    beforeSend: function () {
      $('#loader').show();
    },
    complete: function () {
      $('#loader').hide();
    },
    success: function (res) {
      let data = res.data;
      //refer value input authority_nm
      $('#authority_nm').val(data[0][0].authority_nm);
      $('#authority_nm').attr('data-id',data[0][0].authority_cd)
      //refer value input arrange_order
      $('#arrange_order').val(data[0][0].arrange_order);

      if(data[0][0].use_typ == 1){
        $('#use_typ').prop("checked",true);
      }else{
        $('#use_typ').prop("checked",false);
      }
      //refer check list input organization
      if(data[0][0].organization_belong_person_typ == 1){
        $('#organization').prop("checked",true);
        $('.checkbox').attr('disabled','disabled');
        $('.checkbox').prop('checked',false);
      }else{
        $('#organization').prop("checked",false);
        $('.checkbox').removeAttr('disabled');
      }
      
      $.each(data[1], function( index, value ) {
        let tr = $(`.function_id[function_id=${value.function_id}]`).closest('tr');
        tr.find(".list_authority option").removeAttr('selected');
        tr.find(`.list_authority option[value=${value.authority}]`).attr("selected",true);
      });

      $.each(data[2], function( index, value ) {
          if(value.authority == 1){
            $('#item_'+value.id).find('.checkbox').prop('checked',true);
          }else{
            $('#item_'+value.id).find('.checkbox').prop('checked',false);
          }
      });
      
    }
    
  })
}

/*
 * function   : ajaxDelete -- delete data
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/06/21
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */

function ajaxDelete(data){
  $.ajax({
    type: 'post',
    url:  '/ss0020/delete',
    dataType: 'json',
    data:data,
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
          // jError(res['Exception']);
              alert('Exception');
          break;
        default:
          break;
        }
    }
  })
}