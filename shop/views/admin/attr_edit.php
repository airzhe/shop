<div class="main-content">
	<!-- 面包屑导航 -->
	<div class="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="#">Home</a>
			</li>
			<li class="active">属性分类</li>
		</ul>
	</div>
	<div class="page-content">
		<!-- page-header -->
		<!-- <div class="page-header position-relative">
			<h1>
				<a href="<?php echo base_url('admin/category')?>">栏目列表</a>
				<small>
					<i class="fa fa-angle-double-right"></i>
					添加栏目
				</small>
			</h1>
		</div> -->
		<ul class="nav nav-tabs">
			<li>
				<a href="<?php echo base_url('admin/attr/index').'/'.$tid ?>">属性列表</a>
			</li>
			<li class="active"><a href="#">编辑属性</a></li>
		</ul>
		<form action="#" method="post">
			<table class="table edit">
				<thead>
					<tr>
						<th colspan="2">属性分类</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>属性名称</td>
						<td>
							<!-- 隐藏域名 tid -->
							<input type="hidden" name='tid' value="<?php echo $tid ?>" />
							<input type="text" name='attr_name' value="<?php echo $attr['attr_name'] ?>" class="form-control" required/>
						</td>
					</tr>
					<tr>
						<td>显示方式</td>
						<td>
							<select name="show_type" class="form-control" <?php if(isset($aid)) echo 'disabled'?> >
								<option value="1">文本框</option>
								<option value="2">单选框</option>
								<option value="3">复选框</option>
								<option value="4">下拉列表框</option>
							</select>
						</td>
					</tr>
					<tr id="input">
						<td>属性值</td>
						<td >
							<input type="text" name='attr_value[]' value="<?php echo $value['0']['attr_value'] ?>" class="form-control" />
						</td>
					</tr>
					<tr id="select">
						<td>属性值</td>
						<td>
							<?php $i=0;foreach ($value as $v): $i++;?>
							<p>
							<input type="text" name="attr_value[id_<?php if(isset($v['av_id'])) echo $v['av_id'] ?>]" value="<?php echo $v['attr_value'] ?>" class="form-control" />
								<?php if ($i==1): ?>
									<a href="javascript:void(0)" class="btn btn-default" id="add_node">添加</a>
								<?php else: ?>
									<a href="javascript:void(0)" class="btn btn-default remove_node">移除</a>
								<?php endif ?>
							</p>
						<?php endforeach ?>
					</td>
				</tr>
			</tbody>
		</table>
		<input type="submit" class="btn btn-primary" value="确定"/>
	</form>
</div>
<script>
	$(document).ready(function(){
		// 选择相应的属性值编辑方式
		$("[name='show_type']").on('change',function(){
			// 默认隐藏、不可用
			$('#input,#select').hide();
			$("[name^=attr_value]").attr('disabled','disabled');
			if($(this).val()==1){
				$('#input').show().find("[name^=attr_value]").removeAttr('disabled');
			}else{
				$('#select').show().find("[name^=attr_value]").removeAttr('disabled');
			}
		}).val(<?php echo $attr['show_type'] ?>).trigger('change');
		// 添加节点
		$('#add_node').on('click',function(){
			var node='<p><input type="text" name="attr_value[]" class="form-control" required/>\
			<a href="javascript:void(0)" class="btn btn-default remove_node">移除</a></p>';
			$(node).appendTo($(this).parents('td'));
		})
		// 移除节点
		$('#select').on('click','.remove_node',function(){
			$(this).parent().remove();
		})
	})
</script>