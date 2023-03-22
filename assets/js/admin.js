(function($) {
  $(document).ready( function() {
    //add class to body if there's #app-cards
    if ($('#app-cards').length) {
      $('body').addClass('oss_cards_interface');
    }
    //leaving page
    $('.oci-tab .back').click(function(event) {
      $('#oss_leave_page').fadeIn(300);
    });
    $('#oss_leave_page span').click(function(event) {
      $('#oss_leave_page').fadeOut(300);
    });
    //display shortcode in table list
    $('.post-type-oss_cards').append('<div class="osc_copyed_alert">Shortcode Is Copied</div>');
    $('#the-list tr.type-oss_cards').each(function(index, el) {
      var id = $('.check-column input',this).val();
      $('.page-title strong',this).append('<span class="oss_shortcode_table">Shortcode: <input class="osc_copy_shortcode" type="text" value="[oss_cards id=' + id + ']"><i class="fas fa-copy osc_copy_shortcode_click"></i></span>');
    });
    // modals
    $('.oci-tab .hints').click(function(event) {      
      $('#osti_show_data').fadeOut(300);
      $('body').removeClass('oss_show_full_width');
      $('#osti_show_help').fadeIn(300);
    });
    $('.oci-tab .export').click(function(event) {
      $('#osti_show_help').fadeOut(300);
      $('body').removeClass('oss_show_full_width');
      $('#osti_show_data').fadeIn(300);
    });
    //show full width
    $('.oci-tab .full').click(function(event) {
      $('#osti_show_help, #osti_show_data').fadeOut(300);
      $('body').toggleClass('oss_show_full_width');
    });
    $('.oss_shortcode_table, #extra_fields .inside, .oss_shortcode_drop, .oss_shortcode_block').each(function(index, el) {
      $('.osc_copy_shortcode_click',this).click(function(){
            $('.osc_copy_shortcode',el).focus();
            $('.osc_copy_shortcode',el).select();
            document.execCommand("copy");
            document.getSelection().removeAllRanges();
            $('.osc_copyed_alert').fadeIn(500).delay(1500).fadeOut(500);
            $('.oss_shortcode_drop').slideToggle(300);
      });
    });
    //show/hide sidebar
    $('.oci-tab .sidebar').click(function(event) {
      $('.interface-interface-skeleton__sidebar').fadeToggle(300);
      //todo for ver 6-
      // $('body').removeClass('oss-cards_page_edit_cards');
      // $('body').addClass('wp_show-mode');
    });
/*    
//todo for wp 6-
	  $('.osi_close_wp').click(function(event) {
      $('body').removeClass('wp_show-mode');
      $('body').addClass('oss-cards_page_edit_cards');
      $('.osc_show_sidebar').removeClass('uk-active');
      $('.osc_start_tab').addClass('uk-active');
    });*/

    //img ratio
    $('.oss-card').ossRatio();
    //copy data
    $('.oss_copy_data_click').click(function(){     
      $('#oss_cards_data').copyme();
      $('.oss_copyed_alert_data').fadeIn(500).delay(3000).fadeOut(500);
    });
    //open shortcode
    $('.oss_but1, .oss_shortcode_drop .fa-times').click(function(event) {
      $('.oss_shortcode_drop').slideToggle(300);
    });
  });//end ready
  $.fn.ossRatio = function() {
        var w = $('.uk-card-media-top',this).width();
        var h3 = w * (2 / 3);
        var h4 = w * (3 / 4);
        var h5 = w * (4 / 5);
        var h16 = w * (9 / 16);
        var h18 = w * (6 / 18);
        var hp3 = w * (4 / 3);
        var hp = w * (5 / 4);     
        if (w !== 0) {
          if ($(this).is('.oss-ratio-4-3')) {
              $('.uk-card-media-top',this).height(h4);
          }
          if ($(this).is('.oss-ratio-1')) {
              $('.uk-card-media-top',this).height(w);
          }
          if ($(this).is('.oss-ratio-3-2')) {
              $('.uk-card-media-top',this).height(h3);
          }
          if ($(this).is('.oss-ratio-5-4')) {
              $('.uk-card-media-top',this).height(h3);
          }
          if ($(this).is('.oss-ratio-16-9')) {
              $('.uk-card-media-top',this).height(h16);
          }
          if ($(this).is('.oss-ratio-18-6')) {
              $('.uk-card-media-top',this).height(h18);
          }
          if ($(this).is('.oss-ratio-3-4')) {
              $('.uk-card-media-top',this).height(hp3);
          }
          if ($(this).is('.oss-ratio-4-5')) {
              $('.uk-card-media-top',this).height(hp);
          }
        } else {
        }
  };
    $.fn.copyme = function() {
      this.select();
      $(this).focus();
      document.execCommand("copy");
      document.getSelection().removeAllRanges();
      $('.oss_copyed_alert').fadeIn(500).delay(1500).fadeOut(500);
  };
})(jQuery);