

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
  /*
  * initialize
  * @author    : namnth – namnth@ans-asia.com - create: 2022/07/06
  * @author    :
  * @return    : null
  * @access    : public
  * @see       : init
  */

  function initialize() {
    try { } catch (e) {
      alert('initialize: ' + e.message);
    }
  }
  /*
  * initEvents
  * @author    : namnth – namnth@ans-asia.com - create: 2022/07/06
  * @author    :
  * @return    : null
  * @access    : public
  * @see       : init
  */
  function initEvents() {
    try {
      //btn add
      $(document).on('click', '#add-new-btn', function (e) {
        try {
          e.preventDefault();
          Message(5, function (e) {
            location.reload();
          });
        } catch (e) {
          alert('#btn-search: ' + e.message);
        }
      });
      // btn save
      $(document).on('click', '#save-btn', function (e) {
        try {
          e.preventDefault();
          Message(1, function (e) {
            postSave();
          });
        } catch (e) {
          alert('#btn-search: ' + e.message);
        }
      });
      // btn delete
      $(document).on('click', '#delete-btn', function (e) {
        try {
          e.preventDefault();
          Message(3, function (e) {
            postDelete();
          });
        } catch (e) {
          alert('#btn-search: ' + e.message);
        }
      });
      // refer data 
      $(document).on('click', '.job_master', function (e) {
        try {
          e.preventDefault();
          let job_cd = $(this).data('job_cd');
          let job_nm = $(this).data('job_nm');
          let job_ab_nm = $(this).data('job_ab_nm');
          let arrange_order = $(this).data('arrange_order');
          $('#job_cd').val(job_cd);
          $('#job_nm').val(job_nm);
          $('#job_ab_nm').val(job_ab_nm);
          $('#arrange_order').val(arrange_order);
        } catch (e) {
          alert('#btn-search: ' + e.message);
        }
      });
      $(document).on('click', '.card-item', function (e) {
        try {
          e.preventDefault();
          $('.card-item').removeClass('active');
          $(this).addClass('active');
        } catch (e) {
          alert('#btn-search: ' + e.message);
        }
      });

      // btn search
      $(document).on('click', '#btn-search', function (e) {
        try {
          e.preventDefault();
          postSearch();
        } catch (e) {
          alert('#btn-search: ' + e.message);
        }
      });
      // paging
      $(document).on('click', '.paginate_button', function (e) {
        try {
          let page = $(this).attr('page');
          postSearch(page);
        } catch (e) {
          alert('page: ' + e.message);
        }
      });
      $(document).on('change', '#cb_page', function (e) {
        try {
          let page = $('.paginate_button.active').attr('page');
          postSearch(page);
        } catch (e) {
          alert('page_size: ' + e.message);
        }
      });
    } catch (e) {
      alert('initEvents: ' + e.message);
    }
  }
/*
* postSearch
* @author    : namnth – namnth@ans-asia.com - create: 2022/07/06
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/

function postSearch(page) {
  let data = {};
  data['job_nm'] = $('#input-search').val();
  data['page'] = page;
  $.ajax({
    type: 'post',
    url: '/m0030/search',
    dataType: 'html',
    data: data,
    success: function (res) {
      $('#pagi-wap').html(res);
    }
  });
} 
/*
* saveData
* @author    : namnth – namnth@ans-asia.com - create: 2022/07/06
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/

function postSave() {
  clearErrors();
  let data = {};
  data.job_cd         = $("#job_cd").val();
  data.job_nm         = $("#job_nm").val();
  data.job_ab_nm      = $("#job_ab_nm").val();
  data.arrange_order  = $("#arrange_order").val();
  console.log(data);
  $.ajax({
    type: 'POST',
    url: '/m0030/save',
    data: data,
    datatype: "json",
    success: function (res) {
      switch (res['status']) {
        // success
        case OK:
          Message(2, function () {
            location.reload();
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
          setErrors(res['errors']);
          break;
        default:
          break;
      }
    }
  });
}
/*
* deleteData
* @author    : namnth – namnth@ans-asia.com - create: 2022/07/06
* @author    :
* @return    : null
* @access    : public
* @see       : init
*/
function postDelete() {
  let data = {};
  data.job_cd = $("#job_cd").val();
  $.ajax({
    type: 'post',
    url: '/m0030/delete',
    dataType: 'json',
    data: data,
    success: function (res) {
      console.log(res);
      switch (res['status']) {
        case OK:
          Message(4, function (e) {
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