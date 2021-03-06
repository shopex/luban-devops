
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('jquery-airload');

window.Vue = require('vue');

$.showIndicator = function() {
    $('#indicator').show();
}

$.hideIndicator = function() {
    $('#indicator').hide();
}

$.toast = function(str) {
    $('#toast span').html(str);
    if (!$.toast_is_show) {
        $.toast_is_show = true;
        $('#toast').animate({ top: 0 });
    } else {
        clearTimeout($.toast_close_timer);
    }

    $.toast_close_timer = setTimeout(function() {
        $.toast_is_show = false;
        $('#toast').animate({ top: -50 });
    }, 2500);
}

$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.airloadSetup(window.document, {
      slot: [
        '.main-content',
        '.main-script',
        'meta[name="csrf-token"]'
      ],
      success: function(){
        $.showIndicator();
      },
      start: function(){
        $.showIndicator();
        $('.dropdown-toggle[aria-expanded=true]').click()                
      },
      error: function(){
        console.info('error');
      },
      complete: function(){
        $.hideIndicator();
      }
    });
})

require('../vendor/admin/js/ui');

