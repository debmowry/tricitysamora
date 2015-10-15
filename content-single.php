<?php
/**
 * @package a11yall-child
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 id="page-title"><?php the_title(); ?></h1>
        <?php
            // Check for post_category = exhibit subtitle
            if(get_field('event_subtitle')) { echo '<h2 class="subtitle">'; the_field('event_subtitle'); echo '</h2>'; }
        ?>
    </header>
    <div class="entry clearfix">
        <?
            // Check for post_category = exhibit date and times
            if (get_field('event_date')) {
                echo '<h3 class="eventdate">';
                $datevalues = explode("/", get_field('event_date'));
                echo '<time datetime="'. $datevalues[0] .'">'. $datevalues[1] .'</time>';
                if (get_field('event_btime')) {
                    echo ' at <span>'; the_field('event_btime');
                    if (get_field('event_etime')) { echo ' - '; the_field('event_etime'); }
                    echo '</span>';
                }
                echo '</h3>';
            }
            // Check for post_category = exhibit begin date, end date and times
            if (get_field('event_begin')) {
                echo '<h3 class="eventdate">';
                $beginvalues = explode("/", get_field('event_begin'));
                $begindate = explode(" ", $beginvalues[1]);
                echo '<time datetime="'. $beginvalues[0] .'">'. $begindate[0] .'., '. $begindate[1] .'. '. $begindate[2] .'</time>';
                if (get_field('event_end')) {
                    $endvalues = explode("/", get_field('event_end'));
                    $enddate = explode(" ", $endvalues[1]);
                    echo ' - <time datetime="'. $endvalues[0] .'">'. $enddate[0] .'., '. $enddate[1] .'. '. $enddate[2] .'</time>';
                }
                echo ', ';
                if ($endvalues) { echo $enddate[3]; } else { $begindate[3]; }
                if (get_field('event_btime')) {
                    echo ' at <span>'; the_field('event_btime');
                    if (get_field('event_etime')) { echo ' - '; the_field('event_etime'); }
                    echo '</span>';
                }
                echo '</h3>';
            }
            // Check for post_category = exhibit featured artist
            if (get_field('event_artist')) {
                echo '<h3 class="theartist">'; the_field('event_artist'); echo '</h3>';
            }
            the_content();
                wp_link_pages( array(
                    'before' => '<p class="page-links">' . __( 'Pages: ', 'a11yall' ),
                    'after'  => '</p>',
                    )
                );
        ?>
    </div><!--.entry-->
    <p class="postmetadata">
        <?php
            _e('Posted on <time datetime="','a11yall');
            echo date('Y-m-d') . '">';
            the_time('F j, Y');
            _e('</time> by ','a11yall');
            the_author_link();
            echo '<br />';
            _e('Categories: ','a11yall');
            the_category(', ');
            echo '<br />';
            the_tags();
        ?>
    </p>
    <?php
        $editpost =  sprintf( __('Edit This Post' , 'a11yall') );
        edit_post_link($editpost, '<p class="button editlink">', '</p>');
    ?>
</article>
