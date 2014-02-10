
	<div class="main-content">
		<!-- 面包屑导航 -->
		<div class="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="#">Home</a>
				</li>
				<li class="active">Typography</li>
			</ul>
		</div>
		<div class="page-content">
			<!-- page-header -->
			<div class="page-header position-relative">
				<h1>
					系统配置
				</h1>
			</div>
			<form action="settings/update" method="post">
				<table class="table">
					<?php foreach ($settings as  $v): ?>
						<tr>
							<td ><?php echo $v['title'] ?></td><td><?php echo $v['value'] ?></td>
						</tr>
					<?php endforeach ?>
				</table>
				<p><button class="btn btn-primary">确定</button></p>
			</form>
		</div>
	</div>
</div>