<?php
/**
 * 品牌管理模型
 */
class Goods_Attr_model extends MY_Model {
	
	protected $_table_name = 'goods_attr';
	protected $_primary_key = 'ga_id';
	protected $_primary_filter = 'intval';
	public $rules = array(
		// 'gname' => array(
		// 	'field' => 'gname', 
		// 	'label' => '商品名称', 
		// 	'rules' => 'trim|required|xss_clean'
		// 	),
		);
	
	function __construct() {
		parent::__construct();
	}

	public function save_data($gid,$ga_id=NULL){
		// if(!isset($this->input->post('attr')) return;
		$category_cid=$this->input->post('cid');

		$data=array('category_cid'=>$category_cid,'goods_gid'=>$gid);
		$attr=$this->input->post('attr');
		// 格式化数组
		foreach ($attr as $k => $v) {
			if(is_array($v)){
				$attr[$k]=current($v);
			}
		}
		// p($attr);
		// 执行编辑操作
		foreach ($attr as $key => $value) {
			if(is_string($key)){
				$arr=explode('-', $value);
				$data['attr_value_av_id']=$arr[0];
				$data['attr_value']=$arr[1];
				$this->save($data,$ga_id);
			}else{
				$data['attr_value_av_id']=$key;
				$data['attr_value']=$value;
				$this->save($data,$ga_id);
			}
		}
	}

	public function get_new(){
		return array('gname'=>'','price'=>'','stock'=>'','keywords'=>'','description'=>'');
	}
}