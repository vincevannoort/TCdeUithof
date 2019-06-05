<?php include('views/partials/header.php') ?>
<section class="section section--no-padding">
  <div class="container tc-offset-of-header">
    <div class="columns">
      <section class="column is-two-thirds">
        <div class="tc-about-us">
          <div class="tc-white-box">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h3 class="tc-subtitle"><?php if ( function_exists('yoast_breadcrumb') )  yoast_breadcrumb( '<span class="tc-breadcrumbs">','</span>' ); ?></h2>
            <h2 class="tc-title"><?php the_title(); ?></h2>
            <?php if ( !empty( get_the_content() ) ): ?>
              <?php the_content(); ?>
            <?php else: ?>
              Deze pagina is nog leeg en moet worden gevuld met content.
            <?php endif; ?>
            <?php endwhile; endif; ?>
          </div>
        </div>
      </section>
      <section class="column is-one-third">
        <div class="tc-events">
          <div class="tc-white-box">
            <h3 class="tc-subtitle">Aankomende</h2>
            <h2 class="tc-title">Activiteiten</h2>
            <?= em_get_events(); ?>
          </div>
        </div>
        <?php /** if page is parent or has a parent with children */
        if(has_children(wp_get_post_parent_id($post->ID)) || has_children($post->ID)): ?>
        <div class="tc-white-box">
          <h3 class="tc-subtitle">Relevante</h2>
          <h2 class="tc-title">Pagina's</h2>
          <div class="tc-pages-side">
            <?= wp_list_pages(array('title_li' => '')); ?>
          </div>
        </div>
        <?php endif; ?>
      </section>
    </div>
  </div>
</section>
<?php include('views/partials/footer.php') ?>