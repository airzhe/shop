<div class="main-content">
	<!-- 面包屑导航 -->
	<div class="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="#">Home</a>
			</li>
			<li class="active">栏目管理</li>
		</ul>
	</div>
	<div class="page-content">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#">栏目列表</a>
			</li>
			<li><a href="<?php echo site_url('admin/category/edit') ?>"><i class="fa fa-plus-circle"></i> 添加顶级栏目</a></li>
		</ul>
		<table class="table table-hover list" id="category">
			<thead>
				<tr>
					<th>cid</th>
					<th>栏目名称</th>
					<th>操作</th>
				</tr>
			</thead>
			<?php foreach ($categoryd as $v): ?>
				<tr>
					<td><?php echo $v['cid'] ?></td>
					<td><?php echo $v['html'].$v['cname'] ?></td>
					<td>
						<a href="<?php echo site_url('admin/category/edit/pid/').'/'.$v['cid'] ?>">添加子栏目</a> |
						<a href="<?php echo site_url('admin/category/edit/cid/').'/'.$v['cid'] ?>">编辑</a> |
						<a href="#">删除</a>
					</td>
				</tr>
			<?php endforeach ?>
		</table>
	</div>
</div>

<script>
	$(function(){
		function success(msg){
			alert(msg);
		}
		function error(msg){
			alert(msg);
		}
		/*隐藏没有子元素的分类前的图标*/
		$('tr:gt(0)').each(function(){
			var _tr=$(this);
			var _cid=_tr.data('cid');
			var _children=0;
			_tr.nextUntil('.level_0').each(function(){
				var _pid=$(this).data('pid');
				if(_pid==_cid){
					_children++;
				}
			})
			_tr.data('children',_children);
			if(_children==0){
				_tr.find('i').first().remove();
			}
		})
		/*点击展开、关闭树状结构*/
		$('#category').on('click','.switch',function(){
			if($(this).hasClass('fa-minus-square-o')){
				$(this).removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
			}else{
				$(this).removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
			}

			var _tr=$(this).parents('tr')
			var _cid=_tr.data('cid');

			_tr.nextUntil('.level_0').each(function(){
				var _pid=$(this).data('pid');
				if(_pid==_cid){
					$(this).toggle();
				}
			})
		})
		/*异步修改数据*/
		$('[name=sort],[name=cname]').focus(function(){
			var oldData=$(this).val();
			$(this).off('blur').on('blur',function(){
				//验证文本框内容是否为改变，或为空。
				var newData=$.trim($(this).val());
				if(newData==oldData || newData==''){
					$(this).html(oldData);
					return;
				}
				//验证文本框内容是否为数字
				var name=$(this).attr('name');
				if(name=='sort'){
					if(!/^\d+$/.test(newData)){
						error('内容只能是数字');
						return;
					}
				}
				//取得主键id，并异步修改数据库字段
				var cid=$(this).parents('tr').data('cid');
				$.post('?c=category&m=ajax_edit', {cid:cid,arg:name+'@=@'+newData}, function(data) {
					if(data==1){
						success('操作成功！');
						$(this).html(newData);
					}else{
						error('操作失败！');
						$(this).html(oldData);
					}
				})
			})
		})
		/*异步删除数据*/
		$('.del').on('click',function(e){
			e.preventDefault();
			if(!confirm('确定要执行该操作么？'))
				return;
			var _tr=$(this).parents('tr');
			var _children=_tr.data('children');
			// if(_children!=0){
			// 	error('请先删除该分类下的子分类！')
			// 	return;
			// }
			var cid=_tr.data('cid');
			var pid=_tr.data('pid');
			$.ajax({
				url:'?c=category&m=del',
				type:'get',
				data:{cid:cid},
				success:function(data){
					if(data==1){
						_tr.fadeOut(function(){
							$(this).remove();
							// _par=$('tr').attr('data-pid')=pid
							// _par.data('children')-1;
						});
					}else if(data==2){
						success('请先删除该分类下的子分类！');
					}else{
						error('删除失败');
					}
				}
			})
		})
	})
</script>