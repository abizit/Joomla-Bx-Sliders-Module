<?php
/**
 * Style 1
 */
// no direct access
defined('_JEXEC') or die;
?>
<ul class="bxslider">
  <?php for($i=0;$i<20;$i++):?>
  <?php if(!empty($Image[$i])):?>
  <li>
  	<div class="bx-slider-info">
  	<h2><?php echo $Title[$i]; ?></h2>
          <p><?php echo $Text[$i]; ?></p>  
           <?php if ($Link[$i] != null) {echo '<a href="'.$Link[$i].'" class="bx-link-readmore">'.JText::_('MOD_BX_SLIDER_READMORE_LINK').'</a>';}?>

       </div>

                <div class="bx-slider-image"><?php echo '<img src="'.$Image[$i].'"/>';?></div>
  </li>
  <?php endif;?>
  <?php endfor; ?>
</ul>