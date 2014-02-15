<?php
/**
 * 库存表模型
 */
class Stock_model extends MY_Model {
	
	protected $_table_name = 'stock';
	protected $_primary_key = 'st_id';
	protected $_primary_filter = 'intval';

	function __construct() {
		parent::__construct();
	}

	public function save_data($gid,$st_id=NULL){
		// 如果没有属性就返回
		$_stock=$this->input->post('_stock');
		if(empty($_stock)) return;

		$category_cid=$this->input->post('cid');
		$num=count($_stock['stock']);
		for ($i=0; $i < $num; $i++) { 
			$data=array(
				'price'=>$_stock['price'][$i],
				'stock'=>$_stock['stock'][$i],
				'goods_sn'=>$_stock['goods_sn'][$i],
				'goods_gid'=>$gid
				);
			# 获取库存表id
			$stock_st_id=$this->save($data,$st_id);
			$spec=$this->input->post('spec');
			# 向库存属性关联表插入数据
			foreach ($spec as  $v) {
				$data=array(
					'category_cid'=>$category_cid,
					'goods_gid'=>$gid,
					'attr_value_av_id'=>$v[$i],		
					'stock_st_id'=>$stock_st_id
					);
				$this->load->model('Stock_attr_model');
				$this->Stock_attr_model->save($data);
			}
		}
	}

	public function get_new(){
		return array('gname'=>'','price'=>'','stock'=>'','keywords'=>'','description'=>'');
	}
}