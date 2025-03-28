/**
 * Interface Elements for jQuery
 * Resizable
 *
 * http://interface.eyecon.ro
 *
 * Copyright (c) 2006 Stefan Petre
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 *
 */

jQuery.iResize = {
	resizeElement: null,
	resizeDirection: null,
	dragged: null,
	pointer: null,
	sizes: null,
	position: null,
	/**
	 * internal: Start function
	 */
	startDrag: function(e) {
		jQuery.iResize.dragged = (this.dragEl) ? this.dragEl: this;
		jQuery.iResize.pointer = jQuery.iUtil.getPointer(e);

		// Save original size
		jQuery.iResize.sizes = {
			width: parseInt(jQuery(jQuery.iResize.dragged).css('width')) || 0,
			height: parseInt(jQuery(jQuery.iResize.dragged).css('height')) || 0
		};

		// Save original position
		jQuery.iResize.position = {
			top: parseInt(jQuery(jQuery.iResize.dragged).css('top')) || 0,
			left: parseInt(jQuery(jQuery.iResize.dragged).css('left')) || 0
		};

		// Assign event handlers
		jQuery(document)
			.bind('mousemove', jQuery.iResize.moveDrag)
			.bind('mouseup', jQuery.iResize.stopDrag);

		// Callback?
		if (typeof jQuery.iResize.dragged.resizeOptions.onDragStart === 'function') {
			jQuery.iResize.dragged.resizeOptions.onDragStart.apply(jQuery.iResize.dragged);
		}
		return false;
	},
	/**
	 * internal: Stop function
	 */
	stopDrag: function(e) {
		// Unbind event handlers
		jQuery(document)
			.unbind('mousemove', jQuery.iResize.moveDrag)
			.unbind('mouseup', jQuery.iResize.stopDrag);

		// Callback?
		if (typeof jQuery.iResize.dragged.resizeOptions.onDragStop === 'function') {
			jQuery.iResize.dragged.resizeOptions.onDragStop.apply(jQuery.iResize.dragged);
		}

		// Remove dragged element
		jQuery.iResize.dragged = null;
	},
	/**
	 * internal: Move function
	 */
	moveDrag: function(e) {
		if (!jQuery.iResize.dragged) {
			return;
		}

		pointer = jQuery.iUtil.getPointer(e);

		// Calculate new positions
		newTop = jQuery.iResize.position.top - jQuery.iResize.pointer.y + pointer.y;
		newLeft = jQuery.iResize.position.left - jQuery.iResize.pointer.x + pointer.x;
		newTop = Math.max(
						Math.min(newTop, jQuery.iResize.dragged.resizeOptions.maxBottom - jQuery.iResize.sizes.height),
						jQuery.iResize.dragged.resizeOptions.minTop
					);
		newLeft = Math.max(
						Math.min(newLeft, jQuery.iResize.dragged.resizeOptions.maxRight- jQuery.iResize.sizes.width),
						jQuery.iResize.dragged.resizeOptions.minLeft
					);

		// Callback
		if (typeof jQuery.iResize.dragged.resizeOptions.onDrag === 'function') {
			var newPos = jQuery.iResize.dragged.resizeOptions.onDrag.apply(jQuery.iResize.dragged, [newLeft, newTop]);
			if (typeof newPos == 'array' && newPos.length == 2) {
				newLeft = newPos[0];
				newTop = newPos[1];
			}
		}

		// Update the element
		jQuery.iResize.dragged.style.top = newTop + 'px';
		jQuery.iResize.dragged.style.left = newLeft + 'px';

		return false;
	},
	start: function(e) {
		// Bind event handlers
		jQuery(document)
			.bind('mousemove', jQuery.iResize.move)
			.bind('mouseup', jQuery.iResize.stop);

		// Initialize resizable
		jQuery.iResize.resizeElement = this.resizeElement;
		jQuery.iResize.resizeDirection = this.resizeDirection;

		jQuery.iResize.pointer = jQuery.iUtil.getPointer(e);
		// Callback function
		if (jQuery.iResize.resizeElement.resizeOptions.onStart) {
			jQuery.iResize.resizeElement.resizeOptions.onStart.apply(jQuery.iResize.resizeElement, [this]);
		}
		jQuery.iResize.sizes = {
				width: parseInt(jQuery(this.resizeElement).css('width'))||0,
				height: parseInt(jQuery(this.resizeElement).css('height'))||0
			};
		jQuery.iResize.position = {
				top: parseInt(jQuery(this.resizeElement).css('top'))||0,
				left: parseInt(jQuery(this.resizeElement).css('left'))||0
			};

		return false;
	},
	stop: function() {
		// Unbind event handlers
		jQuery(document)
			.unbind('mousemove', jQuery.iResize.move)
			.unbind('mouseup', jQuery.iResize.stop);

		// Callback function
		if (jQuery.iResize.resizeElement.resizeOptions.onStop) {
			jQuery.iResize.resizeElement.resizeOptions.onStop.apply(jQuery.iResize.resizeElement, [jQuery.iResize.resizeDirection]);
		}

		// Unbind
		jQuery.iResize.resizeElement = null;
		jQuery.iResize.resizeDirection = null;
	},
	getWidth: function(dx, side) {
		return Math.min(
						Math.max(jQuery.iResize.sizes.width + dx * side, jQuery.iResize.resizeElement.resizeOptions.minWidth),
						jQuery.iResize.resizeElement.resizeOptions.maxWidth
					);
	},
	getHeight: function(dy, side) {
		return Math.min(
						Math.max(jQuery.iResize.sizes.height + dy * side, jQuery.iResize.resizeElement.resizeOptions.minHeight),
						jQuery.iResize.resizeElement.resizeOptions.maxHeight
					);
	},
	getHeightMinMax: function(height) {
		return Math.min(
						Math.max(height, jQuery.iResize.resizeElement.resizeOptions.minHeight),
						jQuery.iResize.resizeElement.resizeOptions.maxHeight
					);
	},
	move: function(e) {
		if (jQuery.iResize.resizeElement == null) {
			return;
		}

		pointer = jQuery.iUtil.getPointer(e);
		dx = pointer.x - jQuery.iResize.pointer.x;
		dy = pointer.y - jQuery.iResize.pointer.y;

		newSizes = {
				width: jQuery.iResize.sizes.width,
				height: jQuery.iResize.sizes.height
			};
		newPosition = {
				top: jQuery.iResize.position.top,
				left: jQuery.iResize.position.left
			};

		switch (jQuery.iResize.resizeDirection){
			case 'e':
				newSizes.width = jQuery.iResize.getWidth(dx,1);
				break;
			case 'se':
				newSizes.width = jQuery.iResize.getWidth(dx,1);
				newSizes.height = jQuery.iResize.getHeight(dy,1);
				break;
			case 'w':
				newSizes.width = jQuery.iResize.getWidth(dx,-1);
				newPosition.left = jQuery.iResize.position.left - newSizes.width + jQuery.iResize.sizes.width;
				break;
			case 'sw':
				newSizes.width = jQuery.iResize.getWidth(dx,-1);
				newPosition.left = jQuery.iResize.position.left - newSizes.width + jQuery.iResize.sizes.width;
				newSizes.height = jQuery.iResize.getHeight(dy,1);
				break;
			case 'nw':
				newSizes.height = jQuery.iResize.getHeight(dy,-1);
				newPosition.top = jQuery.iResize.position.top - newSizes.height + jQuery.iResize.sizes.height;
				newSizes.width = jQuery.iResize.getWidth(dx,-1);
				newPosition.left = jQuery.iResize.position.left - newSizes.width + jQuery.iResize.sizes.width;
				break;
			case 'n':
				newSizes.height = jQuery.iResize.getHeight(dy,-1);
				newPosition.top = jQuery.iResize.position.top - newSizes.height + jQuery.iResize.sizes.height;
				break;
			case 'ne':
				newSizes.height = jQuery.iResize.getHeight(dy,-1);
				newPosition.top = jQuery.iResize.position.top - newSizes.height + jQuery.iResize.sizes.height;
				newSizes.width = jQuery.iResize.getWidth(dx,1);
				break;
			case 's':
				newSizes.height = jQuery.iResize.getHeight(dy,1);
				break;
		}

		if (jQuery.iResize.resizeElement.resizeOptions.ratio) {
			if (jQuery.iResize.resizeDirection == 'n' || jQuery.iResize.resizeDirection == 's')
				nWidth = newSizes.height * jQuery.iResize.resizeElement.resizeOptions.ratio;
			else
				nWidth = newSizes.width;
			nHeight = jQuery.iResize.getHeightMinMax(nWidth * jQuery.iResize.resizeElement.resizeOptions.ratio);
			nWidth = nHeight / jQuery.iResize.resizeElement.resizeOptions.ratio;

			switch (jQuery.iResize.resizeDirection){
				case 'n':
				case 'nw':
				case 'ne':
					newPosition.top += newSizes.height - nHeight;
				break;
			}

			switch (jQuery.iResize.resizeDirection){
				case 'nw':
				case 'w':
				case 'sw':
					newPosition.left += newSizes.width - nWidth;
				break;
			}

			newSizes.height = nHeight;
			newSizes.width = nWidth;
		}

		if (newPosition.top < jQuery.iResize.resizeElement.resizeOptions.minTop) {
			nHeight = newSizes.height + newPosition.top - jQuery.iResize.resizeElement.resizeOptions.minTop;
			newPosition.top = jQuery.iResize.resizeElement.resizeOptions.minTop;

			if (jQuery.iResize.resizeElement.resizeOptions.ratio) {
				nWidth = nHeight / jQuery.iResize.resizeElement.resizeOptions.ratio;
				switch (jQuery.iResize.resizeDirection){
					case 'nw':
					case 'w':
					case 'sw':
						newPosition.left += newSizes.width - nWidth;
					break;
				}
				newSizes.width = nWidth;
			}
			newSizes.height = nHeight;
		}

		if (newPosition.left < jQuery.iResize.resizeElement.resizeOptions.minLeft ) {
			nWidth = newSizes.width + newPosition.left - jQuery.iResize.resizeElement.resizeOptions.minLeft;
			newPosition.left = jQuery.iResize.resizeElement.resizeOptions.minLeft;

			if (jQuery.iResize.resizeElement.resizeOptions.ratio) {
				nHeight = nWidth * jQuery.iResize.resizeElement.resizeOptions.ratio;
				switch (jQuery.iResize.resizeDirection){
					case 'n':
					case 'nw':
					case 'ne':
						newPosition.top += newSizes.height - nHeight;
					break;
				}
				newSizes.height = nHeight;
			}
			newSizes.width = nWidth;
		}

		if (newPosition.top + newSizes.height > jQuery.iResize.resizeElement.resizeOptions.maxBottom) {
			newSizes.height = jQuery.iResize.resizeElement.resizeOptions.maxBottom - newPosition.top;
			if (jQuery.iResize.resizeElement.resizeOptions.ratio) {
				newSizes.width = newSizes.height / jQuery.iResize.resizeElement.resizeOptions.ratio;
			}

		}

		if (newPosition.left + newSizes.width > jQuery.iResize.resizeElement.resizeOptions.maxRight) {
			newSizes.width = jQuery.iResize.resizeElement.resizeOptions.maxRight - newPosition.left;
			if (jQuery.iResize.resizeElement.resizeOptions.ratio) {
				newSizes.height = newSizes.width * jQuery.iResize.resizeElement.resizeOptions.ratio;
			}

		}

		var newDimensions = false;
		elS = jQuery.iResize.resizeElement.style;
		elS.left = newPosition.left + 'px';
		elS.top = newPosition.top + 'px';
		elS.width = newSizes.width + 'px';
		elS.height = newSizes.height + 'px';
		if (jQuery.iResize.resizeElement.resizeOptions.onResize) {
			newDimensions = jQuery.iResize.resizeElement.resizeOptions.onResize.apply( jQuery.iResize.resizeElement, [ newSizes, newPosition ] );
			if (newDimensions) {
				if (newDimensions.sizes) {
					jQuery.extend(newSizes, newDimensions.sizes);
				}

				if (newDimensions.position) {
					jQuery.extend(newPosition, newDimensions.position);
				}
			}
		}
		elS.left = newPosition.left + 'px';
		elS.top = newPosition.top + 'px';
		elS.width = newSizes.width + 'px';
		elS.height = newSizes.height + 'px';

		return false;
	},
	/**
	 * Builds the resizable
	 */
	build: function(options) {
		if (!options || !options.handlers || options.handlers.constructor != Object) {
			return;
		}

		return this.each(
			function() {
				var el = this;
				el.resizeOptions = options;
				el.resizeOptions.minWidth = options.minWidth || 10;
				el.resizeOptions.minHeight = options.minHeight || 10;
				el.resizeOptions.maxWidth = options.maxWidth || 3000;
				el.resizeOptions.maxHeight = options.maxHeight || 3000;
				el.resizeOptions.minTop = options.minTop || -1000;
				el.resizeOptions.minLeft = options.minLeft || -1000;
				el.resizeOptions.maxRight = options.maxRight || 3000;
				el.resizeOptions.maxBottom = options.maxBottom || 3000;
				elPosition = jQuery(el).css('position');
				if (!(elPosition == 'relative' || elPosition == 'absolute')) {
					el.style.position = 'relative';
				}

				directions = /n|ne|e|se|s|sw|w|nw/g;
				for (i in el.resizeOptions.handlers) {
					if (i.toLowerCase().match(directions) != null) {
						if (el.resizeOptions.handlers[i].constructor == String) {
							handle = jQuery(el.resizeOptions.handlers[i]);
							if (handle.size() > 0) {
								el.resizeOptions.handlers[i] = handle.get(0);
							}
						}

						if (el.resizeOptions.handlers[i].tagName) {
							el.resizeOptions.handlers[i].resizeElement = el;
							el.resizeOptions.handlers[i].resizeDirection = i;
							jQuery(el.resizeOptions.handlers[i]).bind('mousedown', jQuery.iResize.start);
						}
					}
				}

				if (el.resizeOptions.dragHandle) {
					if (typeof el.resizeOptions.dragHandle === 'string') {
						handleEl = jQuery(el.resizeOptions.dragHandle);
						if (handleEl.size() > 0) {
							handleEl.each(function() {
									this.dragEl = el;
								});
							handleEl.bind('mousedown', jQuery.iResize.startDrag);
						}
					} else if (el.resizeOptions.dragHandle.tagName) {
						el.resizeOptions.dragHandle.dragEl = el;
						jQuery(el.resizeOptions.dragHandle).bind('mousedown', jQuery.iResize.startDrag);
					}else if (el.resizeOptions.dragHandle == true) {
						jQuery(this).bind('mousedown', jQuery.iResize.startDrag);
					}
				}
			}
		);
	},
	/**
	 * Destroys the resizable
	 */
	destroy: function() {
		return this.each(
			function() {
				var el = this;

				// Unbind the handlers
				for (i in el.resizeOptions.handlers) {
					el.resizeOptions.handlers[i].resizeElement = null;
					el.resizeOptions.handlers[i].resizeDirection = null;
					jQuery(el.resizeOptions.handlers[i]).unbind('mousedown', jQuery.iResize.start);
				}

				// Remove the draghandle
				if (el.resizeOptions.dragHandle) {
					if (typeof el.resizeOptions.dragHandle === 'string') {
						handle = jQuery(el.resizeOptions.dragHandle);
						if (handle.size() > 0) {
							handle.unbind('mousedown', jQuery.iResize.startDrag);
						}
					} else if (el.resizeOptions.dragHandle == true) {
						jQuery(this).unbind('mousedown', jQuery.iResize.startDrag);
					}
				}

				// Reset the options
				el.resizeOptions = null;
			}
		);
	}
};


jQuery.fn.extend ({
		/**
		 * Create a resizable element with a number of advanced options including callback, dragging
		 * 
		 * @name Resizable
		 * @description Create a resizable element with a number of advanced options including callback, dragging
		 * @param Hash hash A hash of parameters. All parameters are optional.
		 * @option Hash handlers hash with keys for each resize direction (e, es, s, sw, w, nw, n) and value string selection
		 * @option Integer minWidth (optional) the minimum width that element can be resized to
		 * @option Integer maxWidth (optional) the maximum width that element can be resized to
		 * @option Integer minHeight (optional) the minimum height that element can be resized to
		 * @option Integer maxHeight (optional) the maximum height that element can be resized to
		 * @option Integer minTop (optional) the minmum top position to wich element can be moved to
		 * @option Integer minLeft (optional) the minmum left position to wich element can be moved to
		 * @option Integer maxRight (optional) the maximum right position to wich element can be moved to
		 * @option Integer maxBottom (optional) the maximum bottom position to wich element can be moved to
		 * @option Float ratio (optional) the ratio between width and height to constrain elements sizes to that ratio
		 * @option Mixed dragHandle (optional) true to make the element draggable, string selection for drag handle
		 * @option Function onDragStart (optional) A function to be executed whenever the dragging starts
		 * @option Function onDragStop (optional) A function to be executed whenever the dragging stops
		 * @option Function onDrag (optional) A function to be executed whenever the element is dragged
		 * @option Function onStart (optional) A function to be executed whenever the element starts to be resized
		 * @option Function onStop (optional) A function to be executed whenever the element stops to be resized
		 * @option Function onResize (optional) A function to be executed whenever the element is resized
		 * @type jQuery
		 * @cat Plugins/Interface
		 * @author Stefan Petre
		 */
		Resizable: jQuery.iResize.build,
		/**
		 * Destroy a resizable
		 * 
		 * @name ResizableDestroy
		 * @description Destroy a resizable
		 * @type jQuery
		 * @cat Plugins/Interface
		 * @author Stefan Petre
		 */
		ResizableDestroy: jQuery.iResize.destroy
	});;