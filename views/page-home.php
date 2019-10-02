<?php /* Template Name: Home */ ?>
<?php include('partials/header.php') ?>

<section class="section section--no-padding">
  <div class="container tc-offset-of-header">
    <div class="columns">
      <section class="column is-two-thirds">
        <div class="tc-about-us">
          <div class="tc-white-box">
            <!-- <h3 class="tc-subtitle">Onze vereniging</h2>
            <h2 class="tc-title">TC de Uithof</h2>
            <p>TC de Uithof is de enige studententennisvereniging van Utrecht en met ruim 550 leden tevens de grootste van Nederland. De vereniging biedt naast de vele tennisactiviteiten zoals trainingen, competitie en toernooien, ook veel gezelligheid. Jaarlijkse hoogtepunten zijn onder andere het ledenweekend, wintersport en het bezoeken van Roland Garros. Verder heeft TC de Uithof elke donderdag een clubavond, waarvan elke eerste donderdag van de maand om 21.00 uur een borrel in stamkroeg Café de Rex.</p>
            <p>Zowel beginnende als gevorderde tennissers kunnen bij TC de Uithof terecht. Trainingen worden gegeven op alle niveaus. En voor de beste spelers van de vereniging is een selectie opgericht.</p>
            <p>Ben je geïnteresseerd in een lidmaatschap bij TC de Uithof? Neem gerust een kijkje op onze website en voor vragen kun je altijd naar: secretaris@tcdeuithof.nl.</p> -->
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
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
      </section>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="tc-sponsors">
      <div class="text-center">
        <h3 class="tc-subtitle">Lorem ipsum</h2>
        <h2 class="tc-title">Onze partners</h2>
      </div>
    </div>
    <div class="tc-partners">
      <?php if(have_rows('partners')): while( have_rows('partners') ): the_row(); ?>
        <a href="#" target="_blank" class="tc-partners__partner">
          <img src="<?= get_sub_field('logo'); ?>">
        </a>
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>

<!-- <section class="section section--grey section--rounded">
  <div class="container">
    <div class="columns">
      <div class="column">
        <div class="tc-bestuur">
          <div class="text-center">
            <h3 class="tc-subtitle">Blijf up to date</h2>
            <h2 class="tc-title">Het laatste nieuws</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->

<section class="section">
  <div class="container">
    <div class="text-center">
      <h3 class="tc-subtitle">Volg ons op</h2>
      <h2 class="tc-title">Instagram</h2>
    </div>
    <?php echo wdi_feed(array('id'=>'1')); ?>
  </div>
</section>


<?php include('partials/footer.php') ?>