<div class="main-content">
	<!-- 面包屑导航 -->
	<div class="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="#">Home</a>
			</li>
			<li class="active">品牌分类</li>
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
				<a href="<?php echo base_url('admin/brand/index') ?>">品牌列表</a>
			</li>
			<li class="active"><a href="#">编辑品牌</a></li>
		</ul>
		<form action="#" method="post" enctype="multipart/form-data">
			<table class="table edit">
				<thead>
					<tr>
						<th colspan="2">品牌分类</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>品牌名称</td>
						<td>
							<input type="text" name='bname' value="<?php echo $brand['bname'] ?>" class="form-control" required/>
						</td>
					</tr>
					<tr>
						<td>LOGO</td>
						<td>
							<input type="file" name="logo">
							<?php if (isset($brand['logo'])): ?>
								<img height='30' src="<?php echo base_url($brand['logo']) ?>" alt="">
								<input type="hidden" name='curr_logo' value="<?php echo $brand['logo'] ?>">
							<?php endif ?>
						</td>
					</tr>
				</tbody>
			</table>
			<input type="submit" class="btn btn-primary" value="确定"/>
		</form>
	</div>
</div>