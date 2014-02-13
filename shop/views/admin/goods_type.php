<div class="main-content">
	<!-- 面包屑导航 -->
	<div class="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="#">Home</a>
			</li>
			<li class="active">商品类型</li>
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
					<a href="#">商品类型</a>
				</li>
				<li><a href="<?php echo site_url('admin/goods_type/edit') ?>"><i class="fa fa-plus-circle"></i> 添加类型</a></li>
			</ul>
			<table class="table table-hover list">
				<thead>
					<tr>
						<th>tid</th>
						<th>商品类型名称</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($goods_type_list as $v): ?>
						<tr>
							<td><?php echo $v['tid'] ?></td>
							<td><?php echo $v['gtname'] ?></td>
							<td>
								<a href="<?php echo site_url('admin/goods_type/edit').'/'.$v['tid'] ?>">编辑</a>
								<a href="<?php echo site_url('admin/attr/index').'/'.$v['tid'] ?>">属性</a>
								<a href="#">删除</a>
								<a href="<?php echo site_url('admin/spec/index').'/'.$v['tid'] ?>">规格</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>	
			</table>
		</form>
	</div>
</div>