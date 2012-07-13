<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script language="javascript" src="js/jquery-1.4.2.min.js"></script>
	<script language="javascript" src="js/jquery.ui.core.min.js"></script>
	<script language="javascript" src="js/jquery.ui.widget.min.js"></script>
	<script language="javascript" src="js/jquery.ui.mouse.min.js"></script>
	<script language="javascript" src="js/jquery.ui.draggable.js"></script>
	<script language="javascript" src="js/jquery.ui.sortable.js"></script>
	<script language="javascript" src="js/commend.js"></script>
	<div class="header">
		<img src="images/logo.gif" class="logo" />
		<div id="aaa"></div>
		<table style="float:right">
			<tr>
				<td><b>Welcome: <? echo $_SESSION['uname']; ?></b> <a href="<?php echo $logoutAction ?>" class="loginbtn">logout</a></td>
			</tr>
		</table>
	</div>