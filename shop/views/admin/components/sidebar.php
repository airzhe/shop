<div class="sidebar">
	<div class="sidebar-shortcuts">
		<!-- 大按钮图标 -->
		<div class="sidebar-shortcuts-large">
			<button class="btn btn-small btn-success">
				<i class="fa fa-signal"></i>
			</button>
			<button class="btn btn-small btn-info">
				<i class="fa fa-pencil"></i>
			</button>
			<button class="btn btn-small btn-warning">
				<i class="fa fa-group"></i>
			</button>
			<button class="btn btn-small btn-danger">
				<i class="fa fa-cogs"></i>
			</button>
		</div>
		<!-- 小按钮图标 -->
		<div class="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span>
			<span class="btn btn-info"></span>
			<span class="btn btn-warning"></span>
			<span class="btn btn-danger"></span>
		</div>
	</div>
	<ul class="nav nav-list">
		<li class="active">
			<a href="<?php echo base_url('admin/goods_type')?>">
				<i class="fa fa-dashboard"></i>
				<span class="menu-text"> 类型管理 </span>
			</a>
		</li>
		<li>
			<a href="<?php echo base_url('admin/brand')?>">
				<i class="fa fa-pencil"></i>
				<span class="menu-text"> 品牌管理 </span>
			</a>
		</li>
		<li>
			<a href="<?php echo base_url('admin/category')?>">
				<i class="fa fa-cog"></i>
				<span class="menu-text"> 栏目管理 </span>
			</a>
		</li>
		<li>
			<a href="<?php echo base_url('admin/goods/edit')?>">
				<i class="fa fa-cog"></i>
				<span class="menu-text"> 添加商品 </span>
			</a>
		</li>
		<li>
			<a href="<?php echo base_url('admin/goods/')?>">
				<i class="fa fa-cog"></i>
				<span class="menu-text"> 商品列表 </span>
			</a>
		</li>
		<li>
			<a href="<?php echo base_url('admin/settings')?>">
				<i class="fa fa-cog"></i>
				<span class="menu-text"> 系统配置 </span>
			</a>
		</li>
		<li>
			<a href="#">
				<i class="fa fa-text-width"></i>
				<span class="menu-text"> Typography </span>
			</a>
			<ul class="submenu">
				<li>
					<a href="form-elements.html">
						<i class="fa fa-angle-double-right"></i>
						Form Elements
					</a>
				</li>

				<li>
					<a href="form-wizard.html">
						<i class="fa fa-angle-double-right"></i>
						Wizard &amp; Validation
					</a>
				</li>

				<li>
					<a href="#">
						<i class="fa fa-angle-double-right"></i>
						Three Level Menu
					</a>
					<ul class="submenu">
						<li>
							<a href="form-elements.html">
								<i class="fa fa-angle-double-right"></i>
								Form Elements
							</a>
						</li>

						<li>
							<a href="form-wizard.html">
								<i class="fa fa-angle-double-right"></i>
								WizardValidation
							</a>
						</li>

						<li>
							<a href="wysiwyg.html">
								<i class="fa fa-angle-double-right"></i>
								Wysiwyg &amp; Markdown
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
	<div class="sidebar-collapse">
		<i class="fa fa-angle-double-left"></i>
	</div>
</div>