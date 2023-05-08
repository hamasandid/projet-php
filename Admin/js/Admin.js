$(function()
{
	$("#form_admin").validate(
		{

		rules: {
			nomuser:  {
				required: true,
				minlength: 2
			},
			email: {
				required: true,
				email: true
			},
			mdp: {
				required: true,
				minlength: 3
			},
			tel: {
				required: true,
				number: true
			},
		},

		messages: {
			nomuser: {
				required: "Champ obligatoire",
				minlength: " Le nom d'utilisatuer doit contenir au moins 2 caractères",
			},
			email: {
				required: "Champ obligatoire",
				email: " L email est invalide",
			},
			mdp: {
				required: "Champ obligatoire",
				minlength: " La mot de passe doit contenir au moins 3 caractères",
			},
			tel: {
				required: "Champ obligatoire",
				number: " La telephone doit contenir des numeros",
			},
		}
	});
});