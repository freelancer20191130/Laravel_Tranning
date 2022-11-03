/**
 ***************************************************************************
 * ANS ASIA
 *
 * 作成日          :   2022/03/15
 * 作成者          :   namnth – namnth@ans-asia.com
 *
 * @package         :   
 * @copyright       :   Copyright (c) ANS-ASIA
 * @version         :   1.0.0
 ***************************************************************************
 */
$(function () {
  try {
    initEvents();
    initialize();
  } catch (e) {
    alert('initialize: ' + e.message);
  }
});
/*
 * initialize
 * @author    : namnth – namnth@ans-asia.com - create: 2022/06/15
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */

function initialize() {
  try {
  } catch (e) {
    alert('initEvents: ' + e.message);
  }
}
/*
 * initEvents
 * @author    : namnth – namnth@ans-asia.com - create: 2022/06/15
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function initEvents() {
  try {
    $(document).on('click', '#save-btn', function (e) {
      try {
        Message(86, function (e) {
          postSearch();
        });
      } catch (e) {
        alert('password_length: ' + e.message);
      }
    });

    $(document).on('click', '#back-btn', function (e) {
      try {
        Message(71, function (e) {
          window.location = "/menu";
        });
      } catch (e) {
        alert('password_length: ' + e.message);
      }
    });

    $(document).on('change', '#password_length', function () {
      try {
        var password_length = $(this).val() * 1;
        if (password_length > 20) {
          $(this).val('');
        }
      } catch (e) {
        alert('password_length: ' + e.message);
      }
    });

    $(document).on('blur', '.mmdd', function () {
      try {
        let mmdd = $(this).val(); 
        let length = mmdd.length;
        let year = '1900/';
        let month = (mmdd.slice(0, 2));
        let day = (mmdd.slice(2, 5)).replace(/[^0-9a-z\s]/gi, '');
        if (length != 4 && length != 5) {
          $(this).val('');
          $(this).closest('div').find('.yyyymmdd').val('');
        } else if (length == 4) {
          let yyyymmdd = year + month + '/' + day;
          let mmdd = month + '/' + day;
          if (!isNaN(Number(new Date(yyyymmdd)))){
            $(this).closest('div').find('.mmdd').val(mmdd);
            $(this).closest('div').find('.yyyymmdd').val(yyyymmdd);
          }else{
            $(this).val('');
          }
        } else if (length = 5) {
          let slash = (mmdd.slice(2, 3));
          if (slash != '/') {
            $(this).val('');
          } else {
            let yyyymmdd = year + month + '/' + day;
            if (!isNaN(Number(new Date(yyyymmdd)))) {
              $(this).closest('div').find('.mmdd').val(mmdd);
              $(this).closest('div').find('.yyyymmdd').val(yyyymmdd);
            }else{
              $(this).val('');
            }
          }
        }
      } catch (e) {
        alert('password_length: ' + e.message);
      }
    });


  } catch (e) {
    alert('initEvents: ' + e.message);
  }
}
/*
 * postLogin
 * @author    : namnth – namnth@ans-asia.com - create: 2022/06/15
 * @author    :
 * @return    : null
 * @access    : public
 * @see       : init
 */
function postSearch() {
  try {
    clearErrors();
    let data = {};
    data.beginning_date               = $("#beginning_date_full").val();
    data.beginning_date_1on1          = $("#beginning_date_1on1_full").val();
    data.password_length              = $("#password_length").val();
    data.password_character_limit     = $("#password_character_limit").val();
    data.password_age                 = $("#password_age").val();
    console.log(data);
    $.ajax({
      url: '/saveData',
      type: 'post',
      dataType: 'json',
      data: data,
      success: function (res) {
        switch (res['status']) {
          // success
          case OK:
            Message(2, function (e) {
            });
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
    });
  } catch (error) {
    
  }
}