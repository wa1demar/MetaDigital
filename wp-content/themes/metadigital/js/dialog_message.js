/**
 * Created by LexX on 05.07.2015.
 */
$('.contact-us-send-button').click(
    $(function () {
        $("#dialog-message").dialog({
            modal: true,
            buttons: {
                Ok: function () {
                    $(this).dialog("close");
                }
            }
        });
    })
);