<?php  

if( ! function_exists('dw_single_tweet_count') ) { 
    function dw_single_tweet_count(){
        if( ! isset($_POST['nonce']) || ! wp_verify_nonce( $_POST['nonce'], '_dw_focus_single_tweet_count_nonce' ) ) {
            wp_die( 0 );
        }

        if( ! isset($_POST['post_id']) ) {
            wp_die( 0 );
        }

        $tweets = get_post_meta( $_POST['post_id'], '_dw_tweet_count', true );
        $tweets = $tweets ? $tweets + 1 : 1;

        update_post_meta( $_POST['post_id'], '_dw_tweet_count', $tweets );

        wp_die( $tweets );
    }
    add_action( 'wp_ajax_dw-single-tweet-count', 'dw_single_tweet_count' );
    add_action( 'wp_ajax_nopriv_dw-single-tweet-count', 'dw_single_tweet_count' );
}   

if( ! function_exists('dw_sharing_count_from_url') ) { 
    function dw_sharing_count_from_url(){
        if( ! isset($_POST['nonce']) || ! wp_verify_nonce( $_POST['nonce'], '_dw_sharing_count_nonce' ) ) {
            wp_send_json_error();
        }
        if( ! isset($_POST['url'] ) ) {
            wp_send_json_error();
        }
        $url = rawurlencode( $_POST['url'] );
        //Code here
        $facebook_json = json_decode( dw_get_content_from_url('https://graph.facebook.com/fql?q=SELECT%20like_count,%20total_count,%20share_count,%20click_count,%20comment_count%20FROM%20link_stat%20WHERE%20url%20=%20%22'.$url.'%22' ) );
        $fb_shares = 0;
        if( isset($facebook_json->shares) ) {
            $fb_shares = $facebook_json->shares;
        }

        $linkedin_json = json_decode( dw_get_content_from_url('http://www.linkedin.com/countserv/count/share?url='.$url.'&amp;format=json') );
        $linkedin_shares = 0;
        if( isset($linkedin_json->count) ) {
            $linkedin_shares = $linkedin_json->count;
        }
        

        wp_send_json_success( array( 
            'facebook' => $fb_shares, 
            'linkedin' => $linkedin_shares ) );
    }
    add_action( 'wp_ajax_nopriv_dw-sharing-count-from-url', 
            'dw_sharing_count_from_url' );
    add_action( 'wp_ajax_dw-sharing-count-from-url',
                    'dw_sharing_count_from_url');
}


if( ! function_exists('dw_get_content_from_url') ) {
    /**
     *  Retrieve feeds from given URL
     *
     *  @param $url string Feed URL
     */
    function dw_get_content_from_url( $url, $method = false, $post_fields = array() ){
        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            if( 'post' == $method ) {
                curl_setopt( $ch, CURLOPT_POST, 1 );
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_fields );
            }
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 600);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
            $content = curl_exec($ch);
            curl_close($ch);
        } else {
            // curl library is not installed so we better use something else
            $content = file_get_contents($url);
        }

        return $content;

    } //End get_content_from_url
}
?>