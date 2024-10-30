=== JaJaDi Kerktijden ===
Contributors: DoubelJ
Donate link: http://janjaapvandijk.com/
Tags: kerktijden, Nederlands, kerk, kerken, church, dutch
Requires at least: 3.0.1
Tested up to: 4.9
Stable tag: 3.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Publish gatherings from kerktijden.nl

== Description ==

Publish gatherings from [kerktijden.nl](http://www.kerktijden.nl/). 
[kerktijden.nl](http://www.kerktijden.nl/) will make their own plugin. Until then this plugin will help you to show the gatherings.

== Installation ==

= Install from WordPress Dashboard =
* Log into WordPress dashboard then click **Plugins** > **Add new** > 
 * Then under the title "Install Plugins" click **Upload** > **choose the zip** > **Activate the plugin!**
 * Or Search for **JaJaDi Kerktijden** and click **Install** > **Activate the plugin!**

= Install from FTP =
* Upload `/jajadi-kerktijden/` to the `/wp-content/plugins/` directory
* Activate the plugin through the 'Plugins' menu in WordPress
  
= What now? =
1. Go to [kerktijden.nl](http://www.kerktijden.nl/) and search you church.
1. Look for the URL and search the id of you church
	a. example a: http://www.kerktijden.nl/gem/1/name_of_the_church = id 1
	a. example b: http://www.kerktijden.nl/gem/345/name_of_the_church = id 345
1. Enter the id under settings and save.
1. Create a page or post and place the following shortcode: [kerktijden]

== Frequently Asked Questions ==

= The sermones are not collected automatically =
This probably means that the hosting has disabled the use of WordPress Cron jobs (wp_schedule_event). You can regularly click the button under settings yourself. Or you are looking for a hosting that supports this. [More info](http://lmgtfy.com/?q=wordpress+cron+jobs+alternative).

= I have a Question =
You can find answers to your questions, suggest a feed, or just drop us a line at Support section.

== Screenshots ==

1. Overview on the front side. Table of gatherings as is.
2. The settingspage. You can enter here your church id.

== Changelog ==

= 3.6 =
* Bug fix: Source text placing 

= 3.5 =
* Improvement: Limit attribute: You can now set the ammount of services you want to show. If empty or not set a number, all services will show. Example: [kerktijden limit=20] 

= 3.4 =
* Bug fix: Date rewrite typo. 

= 3.3 =
* Removed "Reguliere dienst" from sermon description. 

= 3.2 =
* Bug fix: Date rewrite typo. 

= 3.1 =
* Added shortcode attribute header. With this attribute you can enable the table header.

= 3.0 =
* Total redesigned plugin. More info wil follow inc. options to style the data.

= 2.2 =
* Updated help text

= 2.1 =
* Updated help text
* Admin Footer fixed, was hovering above content.

= 2.0 =
* Add styling options

= 1.3 =
* Update the shortcode to show a limit number of services in a narrow list. Tanks to [henrivanwerkhoven](https://profiles.wordpress.org/henrivanwerkhoven).
* Fix search on site Kertijden.nl for gatherings. It only shows the current and next month.

= 1.2 =
* Fix Shortcode, when using shortcode, code placed at top of page/post.

= 1.1 =
* Fix some little issues.

= 1.0 =
* First relaese.

== Upgrade Notice ==

= 3.6 =
* Bug fix: Source text placing 

= 3.5 =
* Improvement: Limit attribute. 

= 3.4 =
* Bug fix.

= 3.3 =
* Removed "Reguliere dienst" from sermon description. 

= 3.2 =
* Bug fix.

= 3.1 =
* Added shortcode attribute header. With this attribute you can enable the table header.

= 3.0 =
* Updated plugin after changes by kerktijden.nl

= 2.2 =
* Updated help text

= 2.1 =
* Updated help text
* Admin Footer fixed, was hovering above content.

= 2.0 =
* Add styling options

= 1.3 =
Fix the search on Kerktijden.nl. Update the shortcode to show a limit number of services in a narrow list.

= 1.2 =
This version fixes shortcode place on page/post.

= 1.1 =
This version fixes some little issues.