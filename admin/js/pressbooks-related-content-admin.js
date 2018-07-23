jQuery(document).ready(function () {

    //Code used to remove the Button (Add new site metadata) from the CPT Named Site-Meta
    var txt =  jQuery('.page-title-action').text();

    if(txt == 'Add New Site Metadata'){
        jQuery('.page-title-action').hide();
    }

    jQuery("[data-slug = pb_dublin_coverage_dublin_vocab_metadata]").after("<hr>");
    jQuery("[data-slug = pb_dublin_coverage_dublin_vocab_site-meta]").after("<hr>");
});
