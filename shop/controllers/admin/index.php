<?php 
/**
 * 后台index控制器
 */
Class index extends Admin_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->view('index');
	}
}