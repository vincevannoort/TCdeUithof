<!DOCTYPE html>
<html>
<head>
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body>

  <header class="tc-header">
    <section class="section section--no-padding">
        <div class="container">
          <a href="<?php get_site_url(); ?>" class="tc-header__logo">
            <img class="tc-header__logo__image" src="/wp-content/themes/tcdeuithof-redesign/images/logo.png" alt="TC de Uithof logo">
          </a>
          <a href="#" class="tc-header__links__mobile__open">
            <div class="tc-header__links__mobile__open__icon">
              <span class="line line-1"></span>
              <span class="line line-2"></span>
              <span class="line line-3"></span>
            </div>
          </a>
          <div class="tc-header__links">
            <?php wp_nav_menu( array( 'theme_location' => 'header_menu_left' ) ); ?>
          </div>
          <div class="tc-header__login">
            <?php wp_nav_menu( array( 'theme_location' => 'header_menu_right' ) ); ?>
          </div>
        </div>
    </section>
  </header>

  <section class="tc-slider">
    <?php if(have_rows('slides')): while( have_rows('slides') ): the_row(); ?>
      <div class="tc-slider__slide" style="background-image: url('<?= get_sub_field('afbeelding') ?>');">
        <section class="section section--no-padding">
          <div class="container">
            <div class="columns">
              <div class="column is-four-fifths">
                <h2 class="tc-slider__slide__subheading"><?= get_sub_field('subtitel') ?></h1>
                <h1 class="tc-slider__slide__heading"><?= get_sub_field('titel') ?></h1>
              </div>
            </div>
          </div>  
        </section>
      </div>
    <?php endwhile; else: ?>
      <?php 
        $background_image = get_the_post_thumbnail_url();
        if (!$background_image) $background_image = '/wp-content/themes/tcdeuithof-redesign/images/main.jpg';
      ?>
      <div class="tc-slider__slide tc-slider__slide--standard-image" style="background-image: url('<?= $background_image; ?>');">
      </div>
    <?php endif; ?>
  </section>