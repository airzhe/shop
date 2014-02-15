<?php 
/**
 * 品牌控制器
 */
Class Brand extends Admin_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Brand_model');
	}
	// 列表展示
	public function index (){
		$brand_list=$this->Brand_model->get();
		$this->cache->save('brand_list',$brand_list,0);
		$this->data['brand_list']=$brand_list;
		$this->view('brand',$this->data);
	}
	// 添加 更新
	public function edit ($bid=NULL){
		if($this->input->post()){
			$rules =$this->Brand_model->rules;
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE){
				$data=array('bname'=>$this->input->post('bname'));
				if(count($_FILES)){
					//上传参数配置
					$config['upload_path'] = 'uploads/brand/';
					$config['allowed_types'] = 'gif|jpg|png';
					//默认0,系统配置文件中上传大小,单位k
					$config['max_size'] = '1000';
					$config['max_width']  = '1024';
					$config['max_height']  = '768';

					$this->load->library('upload', $config);
					if ($this->upload->do_upload('logo'))
					{
						$arr=$this->upload->data();
						$logo=$config['upload_path'].$arr['file_name'];
						$data+=array('logo'=>$logo);
					}else{
						echo $this->upload->display_errors();
					}
				}
				if($bid && isset($data['logo'])){
					// 删除之前的logo文件
					$curr_logo=$this->input->post('curr_logo');
					is_file($curr_logo) and unlink($curr_logo);
				}
				$this->Brand_model->save($data,$bid);
				success('操作成功',"admin/brand/");
			}else{
				echo validation_errors(); 
			}
		}else{
			if ($bid) {
				$brand = $this->Brand_model->get($bid);
				$this->data['brand']=$brand;
			}
			else {
				$this->data['brand'] = $this->Brand_model->get_new();	
			}
			$this->view('brand_edit.php',$this->data);
		}
	}
}