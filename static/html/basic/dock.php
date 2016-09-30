<div id="dock_main">
	<div id="dock_bar">
		<div id="dock_logo">Ukeys</div>
		<div id="dock_msg"><?php if($manager == 1){ ?>系统管理员<?php } else {echo "公众账号";} ?>已登录<br />welcome to ukeys</div>

		
		<div id="dock_menu">
			<button class="dock_btn" onclick="location.href='/index.php'">Homepage</button>
			<button class="dock_btn" onclick="location.href='/index.php/blog'">Blogs</button>
			<button class="dock_btn" onclick="location.href='/index.php/album'">Album</button>

			<div class="dock_btn_plus" id="dock_manage">
				<button class="dock_btn" id="dock_mng">User</button>
				
				<button class="manage_plus" onclick="location.href='/index.php/setting'">设置</button>
				<button class="manage_plus" onclick="location.href='/index.php/private'">个人页</button>
				<?php if($manager == 1) { ?>
					<button class="manage_plus" onclick="location.href='/index.php/manager'">管理</button>
				<?php  } ?>
				<?php if(isset($name)) { ?>
				<button class="manage_plus" onclick="location.href='/index.php/logout'">注销</button>
				<?php } else { ?>
					<button class="manage_plus" onclick="location.href("/index.php/login")">
						登录
					</button>
					<button class="manage_plus">注册</button>
			    <?php } ?>
			</div> <!-- end of #dock_manage -->
			
		</div>
		<button id="dock_menu_key" style="display:none; float:right;width:30px; height:30px; border:0; background:white; margin:20px 10px 0 0";>三</button>
	</div>
</div>
<script src="/js/basic/dock.js"></script>
