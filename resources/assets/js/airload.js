require('jquery-airload');


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
      success: function(){
        // console.info('success');
        $.showIndicator();        
      },
      start: function(){
        // console.info('start');
        $('.dropdown-toggle[aria-expanded=true]').click()                
      },
      error: function(){
        // console.info('error');
      },
      complete: function(){
        // console.info('complete');
        $.hideIndicator();
      }
    });
})