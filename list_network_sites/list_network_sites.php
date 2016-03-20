<?php
/*
Plugin Name: List Network Sites
Plugin URI: http://craftplustech.wordpress.com/
Description: List all sites in a network. List is unordered by default. 
	Change to unordered by adding the attribute list="ordered". 
	Note that other input will result in error message.
Author: Amy Yuen Ying Chan
Author URI: http://craftplustech.wordpress.com/
License: GPLv2 or later
*/
add_shortcode('list-network-sites', 'list_network_sites');

function list_network_sites($atts) {
	// Start by getting an array of information of all sites in the network.
	$info = array(
	    'network_id' => null,
	    'public'     => null,
	    'archived'   => null,
	    'mature'     => null,
	    'spam'       => null,
	    'deleted'    => null,
	    'limit'      => 100,
	    'offset'     => 0,
	); 
	$siteInfos = wp_get_sites($info);

	// Use shortcode atts to determine list type, then begin the output variable $list with the right <li> tag.
	$listType = shortcode_atts( array(
		'list' => "unordered",
		), $atts);
	if ($listType['list'] == "unordered") {
		$list = "<ul>";
	} else if ($listType['list'] == "ordered") {
		$list = "<ol>";
	} else {
		$list = "Error: Incorrect shortcode was used. Please contact admin.";
		return $list;
	}

	// Add the list content.
	foreach ($siteInfos as $siteInfo) {
		$blog_details = get_blog_details($siteInfo['blog_id']);
		$list .= "<li><a href='$blog_details->siteurl'>$blog_details->blogname</a></li>";
	}

	// Close the list tag.
	if ($listType['list'] == "unordered") {
		$list .= "</ul>";
	} else {
		$list .= "</ol>";
	}
	return $list;
}
