<?php
session_start();
if(isset($_POST['logoff'])){
	unset($_SESSION['login']);
	unset($_SESSION['password']);
	unset($_SESSION['id']);
}
	abstract class ACore{
		
		protected $db;
		
		public function __construct(){
			$this->db = mysql_connect("localhost","root","");
			if(!$this->db){
				exit("Ошибка соединения с базой данных!");
			}
			if(!mysql_select_db("prosto_blog",$this->db)){
				exit("Нет такой базы данных".mysql_error());
			}
			mysql_query("SET NAMES 'UTF8'");
		}
		protected function get_header(){
			include "block/header.php";
		}
		protected function get_left_bar(){
			
			
			echo '<div class="content"><div class="left_sidebar">';
				if(!empty($_POST['enter'])){
					$login = htmlspecialchars(strip_tags($_POST['login']));
					$password = htmlspecialchars(strip_tags($_POST['password']));
					$password = md5($_POST['password']);
					
					$user = mysql_query("SELECT id FROM user WHERE login='$login' AND password='$password'");
					$id_user = mysql_fetch_array($user);
					if(empty($id_user['id'])){
						echo "<center>Ошибка при вводе логина и/или пароля!</center>";
					}
					else{
						$_SESSION['login'] = $login;
						$_SESSION['password'] = $password;
						$_SESSION['id'] = $id;
					}
				}
				if(!$_SESSION['login']){
					echo '<form action="" method="POST" name="auch">
							<table id="table_auch">
								<tr>
									<td colspan="2"><h4>Авторизация</h4></td>
								</tr>
								<tr>
									<td colspan="2"><input type="text" size="20" name="login" placeholder="Логин"/></td>
								</tr>
								<tr>
									<td colspan="2"><input type="password" size="20" name="password" placeholder="Пароль"/></td>
								</tr>
								<tr>
									<td><a href="/?option=reg">Регистрация</a></td>
									<td><input type="submit" name="enter" value="Войти" style="float:right;"/></td>
								</tr>
							</table>
						</form>';
				}
				else {
					echo '<div style=" width:200px; margin: 2px auto 10px auto;">Приветствуем Вас&nbsp;<b>'.$_SESSION['login'].'</b></br>
						<form action="" method="POST">
							<input type="submit" name="logoff" value="Выйти" style="text-align:left;"/>
						</form>
					</div>';
				}
				
			echo '</div>';
		}
		
		protected function get_footer(){
			include "block/footer.php";
		}
		public function get_body(){
			$this->get_header();
			$this->get_left_bar();
			$this->get_content();
			$this->get_footer();
		}
		abstract function get_content();
	}
?>