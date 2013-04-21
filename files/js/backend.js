jQuery(document).ready(function() { 
    jQuery("#addon_news .rex-table").addClass("tablesorter");
	jQuery("#addon_news .rex-table").tablesorter({
		headers: {
			0: { sorter: false },
			3: { sorter: false },
			4: { sorter: false },
			5: { sorter: false },
			6: { sorter: false },
            7: { sorter: false },
            8: { sorter: false },
            9: { sorter: false },
		   10: { sorter: false }
		}
	}); 
    jQuery('.warningDisplayInfo').parent('p').find('textarea').addClass('warningDisplayInfoP');
});