<?php
require_once ("ACore.php");
	class contacts extends ACore{
		public function get_content(){
			echo '<div class="content_content">';
				echo '<h1>Контакты</h1>
						<p>
						skypeid: procatcar<br/>
						email: prokatcar@gmail.ru<br/>
						icq: 58375492903<br/>
						</p>';
			echo '</div>';
		}
	}
?>