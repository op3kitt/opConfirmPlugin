<?php decorate_with('layoutC') ?>

<div class="dparts preview"><div class="parts">
<div class="partsHeading">
<?php $pageName = ''; foreach(preg_split('/_/s',$form->getName()) as $str): $pageName .= ucfirst($str)." "; endforeach; ?>
<h3><?php echo __(trim($pageName)) ?><?php echo __('confirm page') ?></h3>
</div>
<?php include_partial('previewForm', array('form' => $form, 'modify' => $modify)) ?>
</div>
</div>