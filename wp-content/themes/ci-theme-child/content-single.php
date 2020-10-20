<?php
    $subhead = get_post_meta($post->ID, 'Post Subhead', true);

    $post_thumb = get_the_post_thumbnail_url();
    $post_categories = wp_get_post_categories($post->ID, array('fields' => 'all'));

    $author_first = get_the_author_meta('first_name');
    $author_last = get_the_author_meta('last_name');
    $author_description = get_the_author_meta('description');
    $author_email = get_the_author_meta('user_email');
    $author_avatar = get_avatar_url($author_email);
?>

<article 
    <?php post_class( 'fl-post' ); ?> id="fl-post-<?php the_ID(); ?>"<?php FLTheme::print_schema( ' itemscope itemtype="https://schema.org/BlogPosting"' ); ?>>
    
    <?php if (!empty($post_categories)): ?>
        <ul class="post-categories list-unstyled">
            <?php foreach($post_categories as $category): ?>
                <li><?php echo $category->name?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>

    <div class="fl-post__description">
        <h1 class="fl-post__description__title" style="<?php if (!$subhead): ?>margin-bottom: 50px; <?php endif; ?>"><?php the_title(); ?></h1>
        <?php if ($subhead): ?>
            <h2 class="fl-post__description__subhead"> <?php echo $subhead ?></h2>
        <?php endif; ?>

        <div class="fl-post__description__author">
            <?php if ($author_avatar): ?>
                <img src="<?php echo $author_avatar?>" alt="Author photo">
            <?php else: ?>
                <div class="fl-post__description__author--no-img"></div>
            <?php endif; ?>
            <p>
                <?php echo $author_first ." ". $author_last ?>
                <?php if ($author_description): ?>
                    <?php echo ", ". $author_description?>
                <?php endif; ?>
            </p>
        </div>
        
        <div class="fl-post__description__date">
            <time>
                Published <?php the_date(); ?>
            </time>
            
            <time>
                Last updated <?php the_modified_date(); ?>
            </time>
        </div>

        
        <div class="fl-post__description__featured">
            <?php if ($post_thumb): ?>
                <img src="<?php echo $post_thumb?>" alt="Post thumb">
            <?php else: ?>
                <div class="fl-post__description__featured--no-img"></div>
            <?php endif; ?>
        </div>

        <div class="fl-post__description__body">
            <?php the_content(); ?>
        </div>
    </div>

</article>

<!-- .fl-post -->
