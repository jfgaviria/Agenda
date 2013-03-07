<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::t('core', 'Create :type', array(':type'=>Rights::getAuthItemTypeName($_GET['type']))),
); ?>

<div class="createAuthItem" class="box grid_12">

	<div class="box-head"><h2><?php echo Rights::t('core', 'Create :type', array(
		':type'=>Rights::getAuthItemTypeName($_GET['type']),
	)); ?></h2></div>

	<div class="box-content">
	<?php $this->renderPartial('_form', array('model'=>$formModel)); ?>
	</div>

</div>