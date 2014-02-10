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
	public function edit ($tid,$aid=NULL){
		if($this->input->post()){
			$rules =$this->Attr_model->rules;
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE) {
				// 属性插入attr表
				$aid || $aid=NULL;
				$arr=array('attr_name','show_type','tid');
				$data=$this->Attr_model->array_from_post($arr);
				$aid=$this->Attr_model->save($data,$aid);

				// 属性值插入attr_value表
				$av_id=NULL;
				$attr_value=$this->input->post('attr_value');
				foreach ($attr_value as $v) {
					$_data['aid']=$aid;
					$_data['attr_value']=$v;
					$this->Attr_value_model->save($_data,$av_id);
				}
				success('操作成功','admin/goods_type');	
			}else{
				echo (validation_errors()); 
			}
		}else{
			if ($aid) {
				$this->data['attr'] = $this->Attr_model->get($aid);
			}
			else {
				$this->data['attr'] = $this->Attr_model->get_new();
			}
			p($this->data['attr']);
			$this->data['tid']=$tid;
			$this->view('attr_edit.php',$this->data);
		}
	}
}