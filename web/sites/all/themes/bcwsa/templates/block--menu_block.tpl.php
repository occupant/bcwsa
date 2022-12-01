<?php
// template for blocks in the Navigation area (kills off extra markup)
?>
<?php if ($block->subject): ?>
<h2<?php print $title_attributes; ?>><?php print $block->subject ?></h2>
<?php endif;?>
<?php print $content ?>