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
var titleNumber = 0;

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
            titleNumber++;

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

        //console.dir('file NAME: ' + data.result.files[0].name + ' video TITLE: ' + data.formData[0].value + '\n');
        //console.dir(data);

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
});
