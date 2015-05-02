<?php
namespace WPCPT;

abstract class Shortcode
{
    protected $name;

    public static function logBrokenShortcode($name, $atts, $content)
    {
        global $wpdb;

        $shortcode = "[$name";
        foreach ($atts as $k => $v) {
            $shortcode .= " {$k}=\"{$v}\"";
        }
        $shortcode .= ']';
        if (!empty($content)) {
            $shortcode .= $content . "[/{$name}]";
        }
        if (strpos($_SERVER['SCRIPT_URI'], $_SERVER['REQUEST_URI']) !== false) {
            $calling_page = $_SERVER['SCRIPT_URI'];
        } else {
            $calling_page = substr($_SERVER['SCRIPT_URI'], 0, -1) . $_SERVER['REQUEST_URI'];
        }

        $dupesql = "SELECT * FROM {$wpdb->prefix}wpcpt_broken_shortcodes "
                 . "WHERE shortcode = %s AND calling_page = %s AND resolved = 0;";
        $dupes = $wpdb->get_results(
            $wpdb->prepare(
                $dupesql,
                $shortcode,
                $calling_page
            ),
            ARRAY_A
        );
        if (empty($dupes)) {
            $insertsql = "INSERT INTO {$wpdb->prefix}wpcpt_broken_shortcodes "
                       . "(shortcode, calling_page) VALUES (%s, %s);";
            $wpdb->query(
                $wpdb->prepare(
                    $insertsql,
                    $shortcode,
                    $calling_page
                )
            );
        }
    }

    public function __construct()
    {
        add_shortcode($this->name, array($this, 'run'));
    }

    public function getName()
    {
        return $this->name;
    }

    abstract public function run($atts, $content = null);
}
