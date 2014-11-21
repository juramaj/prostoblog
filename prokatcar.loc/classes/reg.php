<?php
	class reg extends ACore{
		public function get_content(){
		
			echo '<div class="content_content">';
			
			
			if(!empty($_POST['registr'])){
				$login = htmlspecialchars(strip_tags($_POST['login']));
				$password1 = htmlspecialchars(strip_tags($_POST['password']));
				$password2 = htmlspecialchars(strip_tags($_POST['password_2']));
				
				if(strlen($login) < 2) {
					echo '<center style="color:red;">Логин не должен быть менее 2-х символов!</center>';
				}
				else if(strlen($password1) < 3) {
					echo '<center style="color:red;">Пароль не должен быть менее 3-х символов!</center>';
				}
				else if($password1 != $password2){
					echo '<center style="color:red;">Пароли не совпадают!</center>';
				}
				else{
					$result = mysql_query("SELECT id FROM user WHERE login='$login'");
					$myrow = mysql_fetch_array($result);
					if (!empty($myrow['id'])) {
						echo ("<center style='color:red;'>Пользователь с таким логином уже зарегистрирован. Придумайте другой логин!</center>");
					}
					else{
						$password1 = md5($_POST['password']);
						
						$result2 = mysql_query("INSERT INTO user (login, password) VALUES ('$login', '$password1')");
						if($result2 == 'true'){
							echo '<center style="color:green;">Поздравляем, Вы успешно зарегистрировались!</br> Пройдите авторизацию.</center>';
						}
					}
				}
			}
			if(!$_SESSION['login']){
				echo '<h1 style="text-align:center; margin-bottom:15px;">Форма регистрации!</h1>
						<p>
							<form name="form_reg" action="" method="POST">
								<table class="registr_tb">
									<tr>
										<td colspan="2"><input type="text" size="30" name="login" placeholder="Логин"/><td>
									</tr>
									<tr>
										<td colspan="2"><input type="password" size="30" name="password" placeholder="Введите пароль"/><td>
									</tr>
									<tr>
										<td colspan="2"><input type="password" size="30" name="password_2" placeholder="Повторите пароль"/><td>
									</tr>
									<tr>
										<td><input type="reset" name="reset" value="Очистить"/></td>
										<td><input type="submit" name="registr" value="Зарегистрироватся" style="float:right;" onclick="return getValidate(this.form)"/></td>
									</tr>
								</table>
							</form>
						</p>';
			}
			else{
				echo "<center style='color:red;'>Вы уже зарегистрированы!</center>";
			}
			echo '</div>';
		}
	}
?>