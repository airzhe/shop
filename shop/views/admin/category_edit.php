<div class="main-content">
	<!-- 面包屑导航 -->
	<div class="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="#">Home</a>
			</li>
			<li class="active">编辑栏目</li>
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
		<form  method="post">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#home" data-toggle="tab">基本设置</a></li>
				<li><a href="#profile" data-toggle="tab">其他</a></li>
				<li><a href="#brand" data-toggle="tab">品牌</a></li>
			</ul>

			<!-- Tab panes -->
			<!-- 基本设置 -->
			<div class="tab-content category">
				<div class="tab-pane active" id="home">
					<table class="table edit">
						<tr>
							<td>商品类型</td>
							<td>
								
								<select name="tid" class="form-control">
									<?php foreach ($goods_type_list as  $v): ?>
										<option value="<?php echo $v['tid'] ?>"><?php echo $v['gtname'] ?></option>
									<?php endforeach ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>上级栏目</td>
							<td>
								<?php if (is_array($category)): ?>
									<select name="pid" class="form-control">
										<?php foreach ($category as $v): ?>
											<option value="<?php echo $v['cid'] ?>"><?php echo $v['cname'] ?></option>
										<?php endforeach ?>
									</select>
								<?php else: ?>
									顶级栏目
								<?php endif ?>
							</td>
						</tr>
						<tr>
							<td>栏目名称</td>
							<td>
								<input type="text" class='form-control' name="cname" value="<?php echo $cate['cname'] ?>" required/>
							</td>
						</tr>
						<tr>
							<td>栏目类型</td>
							<td>
								<label>
									<input type="radio" name="cat_type" value="1" checked="checked"> 封面栏目 
								</label>
								<label>
									<input type="radio" name="cat_type" value="2">  普通栏目
								</label>
							</td>
						</tr>
						<tr>
							<td>单位</td>
							<td>
								<input type="text" class='form-control' name="unit" value="<?php echo $cate['unit'] ?>">
							</td>
						</tr>
						<tr>
							<td>价格区间</td>
							<td>
								<input type="text" class='form-control' name="price_range" value="<?php echo $cate['price_range'] ?>">
							</td>
						</tr>
					</table>
					
				</div>
				<!-- 其他设置 -->
				<div class="tab-pane" id="profile">
					<table class="table edit">
						<tr>
							<td class="w100">关键字</td>
							<td>
								<input type="text" name='keywords' value="<?php echo $cate['keywords'] ?>" class="form-control"/>
							</td>
						</tr>
						<tr>
							<td>栏目描述</td>
							<td>
								<textarea name="description" id="" cols="30" rows="10" class="form-control"><?php echo $cate['description'] ?></textarea>
							</td>
						</tr>
					</table>
				</div>
				<!-- 品牌 -->
				<div class="tab-pane" id="brand">
					<ul class="clearfix">
						<?php foreach ($brand_list as $v): ?>
							<li>
								<img src="<?php echo base_url($v['logo']) ?>" alt="" heiht="30">
								<span> <input type="checkbox" name="bid[]" value="<?php echo $v['bid'] ?>" class="hide" > <?php echo $v['bname'] ?></span>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</div>
			<input type="submit" class="btn btn-primary" value="确定"/>
		</form>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#brand').find('li').on('click',function(){
			$(this).toggleClass('active');
			var checkbox=$(this).find(':checkbox').get(0);
			// console.log(checkbox.checked);
			checkbox.checked=!checkbox.checked;
		})
	})
</script>