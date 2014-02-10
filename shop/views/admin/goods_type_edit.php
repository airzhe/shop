<style>
	tbody tr > td:first-child{width: 100px;vertical-align: middle;}
</style>
<div class="main-content">
	<!-- 面包屑导航 -->
	<div class="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="#">Home</a>
			</li>
			<li class="active">添加分类</li>
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
				<a href="<?php echo base_url('admin/goods_type')?>">商品类型</a>
			</li>
			<li class="active"><a href="#">添加类型</a></li>
		</ul>
		<form action="#" method="post" class="form-inline">
			<table class="table">
				<thead>
					<tr>
						<th colspan="2">添加商品类型</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>商品类型名称</td>
						<td>
							<div class="form-group">
								<input type="text" name='gtname' value="<?php echo $goods_type['gtname'] ?>" class="form-control" required/>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<input type="submit" class="btn btn-primary" value="确定"/>
		</form>
	</div>
</div>