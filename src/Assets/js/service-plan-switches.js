/*
set common values for bootstrapSwitch by default.
 */
$.fn.bootstrapSwitch.defaults.size = 'small';
$.fn.bootstrapSwitch.defaults.onColor = 'success';
$.fn.bootstrapSwitch.defaults.offColor = 'danger';
$.fn.bootstrapSwitch.defaults.onText = 'enabled';
$.fn.bootstrapSwitch.defaults.offText = 'disabled';
$.fn.bootstrapSwitch.defaults.handleWidth = 100;

/*
hide all hide-able DIVs on page load.
 */
$('#primary_policy_div, #data_limit_div, #time_limit_div, #reset_every_div, #aq_policy_div').toggle();

/*
handle primary policy fade-in/fade-out.
 */
$("input[name='primary_policy_enabled']").bootstrapSwitch({
    'onSwitchChange': function(){
        if(this.checked)
        {
            $('#primary_policy_div').fadeIn();
        } else {
            $('#primary_policy_div').fadeOut();
        }
    }
});

/*
 handle data limit fade-in/fade-out.
 */
$("input[name='data_limit_enabled']").bootstrapSwitch({
    'onSwitchChange': function() {
        if (this.checked) {
            $('#data_limit_div').fadeIn();
        } else {
            $('#data_limit_div').fadeOut();
        }
    }
});

/*
 handle time limit fade-in/fade-out.
 */
$("input[name='time_limit_enabled']").bootstrapSwitch({
    'onSwitchChange': function() {
        if (this.checked) {
            $('#time_limit_div').fadeIn();
        } else {
            $('#time_limit_div').fadeOut();
        }
    }
});

/*
 handle reset every fade-in/fade-out.
 */
$("input[name='reset_every_enabled']").bootstrapSwitch({
    'onSwitchChange': function() {
        if (this.checked) {
            $('#reset_every_div').fadeIn();
        } else {
            $('#reset_every_div').fadeOut();
        }
    }
});

/*
 handle data limit fade-in/fade-out.
 */
$("input[name='aq_policy_enabled']").bootstrapSwitch({
    'onSwitchChange': function() {
        if (this.checked) {
            $('#aq_policy_div').fadeIn();
        } else {
            $('#aq_policy_div').fadeOut();
        }
    }
});