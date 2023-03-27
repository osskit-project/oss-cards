(function($) {
  $(document).ready(function() {
    // alert(42);
    $('.oss-cards').each(function(index, el) {
        var w = $(this).find('.oss-card:first').width();
        console.log("w", w);
        var h3 = w * (2 / 3);
        console.log("h3", h3);
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
        }
    });
  }); //end ready
})(jQuery); //end jquery