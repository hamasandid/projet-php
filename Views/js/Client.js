$(function()
{
	$("#form_client").validate(
		{

		rules: {
			nom:  {
				required: true,
				minlength: 2
			},
			prenom: {
				required: true,
				minlength: 2
			},
			email: {
				required: true,
				email: true
			},
			mdp: {
				required: true,
				minlength: 5,
			},
			tel: {
				required: true,
				number: true,
				minlength:8,
                maxlength: 8,
			},
			adresse: {
				required: true,
				minlength: 3
			},
		},

		messages: {
			nom: {
				required: "Required field",
				minlength: " It must contain at least 2 characters",
			},
			prenom: {
				required: "Required field",
				minlength: " It must contain at least 2 characters",
			},
			email: {
				required: "Required field",
				email: " The email is invalid",
			},
			mdp: {
				required: "Required field",
				minlength: " It must contain at least 5 characters",
			},
			tel: {
				required: "Required field",
				number: " It must contain only numbers",
				minlength:"It must contain 8 numbers",
				maxlength:"It must contain 8 numbers",
			},
			adresse: {
				required: "Required field",
				minlength: " It must contain at least 3 characters",
			},
			
		},
        success: function(label) {
            label.text("\u2713 ").addClass("valid");
        }
	});
});