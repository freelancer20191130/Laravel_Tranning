/**
 * ****************************************************************************
 * ANS ASIA
 *
 * 作成日          :   2021/07/14
 * 作成者          :   namnt
 *
 * @package     :   MODULE MASTER
 * @copyright       :   Copyright (c) ANS-ASIA
 * @version     :   1.0.0
 * ****************************************************************************
 */

$(document).ready(function() {
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
 * @author		:	namnt - 2021/07/14 - create
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
 * @author		:	namnt - 2021/07/14 - create
 * @author		:
 * @return		:	null
 * @access		:	public
 * @see			:	init
 */
function initEvents() {
    try {
        $(document).on('click', '#drop-button', function(e) {
            try {
                $('#tab-drop').addClass('hidden');
                $('#drop-button').addClass('drop-close');
            } catch (e) {
                alert('hidden: ' + e.message);
            }
        });
        $(document).on('click', '.drop-close', function(e) {
            try {
                $('#tab-drop').removeClass('hidden');
                $('#drop-button').removeClass('drop-close');
            } catch (e) {
                alert('hidden: ' + e.message);
            }
        });
        $(document).on('click', '#open-menu', function(e) {
            try {
                openMenu();
            } catch (e) {
                alert('hidden: ' + e.message);
            }
        });
        $(document).on('click', '.menu-close', function(e) {
            try {
                closeMenu();
            } catch (e) {
                alert('open: ' + e.message);
            }
        });
        $(document).on('mouseover', '#tab-navbar', function(e) {
            try {
                $('#triangle-navbar').css("border-right-color", "white")
            } catch (e) {
                alert('hover: ' + e.message);
            }
        });
        $(document).on('mouseover', '#tab-navbar', function(e) {
            try {
                $('#triangle-navbar').css("border-right-color", "white")
            } catch (e) {
                alert('hover: ' + e.message);
            }
        });
        $(document).on('mouseout', '#tab-navbar', function(e) {
            try {
                $('#triangle-navbar').css("border-right-color", "#707070")
            } catch (e) {
                alert('mouse out: ' + e.message);
            }
        });
    } catch (e) {
        alert('initEvents: ' + e.message);
    }
}
/*
 * openMenu
 * @author		:	namnt - 2021/07/14 - create
 * @author		:
 * @return		:	null
 * @access		:	public
 * @see			:	init
 */
function openMenu() {
    try {
        $('#menu').addClass('hidden');
        $('#open-menu').addClass('menu-close');
        $('#right').removeClass('mt-36')
    } catch (e) {
        alert('open menu:' + e.message)
    }
}

/*
 * closeMenu
 * @author		:	namnt - 2021/07/14 - create
 * @author		:
 * @return		:	null
 * @access		:	public
 * @see			:	init
 */
function closeMenu() {
    try {
        $('#menu').removeClass('hidden');
        $('#open-menu').removeClass('menu-close');
        $('#right').addClass('mt-36')
    } catch (e) {
        alert('open menu:' + e.message)
    }
}