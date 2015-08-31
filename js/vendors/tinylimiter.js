/**
* TinyLimiter - scriptiny.com/tinylimiter
* License: GNU GPL v3.0 - scriptiny.com/license
*/

	var limit_zone = 225;
	$(function() {
		$.fn.limiter = function ( limit ) {
		  return this.each(function() { 
			$(this).on('keyup focus', function() {
			  var chars = this.value.length;
			  if (chars > limit) {
				this.value = this.value.substr(0, limit);
				chars = limit;
			  }
			  var charsleft = limit - chars;
			  if (chars > limit_zone) {
				$(this).next().find('span').html(charsleft).addClass('charsRemainAlert');
			  }
			  else {
				$(this).next().find('span').html(charsleft).removeClass('charsRemainAlert');
			  }
			});
		  });
		};
	  $('textarea').limiter(250);
	});
