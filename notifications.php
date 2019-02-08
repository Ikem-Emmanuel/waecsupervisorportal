<?php 
class Notifications{
	public function __construct(){}
	
	public function successMessage($message){
		return "<div class='container'><div class='row'><div class='col-md-6 col-md-offset-3 bg-primary top_200'>".$message."</div></div></div>";

	}
	
	public function errorMessage($message){
		return "<div class='container'><div class='row'><div class='col-md-6 col-md-offset-3 bg-danger top_200'>".$message."</div></div></div>";
	}
}
?>