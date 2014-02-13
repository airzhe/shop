<?php
/**
 * 品牌管理模型
 */
class Brand_Category_model extends MY_Model {
	
	protected $_table_name = 'brand_category';
	
	
	function __construct() {
		parent::__construct();
	}
	
	public function save_data($cid){
		$bid=$this->input->post('bid');
		foreach ($bid as $v) {
			$this->save(array('cid'=>$cid,'bid'=>$v));
		}
	}

}