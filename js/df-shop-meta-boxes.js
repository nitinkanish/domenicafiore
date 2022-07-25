/**
 * Load media uploader on pages with our custom metabox
 */
 jQuery(document).ready(function($){
	'use strict';
	var metaImageFrame;

	$( 'body' ).click(function(e) {
		var btn = e.target;
		if ( !btn || !$( btn ).attr( 'data-media-uploader-target' ) ) return;
		  var field = $( btn ).data( 'media-uploader-target' );

		  e.preventDefault();
  		metaImageFrame = wp.media.frames.metaImageFrame = wp.media({
  			title: meta_image.title,
  			button: { text:  'Use this file' },
  		});

  		metaImageFrame.on('select', function() {
  			var media_attachment = metaImageFrame.state().get('selection').first().toJSON();
  			$( field ).val(media_attachment.url);
  		});

  		metaImageFrame.open();
	});

  $('body').on('click', '.link-select-btn', function(event) {
    wpActiveEditor = true; //we need to override this var as the link dialogue is expecting an actual wp_editor instance
    var target = $(event.target).siblings('.link-url-input');
    initializeLinkSelectButton(target);
    wpLink.open(); //open the link popup
    return false;
  });

  function initializeLinkSelectButton(target) {
    $('body').on('click', '#wp-link-submit', function(event) {
      console.log("click");
      var linkAtts = wpLink.getAttrs();//the links attributes (href, target) are stored in an object, which can be access via wpLink.getAttrs()
      target.val(linkAtts.href);//get the href attribute and add to a textfield, or use as you see fit
      wpLink.textarea = target; //to close the link dialogue, it is again expecting an wp_editor instance, so you need to give it something to set focus back to. In this case, I'm using body, but the textfield with the URL would be fine
      wpLink.close();//close the dialogue
      //trap any events
      event.preventDefault ? event.preventDefault() : event.returnValue = false;
      event.stopPropagation();
      return false;
    });

    $('body').on('click', '#wp-link-cancel, #wp-link-close', function(event) {
      wpLink.textarea = target;
      wpLink.close();
      event.preventDefault ? event.preventDefault() : event.returnValue = false;
      event.stopPropagation();
      return false;
    });
  }


  var resetLinkIds = function() {
    var id = 0;
    $('#links-repeater').find('.link-block-table').each(function(){
      $(this).find('.link-id').attr('value', id);
      $(this).find('.link-image-url').attr('id', 'link_image_' + id);
      $(this).find('.link-image-button').attr('id', 'link_image_upload_btn_link_image_' + id);
      $(this).find('.link-image-button').attr('data-media-uploader-target', '#link_image_' + id);
      $(this).find('.link-select-btn').attr('id', 'link_url_select_' + id);
      id++;
    });
  }

  $( '#add-link-button' ).on('click', function() {
    var row = $( '.empty-link-block.screen-reader-text' ).clone(true);
    var lastLinkID = $('#links-repeater').find('.link-block-table').last().find('.link-id').attr('value');
    var newLinkID = parseInt(lastLinkID) + 1;
    row.removeClass( 'empty-link-block screen-reader-text' );
    row.addClass('link-block-table');
    row.find('.link-id').attr('value', newLinkID);
    row.find('.link-image-url').attr('id', 'link_image_' + newLinkID);
    row.find('.link-image-button').attr('id', 'link_image_upload_btn_link_image_' + newLinkID);
    row.find('.link-image-button').attr('data-media-uploader-target', '#link_image_' + newLinkID);
    row.find('.link-select-btn').attr('id', 'link_url_select_' + newLinkID);
    row.insertBefore( '#links-repeater table:last' );
    $('.remove-table-disabled.button-disabled').removeClass('remove-table-disabled button-disabled').addClass('remove-table');
    initializeButtons();
    return false;
  });

  function initializeButtons() {
    $( '.remove-table' ).on('click', function() {
      $(this).parents('table').remove();
      resetLinkIds();
      return false;
    });
  }

  initializeButtons();

});
