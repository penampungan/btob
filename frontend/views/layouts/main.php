<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use frontend\assets\AppAsset;
// AppAsset::register($this);
// use frontend\assets\AppAssetFreelancer;
// AppAssetFreelancer::register($this);

dmstr\web\AdminLteAsset::register($this);


	$menu='
		<ul class="sidebar-menu">
			<li class="active">
				<a href="#">
					<i class="fa fa-dashboard"></i> <span>Élément</span>
				</a>
			</li>
			<li>
				<a href="#">
					 <i class="fa fa-th"></i>  <span>Élément 2 </span>
					 <small class="badge pull-right bg-green">new </small>
				</a>
			</li>
			<li class="treeview">
				<a href="#">
					 <i class="fa fa-bar-chart-o"></i>
					 <span>Élément 3 </span>
					 <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					 <li>
						<a href="#"><i class="fa fa-angle-double-right"></i> Sous-élément 1</a></li>
					 <li>
						<a href="#"><i class="fa fa-angle-double-right"></i> Sous-élément 2</a></li>
					 <li>
						<a href="#"><i class="fa fa-angle-double-right"></i> Sous-élément 3</a></li>
				</ul>
			</li>
		</ul>
								
	';
?>
<?php $this->beginPage() ?>
	<!DOCTYPE html>
	<html lang="<?= Yii::$app->language ?>">
		<head>
			<meta charset="<?= Yii::$app->charset ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<?= Html::csrfMetaTags() ?>
			<title><?= Html::encode($this->title) ?></title>
			<?php $this->head() ?>
		</head>
		<!-- 
			Default collapse ~ptr.nov~ 
			skin-blue sidebar-mini sidebar-collapse
		!-->
		<body class="skin-blue sidebar-collapse" style="min-height:680px"> 		
			<! - NOT LOGIN- Author : -ptr.nov- >
			<?php if (Yii::$app->user->isGuest) { ?>
				<?php $this->beginBody(['id'=>'page-top','class'=>'index']) ?>
					<div class="wrap">
						<!-- NAV BAR !-->
						<?=$this->render('main-navbarNologin')?>
						<!-- BODY CONTAINER !-->
						<div>
							<?= $content ?>
						</div>
					</div>
					<!-- FOOTER !-->
					<?=$this->render('main-footer')?>
				<?php $this->endBody() ?>
			<?php }; ?>
			<! -LOGIN- Author : -ptr.nov- >
			<?php if (!Yii::$app->user->isGuest) { ?>
				<?php $this->beginBody(['id'=>'page-top','class'=>'index']) ?>
					<div class="wrap">
						<!-- TOP NAV BAR !-->
						<?=$this->render('main-navbar')?>
						<!-- LEFT MENU !-->										
						<?=$this->render('mainleft',['menu'=>$menu]); ?>
						<!-- BODY CONTAINER !-->	
						<?=$this->render('mainContent',['content'=>$content]); ?>	
						<!-- FOOTER !-->
						<?=$this->render('main-footer')?>						
					</div>
					
				<?php $this->endBody() ?>
			<?php }; ?>
		</body>
	</html>
<?php $this->endPage() ?>
