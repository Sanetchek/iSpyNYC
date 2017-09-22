<?php
$images = get_field('images');
$iframe = get_field('oembed');
$video = get_field('video');
$audio = get_field('audio');

if( $images ) {
    $images;
} else {
    $images = array();
}

if( $iframe ) {
    $iframe;
} else {
    $iframe = array();
}

if( $video ) {
    $video;
} else {
    $video = array();
}

if( $audio ) {
    $audio;
} else {
    $audio = array();
}
?>

<div class="media-array">
    <?php if( $images ): ?>
        <?php foreach( $images as $image ): ?>
            <div class="media">
                <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if( $iframe ): ?>
        <div class="embed-container media">

            <?php
            $iframe_url = get_field('oembed', FALSE, FALSE);
            $video_thumb_url = get_video_thumbnail_uri($iframe_url);
            ?>
                <img class="iframeplay2" src="<?php bloginfo('template_url') ?>/images/play.png" alt="play">
                <img src="<?php echo $video_thumb_url; ?>" alt=""  />
        </div>
    <?php endif; ?>

    <?php if( $video ): ?>
        <div id="video-container" class="media">
            <video id="my_video" src="<?php echo $video['url']; ?>" controls>
                <p>Your browser does not support the video tag.</p>
            </video>
        </div>
    <?php endif; ?>

    <?php if( $audio ): ?>
        <div class="media">
            <audio controls>
                <source src="<?php echo $audio['url']; ?>" >
                <p>Your browser does not support the audio tag.</p>
            </audio>
        </div>
    <?php endif; ?>

</div>