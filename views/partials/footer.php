  <footer class="tc-footer">
    <section class="section section--no-padding">
      <div class="container">
        <div class="tc-footer__intro">
          <div class="columns">
            <div class="column">
              <a href="/" class="tc-footer__logo">
                <img class="tc-footer__logo__image" src="/wp-content/themes/tcdeuithof-redesign/images/logo.png" alt="TC de Uithof logo">
                <div class="tc-footer__logo__text">TC de Uithof</div>
              </a>
            </div>
            <div class="column">
              <div class="tc-footer__social">
                <span>Volg ons op: </span>
                <a href="https://www.facebook.com/tc.deuithof/" target="_blank"><img src="/wp-content/themes/tcdeuithof-redesign/images/facebook.svg" alt="facebook"></a>
                <a href="http://instagram.com/tcdeuithof/"><img src="/wp-content/themes/tcdeuithof-redesign/images/instagram.svg" alt="instagram"></a>
              </div>
            </div>
          </div>
        </div>
        <div class="tc-footer__links">
          <?php wp_nav_menu( array( 'theme_location' => 'footer_menu' ) ); ?>
          <?php wp_nav_menu( array( 'theme_location' => 'footer_contact_menu' ) ); ?>
        </div>
        <div class="tc-footer__privacy">
          <?php wp_nav_menu( array( 'theme_location' => 'footer_privacy_menu' ) ); ?>
          <a href="https://www.linkedin.com/in/vince-van-noort" target="_blank" rel="no-follow">Ontwerp & Ontwikkeling: Vince van Noort</a>
        </div>
      </div>
    </section>
  </footer>
  <?php wp_footer(); ?>
</body>
</html>