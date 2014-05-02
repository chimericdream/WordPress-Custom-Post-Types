<?php
class WPCPT_Shortcode_Raw extends WPCPT_Shortcode {
    public function __construct() {
        remove_filter('the_content', 'wpautop');
        remove_filter('the_content', 'wptexturize');
        add_filter('the_content', array($this, 'filter'), 99);
    }

    public function filter($content) {
        $plaintext_shortcodes = array(
            '\[raw\].*?\[\/raw\]',
        );

        $new_content = '';
    	$pattern_full = '/(' . implode('|', $plaintext_shortcodes) . ')/is';
    	$pattern_contents = '/\[(raw|geshi|sourcecode)\](.*?)\[\/\1\]/is';
    	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

    	foreach ($pieces as $piece) {
    		if (preg_match($pattern_contents, $piece, $matches)) {
    			$new_content .= $matches[2];
    		} else {
    			$new_content .= wptexturize(wpautop($piece));
    		}
    	}

    	return $new_content;
    }

    public function run($atts, $content = null) {
        return '';
    }
}