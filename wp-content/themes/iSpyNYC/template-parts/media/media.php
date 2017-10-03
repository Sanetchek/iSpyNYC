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
<?php if( (count($images) > 2) || (count($images) >= 2 and $iframe) || (count($images) >= 2 and $audio) || (count($images) >= 2 and $video) || (count($images) >= 1 and $video and $iframe and $audio) ) : ?>
<div class="media-array">
    <?php if( $images ): ?>
        <?php foreach( $images as $image ): ?>
    <div class="media">
        <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
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
            <img src="<?php echo $video_thumb_url; ?>" alt="" width="134px" height="149px" />
    </div>
    <?php endif; ?>

    <?php if( $video ): ?>
    <div id="video-container" class="media">
        <img class="iframeplay2" src="<?php bloginfo('template_url') ?>/images/play.png" alt="play">
        <video id="my_video" src="<?php echo $video['url']; ?>" width="134px" height="149px" >
            <p>Your browser does not support the video tag.</p>
        </video>
    </div>
    <?php endif; ?>

    <?php if( $audio ): ?>
        <div class="media audio-light">
            <i class="fa fa-music fa-4x slide-audio" aria-hidden="true"></i>
            <img class="iframeplay2" src="<?php bloginfo('template_url') ?>/images/play.png" alt="play">
        </div>
    <?php endif; ?>

</div>
<div class="more-media">
    <span><?php
        $countVideo = 0;
        $countAudio = 0;
        if($video){
            $countVideo = count($video) - 16;
        }
        if($audio){
            $countAudio = count($audio) - 14;
        }
            echo( "+" . (count($images) + count($iframe) + $countVideo + $countAudio - 1 ) );

        ?></span>
    <div class="media-bg"></div>
</div>

<?php elseif( (count($images) == 1 && $iframe) || (count($images) == 1 && $video) || ($video && $iframe) || (count($images) == 2) || (count($images) == 1 && $audio) || ($video && $audio) || ($iframe && $audio) ) : ?>

    <?php if( $images ): ?>
        <?php foreach( $images as $image ): ?>
            <div class="media">
                    <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
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
            <img src="<?php echo $video_thumb_url; ?>" alt="" width="134px" height="149px" />
        </div>
    <?php endif; ?>

    <?php if( $video ): ?>
        <div id="video-container" class="media">
            <img class="iframeplay2" src="<?php bloginfo('template_url') ?>/images/play.png" alt="play">
            <video id="my_video" src="<?php echo $video['url']; ?>" width="134px" height="149px" >
                <p>Your browser does not support the video tag.</p>
            </video>
        </div>
    <?php endif; ?>

    <?php if( $audio ): ?>
        <div class="media audio-light">
            <i class="fa fa-music fa-4x slide-audio" aria-hidden="true"></i>
            <img class="iframeplay2" src="<?php bloginfo('template_url') ?>/images/play.png" alt="play">
        </div>
    <?php endif; ?>

<?php elseif( count($images) == 1 || $iframe || $video || $audio ) :  ?>

        <?php if( $images ): ?>
            <?php foreach( $images as $image ): ?>
                <div class="media">
                    <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if( $iframe ): ?>
            <div class="media">

                <?php
                    $iframe_url = get_field('oembed', FALSE, FALSE);
                    $video_thumb_url = get_video_thumbnail_uri($iframe_url);
                ?>
                <img class="iframeplay1" src="<?php bloginfo('template_url') ?>/images/play.png" alt="play">
                <img src="<?php echo $video_thumb_url; ?>" alt="" width="270px" height="149px" />
            </div>
        <?php endif; ?>

        <?php if( $video ): ?>
            <div id="video-container" class="media">
                <img class="iframeplay1" src="<?php bloginfo('template_url') ?>/images/play.png" alt="play">
                <video id="my_video" src="<?php echo $video['url']; ?>" width="270px" height="149px" >
                    <p>Your browser does not support the video tag.</p>
                </video>
            </div>
        <?php endif; ?>

        <?php if( $audio ): ?>
            <div class="media audio-light-full">
                <i class="fa fa-music fa-4x slide-audio" aria-hidden="true"></i>
                <img class="iframeplay1" src="<?php bloginfo('template_url') ?>/images/play.png" alt="play">
            </div>
        <?php endif; ?>

<?php endif; ?>