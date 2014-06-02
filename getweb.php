<html>
<meta http-equiv="content-type" content="text/html"  charset="utf-8" />
<?php
	require('phpQuery.php');
	$input = $_GET['con'];
	$page = $_GET['page'];				//查询页码
	echo 'this is page page: '.$page.'<br />';
?>	
<head>
	<title>Scoper</title>
	<script type="text/javascript" src="KickStart/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="KickStart/js/kickstart.js"></script>
	<link rel="stylesheet" href="KickStart/css/kickstart.css" media="all"/>
	<link rel="stylesheet" href="top.css" media="all"/> 
</head>
<body>
	<div id="wrapper">
		<div id="main">
			<img src="image/logo_small.png" alt="logo_small.png">
			<form id="main_form">
				<input id ="text1" type="text" name="con"/>	
				<button class="tooltip medium blue pop" value=1 name='page'><i class ="icon-search"></i>Search</button>
			</form>
		</div>
		<hr class="alt2"/>
		<div id="right">
		</div>
		<div id="content">
		<?php
			class man_info{
				public $name;			//名字
				public $refer;
				public $price;			//价格
				public $price_old;		//旧价格
				public $key_word;		//搜索关键词
				public $place_info;	//地点
				public $trans_pay;		//运费
				public $pic_url;		//图片url
				public $source;		//来源
			}	
			include ('get_taobao.php');
			
		//	include ('get_amazon.php');
			$amz_data = [];
			$merged = array_merge($amz_data, $tb_data);
			function obj_arr_cmp($a, $b){
				if(intval($a->price) == intval($b->price)){
					return 0;
				}
				return (intval($a->price)<intval($b->price))?-1:1;
			}
			usort($merged, "obj_arr_cmp");
			foreach($merged as $key){
			?>
			<div class="col_3">
				<div class ="item_pic">
					<?php echo '<a href="'.$key->refer.'" target="blank"><img src="'.$key->pic_url.'"></img></a>'; ?>
				</div>
				<div class="item_info">
					<div class="item_name">
						<p class="Name_p"><?php echo '<a href="'.$key->refer.'"target="blank">'.$key->name.'</a>'; ?></p>
					</div>
					<div>
						<div class="price">
							<div class="item_price">
								<?php echo '￥'.$key->price; ?>
							</div>
							<div class= "item_origin_price"><strike>
								<?php if($key->price_old)
									echo '￥'.$key->price_old;?>
							</strike></div>
						</div>
						<div class="shop_addr">
							<div class="trans_pay">
								<?php echo $key->trans_pay; ?>
							</div>
							<div class="addr">
								<i class="icon-exchange"></i>
								<?php echo $key->place_info; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<div id = "pagepick">
				<?php
					function displayend(){
						echo '<span class="lose">...</span>';
						echo '<button class="pickpage square medium" value=20>20</button>';
					}
					function displayhead(){
						echo '<button class="pickpage square medium" value=1>1</button>';
						echo '<span class="lose">...</span>';
					}
					if($page>3 && $page<18){
						displayhead();
						echo '<button class="pickpage square medium" value='.($page-1).'>'.($page-1).'</button>';
						echo '<button class="pickpage square medium" value='.$page.'>'.$page.'</button>';
						echo '<button class="pickpage square medium" value='.($page+1).'>'.($page+1).'</button>';
						displayend();
					}
					else if($page<=3){
						for($i=1;$i<5;$i++){
							echo '<button class="pickpage square medium" value='.$i.'>'.$i.'</button>';
						}
						displayend();
					}
					else{
						displayhead();
						for($i=16;$i<21;$i++){
							echo '<button class="pickpage square medium" value='.$i.'>'.$i.'</button>';
						}
					}
				?>
			</div>
		</div>
	<hr class="alt2"/>
	</div>
</body>
</html>