/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/screens/m0020.js ***!
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
 * @author		:	tuyendn - 2022/07/4 - create
 * @author		:
 * @return		:	null
 * @access		:	public
 * @see			  :	init
 */

function initialize() {
  try {
    getData();
  } catch (e) {
    alert('initialize: ' + e.message);
  }
}
/*
 * INIT EVENTS
 * @author		:	tuyendn - 2022/07/4 - create
 * @author		:
 * @return		:	null
 * @access		:	public
 * @see			  :	init
 */


function initEvents() {
  try {
    //click level
    $(document).on('click','.lv-wap',function(){
        clearErrors();
        let typ = $(this).attr('type');
        //set type insert level
        $('.breadcrumb-list').attr('check','0');
        // click level active
        $('.background').removeClass('background');
        $(this).addClass('background');
        $(this).toggleClass('actived');
        if($(this).hasClass('actived')){
          $next=$(this).next();
          $next.find('> li').show();
        }else{
          $next=$(this).next();
          $next.find('.lv-wap').removeClass('actived');
          $next.find('li').hide();
        }
        $('.org_cd').val('');
        //process breadcrumb
        //get current level 
        let type = $(this).attr('type');
        let arr ={}
        arr = $(this).attr('cd').split("-");
        //set type check insert level
        $('#typ').val(type); 
        let arr_breadcrumb=[]; 
        var arr_temp = [];
        var typ_cd = [];
        for(let i=0;i<type;i++){
          let result = '';
          arr_temp.push(i); //typ1 1----, typ2 1-2--- , typ3 1-2-3--
            for(let j=0;j<5;j++){
              if(arr_temp[j] == undefined){
                //last remove the character '-'
                if(j == type - 1 ){
                   continue;
                }  
                //concat the character '-' ex: 1(- - - -)
                result = result.concat('-');
              }else{
                //last remove the character '-'
                if(j == type - 1){
                  result = result.concat(arr[arr_temp[j]]);
                }
                //concat the character '1-' ex: 1-,2-,3- 
                else{
                  result = result.concat(arr[arr_temp[j]],'-');
                }
              }
            }
            
            //result 1-1-1-1-1 1----
            // get value name level
            arr_breadcrumb[i] = $(`.lv-wap[cd="${result}"] .lv-nm`).text();
            // get type level
            typ_cd[i]         =   $(`.lv-wap[cd="${result}"] `).attr('type');
        }
        
        $('.breadcrumb-list').html('');
        //loop name level append text in breadcrumb
        $.each(arr_breadcrumb, function( index, value ) {
          if(value != undefined){
            $(`#org_${index + 1}`).val(arr[index]).attr('type_cd',typ_cd[index]);
            $('.breadcrumb-list').append(`<span class="breadcrumb-items" cd="${arr[index]}" type="${typ_cd[index]}">${value}</span>`);
          }
        });
        //arr[0] cd1: 1 , arr[1] cd2: 1 ,arr[2] cd3: 1 
        let data = {
          arr:JSON.stringify(arr),
        }
        ajaxRefer(data);

    })
    //click show popup
    $(document).on('click','#change-org-name-button',function(){
        showPopup('/m0020/popup', '550px');
    })
    //click check input organization
    $(document).on('click','.btn-input',function(){
        var parent = $(this).closest('.row-wap');
        if($(this).prev().is(':checked') && ! $(this).prev().hasClass('checkbox_1')){
            parent.find('.input-nm').removeClass('required'); 
        }else{
            parent.find('.input-nm').addClass('required');
        }
    })
    //click save  organization
    $(document).on('click','#save_1-btn',function(){
        var arrs = [];
        $('.list-item .row-wap').each(function(index, val){  
          arrs.push({
            organization_typ:$(this).find('.checkbox').attr('data-id'),
            use_typ:$(this).find('input').is(':checked' ) ? 1: 0,
            organization_group_nm:$(this).find('.input-nm').val(),
          });
        });
        var data = {
          'data':JSON.stringify(arrs),
        };
        saveOrganization(data);
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
     //click btn paginate
     $(document).on('click','.paginate_button',function(){
      let data = {};
      data.keyword = $('#input-search').val();
      data.page_current = $(this).attr('page');
      ajaxSearch(data);
    })
    //validate number input arrange_order
    $(document).on('keypress','#arrange_order',function(e){
     var charCode = (e.which) ? e.which : event.keyCode    
     if (String.fromCharCode(charCode).match(/[^0-9]/g))    
         return false;   
    })
    //click save level
    $(document).on('click','#save-btn',function(){
        Message(1,function(){
          clearErrors();
          var data = {
            'organization': [{
              organization_cd_1 : $('#org_1').val(),
              organization_cd_2 : $('#org_2').val(),
              organization_cd_3 : $('#org_3').val(),
              organization_cd_4 : $('#org_4').val(),
              organization_cd_5 : $('#org_5').val(),
              organization_typ  : $('#typ').val(),
              organization_nm   : $('#organization_nm').val(),
              organization_ab_nm: $('#organization_ab_nm').val(),
              responsible_cd    : $('#employee_nm').attr('responsible_cd'),
              arrange_order     : $('#arrange_order').val()? $('#arrange_order').val() : 0 ,
              id                : $('#cd-id').val(),
              check             : $('.breadcrumb-list').attr('check'),
            }],
          };
       
        ajaxSave(data);
        })
    })
    //click new same level
    $(document).on('click','#create-org-btn',function(){
        Message(5,function(){
          clearErrors();
          $('#cd-id').val('');
          $('#organization_nm').val('').focus();;
          $('#organization_ab_nm').val('');
          $('#responsible_cd').val('');
          $('#arrange_order').val('');
          $('.breadcrumb-list').find('.under-level').remove();
          $('.breadcrumb-list').attr('check','0');
          if($('.breadcrumb-list').find('.breadcrumb-items').length > 1){
            $('.breadcrumb-list').find('.breadcrumb-items').last().hide();
            $('.breadcrumb-list').append(`<span class="breadcrumb-items same-level">新規作成中</span>`)
          }else{
            $('.breadcrumb-list').find('.breadcrumb-items').hide();
          }
        })
       
    })
     //click under level
    $(document).on('click','#create-division-btn',function(){
        Message(5,function(){
          clearErrors();
          $('#cd-id').val('');
          $('#organization_nm').val('').focus();
          $('#organization_ab_nm').val('');
          $('#responsible_cd').val('');
          $('#arrange_order').val('');
          $('.breadcrumb-list').find('.same-level').remove();
          if($('.breadcrumb-list').find('.breadcrumb-items').length > 0){
            $('.breadcrumb-list').find('.breadcrumb-items').show();
            $('.breadcrumb-list').append(`<span class="breadcrumb-items under-level">下位組織作成中</span>`);
            $('.breadcrumb-list').attr('check','1');
          }else{
            $('.breadcrumb-list').find('.breadcrumb-items').hide();
          }
        })
       
    })
     //click delete level
    $(document).on('click','#delete-btn',function(){
      Message(3,function(){
        clearErrors();
        var data = {
          'organization': [{
            organization_cd_1 : $('#org_1').val(),
            organization_cd_2 : $('#org_2').val(),
            organization_cd_3 : $('#org_3').val(),
            organization_cd_4 : $('#org_4').val(),
            organization_cd_5 : $('#org_5').val(),
            organization_typ  : $('#typ').val(),
          }],
        };
        ajaxDelete(data);
      })
      
    })
    // Click button in employee_nm input => show popup search employee
    $(document).on('click', '#search-employee-btn', function () {
      // Call function show popup
      showPopup('/popup/employee', '1200px');
    });
     
    // POPUP
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

    // Click page-index in popup => refer data 
    $(document).on('click', '#paging-popup #datatable_flextime_paginate .paginate_button', function (event) {
      // Declare obj
      let obj = {};
      // Get page index
      let page_index = $(event.target).attr('page');
      obj['current_page'] = page_index;
      // Get page size 
      let page_size = $('#paging-popup #cb_page').val();
      obj['page_size'] = page_size;
      // Call ajax
      $.ajax({
        type: "POST",
        url: "/popup/refer-table",
        data: obj,
        dataType: "html",
        success: function (res) {
          $('#table-data').empty();
          $('#table-data').append(res);
          let page_size_selected = $('#paging-popup #cb_page').attr('data-selected');
          $('#paging-popup #cb_page').val(page_size_selected);
        }
      });
    }); 

    // Click search-btn in popup => refer data 
    $(document).on('click', '#collapsePopup #search-btn', function (event) {
      // Declare obj
      let obj = {};
      // Get value of input
      let inputs = $('#collapsePopup input');
      for (const input of inputs) {
        let input_id = $(input).attr('id');
        let input_value = input.value;
        obj[input_id] = input_value;
      }
      // Get value of checkbox retired
      let checkbox_value = $('#company_out_dt_flg').is(":checked");
      if (checkbox_value == true ) {
        obj['company_out_dt_flg'] = '1';
      }
      else {
        obj['company_out_dt_flg'] = '0';
      }
      // Get value of combobox
      let selects = $('#collapsePopup select');
      for (const item of selects) {
        let select_el_id = $(item).attr('id');
        let select_el_value = $(`#collapsePopup #${select_el_id}`).val();
        if (select_el_value == -1) {
          select_el_value = '';
        }
        obj[select_el_id] = select_el_value;
      }
      // Get page index
      let page_index = $(event.target).attr('page');
      obj['current_page'] = page_index;
      // Get page size 
      let page_size = $('#paging-popup #cb_page').val();
      obj['page_size'] = page_size;
      // Call ajax
      $.ajax({
        type: "POST",
        url: "/popup/refer-table",
        data: obj,
        dataType: "html",
        success: function (res) {
          $('#table-data').empty();
          $('#table-data').append(res);
          let page_size_selected = $('#paging-popup #cb_page').attr('data-selected');
          $('#paging-popup #cb_page').val(page_size_selected);
        }
      });
    });

    // Click row on table => refer data to input#employee_nm 
    $(document).on('click', '#table-data .table tbody tr', function (event) {
      let row = $(event.target).parents('tr');
      let employee_nm = $(row).attr('employee_nm');
      let employee_cd = $(row).attr('employee_cd');
      // Close popup
      $('#overlay').hide();
      $('#employee_nm').val(employee_nm);
      $('#employee_nm').attr('responsible_cd',employee_cd);
    });

    // END POPUP
  } catch (e) {
    alert('initEvents: ' + e.message);
  }
}
/******/ })()
;
// var arr_check = [];
/*
 * function   : getData -- get data organization by level 
 * @param 
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/07/11
 * @return    : null
 * @access    : public
 * @see       : init
 */
function getData(){
  $.ajax({
    type: 'get',
    url:  '/m0020/getData',
    dataType: 'json',
    success: function (res) {
      var arr = [];
      $('#pagi-wap').html(res.pagi);
      $.each(res.data[0], function( index, value ) {
         let or_typ         = value.organization_typ;
         let arr_cd         = [value.cd_1,value.cd_2,value.cd_3,value.cd_4,value.cd_5]
         let arr_org        = [value.organization_cd_1,value.organization_cd_2,value.organization_cd_3,value.organization_cd_4,value.organization_cd_5]
         let nm             = value.organization_nm;
         checkLv({
            or_typ:or_typ,
            arr_cd:arr_cd,
            nm:nm,
            arr:arr,
            arr_org:arr_org
          });
      });
    }
  })
}
/*
 * function   : checkLv -- append data level
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/07/11
 * @param     : or_typ -- organization_typ              - type[number]
 * @param     : arr_cd -- cd                            - type[array]
 * @param     : nm     -- organization_nm               - type[string]
 * @param     : arr    -- check exist level             - type[array]
 * @param     : arr_org-- organization_cd               - type[array]
 * @return    : null
 * @access    : public
 * @see       : init
 */
function checkLv({ or_typ = '',arr_cd = [] ,nm = '',arr=[],arr_org=[]}){
      var cd_before   = or_typ - 1;
      var arrtem = [];
      //convert key cd from 1
      $.each( arr_cd, function( key, value ) {
        arrtem[key+1] = value;
      });
  
  if(or_typ == 1){
      var html = crLi({class_li:or_typ,id:arrtem[or_typ],name:nm,arr_org:arr_org,typ:or_typ});
      $('#list-lv').append(html);
  }else{
    //check type level not exist create ul
    if($.inArray(arrtem[cd_before],arr) == -1){
      var li = crLi({class_li:or_typ,id:arrtem[or_typ],name:nm,arr_org:arr_org,typ:or_typ});
       var html=`
          <ul class="list-${or_typ}" id="id-${arrtem[cd_before]}">
              ${li}
          </ul>
       ` 
      $(`#cd-${arrtem[cd_before]}`).after(html);
      arr.push(arrtem[cd_before]);
     //check type level  exist append ul
    }else{
       var html = crLi({class_li:or_typ,id:arrtem[or_typ],name:nm,arr_org:arr_org,typ:or_typ});
       $(`#id-${arrtem[cd_before]}`).append(html);
    }
  }
}
/*
 * function   : crLi -- create html li
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/07/11
 * @param     : class_li   -- class_li                      - type[number]
 * @param     : name       -- organization_nm               - type[string]
 * @param     : arr_org    -- organization_cd               - type[array]
 * @param     : typ        -- type level                    - type[number]
 * @return    : null
 * @access    : public
 * @see       : init
 */

function crLi({class_li = '',id='',name= '',arr_org=[] ,typ=''}){ 
  let cd1= arr_org[0] ? arr_org[0] : '';
  let cd2= arr_org[1] ? arr_org[1] : '';
  let cd3= arr_org[2] ? arr_org[2] : '';
  let cd4= arr_org[3] ? arr_org[3] : '';
  let cd5= arr_org[4] ? arr_org[4] : '';
  var li=
  `<li class="lv-${class_li}">
      <div class="lv-wap" id="cd-${id}" type="${typ}" cd="${cd1}-${cd2}-${cd3}-${cd4}-${cd5}"><i class="fa fa-chevron-right" aria-hidden="true"></i><span class="lv-nm">${name}</span></div>
  </li>
  `
  return li;
}

/*
 * function   : saveOrganization -- save data organization
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/07/11
 * @return    : null
 * @access    : public
 * @see       : init
 */

function saveOrganization(data){
  clearErrors();
  $.ajax({
    type: 'post',
    url:  '/m0020/saveOrganization',
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
/*
 * function   : ajaxRefer -- Refer data organization
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/07/11
 * @return    : null
 * @access    : public
 * @see       : init
 */

function ajaxRefer(data){
  $.ajax({
    type: 'post',
    url:  '/m0020/referData',
    dataType: 'json',
    data:data,
    success: function (res) {
      let data  = res.data[0][0];
      let type  = data.organization_typ;
      let arr   = [data.organization_cd_1,data.organization_cd_2,data.organization_cd_3,data.organization_cd_4,data.organization_cd_5];
      let id    = arr[type-1];
      console.log(data);
      $('#employee_nm').attr('responsible_cd',data.responsible_cd);
      $('#employee_nm').val(data.employee_nm);
      $('#arrange_order').val(data.arrange_order);
      $('#cd-id').val(id);
      $('#organization_nm').val(data.organization_nm);
      $('#organization_ab_nm').val(data.organization_ab_nm);
    }
  })
}

/*
 * function   : ajaxSearch -- search data
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/07/11
 * @return    : null
 * @access    : public
 * @see       : init
 */

function ajaxSearch(data){
  $.ajax({
    type: 'post',
    url:  '/m0020/search',
    dataType: 'json',
    data:data,
    success: function (res) {
      var arr = [];
      $('#list-lv').html('');
      $('#pagi-wap').html(res.pagi);
      $.each(res.data[0], function( index, value ) {
         let or_typ         = value.organization_typ;
         let arr_cd         = [value.cd_1,value.cd_2,value.cd_3,value.cd_4,value.cd_5]
         let arr_org        = [value.organization_cd_1,value.organization_cd_2,value.organization_cd_3,value.organization_cd_4,value.organization_cd_5]
         let nm             = value.organization_nm;
         checkLv({
            or_typ:or_typ,
            arr_cd:arr_cd,
            nm:nm,
            arr:arr,
            arr_org:arr_org
          });
      });
    }
  });
}

/*
 * function   : ajaxSave -- post data
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/07/11
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function ajaxSave(data){
  $.ajax({
    type: 'post',
    url:  '/m0020/save',
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
 * function   : ajaxDelete -- delete data
 * @author    : tuyen – tuyendn@ans-asia.com - create 2020/07/11
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */

function ajaxDelete(data){
  $.ajax({
    type: 'post',
    url:  '/m0020/delete',
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