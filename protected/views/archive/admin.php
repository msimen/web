<?php
/* @var $this ArchiveController */
/* @var $model Archive */

$this->breadcrumbs=array(
	'Archives'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Archive', 'url'=>array('index')),
	array('label'=>'Create Archive', 'url'=>array('create')),
);

/** @var CWebApplication $app */
$app = Yii::app();
$app->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#archive-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Archives</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'archive-grid',
	'dataProvider'=>$model->search(1,1,1),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'cam_id',
		'type',
		'date_start',
		'date_end',
		'date_rebuild',
        'h1',
        'h2',
		/*
		'time_rebuild',
		'rebuilded',
		'watched',
		'file',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
