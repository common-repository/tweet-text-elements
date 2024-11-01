=== Tweet Text Elements ===
Contributors: jspellman
Tags: twitter, tweet, share, text, jQuery, admin, plugin
Requires at least: 4.6
Tested up to: 4.8.3
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides tweet functionality for desired text elements within single posts.

== Description ==

This plugin provides tweet functionality for all chosen text elements within a single post. Text elements can be chosen by setting the jQuery selector on the settings page.

= jQuery selector field =

* Can target block level elements, an ID, or a class

= Link text field =

* Does not accept HTML

= Twitter username field =

* Appends “via @username” to tweet
* Do not include “@“ symbol 

= Include URL field =

* Check the box if you wish to include the URL to the page containing your selected element in the tweet
* URL is placed after text, but before username within tweet


== Installation ==

1. Upload `tweet-text-elements` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set jQuery selector and link text on the settings page: `/wp-admin/options-general.php?page=tweet_elements`

== Frequently Asked Questions ==

= Does the jQuery selector field accept an ID or a class?  =

Yes! Using an ID or a class is a great way to target a specific element.

== Screenshots ==

1. Administrative form with the default options set.
2. Unthemed link output displaying after our chosen selector. Appearance will vary based on theme styles.
3. The link markup - makes for easy theming!

== Changelog ==

= 1.1 =
* Adding options to include a Twitter username and the page url in tweets

= 1.0 =
* Initial release