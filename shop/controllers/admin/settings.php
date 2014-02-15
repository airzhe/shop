<?php 
class Settings extends Admin_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['meta_title']="系统配置";
		$this->load->model('Settings_model');
	}
	public function index(){
		// 取得数据库的配置
		$_settings=$this->Settings_model->get();
		foreach ($_settings as $v) {
			$arr[$v['name']]=$v['value'];
		}

		if($this->input->post()){
			foreach ($this->input->post() as $key => $value) {
				// 取得数据是否更改，更改了再操作数据库更新
				if($arr[$key]!=$value){
					$data=array('value'=>$value);
					$this->Settings_model->save($data,$key);
				}
			}
			success('更改成功','admin/settings');
		}else{
			$_settings=$this->Settings_model->get();
			foreach ($_settings as $k=> $v) {

				$settings[$k]['title']=$v['title'];

				switch ($v['show_type']) {
					case '1':
					$settings[$k]['value']="<input class='form-control' type='text' name='$v[name]' value='$v[value]'>";
					break;
					case '2':
					$arr=explode(',',$v['conf']);
					foreach ($arr as $v1) {
						$_arr=explode(':', $v1);
						$checked=$_arr['0']==$v['value']?'checked':'';

						$_val=$checked?$v['value']:1-$v['value'];
						$settings[$k]['value'].="<label><input type='radio' name={$v['name']} value={$_val} $checked />&nbsp;{$_arr['1']}</label>&nbsp;&nbsp;&nbsp;&nbsp;";
					}
					break;
				}
			}
			$this->data['settings']=$settings;
			$this->view('settings',$this->data);
		}
	}
	/**
	 * 更改配置
	 */
	// public function update(){
	// 	$_data=$this->input->post();
	// 	// p($_data);die;

	// 	if($_data){
	// 		foreach ($_data as $k => $v) {

	// 			$this->settings->update($k,$v);
	// 		}
	// 		success('更改成功','admin/settings/');
	// 	}
	// }
}