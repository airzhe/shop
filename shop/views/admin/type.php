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
				<li><a href="<?php echo site_url('admin/type/add') ?>">添加类型</a></li>
			</ul>
			<table class="table">
				<thead>
					<tr>
						<th>tid</th>
						<th>商品类型名称</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>服装</td>
						<td>
							<a href="#">编辑</a>
							<a href="#">属性</a>
							<a href="#">删除</a>
							<a href="#">规格</a>
						</td>
					</tr>
				</tbody>	
			</table>
			<p><button class="btn btn-primary">确定</button></p>
		</form>
	</div>
</div>
</div>