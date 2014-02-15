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
		// 加载图像处理类
		$this->load->library('image_lib'); 
		$arr=explode('/',$img);
		// 主页图片宽高
		$index_thumb_width=$this->config->item('index_thumb_width');
		$index_thumb_height=$this->config->item('index_thumb_height');
		// 栏目图片宽高
		$list_thumb_width=$this->config->item('list_thumb_width');
		$list_thumb_height=$this->config->item('list_thumb_height');
		// 主页图片配置
		$index_img=array(
			'path'=>'index_thumb',
			'width'=>$index_thumb_width,
			'height'=>$index_thumb_height,
			);
		// 栏目图片配置
		$list_img=array(
			'path'=>'list_thumb',
			'width'=>$list_thumb_width,
			'height'=>$list_thumb_height,
			);
		$zoom_img=array($index_img,$list_img);
		// 图片物理目录
		$new_path=$arr[0].'/'.$arr[1].'/';
		is_dir($new_path);
		// 加载图像处理类
		$config['source_image'] = $img;
		$config['maintain_ratio'] = TRUE;
		// 缩略图文件名
		$file_name=basename($img);
		// 遍历数组创建主页和列表页缩略图
		foreach ($zoom_img as $v) {
			$path=$new_path.$v['path'];
			is_dir($path) || mkdir($path);
			$config['width'] = $v['width'];
			$config['height'] = $v['height'];
			$config['new_image'] = $path.'/'.$file_name;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
		}
	}

	public function get_new(){
		return array('gname'=>'','price'=>'','stock'=>'','keywords'=>'','description'=>'','service'=>'','click'=>'100','addtime'=>date('Y/m/d H:i:s'),'body'=>'');
	}
}