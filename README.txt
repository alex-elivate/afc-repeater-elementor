=== Plugin Name ===
Contributors: (nobody)
Donate link: https://elivate.net/
Tags: none
Requires at least: 3.0.1
Tested up to: 6.4
Stable tag: 6.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Here is a short description of the plugin. 
Yes, I'm aware it's ACF, not AFC. If that bugs you, you should leave now :)
This plugin takes a repeater field "repeater" and displays the {{field}} for 
each item.  You create shortcode that looks something like this:

    [news-repeater repeater="news_entry"]
    <div class="news-item">
    <img class="news-logo" src="{{logo}}">
    <a class="news-link" href="{{link}}">{{title}}</a>
    </div>
    [/news-repeater]

This feature is missing from Elementor so this was the quickest solution for me.
