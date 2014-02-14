<?php
/**
 * 品牌管理模型
 */
class Goods_model extends MY_Model {
	
	protected $_table_name = 'goods';
	protected $_primary_key = 'gid';
	protected $_primary_filter = 'intval';
	public $rules = array(
		'gname' => array(
			'field' => 'gname', 
			'label' => '商品名称', 
			'rules' => 'trim|required|xss_clean'
			),
		);
	
	function __construct() {
		parent::__construct();
	}

	public function save_data($gid){
		$field=array('cid','gname','price','stock','keywords','description','service','click','body');
		
		$data=$this->array_from_post($field);
		$flag=implode(',', $_POST['flag']);
		$data['flag']=$flag;
		$data['addtime']=strtotime($_POST['addtime']);
		
		return $this->save($data,$gid);
	}

	public function get_new(){
		return array('gname'=>'','price'=>'','stock'=>'','keywords'=>'','description'=>'','service'=>'','click'=>'100','addtime'=>date('Y/m/d H:i:s'),'body'=>'');
	}
}