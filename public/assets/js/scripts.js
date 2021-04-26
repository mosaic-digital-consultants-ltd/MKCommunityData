
function scroll_to_class(chosen_class) {
	var nav_height = $('nav').outerHeight();
	var scroll_to = $(chosen_class).offset().top - nav_height;

	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 1000);
	}
}

function isNumber(evt) {
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	return true;
}

function populate_preview() {
	var showSubmit = true;
	// var selectedText = $("#combobox").find("option:selected").text();

	var selectedText = $(".custom-combobox-input").data("uiAutocomplete").selectedItem.label;
	var formField = document.getElementById("selOrg_field");
	var select = document.getElementById("combobox");
	for (var i = 0; i < select.length; i++){
		var option = select.options[i]; // now have option.text, option.value
		if (option.text == selectedText) {

			// take the org id & put in the form that's sent to the server
			formField.value = option.value;
			break;
		}
	}
	document.getElementById("previewOrg").innerText = selectedText;
	selectedText = $("#selCat").find("option:selected").text();
	document.getElementById("previewCat").innerText = selectedText;
	selectedText = $("#textBrief").val();
	if (selectedText.length == 0) {
		selectedText = "<span class='text-danger'>No text supplied.</span>";
		showSubmit = false;
	}
	document.getElementById("previewBrief").innerHTML = selectedText;
	selectedText = $("#textFull").val();
	document.getElementById("previewFull").innerText = selectedText;
	selectedText = $("#inputAffected").val();
	document.getElementById("previewAffected").innerHTML = selectedText;

	// selectedText = $('#age-groups option:selected').toArray().map(item => item.text).join();
	// document.getElementById("previewAge").innerText = selectedText;
	selectedText = $('#estates option:selected').toArray().map(item => item.text).join();
	if ($('#estates option:selected').toArray().length == 0)
	{
		selectedText = "<span class='text-danger'>No location entered.</span>";
		showSubmit = false;
	}
	document.getElementById("previewLoc").innerHTML = selectedText;

	locText = $("#inputName").val();
	locText1 = $("#inputEmail").val();
	locText2 = $("#inputPhone").val();
	document.getElementById("previewContact").innerHTML = locText + " " + locText1 + " " + locText2;

	var locText = $("#selAct").find("option:selected").text();
	locText2 = $("#inputAction").val();
	if (($("#selAct").val() == 0) && (locText2.length == 0)) {
		locText = "<span class='text-danger'>No action specified.</span>";
		showSubmit = false;
	}
	else { locText += " : " + locText2 ; }
	document.getElementById("previewAct").innerHTML = locText;

	if ($("#combobox").val() == 0) {
		document.getElementById("previewOrg").innerHTML = "<span class='text-danger'>No organisation selected.</span>";
		showSubmit = false;
	}
	if ($("#selCat").val() == 0) {
		document.getElementById("previewCat").innerHTML = "<span class='text-danger'>No category selected.</span>";
		showSubmit = false;
	}

	if (showSubmit)
	{
		$("#realSubmitButton").show();
	}
	else
	{
		$("#realSubmitButton").hide();
	}
}

function check_value() {
	var info = $('#info');
	var termsblk = $('#previewTerms');
	var text = '';

	var labelArray = [];
	var htmlElem = '';
	var formArray = [];


	$(".keyselector").each(function(){
		//do stuff here

		var jString = $(this).data('selected');

		text += jString + '</p>';

		var obj = JSON.parse(jString);

		$.each(obj, function(index, element) {
			if (labelArray.indexOf(element.label) === -1) {
				labelArray.push(element.label);
				formArray.push(element.value);
			}
		});

	});

	// loop through the array of labels & make little button
	if (labelArray.length == 0) {
		htmlElem = "<span class='text-danger'>No terms selected.</span>";
	}
	else {
		for (var i = 0; i < labelArray.length; i++) {
			htmlElem += "<div class='t1_tag tag_selected'>" + labelArray[i] + "</div>";
		}
	}

	termsblk.html(htmlElem );
	document.getElementById("keywordArray").value= JSON.stringify(formArray);

}




jQuery(document).ready(function() {

	/*
	    Fullscreen background
	*/
	$.backstretch("/assets/img/backgrounds/7.jpg");

	/*
	    Multi Step Form
	*/
	$('.msf-form form fieldset:first-child').fadeIn('slow');
	
	// next step
	$('.msf-form form .btn-next').on('click', function() {
		$(this).parents('fieldset').fadeOut(400, function() {
	    	$(this).next().fadeIn();
			scroll_to_class('.msf-form');
	    });
	});
	
	// previous step
	$('.msf-form form .btn-previous').on('click', function() {
		$(this).parents('fieldset').fadeOut(400, function() {
			$(this).prev().fadeIn();
			scroll_to_class('.msf-form');
		});
	});


	// first step
	$('.msf-form form .btn-start').on('click', function() {
		$(this).parents('fieldset').fadeOut(400, function() {
			$(this).parent().children().first().fadeIn();
			scroll_to_class('.msf-form');
		});
	});

	$("[required]").css({ "text-decoration": "underline",
	"text-decoration-color": "red", "text-decoration-thickness": "2px"});
	
});

	function showHideRow(row) {
		$("#" + row).toggle();
	}

$( function() {
	$.widget( "custom.combobox", {
		_create: function() {
			this.wrapper = $( "<span>" )
				.addClass( "custom-combobox" )
				.insertAfter( this.element );

			this.element.hide();
			this._createAutocomplete();
			this._createShowAllButton();
		},

		_createAutocomplete: function() {
			var selected = this.element.children( ":selected" ),
				value = selected.val() ? selected.text() : "";

			this.input = $( "<input>" )
				.appendTo( this.wrapper )
				.val( value )
				.attr( "title", "" )
				.attr("id", "selOrg")
				.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
				.autocomplete({
					delay: 0,
					minLength: 0,
					source: $.proxy( this, "_source" )
					// ,
					// select: function (event, ui){
					// 	$("#dummy").val(ui.item.id);
					// 	return false;
				})
				.tooltip({
					classes: {
						"ui-tooltip": "ui-state-highlight"
					}
				});

			this._on( this.input, {
				autocompleteselect: function( event, ui ) {
					ui.item.option.selected = true;
					this._trigger( "select", event, {
						item: ui.item.option
					});
				},

				autocompletechange: "_removeIfInvalid"
			});
		},

		_createShowAllButton: function() {
			var input = this.input,
				wasOpen = false;

			$( "<a>" )
				.attr( "tabIndex", -1 )
				.attr( "title", "Show All Items" )
				.tooltip()
				.appendTo( this.wrapper )
				.button({
					icons: {
						primary: "ui-icon-triangle-1-s"
					},
					text: false
				})
				.removeClass( "ui-corner-all" )
				.addClass( "custom-combobox-toggle ui-corner-right" )
				.on( "mousedown", function() {
					wasOpen = input.autocomplete( "widget" ).is( ":visible" );
				})
				.on( "click", function() {
					input.trigger( "focus" );

					// Close if already visible
					if ( wasOpen ) {
						return;
					}

					// Pass empty string as value to search for, displaying all results
					input.autocomplete( "search", "" );
				});
		},

		_source: function( request, response ) {
			var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
			response( this.element.children( "option" ).map(function() {
				var text = $( this ).text();
				if ( this.value && ( !request.term || matcher.test(text) ) ) {

					return {
						label: text,
						value: text,
						option: this
					};
				}
			}) );
		},

		_removeIfInvalid: function( event, ui ) {

			// Selected an item, nothing to do
			if ( ui.item ) {
				return;
			}

			// Search for a match (case-insensitive)
			var value = this.input.val(),
				valueLowerCase = value.toLowerCase(),
				valid = false;
			this.element.children( "option" ).each(function() {
				if ( $( this ).text().toLowerCase() === valueLowerCase ) {
					this.selected = valid = true;
					return false;
				}
			});

			// Found a match, nothing to do
			if ( valid ) {
				return;
			}

			// Remove invalid value
			this.input
				.val( "" )
				.attr( "title", value + " didn't match any item" )
				.tooltip( "open" );
			this.element.val( "" );
			this._delay(function() {
				this.input.tooltip( "close" ).attr( "title", "" );
			}, 2500 );
			this.input.autocomplete( "instance" ).term = "";
		},

		_destroy: function() {
			this.wrapper.remove();
			this.element.show();
		}
	});

	$( "#combobox" ).combobox();
	//$( "#combobox" ).toggle();
	// $( "#toggle" ).on( "click", function() {
	// 	$( "#combobox" ).toggle();
	// });
} );
