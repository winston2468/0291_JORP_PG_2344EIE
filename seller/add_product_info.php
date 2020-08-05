<!DOCTYPE html>
<meta charset="UTF-8">
<head>
<?php 
 include ( "../db/db_connect.php" );

 $user_id= $_POST['user_id'];

 

function categoryTree($parent = 0, $sub_mark = ''){
   global   $mysqli;
   $query = $mysqli->query("SELECT * FROM category WHERE parent = $parent ORDER BY name ASC");
  
   if($query->num_rows > 0){
       while($row = $query->fetch_assoc()){
           echo '<option value="'.$row['id'].'">'.$sub_mark.$row['name'].'</option>';
           categoryTree($row['id'], $sub_mark.'-');
       }
   }
}

?>
</head>

<style>
.ui-autocomplete
{

    cursor:default;
    z-index:2147483647; !important
}
.custom-combobox {
		position: relative;
		display: inline-block;
	}
	.custom-combobox-toggle {
		position: absolute;
		top: 0;
		bottom: 0;
		margin-left: -1px;
		padding: 0;
	}
	.custom-combobox-input {
		margin: 0;
		padding: 5px 10px;
	}
    </style>
<body>


<div class="form-group">
<label>Product Name:</label>
<input type='text' name='name'  class="form-control"/>



<div class="form-group" style="position: relative;" >
<span class="img-div">
  <div class=".img-placeholder"  onClick="triggerClick()">
    <h4>Product Image:</h4>
  </div>
  <img src="../img/200x200.jpg" onClick="triggerClick()" class ="img-thumbnail"  id="productDisplayAdd">
</span>
<input type="file" name="productImage" onChange="displayImage(this)" id="productImageAdd" class="form-control" >
<label class="text-center">Preview Image</label>
</div>

<div class="form-group">
<label>Price:</label>
<input type=number step=0.01 name='price' class="form-control"/>
</div>
<div class="form-group">
<label>Stock:</label>
<input type='number' name='stock'  class="form-control"/>
</div>

<div class="form-group">
<label>Description:</label>
<textarea name='description'  class="form-control"> </textarea>

</div>
<div class="form-group">
<label>Video rent:</label>
<input type='text' name='video_rent'  class="form-control"/>
</div>


<input hidden type='number' name='seller_id' value ='<?php echo $user_id; ?>'/>

<div class="form-group">



<div class="ui-widget">

<label for="category_combobox">Select Category/Sub-Category:</label>
 <!-- <input  id="category_form_autocomplete" type="search" class="form-control"/> -->
  <select id ="category_combobox" name="category_combobox" >
  <option selected="selected" disabled="true">--Please Select --</option>
    <?php categoryTree(); ?>
</select>
  </div>
</div>


<div class="form-group">
        <label>Tags:</label>
        <textarea name="tag" id="tag" class="form-control"> </textarea>
    </div>

</body>

</html>


<script>

function triggerClick(e) {
  document.querySelector('#productImageAdd').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#productDisplayAdd').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
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
					.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: $.proxy( this, "_source" )
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
					if ( this.value && ( !request.term || matcher.test(text) ) )
						return {
							label: text,
							value: text,
							option: this
						};
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

		$( "#category_combobox" ).combobox();
		$( "#toggle" ).on( "click", function() {
			$( "#category_combobox" ).toggle();
		});
	} );
  </script>