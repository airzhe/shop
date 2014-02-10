<?php 
/**
 * 商品属性控制器
 */
Class Attr extends Admin_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Goods_type_model');
		$this->load->model('Attr_model');
		$this->load->model('Attr_value_model');
	}
	// 列表展示
	public function index ($tid= NULL){
		$tid || die;
		$attr_list=$this->Attr_model->get_by(array('tid'=>$tid));
		$this->data['tid']=$tid;
		$this->data['attr_list']=$attr_list;
		$this->view('attr',$this->data);
	}
	// 添加
	public function edit ($tid){
		if($this->input->post()){
			$rules =$this->Attr_model->rules;
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE) {
				//$aid为null时候 insert 否则 update
				

				$arr=array('attr_name','show_type','tid');
				$data=$this->Attr_model->array_from_post($arr);
				p($data);
				$this->Attr_model->save($data,$tid);

				success('操作成功','admin/goods_type');	
			}else{
				echo (validation_errors()); 
			}
		}else{
			// $aid=$this->input->get('aid')?$this->input->get('aid'):NULL;
			// if ($aid) {
			// 	$this->data['attr'] = $this->Goods_type_model->get($tid);
			// }
			// else {
			// 	$this->data['attr'] = $this->Goods_type_model->get_new();
			// }
			$this->data['tid']=$tid;
			$this->view('attr_edit.php',$this->data);
		}
	}
}