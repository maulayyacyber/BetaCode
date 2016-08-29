=== wp-post-view ===
Contributors: towardstech
Tags: post, views, post view, count views, wordpress-view, wp-post-view, post-view, total view
Donate link: https://www.facebook.com/towardstech
Requires at least: 2.7
Tested up to: 4.4
License: GNU General Public License

Display visited views of each post. Tracks total views in each post. Furthermore, it also displays the total views in each row of the post in the administrator panel.

== Description ==
**For Users:**

Now Supporting WordPress 4.4 and above.

This plugin allows you to display every visits/views count of each post.
It accumulates each view everytime a post is viewed by a user. It does not track unique views.
Simply copy and paste a single line of code into your WordPress file to display the views in the post.

Support us from Singapore by simply clicking the donate link(redirect to our Facebook page) or visit facebook.com/towardstech and like our page.
We post cherry picked free icons and design tools and sometimes our developed plugins in our Facebook page.

**For Developers:**

This plugin contains informative source code for developers who have just started plugin development for wordpress,
a suitable plugin source code to take a look on how to use database manipulation, commenting and simple hooks.
I hope this would assist you in your learning journey for wordpress plugin.

We are planning to add or enhance unique features into our plugins. So do keep a watch out.

== Installation ==
1. Upload `wp-post-view folder` to the `/wp-content/plugins/` directory
1. Activate the plugin through the \'Plugins\' menu in WordPress
1. Place echo_post_views(get_the_ID()); anywhere in the file codes to display AFTER if (have_posts ()) : while (have_posts ()) : the_post();  in single.php file.

== Frequently Asked Questions ==


= Why reinvent the wheel? So many plugin has done this? =

This plugin is kept simple for users and developers in mind,
users can easily integrate this plugin intheir wordpress to check the amount of views in their post without much hassle.
This is also simple as it does not contain heavy graphs, charts or crazy statistics, every view is already displayed in each row in the posts of the admin panel.

For developers: You get to see a single source file with commented of each function and how to do simple database manipulation as well as integrating hooks.

== Screenshots ==
1. screenshot-1.png

== Changelog ==
tested  wordpress version 4.4.
Updated content.
