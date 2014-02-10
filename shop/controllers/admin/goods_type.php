<?php 
/**
 * 商品类型控制器
 */
Class Goods_Type extends Admin_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Goods_type_model');
	}
	// 列表展示
	public function index (){
		$goods_type_list=$this->Goods_type_model->get();
		$this->data['goods_type_list']=$goods_type_list;
		$this->view('goods_type',$this->data);
	}
	// 添加
	public function edit ($tid = NULL){
		if($this->input->post()){
			$rules =$this->Goods_type_model->rules;
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE) {
				//$tid为null时候 insert 否则 update
				$tid || $tid=NULL;
				$gtname=$this->input->post('gtname');
				$this->Goods_type_model->save(array('gtname'=>$gtname),$tid);
				success('操作成功','admin/goods_type');	
			}else{
				echo (validation_errors()); 
			}
		}else{
			if ($tid) {
				$this->data['goods_type'] = $this->Goods_type_model->get($tid);
			}
			else {
				$this->data['goods_type'] = $this->Goods_type_model->get_new();
			}

			$this->view('goods_type_edit.php',$this->data);
		}
	}
}