<?php 
class MY_config{
	public function __construct(){
		$this->CI=& get_instance();
		$this->CI->data['meta_title']='后盾商城后台';
		
		// 获取配置文件写入$this->CI->config
		$_config=$this->CI->db->select(array('name','value'))->get('settings')->result_array();
		foreach ($_config as  $v) {
			$this->CI->config->set_item($v['name'], $v['value']);
		}
	}
}