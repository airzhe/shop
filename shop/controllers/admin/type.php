<?php 
/**
 * 商品类型控制器
 */
Class type extends Admin_Controller{
	// 列表展示
	public function index (){
		$this->view('type');
	}
	// 添加
	public function add (){
		$this->view('type_edit.php');
	}
}