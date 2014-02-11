<div class="main-content">
	<!-- 面包屑导航 -->
	<div class="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="#">Home</a>
			</li>
			<li class="active">规格分类</li>
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
			<li class="active"><a href="#">添加规格</a></li>
		</ul>
		<form action="#" method="post">
			<table class="table edit">
				<thead>
					<tr>
						<th colspan="2">规格分类</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>规格名称</td>
						<td>
							<!-- 隐藏域名 tid -->
							<input type="hidden" name='tid' value="<?php echo $tid ?>" />
							<input type="hidden" name='is_spec' value='1'/>
							<input type="hidden" name='show_type' value='3'/>
							<input type="text" name='attr_name' value="<?php echo $attr['attr_name'] ?>" class="form-control" required/>
						</td>
					</tr>
					
					<tr>
						<td>属性值</td>
						<td>
							<?php foreach ($attr['value'] as $v): ?>
								<p>
									<input type="text" name='attr_value[]' value="<?php echo $v['attr_value'] ?>" class="form-control" />
									<a href="javascript:void(0)" class="btn btn-default" id="add_node">添加</a>
								</p>
							<?php endforeach ?>
						</td>
					</tr>
				</tbody>
			</table>
			<input type="submit" class="btn btn-primary" value="确定"/>
		</form>
	</div>
</div>
<script>
	$(document).ready(function(){
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