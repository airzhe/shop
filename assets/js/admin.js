$(document).ready(function(){

	//点击显示隐藏子元素。
	var arrow='<b class="arrow fa fa-angle-down"></b>';
	var toggle_a=$('.sidebar').find('li').has('ul').children('a');
	toggle_a.addClass('dropdown-toggle').append(arrow);
	toggle_a.on('click',function(e){
		console.log(this);
		$(this).next('.submenu').slideToggle('fast');
		e.preventDefault();
	})

	//打开关闭侧边栏
	var flag=0;
	$('.sidebar-collapse').find('i').on('click',function(){
		if(flag==0){
			$('.sidebar').addClass('menu-min');
			$(this).removeClass('fa-angle-double-left').addClass('fa-angle-double-right');
			flag=1;
		}else{
			$('.sidebar').removeClass('menu-min');
			$(this).removeClass('fa-angle-double-right').addClass('fa-angle-double-left');
			flag=0;
		}
	})	
})