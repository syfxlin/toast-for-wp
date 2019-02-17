<?php
/*
Plugin Name: Toastr.js
Plugin URI: https://blog.ixk.me/toastr-js.html
Description: 在你的网站添加Toast弹窗通知。
Version: 1.2
Author: Otstar Lin
Author URI: https://ixk.me/
License: Apache Licence 2.0
*/

if(!class_exists('WP_Toastr')) {
	class WP_Toastr {
		/**
		 * 插件项目开启
		 */
		public function __construct() {
			// 初始化设置
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			$WP_Toastr_Settings = new WP_Toastr_Settings();

			$plugin = plugin_basename(__FILE__);
			add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));
		} // 结束 public function __construct

		/**
		 * 激活插件
		 */
		public static function activate() {
		} 
		/**
		 * 取消激活
		 */
		public static function deactivate() {
	}
		// 设置插件页面链接
		function plugin_settings_link($links) {
			$settings_link = '<a href="options-general.php?page=WP_Toastr">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}
	} // 结束 class WP_Toastr
} // 结束 if(!class_exists('WP_Toastr'))

if(class_exists('WP_Toastr'))
{
	// 安装和卸载钩子
	register_activation_hook(__FILE__, array('WP_Toastr', 'activate'));
	register_deactivation_hook(__FILE__, array('WP_Toastr', 'deactivate'));

	// 增加插件类
	$WP_Toastr = new WP_Toastr();

}
 //载入CSS和JS
function toastr_head() {
	print('
<link rel="stylesheet" href="'.plugins_url('',__FILE__).'/toastr.min.css" type="text/css" />
	');
}
add_action('wp_head', 'toastr_head');

function toastr_foot() {
	print('
<script src="'.plugins_url('',__FILE__).'/toastr.min.js"></script>
	');
}
add_action('wp_footer', 'toastr_foot');

