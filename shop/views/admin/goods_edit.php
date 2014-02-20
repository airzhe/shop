<div class="main-content">
	<!-- 面包屑导航 -->
	<div class="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="#">Home</a>
			</li>
			<li class="active">编辑商品</li>
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
		<form  method="post" enctype="multipart/form-data">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#home" data-toggle="tab">基本设置</a></li>
				<li><a href="#profile" data-toggle="tab">扩展配置</a></li>
				<li><a href="#pic" data-toggle="tab">内容页展示图片</a></li>
				<li><a href="#brand" data-toggle="tab">品牌</a></li>
			</ul>

			<!-- Tab panes -->
			<!-- 基本设置 -->
			<div class="tab-content goods">
				<div class="tab-pane active" id="home">
					<table class="table table-condensed edit">
						<tr>
							<td>栏目</td>
							<td class="category" data-cid="<?php echo $goods['cid'] ?>">
								<?php if ($goods['cid']): ?>
									<div class="category_text" style="display:none;" >
										<?php echo $category ?>
										<input type="hidden" disabled name="cid" value="<?php echo $goods['cid'] ?>">
										<a href="javascript:void(0)" id="edit_category">编辑</a>
									</div>
								<?php endif ?>
								<div class="category_select" style="display:none">
									<select name="cid" class="form-control" disabled>
										<option value="0">请选择</option>
										<?php foreach ($category_list as  $v): ?>
											<option value="<?php echo $v['cid'] ?>" ><?php echo $v['cname'] ?></option>
										<?php endforeach ?>
									</select>
									<a href="javascript:void(0)" class="btn btn-default">确定</a>
								</div>
							</td>
						</tr>
						<tr>
							<td>商品名称</td>
							<td>
								<input type="text" class='form-control' name="gname" value="<?php echo $goods['gname'] ?>" required/>
							</td>
						</tr>
						<tr>
							<td>属性</td>
							<td>
								<label>
									<input type="checkbox" name="flag[]" value="推荐" <?php if(strpos($goods['flag'],'推荐')!==false) echo "checked" ?>> 推荐 
								</label>
								<label>
									<input type="checkbox" name="flag[]" value="置顶" <?php if(strpos($goods['flag'],'置顶')!==false) echo "checked" ?>> 置顶
								</label>
							</td>
						</tr>
						<tr>
							<td>商品图片</td>
							<td>
								<input type="file" name="pic">
								<?php if (isset($goods['index_pic'])): ?>
									<img src="<?php echo base_url($goods['index_pic']) ?>" alt="" height="50">
								<?php endif ?>
							</td>
						</tr>
						<tr>
							<td>价格</td>
							<td>
								<input type="text" class='form-control' name="price" value="<?php echo $goods['price'] ?>">
							</td>
						</tr>
						<tr>
							<td>库存</td>
							<td>
								<input type="text" class='form-control' name="stock" value="<?php echo $goods['stock'] ?>">
							</td>
						</tr>
					</table>
					
				</div>
				<!-- 其他设置 -->
				<div class="tab-pane" id="profile">
					<table class="table edit">
						<tr>
							<td>关键字</td>
							<td>
								<input type="text" name='keywords' value="<?php echo $goods['keywords'] ?>" class="form-control"/>
							</td>
						</tr>
						<tr>
							<td>栏目描述</td>
							<td>
								<textarea name="description" id="" cols="30" rows="6" class="form-control"><?php echo $goods['description'] ?></textarea>
							</td>
						</tr>
						<tr>
							<td>服务</td>
							<td>
								<textarea name="service" id="" cols="30" rows="6" class="form-control"><?php echo $goods['service'] ?></textarea>
							</td>
						</tr>
						<tr>
							<td>点击次数</td>
							<td>
								<input type="text" name='click' value="<?php echo $goods['click'] ?>" class="form-control"/>
							</td>
						</tr>
						<tr>
							<td>上架时间</td>
							<td>
								<input type="text" id="addtime" name='addtime' value="<?php echo $goods['addtime'] ?>" class="form-control"/>
							</td>
						</tr>
						<tr>
							<td>详细介绍</td>
							<td>
								<textarea class="ckeditor" name="body" id="" cols="30" rows="10" class="form-control"><?php echo $goods['body'] ?></textarea>
							</td>
						</tr>
					</table>
				</div>
				<!-- 内容页展示图片 -->
				<div class="tab-pane" id="pic" >
					<?php if (isset($goods_pic)): ?>
						<ul class="clearfix">
							<?php foreach ($goods_pic as $v): ?>
								<li>
									<img width="150" class="img-thumbnail" src="<?php echo base_url($v['medium']) ?>" alt="">
									<i class="fa fa-times red"></i>
								</li>
							<?php endforeach ?>
						</ul>
					<?php endif ?>
					<table class="table edit">
						<tr>
							<td><a href="javascript:void(0)" id="add_node_pic" class="node_edit">[+]</a></td>
							<td><input type="file" name="pics[]"></td>
						</tr>
					</table>
				</div>
				<!-- 品牌 -->
				<div class="tab-pane" id="brand" >
					<ul class="clearfix">
						<?php foreach ($brand_list as $v): ?>
							<li class="brand_<?php echo $v['bid'] ?>">
								<img src="<?php echo base_url($v['logo']) ?>" alt="" heiht="30">
								<span> <input type="radio" name="brand_bid" value="<?php echo $v['bid'] ?>"  > <?php echo $v['bname'] ?></span>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</div>
			<input type="submit" class="btn btn-primary" value="确定"/>
		</form>
	</div>
</div>
<script src="<?php echo base_url('assets/js/lhgcalendar.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/ckeditor/ckeditor.js') ?>"></script>
<script>
	$(document).ready(function(){
		// 时间选择插件
		$('#addtime').calendar({format: 'yyyy/MM/dd HH:mm:ss'});
		// 添加节点
		$('#add_node_pic').on('click',function(){
			var node='<tr>\
			<td><a href="javascript:void(0)" class="node_edit remove_node">[-]</a></td>\
			<td><input type="file" name="pics[]"></td>\
		</tr>';
		$(node).appendTo($(this).parents('table'));
	})

		//
		$("body").on('change','[name="cid"]',function(){
			$(this).nextAll('select').remove();
			var pid=this.value;
			if(pid==0)return;
			$(this).parents('td').data('cid',pid);
			$(this).after($('<i>',{class:'fa fa-spinner'}))
			//
			var str='<select class="form-control" name="cid"><option selected value="0" class="null">请选择</option>';
			$.ajax({
				url:site_url+'admin/goods/category/'+pid,
				dataType:'json',
				success:function(data){
					$('td.category').find('.fa').remove();
					if(data.status==0)return;
					var category=data.category;
					$.each(category,function(i,n){
						str+='<option value="' + category[i]['cid'] + '">' + category[i]['cname'] + '</option>';
					})
					str+='</select>';
					$('td.category').find('select').last().after(str);
				},
				error:function(){
					$('td.category').find('.fa').remove();
				}
			})
		})
		// 异步加载栏目属性及属性值

		$('td.category').find('a').on('click',function(){
			$('table.attr').remove();
			$('table.spec').remove();
			$('p.bg-info').remove();
			var cid=$(this).parents('td').data('cid');
			if(cid==0){
				alert('请选择');
				return;
			}
			$.ajax({
				url:site_url+'admin/goods/get_attr_spec/'+cid,
				dataType:'json',
				success:function(data){
					if(data.status==1){
						$(data.attr).appendTo($('#home'));
						$(data.spec).appendTo($('#home'));
					};
				}
			})
			$.ajax({
				url:site_url+'admin/category/get_brand/'+cid,
				dataType:'json',
				success:function(data){
					if(data.status==1){
						$('#brand').find('ul').html('');
						$(data.brand_list).each(function(i){
							var _brand=data.brand_list[i];
							var brand='\
							<li class="brand_'+_brand["bid"]+'">\
								<img src="'+ site_url + _brand["logo"] +'" alt="" heiht="30">\
								<span> <input type="radio" name="brand_bid" value="'+ _brand["bid"]+'"> '+ _brand["bname"] +'</span>\
							</li>\
							';
							$(brand).appendTo($('#brand').find('ul'));
						})
					}else{
						$('#brand').find('ul').html('<input type="radio" name="bid">');
					}
				}
			})
		})
		// 添加规格节点
		$('body').on('click','#add_node_spec',function(){
			console.log('run...');
			var node=$(this).parents('tr').clone();
			node.find('td').eq(0).html('<a href="javascript:void(0)" class="node_edit remove_node">[-]</a>');
			node.appendTo($(this).parents('table'));
		})
		// 移除规格节点
		$('body').on('click','.remove_node',function(){
			$(this).parents('tr').remove();
		})
		// 通过图片点击切换checkbox是否选中
		$('#brand').on('click','li',function(){
			$('#brand').find('li').removeClass();
			$(this).addClass('active');
			var radio=$(this).find(':radio').get(0);
			// console.log(checkbox.checked);
			radio.checked=true;
		})
		/**
		 * 产品编辑js
		 */
		 if($("[name='gname']").val()!=''){
		 	$('.category_text').show();
		 	$("select[name='cid']").attr('disabled',true);
		 	$("input[name='cid']").removeAttr('disabled');
		 	$('.category_select').find('.btn').trigger('click');
		 }else{
		 	$('.category_select').show();
		 	$("select[name='cid']").removeAttr('disabled');
		 }
		 $('#edit_category').on('click',function(){
		 	$('.category_select').show();
		 	$("select[name='cid']").removeAttr('disabled');
		 	$('.category_text').hide();

		 })
		 //删除商品图片
		 $('ul').on('click','.fa-times',function(){
		 	var li=$(this).parents('li');
		 	path=li.find('img').attr('src');
		 	$.ajax({
		 		url: site_url+'admin/goods/del_goods_pic',
		 		type: 'post',
		 		dataType: 'json',
		 		data: {path:path,pic_id:pic_id},
		 		success:function(data){
		 			if(data.status==1){
		 				li.fadeOut(400,function(){
		 					$(this).remove();
		 				});
		 			}
		 		}
		 	})
		 });
		 //
	//
})
</script>
