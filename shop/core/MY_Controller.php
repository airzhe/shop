<?php

/**
 * The base controller which is used by the Front and the Admin controllers
 */
class Base_Controller extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->data=array();
	}
	
}//end Base_Controller

/**
 * 前台公共控制器
 */
class Front_Controller extends Base_Controller
{
	
	function __construct(){
		parent::__construct();

		$this->load->model('User_model');
		$this->auth();
		$this->output->enable_profiler(TRUE);
		// $this->session->sess_destroy();
	}
	
	/*
	This works exactly like the regular $this->load->view()
	The difference is it automatically pulls in a header and footer.
	*/
	function view($view, $vars = array(), $string=false)
	{
		if($string)
		{
			$result	 = $this->load->view('components/header', $vars, true);
			$result	.= $this->load->view($view, $vars, true);
			$result	.= $this->load->view('components/footer', $vars, true);
			return $result;
		}
		else
		{
			$this->load->view('components/header', $vars);
			$this->load->view($view, $vars);
			$this->load->view('components/footer', $vars);
		}
	}
	
	/*
	This function simply calls $this->load->view()
	*/
	function partial($view, $vars = array(), $string=false)
	{
		if($string)
		{
			return $this->load->view($view, $vars, true);
		}
		else
		{
			$this->load->view($view, $vars);
		}
	}
	/**
	 * 用户是否登录验证
	 */
	public function auth(){
		$exception_uris = array(
			'login', 
			'signup'
			);
		if(in_array($this->uri->segment(1),$exception_uris)) return;
		if ($this->User_model->loggedin() == FALSE) {
			redirect('login');
		}
	}
}
/**
 * 后台公共控制器
 */
class Admin_Controller extends Base_Controller{
	function __construct(){
		parent::__construct();
		$this->data['meta_title']='后盾商城后台';
		
		// 获取配置文件写入$this->config
		$_config=$this->db->select(array('name','value'))->get('settings')->result_array();
		foreach ($_config as  $v) {
			$this->config->set_item($v['name'], $v['value']);
		}
		// 开启调试
		$this->output->enable_profiler(TRUE);
		// 开启缓存
		$this->load->driver('cache', array('adapter' => 'memcached', 'backup' => 'file'));
	}
	function view($view, $vars = array(), $string=false)
	{
		if($string)
		{
			$result	 = $this->load->view('admin/components/header', $vars, true);
			$result	.= $this->load->view('admin/components/sidebar', $vars);
			$result	.= $this->load->view('admin/'.$view, $vars, true);
			$result	.= $this->load->view('admin/components/footer', $vars, true);
			return $result;
		}
		else
		{
			$this->load->view('admin/components/header', $vars);
			$this->load->view('admin/components/sidebar', $vars);
			$this->load->view('admin/'.$view, $vars);
			$this->load->view('admin/components/footer', $vars);
		}
	}
}