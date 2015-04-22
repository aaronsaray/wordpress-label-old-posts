=== Label Old Posts ===
Contributors: AaronSaray
Tags: posts, legacy
Requires at least: 3.0.1
Tested up to: 4.2
Stable tag: trunk
License: MIT

Label older posts that may no longer be relevant.

== Description ==

As content ages (especially technical blogs), it may not be as relevant.  This plugin automatically marks content older
than a specified date with a customizable message.  For example, if you have content that is older than 2 years, you might
want to alert the user to check for new releases of the information.

== Installation ==

1. Upload `label-old-posts` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('label-old-posts'); ?>` in your template for a piece of content in the location you'd like it to be labeled.

== Frequently Asked Questions ==

= Can I customize the date that items are marked as old by? =

Yup.  Check the plugin settings.

= Can I change the message displayed? =

Yup.  You can even use HTML.

== Screenshots ==

1. The plugin will label your older posts with a customized message.