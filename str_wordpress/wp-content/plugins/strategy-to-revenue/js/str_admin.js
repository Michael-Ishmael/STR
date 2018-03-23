jQuery(function($){

    function init(){
        setUpResultsBox();
        setUpImageBoxes();
    }

    function setUpResultsBox(){

        var resDiv = $('#str-result-list');
        var j = $('#str-result-list p').length + 1;

        $('#addRes').live('click', function () {
            $('<p><label for="meta_success_result_' + j + '"><strong>Result:</strong> <input id="meta_success_result' + j + '" ' +
                'name="meta_success_result[]" size="20" ' +
                'value="" /></label>' +
                ' <a href="#" id="remRes">Remove</a></p>').appendTo(resDiv);
            j++;
            return false;
        });
        $('#remRes').live('click', function () {
            if (j > 2) {
                $(this).parents('p').remove();
                j--;
            }
            return false;
        });


    }

    function setUpImageBoxes(){

        var imageBoxIds = [];
        try{
            imageBoxIds = imageBoxManager.imageBoxIds;
        } catch(ex){

        }

        for (var i = 0; i < imageBoxIds.length; i++) {
            var boxId = imageBoxIds[i];
            setUpImageBox(boxId);

        }

    }

    function setUpImageBox(boxId){

        // Set all variables to be used in scope
        var frame,
            metaBox = $('#' + boxId + '.postbox'), // Your meta box id here
            addImgLink = metaBox.find('.upload-custom-img'),
            delImgLink = metaBox.find( '.delete-custom-img'),
            imgContainer = metaBox.find( '.custom-img-container'),
            imgIdInput = metaBox.find( '.custom-img-id' );

        // ADD IMAGE LINK
        addImgLink.on( 'click', function( event ){

            event.preventDefault();

            // If the media frame already exists, reopen it.
            if ( frame ) {
                frame.open();
                return;
            }

            // Create a new media frame
            frame = wp.media({
                title: 'Select or Upload Media Of Your Chosen Persuasion',
                button: {
                    text: 'Use this media'
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });


            // When an image is selected in the media frame...
            frame.on( 'select', function() {

                // Get media attachment details from the frame state
                var attachment = frame.state().get('selection').first().toJSON();

                // Send the attachment URL to our custom image input field.
                imgContainer.append( '<img src="'+attachment.url+'" alt="" style="max-width:50%;"/>' );

                // Send the attachment id to our hidden input
                imgIdInput.val( attachment.id );

                // Hide the add image link
                addImgLink.addClass( 'hidden' );

                // Unhide the remove image link
                delImgLink.removeClass( 'hidden' );
            });

            // Finally, open the modal on click
            frame.open();
        });


        // DELETE IMAGE LINK
        delImgLink.on( 'click', function( event ){

            event.preventDefault();

            // Clear out the preview image
            imgContainer.html( '' );

            // Un-hide the add image link
            addImgLink.removeClass( 'hidden' );

            // Hide the delete image link
            delImgLink.addClass( 'hidden' );

            // Delete the image id from the hidden input
            imgIdInput.val( '' );

        });
    }

    init();
});