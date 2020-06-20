<?php get_header(); ?>

<section id="home">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <?php the_content() ?>


        <?php endwhile;
        endif ?>

    </div>
    <div class="container-fluid">
        <ul>
            <?php $the_query = new WP_Query('posts_per_page=5'); ?>

            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                    <div class="card posts">
                        <img class="card-img-top img-fluid" src="
                    <?php
                    if (has_post_thumbnail()) { // check if the post has a Post Thumbnail assigned to it.
                        the_post_thumbnail_url('medium');
                    }
                    ?>" alt="">
                        <div class="card-body d-flex flex-column">
                            <div class="card-title">
                                <a href="<?php the_permalink() ?>">
                                    <?php the_title() ?>
                                </a>
                            </div>

                            <div class="card-text">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-success mt-auto"> Devamı</a>
                        </div>
                    </div>

            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </ul>
    </div>

    <div class="container">
        <?php dynamic_sidebar('recentposts'); ?>
    </div>
</section>


</div>
<?php get_footer(); ?>