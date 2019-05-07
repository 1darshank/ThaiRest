<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header(); ?>
<div class="container">
<div class="row">

	<div id="tribe-events-pg-template" class="col-md-12 col-lg-12 col-xs-12">
		<?php tribe_events_before_html(); ?>
		<?php tribe_get_view(); ?>
		<?php tribe_events_after_html(); ?>
	</div> <!-- #tribe-events-pg-template -->

</div> <!-- .row -->
</div> <!-- .container -->
<?php get_footer(); ?>