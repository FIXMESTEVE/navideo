/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */


$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        formData: {title: ""},
        url: 'server/php/',
        maxChunkSize: 10000000 // 10 MB
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );
    // Load existing files:
    $('#fileupload').fileupload('option', {
        url: $('#fileupload').fileupload('option', 'url'),
        acceptFileTypes: /(\.|\/)(mp4)$/i
    });
    
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#fileupload')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});

        console.dir(result);
    });

    
    $('#fileupload').on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.error) {
            //do nothing
        }
        else if (file.preview) {
            var node = $('<td/>')
            .append('<br /><strong>Title:</strong> <input type="text" name="title" value="">');
            node.appendTo(data.context);


            node = $(data.context.children()[index]);
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        
    })
    

    $('#fileupload').bind('fileuploadsubmit', function (e, data) {
        var inputs = data.context.find(':input');

        if (inputs.filter(function () {
                return !this.value && $(this).prop('required');
            }).first().focus().length) {
            data.context.find('button').prop('disabled', false);
            return false;
        }
        data.formData = inputs.serializeArray();            

        if(data.formData[0].value === null || data.formData[0].value === ""){
            data.context.find('button').removeProp('disabled', false);
            data.context.find(':input[name=title]').after("<p name='error'>Title required.</p>");
            data.context.find('[name=error]').fadeOut(1000);
            return false;
        }
    });

    $('#fileupload').bind('fileuploaddone', function (e, data) {
        var inputs = data.context.find(':input');

        if (inputs.filter(function () {
                return !this.value && $(this).prop('required');
            }).first().focus().length) {
            data.context.find('button').prop('disabled', false);
            return false;
        }
        data.formData = inputs.serializeArray();
        $('a[title="'+ data.result.files[0].name +'"]').after('<br /><strong>Title:</strong> <input type="text" name="title" value="">');

        $.ajax({
            type: 'POST',
            url: 'server/php/videoProcess.php',
            data: {
                filename: data.result.files[0].name,
                title: data.formData[0].value
            },
            success: function(data) {
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            },
            cache: false
        });
    });

    function sendNewTitle(event){
        console.dir(event);
        if($('input[title="'+ event.data.filename +'"]').val() === null || $('input[title="'+ event.data.filename +'"]').val() === ""){
            $('button[name="'+ event.data.filename +'"]').after("<p name='error'>Title required.</p>");
            $('[name=error]').fadeOut(1000);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'server/php/modifyVideoTitle.php',
            data: {
                filename: event.data.filename,
                title: $('input[title="'+ event.data.filename +'"]').val()
            },
            success: function(data) {
                $('button[name="'+ event.data.filename +'"]').after("<p name='success'>Title changed.</p>");
                $('[name=success]').css('color', 'green');
                $('[name=success]').fadeOut(1000);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            },
            cache: false
        });
    }

    $('#fileupload').bind('fileuploadcompleted', function (e, data) {
        //for each file retrieved, make an sql query to retrieve the titles.
        console.dir(data);
        for(var i = 0; i < data.result.files.length; i++ ){
            
            $.ajax({
                type: 'POST',
                url: 'server/php/retrieveVideoTitle.php',
                data: {
                    filename: data.result.files[i].name
                },
                success: function(data) {
                    console.dir(data);
                    $('a[title="'+ data.filename +'"]').after(
                        '<br /><strong>Title:</strong> <input type="text" name="title" title="'+ data.filename +'" value="'+ data.title +'"><button type="button" name="'+ data.filename +'">Modify</button>');
                        $('button[name="'+ data.filename +'"]' ).on('click', {filename: data.filename},sendNewTitle);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                },
                cache: false
            });
        }
    });

    $('#fileupload').bind('fileuploaddestroyed', function (e, data){
        var filenameFromUrl = data.url.substring(data.url.indexOf("=") + 1);
        $.ajax({
            type: 'POST',
            url: 'server/php/videoDeletion.php',
            data: {
                filename: filenameFromUrl,
            },
            success: function(data) {
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            },
            cache: false
        });
    });
});
