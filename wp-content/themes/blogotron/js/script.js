/**
 * Theme JavaScript functions and definitions for a better usability.
 */
(function( $ ) {
	// When document load
	$(document).ready(function() { 
		// Site navigation
		$( 'nav .main-menu > ul li > ul li' ).mouseenter(function() {
			var $curSubMenu = $( this ),
			$nextSubMenu = $curSubMenu.find( 'ul' ),
			subMenuWidth = $curSubMenu.width(),
			subMenuShift = 112,
			subMenuPosLeft = Math.round( $curSubMenu.offset().left ),
			windowWidth = $( window ).width();
			$( window ).resize(function() {
				windowWidth = $( window ).width();
				$( 'nav .normal-sub-menu' ).removeClass( 'normal-sub-menu' );
				$( 'nav .reverse-sub-menu' ).removeClass( 'reverse-sub-menu' );
			});
			if( windowWidth - subMenuPosLeft - subMenuWidth < subMenuShift ) {
				if ( $nextSubMenu.hasClass( 'normal-sub-menu' ) ) {
					$nextSubMenu.removeClass( 'normal-sub-menu' );	
				}
				$nextSubMenu.addClass( 'reverse-sub-menu' );
			}
			if( subMenuPosLeft - subMenuShift < 0 ) {
				if ( $nextSubMenu.hasClass( 'reverse-sub-menu' ) ) {
					$nextSubMenu.removeClass( 'reverse-sub-menu' );	
				}
				$nextSubMenu.addClass( 'normal-sub-menu' );
			}
		});
		
		// Search field placeholder
		$( '.custom-search' ).val( iSearchText ).on( 'blur', function() {
			if ( $( this ).val() == '' ) {
				$( this ).val( iSearchText );	
			}
		}).on( 'focus', function() {
			if ( $( this ).val() == iSearchText ) {
				$( this ).val( '' );	
			}	
		});	
		$( '.custom-search' ).parents( 'form' ).on( 'submit', function() {
			if( $( this ).find( '.custom-search' ).val() === iSearchText ) {
				$( this ).find( '.custom-search' ).focus();
				return false;
			}
		});
		// Customize input[type="file"]
		$( 'input[type=file]' ).blogotronInputFile({
			'iFileBrowse'      : iFileBrowse,
			'iFileNotSelected' : iFileNotSelected
		});
		// Customize input[type="radio"]
		$( 'input[type=radio]' ).blogotronRadio();
		// Customize input[type="checkbox"]
		$( 'input[type=checkbox]' ).blogotronCheckbox();
		// Customize select
		$( 'select' ).blogotronSelect();
		// Scroll top
		$( '.scroll-top' ).on( 'click', function() {
			$( 'body' ).animate( { scrollTop : 0 }, 'slow' );
		});
		// When form reset, reset custom input[type="file"], input[type="radio"], input[type="checkbox"], select
		$( 'form' ).bind( 'reset', function() {
			var form = $( this );
			$( 'input[type=radio]' ).blogotronRadio( 'reset', form );
			$( 'input[type=file]' ).blogotronInputFile( 'reset', form );
			$( 'input[type=checkbox]' ).blogotronCheckbox( 'reset', form );
			$( 'select' ).blogotronSelect( 'reset', form );
		});
		// Fix for plugin BWS Portfolio
		$( '.page-template-portfolio-php #portfolio_pagenation' ).appendTo( '.page-template-portfolio-php #content.hentry' );
	} ); // end document ready
})( jQuery );

/**
 * Plugin for customize input[type="checkbox"].
 */
(function( $ ) {	
	var methods = {
		'init' : function( options ) {	
			return this.each(function( index ) {			  
				var $this = $( this );
				if ( $this.attr( 'type' ) != 'checkbox' ) {
					return;
				}
				var form = $( '<div/>', {
					'class' : 'checkbox-button checkbox-button-' + index
				} );
				$this.hide();
				$this.after( form );
				if ( $this.is( ':checked' ) ) {
					form.addClass( 'checkbox-button-checked ' );	
				}
				form.on( 'click', function() {
					$this.trigger( 'click' );	
				});
				$( 'label' ).filter( '[for=' + $this.attr( 'id' ) + ']' ).on( 'click', function( e ) {
					$this.trigger( 'click' );
					e.preventDefault();
				});
				$this.filter( ':enabled' ).bind( 'change', function() {
					if ( $this.is( ':checked' ) ) {
						$( this ).next().addClass( 'checkbox-button-checked' );
					} else {
						$( this ).next().removeClass( 'checkbox-button-checked' );		
					}
				});
				form.hover(function() {
					if ( $this.is( ':enabled' ) ) {
						$( this ).addClass( 'checkbox-button-hover' );	
					}
				}, function() {
					if ( $this.is( ':enabled' ) ) {
						$( this ).removeClass( 'checkbox-button-hover' );
					}
				});
				$( 'label' ).filter( '[for=' + $this.attr( 'id' ) + ']' ).hover(function() {			
					if ( $this.is( ':enabled' ) ) {
						var target = $( this ).attr( 'for' );
						$( '#' + target ).next().addClass( 'checkbox-button-hover' );
					}
				}, function() {
					if ( $this.is( ':enabled' ) ) {
						var target = $( this ).attr( 'for' );
						$( '#' + target ).next().removeClass( 'checkbox-button-hover' );
					}
				});	  
			});
		},
		'reset' : function( form ) {
			form.find( '.checkbox-button' ).removeClass( 'checkbox-button-checked ' );
		}
	}
	$.fn.blogotronCheckbox = function( method ) {
		if ( methods[ method ] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ) );
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' not found!' );
		}		
	}
})( jQuery );

/**
 * Plugin for customize input[type="radio"].
 */
(function( $ ) {
	var methods = {
		'init' : function( options ) {
			return this.each( function( index ) {	
				var $this = $( this );
				if ( $this.attr( 'type' ) != 'radio' ) {
					return;
				}					
				var form = $( '<div/>', {
					'class' : 'radio-button radio-button-' + index
				});
				$this.hide();
				$this.after( form );
				if ( $this.is( ':checked' ) ) {
					form.addClass( 'radio-button-checked' );	
				}
				form.on( 'click', function() {
					$this.trigger( 'click' );	
				});
				$( 'label' ).filter( '[for=' + $this.attr( 'id' ) + ']' ).on( 'click', function( e ) {
					$this.trigger( 'click' );
					e.preventDefault();
				});
				$this.filter( ':enabled' ).bind( 'change', function() {
					var name = $this.attr( 'name' ),
						 checked = $( '.radio-button' ).prev().filter( 'input[name=' + name + ']' );
					checked.next().removeClass( 'radio-button-checked' );
					$( this ).next().addClass( 'radio-button-checked' );		
				});
				form.hover(function() {
					if ( $this.is( ':enabled' ) ) {
						$( this ).addClass( 'radio-button-hover' );	
					}
				}, function() {
					if ( $this.is( ':enabled' ) ) {
						$( this ).removeClass( 'radio-button-hover' );
					}
				});
				$( 'label' ).filter( '[for=' + $this.attr( 'id' ) + ']' ).hover(function() {			
					if ( $this.is( ':enabled' ) ) {
						var target = $( this ).attr( 'for' );
						$( '#' + target ).next().addClass( 'radio-button-hover' );
					}
				}, function() {
					if ( $this.is( ':enabled' ) ) {
					var target = $( this ).attr( 'for' );
						$( '#' + target ).next().removeClass( 'radio-button-hover' );
					}
				});
			});	
		},
		'reset' : function( form ) {
			form.find( '.radio-button' ).removeClass( 'radio-button-checked' ); 
		}
	}
	$.fn.blogotronRadio = function( method ) {	
		if ( methods[ method ] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ) );
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' not found!' );
		}			
	}
})( jQuery );

/**
 * Plugin for customize input[type="file"].
 */
(function( $ ) {	
	var methods = {
		'init' : function( options ) {
			return this.each( function( index ) {
				var settings = $.extend({
					'iFileBrowse'      : 'Choose file...',
					'iFileNotSelected' : 'File is not selected.'
				}, options);
				var $this = $( this );
				$this.data( 'settings', settings );
				if ( $this.attr( 'type' ) != 'file' ) {
					return;
				}					
				var form = $( '<div/>', {
						'class' : 'input-file-form input-file-form-' + index
					}),
					button = $( '<div/>', {
						'class' : 'input-file-button input-file-button-' + index
					}),
					buttonText = $( '<div/>', {
						'class' : 'input-file-button-text input-file-button-text-' + index ,
						'text'  : settings.iFileBrowse
					}),
					fileName = $( '<div/>', {
						'class' : 'input-file-name input-file-name-' + index,
						'text'  : settings.iFileNotSelected
					});		
				button.append( buttonText );
				form.append( button );
				form.append( fileName );
				$this.addClass( 'input-file' );
				$this.after( form );
				button.append( $this );
				$this.on( 'change', function() {
					var str = $( this ).val();
					if ( str.lastIndexOf( '\\' ) ) {
						var i = str.lastIndexOf( '\\' ) + 1;
					} else {
						var i = str.lastIndexOf( '/' ) + 1;
					}						
					var file = str.slice( i );
					fileName.text( file );
				});	
			});
		},
		'reset' : function( form ) {	
			$this = $( this );
			form.find( '.input-file-name' ).text( $this.data( 'settings' ).iFileNotSelected ); 
		}
	}
	$.fn.blogotronInputFile = function( method ) {	
		if ( methods[ method ] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ) );
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' not found!' );
		}
	}
})( jQuery );

/**
 * Plugin for customize select.
 */
(function( $ ) {	
	var methods = {
		'init' : function( options ) {
			return this.each(function( index ) {
				var $this = $ ( this );
				if ( $this.attr( 'multiple' ) == 'multiple' ) {
					return;	
				}
				var $form = $( '<div/>', {
						 'class'        : 'select-form select-form-' + index,
						 'unselectable' : 'on'
					 }),
					 $button = $( '<div/>', {
						 'class' : 'select-button select-button-' + index,
						 'title' : $this.find( 'option:selected' ).text()
					 }),
					 $buttonWrapper = $( '<div/>', {
						 'class' : 'select-button-wrapper'
					 }),
					 $buttonText = $( '<div/>', {
						 'class' : 'select-button-text',
						 'text'  : $this.find( 'option:selected' ).text()
					 }),		
					 $list = $( '<ul/>', {
						 'class' : 'select-list select-list-' + index
					 }),
					 $listItem = {
						 add : function( index, type, text ) {
							 return $( '<li/>', {
								 'class' : type  + ' select-list-item-' + index, 
								 'title' : text
							 }).append(
								 $( '<div/>', {
									 'class' : 'select-list-option-text', 
									 'text'  : text
								 })
							 );
						 }
					 };
				$button.data( 'open', false );
				$button.append( $buttonWrapper );
				$buttonWrapper.append( $buttonText );
				$form.append( $button );
				$form.append( $list );
				$this.hide();
				$this.after( $form );
				$this.find( '*' ).each(function( index, element ) {
					var type = element.tagName.toLowerCase();
					switch ( type ) {
						case 'optgroup' :
							var $optGroup = $listItem.add( index, 'select-list-optgroup', $( this ).attr( 'label' ) );
							$list.append( $optGroup );
							$optGroup.on( 'click', function() {
								return false;	
							});
							break;
						case 'option' :
							var $optGroup = $( this ).parent( 'optgroup' ),
								 optGroupIndex = $optGroup.index(),
								 typeItem = optGroupIndex == -1 ? 'select-list-option' : 'select-list-optgroup-option',
								 $option = $listItem.add( index, typeItem, $( this ).text() );
							$option.data( 'selectOption', $( this ) );
							if( $( this ).is( ':selected' ) ) {
								$list.data( 'selected', index );
								$list.data( 'default', index );
							}
							$option.on( 'click', function() {
								var $selectOption = $option.data( 'selectOption' );
								$buttonText.text( $selectOption.text() );
								$button.attr( 'title', $selectOption.text() );
								if ( $list.data( 'selected' ) != $option.index() ) {
									$selectOption.prop( 'selected', 'selected' ).trigger( 'change' );
								}
								$list.data( 'selected', $option.index() );
							});
							$option.on( 'mouseover', function() {
								$list.find( '.select-list-option-hover' ).removeClass( 'select-list-option-hover' );
								$( this ).addClass( 'select-list-option-hover' );
							});
							$list.append( $option );
							break;
						default : 
							break;
					}
				});		
				$list.bind( 'show.list' , function() {			
					$( '.select-list' ).filter( ':visible' ).hide( 0, function() {
						$( this ).prev().removeClass( 'select-button-list' );
					});				
					$button.addClass( 'select-button-list' );
					$list.find( '.select-list-option-hover' ).removeClass( 'select-list-option-hover' );
					$list.find( 'li' ).eq( $list.data('selected') ).addClass( 'select-list-option-hover' );				
					$list.show();	
				});
				$list.bind( 'hide.list' , function() {					
					$list.hide( 0, function() {
						$button.removeClass( 'select-button-list' );
					});		
				});
				$list.toggle(function() {
					if( $list.is( ':hidden' ) ) {
						$list.trigger( 'show.list' );
					} else {
						$list.trigger( 'hide.list' );
					}
				}, function() {
					if( $list.is( ':hidden' ) ) {
						$list.trigger( 'show.list' );
					} else {
						$list.trigger( 'hide.list' );
					}
				});
				$button.on( 'click', function( e ) {
					$list.trigger( 'click' );
					return false;
				});
				$( document ).on( 'click ', function() {
					$list.trigger( 'hide.list' );	
				});
			});
		},
		'reset' : function( form ) {
			var $this = $( this ),
				 defaultIndexOption = form.find( '.select-list' ).data( 'default' ),
				 $defaultOption = $this.find( '*' ).eq( defaultIndexOption ),
				 defaultTextOption = $defaultOption.text();
			$defaultOption.prop( 'selected', 'selected' );
			form.find( '.select-button-text' ).text( defaultTextOption );
			form.find( '.select-list' ).data( 'selected', defaultIndexOption );
		}
	}	
	$.fn.blogotronSelect = function( method ) {
		if ( methods[ method ] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ) );
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' not found!' );
		}
	};
})( jQuery );