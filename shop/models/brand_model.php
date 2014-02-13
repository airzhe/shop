<?php
/**
 * 品牌管理模型
 */
class Brand_model extends MY_Model {
	
	protected $_table_name = 'brand';
	protected $_primary_key = 'bid';
	protected $_primary_filter = 'intval';
	public $rules = array(
		'bname' => array(
			'field' => 'bname', 
			'label' => '品牌名称', 
			'rules' => 'trim|required|xss_clean'
			),
		);
	
	function __construct() {
		parent::__construct();
	}
	public function get_new(){
		return array('bname'=>'');
	}
}