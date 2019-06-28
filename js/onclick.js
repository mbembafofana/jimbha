	//Menu Hamburger
		$(function()
		{
			$("#hamburger").click(function()
			{
				$("#sideButton").hide();
				$("#menu_left").show();
			});
		});
		$(function()
		{
			$("#closeHamburger").click(function()
			{
				$("#sideButton").show();
				$("#menu_left").hide();
			});
		});
		$(function()
		{
			$("#menu_left").hide();
		});

	//Rechercher
		$(function()
		{
			$("#barre_recherche").hide();
			/*$("#input_search").hide();
			$("#submit_recherche").hide();*/
		});

		$(function()
		{
			$("#search").click(function()
			{
				$("#barre_recherche").toggle();
				/*$("#input_search").toggle();
				$("#submit_recherche").toogle();*/
			});
		});

