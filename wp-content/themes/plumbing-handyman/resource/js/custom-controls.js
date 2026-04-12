(function(api) {

    api.sectionConstructor['plumbing-handyman-upsell'] = api.Section.extend({

        // Remove events for this section.
        attachEvents: function() {},

        // Ensure this section is active. Normally, sections without contents aren't visible.
        isContextuallyActive: function() {
            return true;
        }
    });

    const plumbing_handyman_section_lists = ['slider', 'about'];
    plumbing_handyman_section_lists.forEach(plumbing_handyman_homepage_scroll);

    function plumbing_handyman_homepage_scroll(item, index) {
        // Detect when the front page sections section is expanded (or closed) so we can adjust the preview accordingly.
        item = item.replace(/-/g, '_');
        wp.customize.section('plumbing_handyman_' + item + '_section', function(section) {
            section.expanded.bind(function(isExpanding) {
                // Value of isExpanding will = true if you're entering the section, false if you're leaving it.
                wp.customize.previewer.send(item, { expanded: isExpanding });
            });
        });
    }
})(wp.customize);

// Example JavaScript/jQuery for tab interaction
jQuery(document).ready(function($) {
    $('.customize-control-radio input[type="radio"]').change(function() {
        // Remove active class from all labels
        $('.customize-control-radio label').removeClass('active');
        
        // Add active class to the selected label
        $(this).next('label').addClass('active');
    });
});

jQuery(document).ready(function($) {
    $('#plumbing-handyman-custom-container img').on('click', function() {
        $('#plumbing-handyman-custom-container img').removeClass('plumbing-handyman-selected-img');
        $(this).addClass('plumbing-handyman-selected-img');
        $(this).prev('input[type="radio"]').prop('checked', true).trigger('change');
    });
});

//
(function ($) {
    function ResetDemoSettings() {
        if (!confirm("Are you sure you want to reset demo import settings?")) return;

        $.post(ajaxurl, { action: 'plumbing_handyman_reset_demo_import_settings' }, function () {
            location.reload();
        });
    }

    window.ResetDemoSettings = ResetDemoSettings;
})(jQuery);

(function ($,wp) {
    function ResetGlobalColor() {
        if (confirm("Are you sure you want to reset global color settings?")) {
            wp.customize.instance("plumbing_handyman_primary_color").set("#067EEF");
			wp.customize.instance("plumbing_handyman_secondary_color").set("#002A66");
        }
    }

    window.ResetGlobalColor = ResetGlobalColor;
})(jQuery, wp);