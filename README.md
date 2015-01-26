# Label Old Posts
## Wordpress Plugin

This plugin labels old posts on a wordpress plug.  This is useful if you have older posts that you may want to remind the user about information possibly being out of date.

## How To Use This Plugin

Install the plugin.  Then, insert the following PHP in your theme file that is used for posts. This may be called content.php

~~~~
if (function_exists('\AaronSaray\LabelOldPosts\insert_label')) {
	\AaronSaray\LabelOldPosts\insert_label();
}
~~~~

The message will be included in a div with the class of *label-old-posts-label*. Target it with this CSS selector:

~~~~
.label-old-posts-label
~~~~
