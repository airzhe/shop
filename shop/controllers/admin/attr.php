<?php 
/**
 * 商品属性控制器
 */
Class Attr extends Admin_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Attr_model');
		$this->load->model('Attr_value_model');
	}
	// 列表展示
	public function index ($tid= NULL){
		$tid || die;
		$arr=array('tid'=>$tid,'is_spec'=>'0');
		$attr_list=$this->Attr_model->get_by($arr);
		// 给数组赋值 查出展示类型
		$type=array(
			1=>'文本框','单选框','复选框','列表选项');
		foreach($attr_list as $k=>$v){
			$attr_list[$k]['type']=$type[$v['show_type']];
		}
		$this->data['tid']=$tid;
		$this->data['attr_list']=$attr_list;

		$this->view('attr',$this->data);
	}
	// 添加 更新
	public function edit ($tid,$aid=NULL){
		if($this->input->post()){
			$rules =$this->Attr_model->rules;
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE) {
				// 属性插入attr表
				$aid || $aid=NULL;
				$arr=array('attr_name','tid');
				// 编辑状态下不取show_type值
				if(!$aid) $arr[]='show_type';
	
				$data=$this->Attr_model->array_from_post($arr);
				$aid=$this->Attr_model->save($data,$aid);

				// 属性值插入attr_value表
				$aid && $av_id=NULL;
				$attr_value=$this->input->post('attr_value');
				// 编辑前先删除数据
				if($aid){
					$this->db->delete('attr_value',array('aid'=>$aid));
				}
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
				$this->data['aid']=$aid;
				$this->data['attr']=$attr;
				$this->data['value']=$attr_value;
			}
			else {
				$this->data['attr'] = $this->Attr_model->get_new();
				$this->data['value'] = $this->Attr_value_model->get_new();
			}
			// p($this->data['attr']);
			$this->data['tid']=$tid;
			$this->view('attr_edit.php',$this->data);
		}
	}
}