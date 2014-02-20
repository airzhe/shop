<div class="main-content">
	<!-- 面包屑导航 -->
	<div class="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="#">Home</a>
			</li>
			<li class="active">商品列表</li>
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
					<a href="#">商品列表</a>
				</li>
				<li><a href="<?php echo site_url('admin/goods_type/edit') ?>"><i class="fa fa-plus-circle"></i> 添加类型</a></li>
			</ul>
			<table class="table table-hover list">
				<thead>
					<tr>
						<th>gid</th>
						<th>商品名称</th>
						<th>商品图片</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($goods_list as $v): ?>
						<tr>
							<td><?php echo $v['gid'] ?></td>
							<td><?php echo $v['gname'] ?></td>
							<td> <img src="<?php echo base_url($v['index_pic']) ?>" alt="" height="30"> </td>
							<td>
								<a href="<?php echo site_url('admin/goods/edit').'/'.$v['gid'] ?>">编辑</a>
								<a href="#">删除</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>	
			</table>
		</form>
	</div>
</div>