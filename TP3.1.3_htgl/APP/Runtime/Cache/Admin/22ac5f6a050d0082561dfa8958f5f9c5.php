<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<html xmlns="http://www.w3.org/1999/xhtml">
	<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
	<link rel="stylesheet" href="__PUBLIC__/Css/public.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/node.css">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>权限分配列表</title>
	<script type="text/javascript">
	$(function(){
		$('input[level=1]').click(function(){
			var inputs = $(this).parents('.app').find('input');
			$(this).attr('checked') ? inputs.attr('checked','checked') :
			inputs.removeAttr('checked');
		});
		$('input[level=2]').click(function() {
			var inputs = $(this).parents('dl').find('input');
			$(this).attr('checked') ? inputs.attr('checked','checked') :
			inputs.removeAttr('checked');
		});
	});
	</script>

</head>
<body>
	<form action="<?php echo U('Admin/Rbac/setAccess');?>" method="post">
		<div id="wrap">
			<a  href="<?php echo U('Admin/Rbac/role');?>"class="add-app">返回</a>
			<?php if(is_array($node)): foreach($node as $key=>$app): ?><div class="app">
					<p>
						<strong><?php echo ($app["title"]); ?></strong>
						<input type="checkbox" name="access[]"  value="<?php echo ($app['id']); ?>_1" level="1"<?php if($app["access"]): ?>checked="checked"<?php endif; ?>/>
					</p>
					<?php if(is_array($app["child"])): foreach($app["child"] as $key=>$action): ?><dl>
							<dt>
								<strong><?php echo ($action["title"]); ?></strong>
								<input type="checkbox" name="access[]" value="<?php echo ($action['id']); ?>_2" level="2" <?php if($action["access"]): ?>checked="checked"<?php endif; ?>/>
							</dt>
						
							<?php if(is_array($action["child"])): foreach($action["child"] as $key=>$method): ?><dd>
									<span><?php echo ($method["title"]); ?></span>	
									<input type="checkbox" name="access[]" value="<?php echo ($method['id']); ?>_3" level="3" <?php if($method["access"]): ?>checked="checked"<?php endif; ?>/>					
								</dd><?php endforeach; endif; ?>
						</dl><?php endforeach; endif; ?>
				</div><?php endforeach; endif; ?>
		</div>
		<input type="hidden" name="rid" value="<?php echo ($rid); ?>">
		<input type="submit" value="保存提交" style="margin:20px 500px; border-radius:4px;cursor: pointer;">
	</form>
</body>
</html>