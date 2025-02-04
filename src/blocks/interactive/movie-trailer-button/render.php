<?php
$wrapper_attributes = get_block_wrapper_attributes(
	array( 'class' => 'wpmovies-trailer-button' )
);

$post      = get_post();
$play_icon = file_get_contents( get_template_directory() . '/assets/play.svg' );
$videos    = get_post_meta( $post->ID, '_wpmovies_videos', true );
$trailers  = array_filter( json_decode( $videos, true ), function( $video ) {
	return $video['type'] === 'Trailer';
} );

if ( count( $trailers ) !== 0 ) {
	$trailer_url = reset( $trailers )['url'];
	$trailer_id  = substr( $trailer_url, strpos( $trailer_url, '?v=' ) + 3 );
?>

<div <?php echo $wrapper_attributes; ?> wp-context='{ "videoId": "<?php echo $trailer_id; ?>" }'>
	<div class="wpmovies-page-button-parent" wp-on:click="actions.wpmovies.setVideo">
		<div class="wpmovies-page-button-child">
			<?php echo $play_icon; ?><span>Play trailer</span>
		</div>
	</div>
</div>

<?php } ?>
