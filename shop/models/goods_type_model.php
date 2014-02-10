<?php
class Goods_type_model extends MY_Model {
	
	protected $_table_name = 'goods_type';
	protected $_primary_key = 'tid';
	protected $_primary_filter = 'intval';
	public $rules = array(
		'gtname' => array(
			'field' => 'gtname', 
			'label' => '商品类型名', 
			'rules' => 'trim|required|is_unique[goods_type.gtname]|xss_clean'
			)
		);
	
	function __construct() {
		parent::__construct();
	}
	public function get_new(){
		return array('gtname'=>'');
	}
}