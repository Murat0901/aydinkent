<?php get_header(); ?>

<div class="container-fluid mt-5 ">
    <div class="row">
        <div class="col-md-8">
            <h1><?php the_title() ?></h1>

            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid">
            <?php endif; ?>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <?php the_content() ?>

            <?php endwhile;
            endif ?>
        </div>
        <div class="col-md-4">
            <div class="recent">
                <ul>
                    <?php $the_query = new WP_Query('posts_per_page=4'); ?>

                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                        <div class="card posts">
                            <h4 class="card-title"> <?php dynamic_sidebar('baslik'); ?>
                            </h4>
                            <img class="card-img-top img-fluid" src="
                            <?php
                            if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
                                the_post_thumbnail_url('thumbnail');
                            }
                            ?>" alt="">
                            <div class="card-body d-flex flex-column">
                                <div class="card-title">
                                    <a href="<?php the_permalink() ?>">
                                        <?php the_title() ?>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
            <div>
                <?php dynamic_sidebar('popular'); ?>
            </div>
        </div>
    </div>

</div>

</div>
<?php get_footer(); ?>