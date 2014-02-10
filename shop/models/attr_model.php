<?php
class Attr_model extends MY_Model {
	
	protected $_table_name = 'attr';
	protected $_primary_key = 'aid';
	protected $_primary_filter = 'intval';
	public $rules = array(
		'attr_name' => array(
			'field' => 'attr_name', 
			'label' => '属性名称', 
			'rules' => 'trim|required|xss_clean'
			),
		'show_type' => array(
			'field' => 'show_type', 
			'label' => '显示方式', 
			'rules' => 'trim|required|xss_clean'
			)
		);
	
	function __construct() {
		parent::__construct();
	}
	public function get_new(){
		return array('attr_name'=>'','show_type'=>'1','value'=>'');
	}
}