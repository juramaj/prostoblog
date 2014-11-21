<div class="content_content">
		<?php 
			if($_GET['option']){
				$class = trim(strip_tags($_GET['option']));
			}
			else {
				$class = 'main';
			}
			if (file_exists("classes/".$class.".php")){
				include ("classes/".$class.".php");
				if (class_exists($class)){
					$obj = new $class;
					$obj->get_body();
				}
				else {
					exit ("Не правильные данные для входа!");
				}
			}
			else {
				exit ("Не правильный адресс!");
			}
		?>
	</div>
</div>