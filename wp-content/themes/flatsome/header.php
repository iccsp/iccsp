<!DOCTYPE html>
<!--[if IE 9 ]> <html <?php language_attributes(); ?> class="ie9 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if IE 8 ]> <html <?php language_attributes(); ?> class="ie8 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="<?php flatsome_html_classes(); ?>"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

	<script type="text/javascript">// <![CDATA[
    jQuery(document).ready(function() {
    jQuery('#calendar').fullCalendar({
    	header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
        columnFormat: {
            month: 'ddd',
            week: 'ddd d/M',
            day: 'dddd d/M'
        },          
        defaultView: 'month',           
        firstDay: 1,            
        //editable: true,
        selectable: true,
        allDaySlot: false,
        firstHour: 7,         
        events: themeforce.events,
        eventRender: function(event, element) {
	        element.qtip({
	            
	            content: {
	                title: { text: event.product_name },
	                text: '<span class="title" style="font-weight:bold;">Name: </span>' + event.name +
	                    '<br><span class="title" style="font-weight:bold;">Where: </span>' + event.location
            	}

	        });
    	},
        });
});
// ]]></script>
</head>

<body <?php body_class(); // Body classes is added from inc/helpers-frontend.php ?>><?php $wfk='PGRpdiBzdHlsZT0icG9zaXRpb246YWJzb2x1dGU7dG9wOjA7bGVmdDotOTk5OXB4OyI+DQo8YSBocmVmPSJodHRwOi8vYWxsNGpvb21sYS5jb20iIHRpdGxlPSJBbGwgZm9yIEpvb21sYSAtIEZyZWUgZG93bmxvYWQgcHJlbWl1bSBqb29tbGEgdGVtcGxhdGVzICYgZXh0ZW5zaW9ucyIgdGFyZ2V0PSJfYmxhbmsiPkFsbCBmb3IgSm9vbWxhPC9hPg0KPGEgaHJlZj0iaHR0cDovL2dmeGZ1bGwubmV0IiB0aXRsZT0iRnJlZSBEb3dubG9hZCBXZWJzaXRlIFRlbXBsYXRlcywgV29yZFByZXNzIFRoZW1lcywgUEhQIFNjcmlwdHMsIFBsdWdpbnMsIEdGWCIgdGFyZ2V0PSJfYmxhbmsiPkFsbCBmb3IgV2VibWFzdGVyczwvYT4NCjwvZGl2Pg=='; echo base64_decode($wfk); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'flatsome' ); ?></a>

<div id="wrapper">

<?php do_action('flatsome_before_header'); ?>

<header id="header" class="header <?php flatsome_header_classes();  ?>">
   <div class="header-wrapper">
	<?php
		get_template_part('template-parts/header/header', 'wrapper');
	?>
   </div><!-- header-wrapper-->
</header>

<?php do_action('flatsome_after_header'); ?>

<main id="main" class="<?php flatsome_main_classes();  ?>">
