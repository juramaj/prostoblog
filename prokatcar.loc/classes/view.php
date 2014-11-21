<?php
	class view extends ACore{
		public function get_content(){
		
			echo '<div class="content_content">';
		
			if(!$_GET['station']){
				exit ("Не правильный адресс!");
			}
			else{
				$station = trim(strip_tags($_GET['station']));
				
				if(!$station = (int)($_GET['station'])){
					echo "Нет такой статьи!";
				}
				else{
				
					if(!$station){
						echo "Не коректные данные для вывода статьи!";
					}
					else {
						$query = "SELECT title,date,full_text FROM station WHERE id='$station'";
						$query2 = "SELECT title,date,full_text FROM station";
						$result2 = mysql_query($query2);
						
						$result = mysql_query($query);
						if(!$result){
							exit(mysql_error());
						}
					}
						$koll = mysql_num_rows($result2);
						if($station > $koll){
							echo "Нет такой статьи!";
						}
						else{
							$row = mysql_fetch_array($result,MYSQL_ASSOC);
							printf ("<div style='border-bottom: 2px dashed #6383A8;'><h2>%s</h2></br>
							<u>Дата публикации:</u> <i>%s</i></br>
							<span>%s</span></br></div>
							",$row['title'],$row['date'],$row['full_text']);
							$query_comment = "SELECT id,text_comment,login_comment,id_station_comment,date_comment FROM comment_station WHERE id_station_comment='$station' ORDER BY id DESC";
							$result_comment = mysql_query($query_comment);
							$koll_comment = mysql_num_rows($result_comment);
							if(!$result_comment){
								exit(mysql_error());
							}
							else{
								if($koll_comment < 1 ){
									echo "<h3 style='text-align:center; color:#6383A8;'>Комментариев нет!</h3>";
								}
								else{
									echo "<h3 style='text-align:center; color:#6383A8; margin-top:10px;'>Комментарии</h3>";
									for($i = 0; $i < mysql_num_rows($result_comment); $i++){
										$row_comment = mysql_fetch_array($result_comment,MYSQL_ASSOC);
										printf ("<div style='width:550px;  padding:5px; margin-left:40px; margin-bottom:5px; border-left: 5px solid #6383A8; border-top: 1px solid #6383A8; border-right: 1px solid #6383A8; border-bottom: 1px solid #6383A8;'>
													<table style='width:550px;'>
														<tr>
															<td style='font-size:14px; width:400px;'><b>%s</b></td>
															<td style='font-size:14px; width:150px; text-align:right;'><u>%s</u></td>
														</tr>
													</table>
													</hr>
													<p><i>%s</i></p>
										
										</div>",$row_comment['login_comment'],$row_comment['date_comment'],$row_comment['text_comment']);
									}
								}
							}
							if($_SESSION['login']){
								if(!empty($_POST['int_comment'])){
									$text_comment = htmlspecialchars(strip_tags($_POST['text_comment_ins']));
									$login = ($_SESSION['login']);
									$station = trim(strip_tags($_GET['station']));
									$date = date("d.m.Y G:i");
									$result_comment_ins = mysql_query("INSERT INTO comment_station (text_comment, login_comment, id_station_comment, date_comment) VALUES ('$text_comment', '$login', '$station', '$date')");
									if($result_comment_ins == 'true'){
										echo "Вы удачно добавили комментарий!";
									}
								}
								echo "
									<div style='margin-left:40px;'>
										<form action='' method='POST'>
											<textarea name='text_comment_ins' placeholder='Ваш комментарий' cols='78' rows='5' style='margin-bottom:3px;'></textarea></br>
											<input type='submit' name='int_comment' value='Добавить комментарий'/>
										</form>
									</div>";
							}
							else{
								echo "Чтобы оставить комментарий Вам нужно <a href='/?option=reg'>зарегистрироватся</a> или авторизироватся.";
							}
						}
				}	
			}
			echo '</div>';
		}
	}
?>