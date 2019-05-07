<?php
/**
 * Team Member box
 *
 *
 * @package WordPress
 * @subpackage Howes
 * @since Howes 1.0
 */

global $howes;
$teamcat_column = ( isset($howes['teamcat_column']) && trim($howes['teamcat_column'])!='' ) ? trim($howes['teamcat_column']) : 'three' ;

?>
<?php echo thememount_teammemberbox($teamcat_column); ?>
