<?php /* Template Name: Event */ ?>
<?php include('partials/header.php') ?>
<?php global $EM_Event; ?>
<section class="section section--no-padding">
  <div class="container tc-offset-of-header">
    <div class="columns">
      <section class="column is-two-thirds">
        <div class="tc-about-us">
          <div class="tc-white-box">
            <h3 class="tc-subtitle"><?= $EM_Event->start(); ?> - <?= $EM_Event->end(); ?></h2>
            <h2 class="tc-title"><?= $EM_Event->event_name; ?></h2>
            <?= $EM_Event->output_single(); ?>
            <!-- <p>Vriendjesdag 2019 van dé Studenten Tennisvereniging van Utrecht staat weer voor de deur!!! Met in deze editie een biercantus als kers op de 'TC de Uithof'-taart! Dat wil je zeker niet missen. </p> -->
          </div>
        </div>
      </section>
      <section class="column is-one-third">
        <div class="tc-information">
          <div class="tc-white-box">
            <h3 class="tc-subtitle">Evenement</h2>
            <h2 class="tc-title">Informatie</h2>
            <table>
              <tr><td>Start:</td><td><?= $EM_Event->start(); ?></td></tr>
              <tr><td>Eind:</td><td><?= $EM_Event->end(); ?></td></tr>
              <tr><td>Locatie:</td><td><?= $EM_Event->get_location()->name; ?></td></tr>
              <tr><td>Adres:</td><td><?= $EM_Event->get_location()->address; ?></td></tr>
              <tr><td>Stad:</td><td><?= $EM_Event->get_location()->town; ?></td></tr>
            </table>
          </div>
        </div>
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
<?php include('partials/footer.php') ?>