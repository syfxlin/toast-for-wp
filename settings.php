<?php

if(!class_exists('WP_Toastr_Settings')) {
	class WP_Toastr_Settings {
		/**
		 * 构建插件项目
		 */
		public function __construct() {
			// 注册内容
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
            add_action('wp_footer', array(&$this, 'add_toastr'));
		} // 结束 public function __construct

        private function wrap_var($v) {
            if ($v === false) return true;
            if ($v) return true;
            return false;
        } 
		public function add_toastr() {
            //判断当前页面是否开启
            $will_show = false;
            $is_home = $this->wrap_var(get_option('cn_setting_ishome'));
            $is_archive = $this->wrap_var(get_option('cn_setting_isarchive'));
            $is_singular = $this->wrap_var(get_option('cn_setting_issingular'));
            $is_search = $this->wrap_var(get_option('cn_setting_issearch'));
            $is_404 = $this->wrap_var(get_option('cn_setting_is404'));

            if (is_home() && $is_home === is_home()) $will_show = true;
            else if (is_singular() && $is_singular === is_singular()) $will_show = true;
            else if (is_archive() && $is_archive === is_archive()) $will_show = true;
            else if (is_search() && $is_search === is_search()) $will_show = true;
            else if (is_404() && $is_404 === is_404()) $will_show = true;

            if ($will_show) {
                $setting_title = get_option('cn_setting_title');
                if ($setting_title === false) $setting_title = 'Title';
                $setting_content = get_option('cn_setting_content');
                if ($setting_content === false) $setting_content = 'Content';
                $setting_closebutton = get_option('cn_setting_closebutton');
                if ($setting_closebutton === false) $setting_closebutton = 'false';
                $setting_toast_type = get_option('cn_setting_toast_type');
                if ($setting_toast_type === false) $setting_toast_type = 'success';
                $setting_onclick = get_option('cn_setting_onclick');
                if ($setting_onclick === false)  $setting_onclick = 'null';
                $setting_progress_bar = get_option('cn_setting_progress_bar');
                if ($setting_progress_bar === false)  $setting_progress_bar = 'false';
                $setting_prevent_duplicates = get_option('cn_setting_prevent_duplicates');
                if ($setting_prevent_duplicates === false)  $setting_prevent_duplicates = 'false';
                $setting_newest_on_top = get_option('cn_setting_newest_on_top');
                if ($setting_newest_on_top === false) $setting_newest_on_top = 'false';
                $setting_position = get_option('cn_setting_position');
                if ($setting_position === false) $setting_position = 'toast-top-right';
                $setting_show_easing = get_option('cn_setting_show_easing');
                if ($setting_show_easing === false) $setting_show_easing = 'swing';
                $setting_hide_easing = get_option('cn_setting_hide_easing');
                if ($setting_hide_easing === false) $setting_hide_easing = 'linear';
                $setting_show_method = get_option('cn_setting_show_method');
                if ($setting_show_method === false) $setting_show_method = 'fadeIn';
                $setting_hide_method = get_option('cn_setting_hide_method');
                if ($setting_hide_method === false) $setting_hide_method = 'fadeOut';
                $setting_show_duration = get_option('cn_setting_show_duration');
                if ($setting_show_duration === false) $setting_show_duration = '300';
                $setting_hide_duration = get_option('cn_setting_hide_duration');
                if ($setting_hide_duration === false) $setting_hide_duration = '1000';
                $setting_time_out = get_option('cn_setting_time_out');
                if ($setting_time_out === false) $setting_time_out = '5000';
                $setting_extended_time_out = get_option('cn_setting_extended_time_out');
                if ($setting_extended_time_out === false) $setting_extended_time_out = '1000';
                $setting_starttime = get_option('cn_setting_starttime');
                if ($setting_starttime === false) $setting_title = '5000';
                
                
                echo "<script>function tmo(){toastr.options = {\"closeButton\":$setting_closebutton,\"debug\": false,\"newestOnTop\": $setting_newest_on_top,\"progressBar\": $setting_progress_bar,\"positionClass\": \"$setting_position\",\"preventDuplicates\": $setting_prevent_duplicates,\"onclick\": $setting_onclick,\"showDuration\": \"$setting_show_duration\",\"hideDuration\": \"$setting_hide_duration\",\"timeOut\": \"$setting_time_out\",\"extendedTimeOut\": \"$setting_extended_time_out\",\"showEasing\": \"$setting_show_easing\",\"hideEasing\": \"$setting_hide_easing\",\"showMethod\": \"$setting_show_method\",\"hideMethod\": \"$setting_hide_method\"}}
                setTimeout('tmo()', 0 )</script><script type='text/javascript'>function tm(){
                toastr['$setting_toast_type']('$setting_content', '$setting_title')}
                setTimeout('tm()', $setting_starttime )</script>";
                }
        }
        /**
         * hook admin_init()
         */
        public function admin_init() {
        	// 注册插件设置
        	register_setting('WP_Toastr-group', 'cn_setting_title');
        	register_setting('WP_Toastr-group', 'cn_setting_content');
            register_setting('WP_Toastr-group', 'cn_setting_closebutton');
            register_setting('WP_Toastr-group', 'cn_setting_toast_type');
            register_setting('WP_Toastr-group', 'cn_setting_progress_bar');
            register_setting('WP_Toastr-group', 'cn_setting_prevent_duplicates');
            register_setting('WP_Toastr-group', 'cn_setting_newest_on_top');
            register_setting('WP_Toastr-group', 'cn_setting_position');
            register_setting('WP_Toastr-group', 'cn_setting_show_easing');
            register_setting('WP_Toastr-group', 'cn_setting_hide_easing');
            register_setting('WP_Toastr-group', 'cn_setting_show_method');
            register_setting('WP_Toastr-group', 'cn_setting_hide_method');
            register_setting('WP_Toastr-group', 'cn_setting_show_duration');
            register_setting('WP_Toastr-group', 'cn_setting_hide_duration');
            register_setting('WP_Toastr-group', 'cn_setting_time_out');
            register_setting('WP_Toastr-group', 'cn_setting_extended_time_out');
            register_setting('WP_Toastr-group', 'cn_setting_starttime');

        	// 插件设置页面
        	add_settings_section(
        	    'WP_Toastr-section', 
        	    '1. Toastr.js Setting(配置参数)', 
        	    array(&$this, 'settings_section_WP_Toastr'), 
        	    'WP_Toastr'
        	);
        	
            add_settings_field(
                'WP_Toastr-setting_title', 
                'Title(标题): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_title',
                    'value' => 'Title',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_content', 
                'Content(内容): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_content',
                    'value' => 'Content',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_toast_type', 
                'Toast Type(吐司类型): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_toast_type',
                    'value' => 'success',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_starttime', 
                'Start Time(启动延迟): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_starttime',
                    'value' => '5000',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_position', 
                'Position(位置): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_position',
                    'value' => 'toast-top-right',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_progress_bar', 
                'Progress Bar(进度条): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_progress_bar',
                    'value' => 'false',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_prevent_duplicates', 
                'Prevent Duplicates(防止重复): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_prevent_duplicates',
                    'value' => 'false',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_newest_on_top', 
                'Newest on top(最新置顶): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_newest_on_top',
                    'value' => 'false',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_closebutton', 
                'Close Button(关闭按钮): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_closebutton',
                    'value' => 'false',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_show_easing', 
                'Show Easing(显示缓解): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_show_easing',
                    'value' => 'swing',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_hide_easing', 
                'Hide Easing(隐藏缓解): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_hide_easing',
                    'value' => 'linear',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_show_method', 
                'Show Method(显示动画): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_show_method',
                    'value' => 'fadeIn',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_hide_method', 
                'Hide Method(隐藏动画): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_hide_method',
                    'value' => 'fadeOut',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_show_duration', 
                'Show Duration(显示时间): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_show_duration',
                    'value' => '300',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_hide_duration', 
                'Hide Duration(隐藏时间): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_hide_duration',
                    'value' => '1000',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_time_out', 
                'Time out(超时): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_time_out',
                    'value' => '5000',
                    'type' => 'text'
                )
            );
            add_settings_field(
                'WP_Toastr-setting_extended_time_out', 
                'Extended time out(延长超时): ', 
                array(&$this, 'settings_field_input_text'), 
                'WP_Toastr', 
                'WP_Toastr-section',
                array(
                    'field' => 'cn_setting_extended_time_out',
                    'value' => '1000',
                    'type' => 'text'
                )
            );
              
            // 第二部分
            register_setting('WP_Toastr-checkbox-group', 'cn_setting_ishome');
            register_setting('WP_Toastr-checkbox-group', 'cn_setting_issearch');
            register_setting('WP_Toastr-checkbox-group', 'cn_setting_issingular');
            register_setting('WP_Toastr-checkbox-group', 'cn_setting_isarchive');
            register_setting('WP_Toastr-checkbox-group', 'cn_setting_is404');

            add_settings_section(
                'WP_Toastr-checkbox-section', 
                '2. Launch in Which pages(在哪些页面开启)', 
                array(&$this, 'settings_section_WP_Toastr_Checkbox'), 
                'WP_Toastr_Checkbox'
            );

            add_settings_field(
                'WP_Toastr-setting_ishome', 
                'Index(首页): ', 
                array(&$this, 'settings_field_checkbox'), 
                'WP_Toastr_Checkbox', 
                'WP_Toastr-checkbox-section',
                array(
                    'field' => 'cn_setting_ishome', 'value' => true
                )
            );
            add_settings_field(
                'WP_Toastr-setting_isarchive', 
                'Archive(归档页): ', 
                array(&$this, 'settings_field_checkbox'), 
                'WP_Toastr_Checkbox', 
                'WP_Toastr-checkbox-section',
                array(
                    'field' => 'cn_setting_isarchive', 'value' => true
                )
            );
            add_settings_field(
                'WP_Toastr-setting_issingular', 
                'Singular(文章单页): ', 
                array(&$this, 'settings_field_checkbox'), 
                'WP_Toastr_Checkbox', 
                'WP_Toastr-checkbox-section',
                array(
                    'field' => 'cn_setting_issingular', 'value' => true
                )
            );
            add_settings_field(
                'WP_Toastr-setting_issearch', 
                'Search(搜索页): ', 
                array(&$this, 'settings_field_checkbox'), 
                'WP_Toastr_Checkbox', 
                'WP_Toastr-checkbox-section',
                array(
                    'field' => 'cn_setting_issearch', 'value' => true
                )
            );
            add_settings_field(
                'WP_Toastr-setting_is404', 
                '404(404页): ', 
                array(&$this, 'settings_field_checkbox'), 
                'WP_Toastr_Checkbox', 
                'WP_Toastr-checkbox-section',
                array(
                    'field' => 'cn_setting_is404', 'value' => true
                )
            );
        } // 结束 public static function activate
        public function settings_section_WP_Toastr_Checkbox() {
            echo '设置在那些页面开启Toastr.js';
        }

        public function settings_section_WP_Toastr() {
            echo '设置<a target="_blank" href="https://github.com/syfxlin">Toastr.js</a>参数，需要帮助?点击<a target="_blank" href="https://blog.syfxlin.win">这里</a>. ';
        }

        public function settings_field_checkbox($args) {
            $field = $args['field'];
            $value = $this->wrap_var(get_option($field));

            if ($value) {
                $value = "checked='checked'";
            }
            else {
                $value = '';
            }
            echo sprintf('<input type="checkbox" name="%s" id="%s" %s />', $field, $field, $value);
        }
        /**
         * 此功能为设置字段提供文本输入
         */
        public function settings_field_input_text($args) {
            $field = $args['field'];
            $type = $args['type'];
            $value = get_option($field);
            if ($value === false) {
                $value = $args['value'];
            }
            echo sprintf('<input type="%s" name="%s" id="%s" value="%s" />', $type, $field, $field, $value);
        }
        
        /**
         * 增加设置菜单
         */		
        public function add_menu() {
         add_options_page(
        	    'Toastr.js Setting', 
        	    'Toastr.js', 
        	    'manage_options', 
        	    'WP_Toastr', 
        	    array(&$this, 'plugin_settings_page')
        	);
        } 
        /**
         * Menu Callback
         */		
        public function plugin_settings_page() {
        	if(!current_user_can('manage_options')) {
        		wp_die(__('您没有足够权限访问此页面'));
        	}
        	include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        } // 结束 public function plugin_settings_page()
    } // 结束 class WP_Toastr_Settings
} // 结束 if(!class_exists('WP_Toastr_Settings'))
