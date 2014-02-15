<?php
/**
 * 分类管理
 */
class Category extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Category_model');
		$this->load->model('Brand_Category_model');
		$this->load->library('categoryd');
		$this->load->library('code');
	}
	public function index(){
		// p(get_class_methods($this->db));
		$category=$this->Category_model->get();

		$categoryd=$this->categoryd->unlimitedForLevel($category);
		// p($categoryd);

		$this->cache->save('categoryd',$categoryd,0);
		$this->cache->clean();
		// p($categoryd);
		$this->data['categoryd']=$categoryd;
		$this->view('category',$this->data);
	}
	// 添加 更新
	public function edit ($type=NULL,$cid=NULL){
		if($this->input->post()){
			$rules =$this->Category_model->rules;
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == TRUE){
				
				if($type!='cid')$cid=NULL;

				// die('debug');
				//再添加或更新
				if($_cid=$this->Category_model->save_data($cid)){

					$this->Brand_Category_model->save_data($_cid);
				}
				success('操作成功',"admin/category/");
			}else{
				echo validation_errors(); 
			}
		}else{
			$brand='';
			// 类型列表
			$goods_type_list=$this->cache->get('goods_type_list');
			// 品牌列表
			$brand_list=$this->cache->get('brand_list');
			// 栏目列表
			
			if($type===NULL || $type=='pid'){
				$cate=$this->Category_model->get_new();
				if($type){

					$_category=$this->Category_model->get_by(array('cid'=>$cid),TRUE);
					$_category['html']='';
					$_category['selected']='';
					$_category['level']='';

					$category['pid']=$_category;

				}else{
					$category='';
				}
			}else{
				$category=$this->cache->get('categoryd');
				$cate=$this->Category_model->get($cid);
				foreach ($category as $k => $v) {
					if($v['cid']==$cate['pid']){
						$category[$k]['selected']='selected';
					}else{
						$category[$k]['selected']='';
					}
				}
				foreach ($goods_type_list as $k => $v) {
					if($v['tid']==$cate['tid']){
						$goods_type_list[$k]['selected']='selected';
					}else{
						$goods_type_list[$k]['selected']='';
					}
				}
				$_brand=$this->db->select('bid')->get_where('brand_category',array('cid'=>$cid))->result_array();
				
				foreach ($_brand as $v) {
					$brand.=$v['bid'].',';
				}
				
			}
			$this->data['brand']=$brand;
			$this->data['goods_type_list']=$goods_type_list;
			$this->data['category']=$category;
			$this->data['brand_list']=$brand_list;
			$this->data['cate']=$cate;
			
			$this->view('category_edit.php',$this->data);
		}
	}
}