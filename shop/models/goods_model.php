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
		$this->load->model('Goods_pic_model');
	}

	public function save_data($gid){
		$field=array('cid','gname','price','stock','keywords','description','service','click','body','brand_bid');
		
		$data=$this->array_from_post($field);
		$flag=implode(',', $_POST['flag']);
		$data['flag']=$flag;
		$data['addtime']=strtotime($_POST['addtime']);
		
		// 首页列表页图
		$file=$_FILES['pic'];
		if($file['error']==0 and is_uploaded_file($file['tmp_name'])){
			$pic=$this->upload('pic');
			$index_pic=str_replace('source_img','index_thumb',$pic);
			$list_pic=str_replace('source_img','list_thumb',$pic);

			$data['pic']=$pic;
			$data['index_pic']=$index_pic;
			$data['list_pic']=$list_pic;

			$this->zoom($pic);
		}


		return $this->save($data,$gid);
	}
	public function save_goods_pic($_gid){
		// 产品内容图
		$goods_pic=$_FILES['pics'];
		$pic_id =NULL;

		if(!empty($goods_pic['name'][0])){
			$this->load->helper('upload');
			multifile_array();
			foreach ($_FILES as $file => $file_data){
				$goods_pic=$this->upload($file);
				$this->zoom_goods_pic($goods_pic);

				$big=str_replace('source_img','goods_big',$goods_pic);
				$medium=str_replace('source_img','goods_medium',$goods_pic);
				$small=str_replace('source_img','goods_small',$goods_pic);
				$arr['big']=$big;
				$arr['medium']=$medium;
				$arr['small']=$small;
				$arr['goods_gid']=$_gid;
				$this->Goods_Pic_model->save($arr,$pic_id);
				echo $this->db->last_query();
			}
		}
	}
	/**
	 * 上传产品图片
	 */
	private function upload($name){
		// $info = pathinfo($file['name']);
		// 路径
		$upload_path='images/'.date("Ym").'/source_img/';
		is_dir($upload_path) || mkdir($upload_path,0777,TRUE);
		// 文件名
		// $file_name=time().mt_rand(0,1000).'.'.$info['extension'];

		// 配置项
		$config['upload_path'] = $upload_path;
		// $config['file_name'] = $file_name;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		// 默认0,系统配置文件中上传大小,单位k
		$config['max_size'] = '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '1024';
		// 开启文件重命名
		$config['encrypt_name']=TRUE;

		$this->load->library('upload', $config);
		if ($this->upload->do_upload($name))
		{
			$arr=$this->upload->data();
			return $config['upload_path'].$arr['file_name'];
		}else{
			echo $this->upload->display_errors();
			die;
		}
	}

	/**
	 * 缩放主页图片
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

	/**
	 * 缩放产品图片
	 */
	private function zoom_goods_pic($img){
		if(!is_file($img)) return;
		// 加载图像处理类
		$this->load->library('image_lib'); 
		$arr=explode('/',$img);
		// 大图宽高
		$goods_big_width=$this->config->item('goods_big_width');
		$goods_big_height=$this->config->item('goods_big_height');
		// 中图宽高
		$goods_medium_width=$this->config->item('goods_medium_width');
		$goods_medium_height=$this->config->item('goods_medium_height');
		// 小图宽高
		$goods_small_width=$this->config->item('goods_small_width');
		$goods_small_height=$this->config->item('goods_small_height');
		// 大图配置
		$goods_big=array(
			'path'=>'goods_big',
			'width'=>$goods_big_width,
			'height'=>$goods_big_height,
			);
		// 中图配置
		$goods_medium=array(
			'path'=>'goods_medium',
			'width'=>$goods_medium_width,
			'height'=>$goods_medium_height,
			);
		// 小图配置
		$goods_small=array(
			'path'=>'goods_small',
			'width'=>$goods_small_width,
			'height'=>$goods_small_height,
			);
		$zoom_img=array($goods_big,$goods_medium,$goods_small);
		// 图片物理目录
		$new_path=$arr[0].'/'.$arr[1].'/';
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
		return array('cid'=>'','gid'=>'','gname'=>'','flag'=>'','price'=>'','stock'=>'','keywords'=>'','description'=>'','service'=>'','click'=>'100','addtime'=>date('Y/m/d H:i:s'),'body'=>'','brand_bid'=>'');
	}
}