An error occurred...
<br>
<hr>
<br>
<?php

if ($context->data != null)
	print_r($context->data);
echo '<hr>';
if ($context->tmp != null)
	print_r($context->tmp);
echo '<hr>';
if ($context->tweets != null)
	print_r($context->tweets);

?>
