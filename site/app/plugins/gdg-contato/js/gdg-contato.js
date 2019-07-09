function sendAjax(controller, operation, parameters, callback) {
	jQuery.ajax({
        type: 'POST',
        url: gdg.ajaxUrl,
        async: true,
        data: {
            action:     'ajaxcall',
            controller: controller,
            operation:  operation,
            parameters: parameters
        },
        success: function(data, textStatus, XMLHttpRequest) {
            var fn  = window[callback];
            var ret = jQuery.parseJSON(data);

            if (typeof fn === 'function') {
                fn(ret);
            }
        },
        error: function(MLHttpRequest, textStatus, errorThrown){
            console.log('ajax error: '+ textStatus + errorThrown);
        }
    });
}

function hideFallback(fallbackID) {
    jQuery(fallbackID)
        .addClass('hidden')
        .hide()
        .html('');
}

function showFallback(data) {
    var fallbackMsg  = (typeof data.data.message !== 'undefined') ? data.data.message : data.data;
    var fallbackID   = '#'+ data.fallback_target.toString();
    var messageClass = data.status;

    switch (data.status) {
        case 'data':
            messageClass = 'info';
            break;

        case 'error':
            messageClass = 'danger';
            break;
    }

    jQuery(fallbackID)
        .removeClass('hidden')
        .show()
        .html('<div class="alert alert-' + messageClass + '" role="alert">' + fallbackMsg + '</div>');
}

function disableButton(buttonObject, loadingIcon) {
    if (typeof loadingIcon === 'undefined') {
        loadingIcon = 'Aguarde...';
    }

    buttonObject.prop('disabled',true);
    buttonObject.data('label', buttonObject.html());
    buttonObject.html(loadingIcon);
}

function disableButtonByID(buttonID, loadingIcon) {
    disableButton(jQuery(buttonID), loadingIcon);
}

function enableButton(buttonObject) {
    var btnLabel = buttonObject.data('label');

    buttonObject.prop('disabled',false);
    buttonObject.html(btnLabel);
}

function enableButtonByID(buttonID) {
    enableButton(jQuery(buttonID));
}

function collectFormData(formID) {
    var formData = {};
    var selectors = 'input[type="text"], input[type="email"], input[type="hidden"], input[type="password"]';
    selectors += ', input[type="tel"], input[type="date"], input[type="number"], textarea';

    jQuery(formID).find(selectors).each(function() {
        var elem = jQuery(this);
        if (typeof elem.attr('id') !== 'undefined') {
            formData[elem.attr('id')] = elem.hasClass('masked') ? elem.cleanVal() : elem.val();
        }
    });

    jQuery(formID + ' select option:selected').each(function() {
        formData[jQuery(this).parent().attr('id')] = jQuery(this).val();
    });

    jQuery(formID + ' input[type="radio"]:checked').each(function() {
        formData[jQuery(this).attr('name')] = jQuery(this).val();
    });

    jQuery(formID + ' input[type="checkbox"]').each(function() {
        formData[jQuery(this).attr('id')] = jQuery(this).is(':checked') ? 1 : 0;
    });

    return formData;
}

function submitStandardAction(form) {
    var formObject = jQuery(form);
    var button     = formObject.find('.action');
    var controller = formObject.data('cac');
    var operation  = button.attr('id');
    var parameters = collectFormData('#' + formObject.attr('id'));
    var fallbackID = '#' + formObject.find('.fallback').attr('id');
    var callback   = 'standardActionCallback';

    if (typeof formObject.data('ccb') !== 'undefined') {
        callback = formObject.data('ccb');
    }

    hideFallback(fallbackID);
    disableButton(button);
    sendAjax(controller, operation, parameters, callback);
}

function initStandardActionButtons() {
    jQuery('.action').click(function() {
        var formID = '#' + jQuery(this).attr('id') + '_form';
        submitStandardAction(formID);
        return false;
    });
}

function standardActionCallback(ret) {
	var fallbackID   = '#' + ret.fallback_target.toString();
    
    showFallback(ret);
    enableButton(jQuery(fallbackID).parents('form').find('.action'));
}


jQuery(document).ready(function() {
    initStandardActionButtons();
});
