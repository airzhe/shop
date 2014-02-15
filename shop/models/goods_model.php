<?php
/**
 * 品牌管理模型
 */
class Goods_model extends MY_Model {
	
	protected $_table_name = 'goods';
	protected $_primary_key = 'gid';
	protected $_primary_filter = 'intval';
	public $rules = array(
		'gname' => array(
			'field' => 'gname', 
			'label' => '商品名称', 
			'rules' => 'trim|required|xss_clean'
			),
		);
	
	function __construct() {
		parent::__construct();
	}

	public function save_data($gid){
		$field=array('cid','gname','price','stock','keywords','description','service','click','body');
		
		$data=$this->array_from_post($field);
		$flag=implode(',', $_POST['flag']);
		$data['flag']=$flag;
		$data['addtime']=strtotime($_POST['addtime']);
		
		if(count($_FILES)){
			$pic=$this->upload();
			echo $pic;
			$data['pic']=$pic;
			$this->zoom($pic);
		}
		
		return $this->save($data,$gid);
	}
	/**
	 * 上传产品图片
	 */
	private function upload(){

		$file=$_FILES['pic'];
		$info = pathinfo($file['name']);
		// 路径
		$upload_path='images/'.date("Ym").'/source_img/';
		is_dir($upload_path) || mkdir($upload_path,0777,TRUE);
		// 文件名
		$file_name=time().mt_rand(0,1000).'.'.$info['extension'];

		// 配置项
		$config['upload_path'] = $upload_path;
		$config['file_name'] = $file_name;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		// 默认0,系统配置文件中上传大小,单位k
		$config['max_size'] = '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
		if ($this->upload->do_upload('pic'))
		{
			$arr=$this->upload->data();
			return $config['upload_path'].$arr['file_name'];
		}else{
			echo $this->upload->display_errors();
		}
	}

	/**
	 * 缩放图片
	 */
	private function zoom($img){
		if(!is_file($img)) return;
		
	}

	public function get_new(){
		return array('gname'=>'','price'=>'','stock'=>'','keywords'=>'','description'=>'','service'=>'','click'=>'100','addtime'=>date('Y/m/d H:i:s'),'body'=>'');
	}
}