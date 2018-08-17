$("#comuna").change(function(event){

	$.get("tablereportsest/"+ event.target.value+"",function (response,comuna){
		$("#establecimiento").empty();
		$("#establecimiento").append("<option value=''>Seleccione Establecimiento</option>");
		for(i=0; i<response.length; i++){
			$("#establecimiento").append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
		}
	});
});



$("#jsoncategorie_id").change(function(event){

	$('#items').empty();
	var categorie = $(this).val();

	if (categorie == ''){
		$('#items').empty();
	}else{
		//alert('/facturas/categoria/' + categorie);	
		$.get('/facturas/categoria/' + categorie , function (response) {
		
		for(i=0; i<response.length; i++){
			$("#items").append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
		}

		});	

	}


});	
	

$("#jsonprovider_id").change(function(event){

	$('#jsoncategorie_id').empty();
	$('#items').empty();
	
	var provider = $(this).val();

		$.get('/facturas/provider/' + provider , function (response) {

		$("#jsoncategorie_id").append("<option value=''>Seleccione Categoria</option>");

		
		for(i=0; i<response.length; i++){
			$("#jsoncategorie_id").append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
		}

		});	


});	


	

