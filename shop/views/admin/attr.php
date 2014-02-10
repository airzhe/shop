	<style>
		tr>td:last-child{width:200px;}
	</style>
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
					商品类型
				</h1>
			</div> -->
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#">属性列表</a>
				</li>
				<li><a href="<?php echo site_url('admin/attr/edit').'/'.$tid ?>"><i class="fa fa-plus-circle"></i> 添加属性</a></li>
			</ul>
			<table class="table">
				<thead>
					<tr>
						<th>aid</th>
						<th>属性名称</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($attr_list as $v): ?>
						<tr>
							<td><?php echo $v['aid'] ?></td>
							<td><?php echo $v['attr_name'] ?></td>
							<td>
								<a href="<?php echo site_url('admin/attr/edit').'/'.$tid.'/?aid='.$v['aid'] ?>">编辑</a>
								<a href="#">删除</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>	
			</table>
		</form>
	</div>
</div>
</div>