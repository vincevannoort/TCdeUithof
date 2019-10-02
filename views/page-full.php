<?php /* Template Name: Volledige breedte */ ?>
<?php include('partials/header.php'); ?>
<section class="section section--no-padding">
  <div class="container tc-offset-of-header">
    <div class="columns">
      <section class="column">
        <div class="tc-about-us">
          <div class="tc-white-box">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h3 class="tc-subtitle"><?php if ( function_exists('yoast_breadcrumb') )  yoast_breadcrumb( '<span class="tc-breadcrumbs">','</span>' ); ?></h2>
            <h2 class="tc-title"><?php the_title(); ?></h2>
            <?php the_content(); ?>
            <?php endwhile; endif; ?>
          </div>
        </div>
      </section>
    </div>
  </div>
</section>
<?php include('partials/footer.php'); ?>