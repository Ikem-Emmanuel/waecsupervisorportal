$(document).ready(function () {

	$(document).on("change", "#nameOfState", function(){
		var statename = $(this).val().trim();
		if(statename != ""){
			$.ajax({
			method: "GET",
			url: "../getLga.php",
			data: "statename="+statename
			}).done(function(data){
				$("#lga").html(data);
			}).fail(function(){

			})
		}
		else{
			$("#lga").html("<option value=''>Select your local government</option>");
			$("#nameOfSchool").html("<option value=''>Select a school</option>");
		}

	});

	$(document).on("change", "#lga", function(){
		var lga = $(this).val().trim();
		if(lga != ""){
			$.ajax({
				method : "GET",
				url : "../getSchools.php",
				data : "lga="+lga
			}).done(function(data){
				$("#nameOfSchool").html(data);
			}).fail(function(){

			})
		}
		else{
			$("#nameOfSchool").html("<option value=''>Select a school</option>");
		}

	});

	$(document).on("keyup", "#search-field", function(){
		var searchVal = $(this).val().trim();
		var office_id = $(this).attr("office-id-attr");
		
		if(searchVal === ""){
			window.location="../viewsupervisors.php";
		}else{
			$.ajax({
				method : "GET",
				url : "../searchsupervisor.php",
				data : "search="+searchVal+"&office_id="+office_id
			}).done(function(data){
				//console.log(data);
				$(".search-result").html(data);
			}).fail(function(){

			})
		} 
	});

	$(document).on("keyup", "#search-officer", function(){
		var searchVal = $(this).val().trim();
		var office_id = $(this).attr("office-id-attr");
		
		if(searchVal === ""){
			window.location="../viewofficers.php";
		}else{
			$.ajax({
				method : "GET",
				url : "../searchofficer.php",
				data : "searchval="+searchVal
			}).done(function(data){
				//console.log(data);
				$(".search-result").html(data);
			}).fail(function(){

			})
		} 
	});
	
	$(document).on("keyup", "#search-all-officers", function(){
			var searchVal = $(this).val().trim();
			var office_id = $(this).attr("office-id-attr");
			
			if(searchVal === ""){
				window.location="../viewofficers.php";
			}else{
				$.ajax({
					method : "GET",
					url : "../searchofficer.php",
					data : "searchAllOfficers="+searchVal
				}).done(function(data){
					//console.log(data);
					$(".search-result").html(data);
				}).fail(function(){

				})
			} 
		});

})