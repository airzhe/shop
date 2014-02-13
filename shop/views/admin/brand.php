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
					商品类型
				</h1>
			</div> -->
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#">品牌列表</a>
				</li>
				<li><a href="<?php echo site_url('admin/brand/edit') ?>"><i class="fa fa-plus-circle"></i> 添加品牌</a></li>
			</ul>
			<table class="table table-hover list brand">
				<thead>
					<tr>
						<th>bid</th>
						<th>品牌名称</th>
						<th>logo</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($brand_list as $v): ?>
						<tr>
							<td><?php echo $v['bid'] ?></td>
							<td><?php echo $v['bname'] ?></td>
							<td> <img src="<?php echo base_url($v['logo']) ?>" alt="" heiht="30"> </td>
							<td>
								<a href="<?php echo site_url('admin/brand/edit').'/'.$v['bid'] ?>">修改</a>
								<a href="#">删除</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>	
			</table>
		</form>
	</div>
</div>