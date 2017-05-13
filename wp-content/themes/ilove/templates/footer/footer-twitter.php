<?php
    global $ilove;
    if ( !empty( $ilove['footer_twitter_api_key'] ) && !empty( $ilove['footer_twitter_api_secret'] ) && !empty( $ilove['footer_twitter_username'] ) ) {
        $twitter_username   = $ilove['footer_twitter_username'];
        $twitter_number     = $ilove['footer_twitter_number'];
        $twitter_api_key    = $ilove['footer_twitter_api_key'];
        $twitter_api_secret = $ilove['footer_twitter_api_secret'];
        if ( empty( $ilove['footer_twitter_number'] ) ) {
            $twitter_number = 3;
        }

        $list_feed = ilove_get_twitter_feed( $twitter_username, $twitter_number, $twitter_api_key, $twitter_api_secret );
?>
        <div class="container-fluid color pattern">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 footer1">
                        <div class="wow fadeInUp" data-wow-delay="0.5s">
                            <p class="text-center"><span class="fa fa-twitter fa-5x"></span></p>
                            <div class="footer-tweet">
                                <ul>
                                    <?php foreach ( $list_feed as $tweet ): ?>
                                        <?php
                							$latestTweet = $tweet['text'];
                							$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
                							$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
                							$twitterTime = strtotime( $tweet['created_at'] );
                							$timeAgo 	 = ilove_time_ago( $twitterTime );
                						?>
                                        <li>
                                            <span class="tweet_text">
                                                <?php echo !empty( $latestTweet ) ? $latestTweet : ''; ?>
                                            </span><br>
                                            <span class="tweet_time">
                                                <a href="http://twitter.com/<?php echo esc_attr( $twitter_username ); ?>/status/<?php echo esc_attr( $tweet['id_str'] ); ?>" title="<?php echo esc_html__( 'view tweet on twitter', 'plutonthemes' ); ?>"><?php echo $timeAgo; ?></a>
                                            </span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
