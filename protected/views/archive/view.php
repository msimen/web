<?php
/* @var $this ArchiveController */
/* @var $model Archive */

$this->breadcrumbs=array(
	'Archives'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Archive', 'url'=>array('index')),
	array('label'=>'Create Archive', 'url'=>array('create')),
	array('label'=>'Update Archive', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Archive', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Archive', 'url'=>array('admin')),
);

/** @var CWebApplication $app */
$app = Yii::app();

$app->clientScript->registerCSSFile('/mediaelement/build/mediaelementplayer.css');
$app->clientScript->registerScriptFile('/mediaelement/build/jquery.js', CClientScript::POS_HEAD);
$app->clientScript->registerScriptFile('/mediaelement/build/mediaelement-and-player.min.js', CClientScript::POS_HEAD);

//Yii::app()->clientScript->registerCSSFile('http://vjs.zencdn.net/4.5/video-js.css');
//Yii::app()->clientScript->registerScriptFile('http://vjs.zencdn.net/4.5/video.js', CClientScript::POS_HEAD);
?>

<h1>View Archive #<?php echo $model->id; ?></h1>


<?php

$frame = new VideoFrame();

//echo $frame->view($model->file);
//http://10.154.28.208/rec/1/2014-03-16/17_22_47_UID_1__CID_9_rec.avi
$url = '';
if($model->pathMp4()){
    //echo $frame->view($this->createUrl('stream',array('id'=>$model->id)));
    $url = $this->getUrl($model->id);
    echo $frame->view($url);
    //$frame = new CamFrame(new CamSettings());
    //echo $frame->fpf_plugin($url);
    //echo $frame->fp5_plugin($url);
}
else{
    if(!$model->pathAvi()){
        echo 'Файл не найден';
    }
    else{
        echo 'Поток не является h264, просмотр на мобильных устройствах не возможен<br>';
        $frame = new CamFrame(new CamSettings());
        $url = $this->getUrl($model->id);
        //echo $frame->vlc2_plugin($this->getFile($model->pathAvi()));
        echo $frame->vlc2_plugin($url);
    }
}
echo '<br>';
//if($url!='') echo CHtml::link("Скачать",$this->getDownloadUrl($model->id), array('class'=>'archive'));
//if($url!='') echo CHtml::link("Скачать",$url, array('class'=>'archive'));
if($url!='') echo CHtml::link("Скачать",$this->createUrl('file',array('id'=>$model->id)), array('class'=>'archive'));
?>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cam_id',
		'type',
		'date_start',
		'date_end',
		'date_rebuild',
		'time_rebuild',
		'rebuilded',
		'watched',
		'file',
	),
)); ?>
