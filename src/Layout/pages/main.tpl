<!DOCTYPE html>
<html lang="en">
<head>
	{insert "chunks/head.tpl"}
</head>
<body>
	<div class="container py-5">
		{if $content?}
			{include "contents/{$content}.tpl"}
		{/if}
	</div>
</body>
</html>