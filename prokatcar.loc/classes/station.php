<?php
require_once ("ACore.php");
	class station extends ACore{
		public function get_content(){
			
			
			$query = "SELECT id,title,intro_text,date FROM station ORDER BY id DESC";
			$result = mysql_query($query);
			if(!$result){
				exit(mysql_error());
			}
			
			echo '<div class="content_content">';
				$row = array();
				for($i = 0; $i < mysql_num_rows($result); $i++){
					$row = mysql_fetch_array($result, MYSQL_ASSOC);
						printf("<span style='margin-bottom:5px;'><h2>%s</h2></br>
						<u>Дата публикации:</u> <i>%s</i></br>
						<span>%s</span></br>
						<p><a href='?option=view&station=%s'>Подробнее ...</a></p></span><hr style='background-color:#ccc; height:2px;'>
						
						",$row['title'],$row['date'],$row['intro_text'],$row['id']);
				}
			echo '</div>';
		}
	}
?>
