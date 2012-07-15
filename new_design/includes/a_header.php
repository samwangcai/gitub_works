<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script language="javascript" src="js/jquery-1.4.2.min.js"></script>
	<script language="javascript" src="js/jquery.ui.core.min.js"></script>
	<script language="javascript" src="js/jquery.ui.widget.min.js"></script>
	<script language="javascript" src="js/jquery.ui.mouse.min.js"></script>
	<script language="javascript" src="js/jquery.ui.draggable.js"></script>
	<script language="javascript" src="js/jquery.ui.sortable.js"></script>
	<script language="javascript" src="js/commend.js"></script>
	<script  src="xheditor/xheditor-en.min.js" type="text/javascript"></script>
	<div class="header">
		<img src="images/logo.gif" class="logo" />
		<div class="info">
			<p>
				Welcome: <? echo $_SESSION['uname']; ?></b> <a href="<?php echo $logoutAction ?>" class="loginbtn">logout</a>
			</p>
			<p>
				<a href="admin.php">回到管理首页</a> &nbsp; 
				<a href="order.php">网站内容排序</a>
			</p>
		</div>
		<div class="space"></div>
	</div>