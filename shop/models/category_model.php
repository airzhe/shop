<?php
/**
 * 品牌管理模型
 */
class Category_model extends MY_Model {
	
	protected $_table_name = 'category';
	protected $_primary_key = 'cid';
	protected $_primary_filter = 'intval';
	public $rules = array(
		'cname' => array(
			'field' => 'cname', 
			'label' => '栏目名称', 
			'rules' => 'trim|required|xss_clean'
			),
		);
	
	function __construct() {
		parent::__construct();
	}

	public function save_data($cid){
		$data=$this->input->post();
		unset($data['bid']);
		return $this->save($data,$cid);
	}

	public function get_new(){
		return array('cname'=>'','unit'=>'个','price_range'=>'5','keywords'=>'','description'=>'');
	}
}