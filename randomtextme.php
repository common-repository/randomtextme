<?php
/*
Plugin Name: randomtext.me
Plugin URI: http://scienzedellevanghe.net
Description: Unofficial plugin of http://www.randomtext.me/.
Version: 1.0
Author: scienzedellevanghe
Author URI: http://scienzedellevanghe.net
License: GPLv2
*/
/*  Copyright 2011  Daniele Colangelo  (email : scienzedellevanghe@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_shortcode('randomtext', 'sdv_randomtextdotme' );

function sdv_randomtextdotme( $atts, $content=null) {
	extract( shortcode_atts( array(
		'type'=> 'lorem',
		'amount'=> 5,
		'format'=> 'p',
		'number'=> 10,
		'number_max'=> 20	
	), $atts ) );
	$api_url='http://www.randomtext.me/api/'.$type.'/'.$format.'-'.$amount.'/'.$number.'-'.$number_max;
	$api_response=wp_remote_get($api_url);
	$json=wp_remote_retrieve_body($api_response);
	if(empty($json)) return false;
	$json=json_decode($json);
	//$debug='<p><a href="'.$api_url.'">Check the api</a></p>';
	return $json->text_out;
}


?>