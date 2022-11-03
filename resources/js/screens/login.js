/**
 * ****************************************************************************
 * ANS ASIA
 *
 * 作成日          :   2018/06/22
 * 作成者          :   huongtd – datnt@ans-asia.com
 *
 * @package     :   MODULE MASTER
 * @copyright       :   Copyright (c) ANS-ASIA
 * @version     :   1.0.0
 * ****************************************************************************
 */

 $( document ).ready(function() {
	try{
		//initialize();
        initEvents();
	}
	catch(e){
		alert('ready' + e.message);
	}
});

/**
 * initialize
 *
 * @author		:	huongtd - 2021/07/13 - create
 * @author		:
 * @return		:	null
 * @access		:	public
 * @see			:	init
 */
function initialize() {
	try {
		
	} catch (e) {
		alert('initialize: ' + e.message);
	}
}
/**
 * INIT EVENTS
 * @author		:	huongtd - 2021/07/13 - create
 * @author		:
 * @return		:	null
 * @access		:	public
 * @see			:	init
 */
function initEvents() {
    try {
		//click remove placeholder
		$(document).on('click', '#delete-placeholder', function () {
            try {
					$('.delete-placeholders').removeAttr('placeholder');
            } catch (e) {
                alert('.delete-placeholder click' + e.message);
            }
        });
		$(document).on('click', '.add-placeholder', function () {
            try {
				$('.delete-placeholders').attr({
					'placeholder': '会社ＩＤ',
					'text': 'white'					});
            } catch (e) {
                alert('.add-placeholder click' + e.message);
            }
        });
		//click remove placeholder
		$(document).on('click', '#placeholder', function () {
            try {
					$('.delete-placeholder').removeAttr('placeholder');
            } catch (e) {
                alert('#placeholder click' + e.message);
            }
        });
		$(document).on('click', '.add-placeholders', function () {
            try {
				$('.delete-placeholder').attr({
					'placeholder': 'ユーザー名'
					});
            } catch (e) {
                alert('.add-placeholders click' + e.message);
            }
        });
		//click remove placeholder
		$(document).on('click', '#placeholders', function () {
            try {
					$('.placeholder').removeAttr('placeholder');
            } catch (e) {
                alert('#placeholders click' + e.message);
            }
        });
		$(document).on('click', '.placeholders', function () {
            try {
				$('.placeholder').attr({
					'placeholder': 'パスワード'
					});
            } catch (e) {
                alert('.placeholders click' + e.message);
            }
        });
	} catch (e) {
		alert('initEvents: ' + e.message);
	}
}