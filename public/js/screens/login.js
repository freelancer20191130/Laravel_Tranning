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
    //Login
    $(document).on('click', '#btn_login', function (e) {
      try {
          postLogin();
      } catch (e) {
        alert('login: ' + e.message);
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
function postLogin() {
  try {
    
  } catch (error) {
    
  }
}