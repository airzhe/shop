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
		$category=$this->Category_model->get();

		$categoryd=$this->categoryd->unlimitedForLevel($category);
		// p($categoryd);

		$this->cache->save('categoryd',$categoryd,0);
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
				//先删除品牌
				if($cid){
					$this->Brand_Category_model->delete(array('cid'=>$cid));
				}
				//再添加或更新
				if($cid=$this->Category_model->save_data()){
					$this->Brand_Category_model->save_data($cid);
				}
				success('操作成功',"admin/category/");
			}else{
				echo validation_errors(); 
			}
		}else{
			// if ($bid) {
			// 	$brand = $this->Brand_model->get($bid);
			// 	$this->data['brand']=$brand;
			// }
			// else {
			// 	$this->data['brand'] = $this->Brand_model->get_new();	
			// }
			// 类型列表
			$goods_type_list=$this->cache->get('goods_type_list');
			// 品牌列表
			$brand_list=$this->cache->get('brand_list');
			// 栏目列表
			switch ($type) {
				case '':
				$category='顶级栏目';
				break;
				case 'pid':
				$category[]=$this->Category_model->get_by(array('cid'=>$cid),TRUE);
					// p($category);
				break;
				case 'cid':
				$category=$this->cache->get('categoryd');
				break;
			}
			if($type===NULL || $type=='pid'){
				$cate=$this->Category_model->get_new();
			}else{
				$cate=$this->Category_model->get($cid);

			}

			$this->data['goods_type_list']=$goods_type_list;
			$this->data['category']=$category;
			$this->data['brand_list']=$brand_list;
			$this->data['cate']=$cate;

			$this->view('category_edit.php',$this->data);
		}
	}
	// 	//添加分类
	// public function add(){
	// 	$this->assign('title','添加分类');
	// 	if(!empty($_POST)){
	// 		if($this->db->add()){
	// 			$this->success('分类添加成功','?c=category&amp;');
	// 		}else{
	// 			$this->error('添加失败','?c=category&amp;');
	// 		}
	// 	}else{
	// 		$pid=isset($_GET['pid'])?(int)$_GET['pid']:0;
	// 		$p_cate=$this->db->where("cid=$pid")->find();
	// 		$this->assign('pid',$pid);
	// 		$this->assign('pname',$p_cate['cname']);
	// 		$this->display('Category/add.php');
	// 	}
	// }
	// //编辑分类
	// public function edit(){
	// 	$this->assign('title','编辑分类');
	// 	if(!empty($_POST)){
	// 		if($this->db->save()){
	// 			$this->success('编辑成功','?c=category&amp;');
	// 		}else{
	// 			$this->error('编辑失败','?c=category&amp;');
	// 		}
	// 	}else{
	// 		//上级分类
	// 		$pid=isset($_GET['pid'])?(int)$_GET['pid']:0;
	// 		$p_cate=$this->db->where("cid=$pid")->find();
	// 		//本分类
	// 		$cid=isset($_GET['cid'])?(int)$_GET['cid']:0;
	// 		$c_cate=$this->db->where("cid=$cid")->find();
	// 		$cate=array('cid'=>$cid,'cname'=>$c_cate['cname'],'aliases'=>$c_cate['aliases'],'pname'=>$p_cate['cname']);
	// 		$this->assign('cate',$cate);
	// 		$this->display('Category/edit.php');
	// 	}
	// }
}