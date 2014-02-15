<?php
/**
 * 分类管理
 */
class Goods extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Goods_model');
		$this->load->model('Goods_Attr_model');
		$this->load->model('Category_model');
		// $this->load->model('Brand_Category_model');
	}
	public function index(){
		$this->view('goods_edit',$this->data);
	}
	// 添加 更新
	public function edit ($gid=NULL){
		if($this->input->post()){
			$rules =$this->Goods_model->rules;
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == TRUE){
				
				$gid || $gid = NULL;
				
				if($_gid=$this->Goods_model->save_data($gid)){
					$this->Goods_Attr_model->save_data($_gid);
				}
				success('操作成功',"admin/category/");
			}else{
				echo validation_errors(); 
			}
		}else{
			if($gid){
				$goods=$this->Goods_model->get($gid);
			}else{
				$goods=$this->Goods_model->get_new();
			}
			$this->data['category_list']=$this->Category_model->get_by(array('pid'=>0));
			$this->data['goods']=$goods;
			$this->view('goods_edit.php',$this->data);
		}
	}
	//获取相应ID的子分类
	public function category($cid){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->load->model('Goods_model');
		$result=$this->Category_model->get_by(array('pid'=>$cid));
		if(!empty($result)){
			die(json_encode(array('status'=>1,'category'=>$result)));
		}
	}
	public function get_attr_spec($cid){
		$attr= $this->goods_attr($cid);
		$spec= $this->goods_apec($cid);
		$arr=array('status'=>'1','attr'=>$attr,'spec'=>$spec);
		die(json_encode($arr));
	}
	//获取相应的属性
	public function goods_attr($cid){
		$this->load->model('Attr_model');
		$this->load->model('Attr_value_model');
		$tid=$this->Category_model->get_field('tid',array('cid'=>$cid));

		$attr=$this->Attr_model->get_by(array('tid'=>$tid,'is_spec'=>0));
		if(empty($attr)) return;
		// 取得属性值
		foreach ($attr as $k => $v) {
			$attr[$k]['attr_value']=$this->Attr_value_model->get_by(array('aid'=>$v['aid']));
		}
		
		// 链接属性html
		$html="<p class='bg-info'>属性</p><table class='table table-condensed table-bordered edit attr'>";
		foreach ($attr as $k => $v) {
			$html.='<tr>';
			switch ($v['show_type']) {
				case '1':
					# 文本框...
				$html.="<td>{$v['attr_name']}</td><td>";
				foreach ($v['attr_value'] as $av) {
					$html.="<input type='text' class='form-control' name='attr[{$av['av_id']}]' value='{$av['attr_value']}'>";
				}
				$html.="</td>";
				break;
				case '2':
					# 单选框...
				$html.="<td>{$v['attr_name']}</td><td>";
				foreach ($v['attr_value'] as $av) {
					$html.="<label><input type='radio' name='attr[radio]' value='{$av['av_id']}-{$av['attr_value']}'>{$av['attr_value']}</label>";
				}
				$html.="</td>";
				break;
				case '3':
					# 复选框...
				$html.="<td>{$v['attr_name']}</td><td>";
				foreach ($v['attr_value'] as $av) {
					$html.="<label><input type='checkbox' name='attr[{$av['av_id']}][]' value='{$av['attr_value']}'>{$av['attr_value']}</label>";
				}
				$html.="</td>";
				break;
				case '4':
				$html.="<td>{$v['attr_name']}</td><td><select class='form-control' name='attr[select]'>";
				foreach ($v['attr_value'] as $av) {
					$html.="<option name='' value='{$av['av_id']}-{$av['attr_value']}'>{$av['attr_value']}</option>";
				}
				$html.="</td></select>";
				break;
			}
			$html.='</tr>';
		}
		$html.='</table>';
		return $html;
	}

	//获取相应的规格
	public function goods_apec($cid){
		$this->load->model('Attr_model');
		$this->load->model('Attr_value_model');
		$tid=$this->Category_model->get_field('tid',array('cid'=>$cid));
		
		$attr=$this->Attr_model->get_by(array('tid'=>$tid,'is_spec'=>1));
		if(empty($attr)) return;
		// 取得属性值
		foreach ($attr as $k => $v) {
			$attr[$k]['attr_value']=$this->Attr_value_model->get_by(array('aid'=>$v['aid']));
		}
		// p($attr);die;
		// 链接属性html
		$html="<p class='bg-info'>规格</p><table class='table table-condensed table-bordered attr'>";
		$html.="<tr><td>规格</td>";
		foreach ($attr as  $v) {
			$html.="<td>{$v['attr_name']}</td>";
		}
		$html.='<td>库存</td><td>价格</td><td>货号</td></tr><tr><td><a href="javascript:void(0)" id="add_node_spec" class="node_edit">[+]</a></td>';
		foreach ($attr as  $k=>$v) {
			$html.="<td><select class='form-control'>";
			foreach ($v['attr_value'] as $k => $_v) {
				$html.="<option value='{$_v['av_id']}'>{$_v['attr_value']}</option>";
			}
		}
		$html.="<td><input type='text' name='' class='form-control'/></td>
		<td><input type='text' name='' class='form-control'/></td>
		<td><input type='text' name='' class='form-control'/></td>";
		$html.="</tr></table>";
		$html.="</select></td>";
		$html.='</table>';
		return $html;
	}

}