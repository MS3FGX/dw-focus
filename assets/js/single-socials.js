
// Init listener for twitter share
window.twttr = (function (d,s,id) {
  var t, js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
  js.src="//platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
  return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
}(document, "script", "twitter-wjs"));


function update_tweet_count(intent_event) {
  if (intent_event) {
    var label = "tweet",
      link = jQuery('#twitter-share'),
      post_id = link.data('post-id'),
      nonce = link.data('nonce');
      jQuery.ajax({
        url: dw_focus.ajax_url,
        type: 'POST',
        dataType: 'html',
        data: {
            action : 'dw-single-tweet-count',
            post_id: post_id,
            nonce: nonce
        },
        success: function(data, textStatus, xhr) {
          if( data ) {
            jQUery('.digit-twitter').text( data );
          }
        }
      });
      
  };
}

twttr.ready(function (twttr) {
  // Now bind our custom intent events
  twttr.events.bind('tweet', update_tweet_count );
});
//End single tweet count

jQuery(function($) {
    var intentRegex = /twitter\.com(\:\d{2,4})?\/intent\/(\w+)/,
        windowOptions = 'scrollbars=yes,resizable=yes,toolbar=no,location=yes',
        width = 550,
        height = 420,
        winHeight = screen.height,
        winWidth = screen.width;
   

    $('.social-action ul li a').on('click',function(event){
          var href = $(this).attr('href');
          if( ! href.match(intentRegex) ) {  
            event.preventDefault();
            left = Math.round((winWidth / 2) - (width / 2));
            top = 0;
            if (winHeight > height) {
              top = Math.round((winHeight / 2) - (height / 2));
            }
            window.open( href, 'DWFOCUS', windowOptions + ',width=' + width +',height=' + height + ',left=' + left + ',top=' + top);
          }
    });

});