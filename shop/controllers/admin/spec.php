<?php 
/**
 * 商品规格控制器
 */
Class Spec extends Admin_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Goods_type_model');
		$this->load->model('Attr_model');
		$this->load->model('Attr_value_model');
	}
	// 列表展示
	public function index ($tid= NULL,$spec= NULL){
		
	}
	// 添加
	public function edit ($tid,$aid=NULL){
		if($this->input->post()){
			$rules =$this->Attr_model->rules;
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE) {
				// 属性插入attr表
				$aid || $aid=NULL;
				$arr=array('attr_name','is_spec','show_type','tid');
				$data=$this->Attr_model->array_from_post($arr);
				$aid=$this->Attr_model->save($data,$aid);

				// 属性值插入attr_value表
				$aid && $av_id=NULL;
				$attr_value=$this->input->post('attr_value');
				foreach ($attr_value as $v) {
					$_data['aid']=$aid;
					$_data['attr_value']=$v;
					$this->Attr_value_model->save($_data,$av_id);
				}
				success('操作成功',"admin/attr/index/$tid");	
			}else{
				echo (validation_errors()); 
			}
		}else{
			if ($aid) {
				$attr = $this->Attr_model->get($aid);
				$attr_value=$this->Attr_value_model->get_by(array('aid'=>$aid));
				// p($attr_value);
				$attr['value']=$attr_value;
				$this->data['attr']=$attr;
			}
			else {
				$this->data['attr'] = $this->Attr_model->get_new();
			}
			// p($this->data['attr']);
			$this->data['tid']=$tid;
			$this->view('spec_edit.php',$this->data);
		}
	}
}