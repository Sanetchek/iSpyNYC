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
<div class="slider">
    <div class="al-slider">
        <?php if( $images ): ?>
            <?php foreach( $images as $image ): ?>
                <div class="slide">
                    <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if( $iframe ): ?>
            <div class="slide">

                <?php
                $iframe_url = get_field('oembed', FALSE, FALSE);
                $video_thumb_url = get_video_thumbnail_uri($iframe_url);
                ?>
                    <img class="iframeplay2" src="<?php bloginfo('template_url') ?>/images/play.png" alt="play">
                    <img src="<?php echo $video_thumb_url; ?>" alt=""  />
            </div>
        <?php endif; ?>

        <?php if( $video ): echo $video['types']; ?>
            <div class="slide">
                <video controls>
                    <source src="<?php echo $video['url']; ?>">
                    <p>Your browser does not support the video tag.</p>
                </video>
            </div>
        <?php endif; ?>

        <?php if( $audio ): ?>
            <div class="slide">
                <i class="fa fa-music fa-4x slide-audio" aria-hidden="true"></i>
                <audio controls>
                    <source src="<?php echo $audio['url']; ?>" >
                    <p>Your browser does not support the audio tag.</p>
                </audio>
            </div>
        <?php endif; ?>

        <div class="prev-slide"><span class="fa fa-angle-left"></span></div>
        <div class="next-slide"><span class="fa fa-angle-right"></span></div>
    </div>

</div>
<script type="text/javascript">
    jQuery(function ($) {
        $('.al-slider').alSlider();
    });
</script>