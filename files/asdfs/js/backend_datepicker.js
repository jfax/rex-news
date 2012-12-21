jQuery(document).ready(function() { 

    jQuery("#rex_336_news_News_anlegen_online_date").datepicker(
        {
            numberOfMonths: 2, 
            showButtonPanel: true, 
            appendText: '(yyyy-mm-dd)', 
            dateFormat: 'yy-mm-dd', 
            showOn: 'button', 
            buttonImage: '../files/addons/news/images/calendar.gif', 
            buttonImageOnly: true
        }        
    );
    jQuery("#rex_336_news_News_anlegen_archive_date").datepicker(
        {
            numberOfMonths: 2, 
            showButtonPanel: true, 
            appendText: '(yyyy-mm-dd)', 
            dateFormat: 'yy-mm-dd', 
            showOn: 'button', 
            buttonImage: '../files/addons/news/images/calendar.gif', 
            buttonImageOnly: true
        }        
    );
    jQuery("#rex_336_news_News_anlegen_offline_date").datepicker(
        {
            numberOfMonths: 2, 
            showButtonPanel: true, 
            appendText: '(yyyy-mm-dd)', 
            dateFormat: 'yy-mm-dd', 
            showOn: 'button', 
            buttonImage: '../files/addons/news/images/calendar.gif', 
            buttonImageOnly: true
        }        
    );
    jQuery("#rex_336_news_News_editieren_online_date").datepicker(
        {
            numberOfMonths: 2, 
            showButtonPanel: true, 
            appendText: '(yyyy-mm-dd)', 
            dateFormat: 'yy-mm-dd', 
            showOn: 'button', 
            buttonImage: '../files/addons/news/images/calendar.gif', 
            buttonImageOnly: true
        }        
    );
    jQuery("#rex_336_news_News_editieren_archive_date").datepicker(
        {
            numberOfMonths: 2, 
            showButtonPanel: true, 
            appendText: '(yyyy-mm-dd)', 
            dateFormat: 'yy-mm-dd', 
            showOn: 'button', 
            buttonImage: '../files/addons/news/images/calendar.gif', 
            buttonImageOnly: true
        }        
    );
    jQuery("#rex_336_news_News_editieren_offline_date").datepicker(
        {
            numberOfMonths: 2, 
            showButtonPanel: true, 
            appendText: '(yyyy-mm-dd)', 
            dateFormat: 'yy-mm-dd', 
            showOn: 'button', 
            buttonImage: '../files/addons/news/images/calendar.gif', 
            buttonImageOnly: true
        }        
    );
    jQuery("#rex_336_news_News_anlegen_online_date").datepicker("setDate",  new Date());
    jQuery("#rex_336_news_News_anlegen_archive_date").datepicker("setDate","+6m");
    jQuery("#rex_336_news_News_anlegen_offline_date").datepicker("setDate", "+2y");

});