<!DOCTYPE html>
<meta charset="UTF-8">
<head>
<?php 
 include ( "../db/db_connect.php" );
 $table_name = 'product';
 $id = $_POST['id'];

 
function categoryTree($parent = 0, $sub_mark = '', $curr_id){
  global   $mysqli;
  $query = $mysqli->query("SELECT * FROM category WHERE parent = $parent ORDER BY name ASC");
 
  if($query->num_rows > 0){
      while($row = $query->fetch_assoc()){
         if($row['id'] == $curr_id){
          echo '<option selected="selected" value="'.$row['id'].'">'.$sub_mark.$row['name'].'</option>';
         }
         else{
          echo '<option value="'.$row['id'].'">'.$sub_mark.$row['name'].'</option>';
         }
          categoryTree($row['id'], $sub_mark.'-', $curr_id);
      }
  }
}


?>

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


</head>

<?php
                   $stmt = $mysqli->prepare("SELECT * FROM  $table_name WHERE id = ?;");
                   $stmt->bind_param("s", $id);


                    if($stmt->execute()){
                        $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            if($row != NULL){
                            foreach ($row as $column => $value) {
                                if($column == 'seller'){
                                }
                            else if($column == 'image'){
                                  echo  "<div class='form-group'>
                                  <label>" . $column . ":</label>";
                                    echo "<input readonly='readonly' name='" . $column . "_old' value='" . $value . "'class='form-control'>";
                                    echo "</div>";
                                    echo"  
                                    <div class='form-group' style='position: relative;' >
                                    <span class='img-div'>
                                    <div class='.img-placeholder'  onClick='triggerClick()'>
                                        <h4>Product Image:</h4>
                                        </div>
                                      <img src='../image/". $value ."' onClick='triggerClick()' class ='img-thumbnail'  id='productDisplayUpdate'>
                                    </span>
                                    <input type='file'  name='productImage' onChange='displayImage(this)' id='productImageUpdate' class='form-control''>
                                    <label class='text-center'>Preview Image</label>
                                  </div>";

                                }
                                else if ($column== 'category'){
                                  echo  "<div class='form-group'>
                                  ";
                                  echo "<input hidden  value='" . $value . "' class='form-control'>";
                                  echo "</div>";


                                  

                                  echo  "<div class='ui-widget'> <label for='category_combobox'>Select Category/Sub-Category:</label>

  <select id ='category_combobox' name='category_combobox' >
    ";
    
   categoryTree( 0,'', $value ); 
   echo "
</select>
  
  </div>
";


								  }
								  else if($column== 'price'){
									echo  "<div class='form-group'>
									<label>Price (Please type in HKD):</label>";
									echo "<input name='" . $column . "' value='" . $value . "' class='form-control'>";
									echo "</div>";
								   }
								   else if($column == 'description') {
									echo  "<div class='form-group'>
									<label>" . $column . ":</label>";
									echo "<textarea name='" . $column . "' class='form-control'>$value</textarea>";
									echo "</div>";
                                }
                                else if ($column!= 'id' && $column!= 'seller_id'){
                                echo  "<div class='form-group'>
                                <label>" . $column . ":</label>";
                                echo "<input name='" . $column . "' value='" . $value . "' class='form-control'>";
                                echo "</div>";
                                }

   
								

								
                                else {
                         
                                    echo  "<div class='form-group'>";
                                      echo "<input hidden type='number' readonly='readonly' name='" . $column . "' value='" . $value . "' class='form-control'>";
                                      echo "</div>";
                                }
                            }
                        }
                        else{

                            echo "Invalid ID.";
                        }
                            // Free result set
                            mysqli_free_result($result);
                        
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    $stmt->close();
                    ?>
</body>

</html>

<script>

function triggerClick(e) {
  document.querySelector('#productImageUpdate').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#productDisplayUpdate').setAttribute('src', e.target.result);
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

