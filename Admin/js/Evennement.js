$(function()
{
	$("#form_event").validate(
		{

		rules: {
			nom:  {
				required: true,
				minlength: 2
			},
			lieu: {
				required: true,
				minlength: 2
			},
			info: {
				required: true,
				minlength: 5
			},
		},

		messages: {
			nom: {
				required: "Champ obligatoire",
				minlength: " Le nom doit contenir au moins 2 caractères",
			},
			lieu: {
				required: "Champ obligatoire",
				minlength: " Le lieu doit contenir au moins 2 caractères",
			},
			info: {
				required: "Champ obligatoire",
				minlength: " L'information doit contenir au moins 5 caractères",
			},


		}
	});
});