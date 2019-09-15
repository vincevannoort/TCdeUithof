<?php
/**
* Template Name: Verwijderen-Reserveringen
*/
    get_header();
    ?>
    
    <div id="primary" class="content-area-post">
    	<main id="main" class="site-main" role="main">
    	    <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
        	    <div class="single-thumb">
                    <img size = 'single' src="<?php bloginfo('template_directory'); ?>-child/images/default.jpg">
                    <!-- donkere overlay om er tekst over te hebben -->
                    <div class="single-thumb-overlay"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></div>
                </div>
                <div class="entry-content">
                    <?php
                        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        $data = intval(explode("verwijder-tickets/", $url)[1]);
                        $id = get_current_user_id();
                        global $wpdb;
                        $ticket_booking = $wpdb->get_results('SELECT ticket_id, booking_id, ticket_booking_spaces FROM wp_3_em_tickets_bookings WHERE ticket_booking_id =' . $data);
                        $ticket = $wpdb->get_results('SELECT ticket_end FROM wp_3_em_tickets WHERE ticket_id =' . $ticket_booking[0]->ticket_id);
                        $booking = $wpdb->get_results('SELECT person_id, event_id, booking_spaces FROM wp_3_em_bookings WHERE booking_id = ' . $ticket_booking[0]->booking_id);
                        $event = $wpdb->get_results('SELECT event_rsvp_date, event_rsvp_time FROM wp_3_em_events WHERE event_id = ' . $booking[0]->event_id);
                        $dt = new DateTime();
                        // als de user niet de eigenaar is of als er geen ticket_booking_id met de URL is meegegeven
                        if ($id != $booking[0]->person_id)
                        {
                            ?>
                            Er is iets fout gegaan, als je probeert een reservering aan te passen en je bent hier gekomen mail naar de <a href="mailto:webcie@tcdeuithof.nl">WebCie</a>. <br>
                            Klik <a href =<?php echo bp_loggedin_user_domain( '/' ) . "reserveringen"; ?>>hier</a> om terug naar je reserveringen te gaan.
                            <?php
                        }
                        // als de rsvp tijd al verstreken is
                        else if (($ticket[0]->ticket_end < $dt->format('Y-m-d H:i:s') && $ticket[0]->ticket_end) || (!$ticket[0]->ticket_end && ($event[0]->event_rsvp_date < $dt->format('Y-m-d') || ($event[0]->event_rsvp_date == $dt->format('Y-m-d') && $event[0]->event_rsvp_time < $dt->format('H:i:s')))))
                        {
                            ?>
                            Het is niet meer mogelijk om je ticket aan te passen, klik <a href =<?php echo bp_loggedin_user_domain( '/' ) . "reserveringen"; ?>>hier</a> om terug naar je reserveringen te gaan.
                            <?php
                        }
                        else
                        {
                            // verwijderen en redirect
                            $wpdb->delete('wp_3_em_tickets_bookings', array('ticket_id' => $ticket_booking[0]->ticket_id, 'booking_id' => $ticket_booking[0]->booking_id));
                            if (count($wpdb->get_results('SELECT ticket_id, booking_id FROM wp_3_em_tickets_bookings WHERE booking_id =' . $ticket_booking[0]->booking_id)) == 0)
                            {
                                $wpdb->delete('wp_3_em_bookings', array('booking_id' => $ticket_booking[0]->booking_id));
                            }
                            else
                            {
                                $wpdb->update('wp_3_em_bookings', array('booking_spaces' => ($booking[0]->booking_spaces - $ticket_booking[0]->ticket_booking_spaces)), array('booking_id' => $ticket_booking[0]->booking_id));
                            }
                            ?>
                            Het is gelukt, klik <a href =<?php echo bp_loggedin_user_domain( '/' ) . "reserveringen"; ?>>hier</a> om terug naar je reserveringen te gaan.
                            <?php
                        }
                    ?>
                </div>
            </article>
    	</main><!-- .site-main -->
    </div><!-- .content-area -->
    <?php
    get_footer();
?>