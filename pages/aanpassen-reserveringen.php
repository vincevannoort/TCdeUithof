<?php
/**
* Template Name: Aanpassen-Reserveringen
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
                        $data = intval(explode("aanpassen-tickets/", $url)[1]);
                        $id = get_current_user_id();
                        global $wpdb;
                        $ticket_booking = $wpdb->get_results('SELECT ticket_id, booking_id, ticket_booking_spaces FROM wp_3_em_tickets_bookings WHERE ticket_booking_id =' . $data);
                        $ticket = $wpdb->get_results('SELECT ticket_end, ticket_price, ticket_max, ticket_spaces FROM wp_3_em_tickets WHERE ticket_id =' . $ticket_booking[0]->ticket_id);
                        $booking = $wpdb->get_results('SELECT person_id, event_id FROM wp_3_em_bookings WHERE booking_id = ' . $ticket_booking[0]->booking_id);
                        $event = $wpdb->get_results('SELECT event_rsvp_date, event_rsvp_time FROM wp_3_em_events WHERE event_id = ' . $booking[0]->event_id);
                        $dt = new DateTime();
                        // niet van de persoon die er probeert te komen of geen data in de url mee
                        if ($id != $booking[0]->person_id)
                        {
                            ?>
                            Er is iets fout gegaan, als je probeert een reservering aan te passen en je bent hier gekomen mail naar de <a href="mailto:webcie@tcdeuithof.nl">WebCie</a>. <br>
                            Klik <a href =<?php echo bp_loggedin_user_domain( '/' ) . "reserveringen"; ?>>hier</a> om terug naar je reserveringen te gaan.
                            <?php
                        }
                        // als de rsvp data al verstreken is
                        else if (($ticket[0]->ticket_end < $dt->format('Y-m-d H:i:s') && $ticket[0]->ticket_end) || (!$ticket[0]->ticket_end && ($event[0]->event_rsvp_date < $dt->format('Y-m-d') || ($event[0]->event_rsvp_date == $dt->format('Y-m-d') && $event[0]->event_rsvp_time < $dt->format('H:i:s')))))
                        {
                            ?>
                            Het is niet meer mogelijk om je ticket aan te passen, klik <a href =<?php echo bp_loggedin_user_domain( '/' ) . "reserveringen"; ?>>hier</a> om terug naar je reserveringen te gaan.
                            <?php
                        }
                        else
                        {
                            $event = $wpdb->get_results('SELECT ticket_max FROM wp_3_em_events WHERE event_id = ' . $booking[0]->event_id);
                            // $otherTickets zijn andere tickets van dezelfde event op dezelfde user
                            $otherTickets = $wpdb->get_results('SELECT ticket_booking_spaces FROM wp_3_em_tickets_bookings WHERE booking_id = ' . $ticket_booking[0]->booking_id . 'AND ticket_id <> ' . $ticket_booking[0]->ticket_id);
                            $otherTicketsTotal = 0;
                            foreach ($otherTickets as $otherTicket)
                            {
                                $otherTicketsTotal += $otherTicket->ticket_booking_spaces;
                            }
                            // $currentAmountOfTickets is als je meerdere tickets hebt maar aantal plaatsen per ticket * ticket is kleiner dan totale plaatsen 
                            // bijv gala met donatie en geen donatie, maakt niet uit welk kaartje ze kopen voor plekken maar komt per ticket in de db dus $currentAmountOfTickets telt die bij elkaar
                            $total = $wpdb->get_results('SELECT ticket_booking_spaces FROM wp_3_em_tickets_bookings WHERE booking_id <> ' . $ticket_booking[0]->booking_id . 'AND ticket_id = ' . $ticket_booking[0]->ticket_id);
                            $currentAmountOfTickets = 0;
                            foreach($total as $t)
                            {
                                $currentAmountOfTickets += $t->ticket_booking_spaces;
                            }
                            if ($event[0]->ticket_max)
                            {
                                $ticketsAvailable = min($ticket[0]->ticket_spaces - $currentAmountOfTickets , $event[0]->ticket_max - $otherTicketsTotal) + $ticket_booking[0]->ticket_booking_spaces;
                            }
                            else
                            {
                                $ticketsAvailable = $ticket[0]->ticket_spaces - $currentAmountOfTickets;
                            }
                            // wacht een post af en update dan
                            if ($_POST)
                            {
                                
                                if (($_POST['aantal'] <= $ticket[0]->ticket_max || !$ticket[0]->ticket_max) && ($_POST['aantal'] + $otherTicketsTotal <= $event[0]->ticket_max || !$event[0]->ticket_max) && $_POST['aantal'] + $currentAmountOfTickets <= $ticket[0]->ticket_spaces)
                                {
                                    $wpdb->update('wp_3_em_bookings', array('booking_spaces' => ($otherTicketsTotal + $_POST['aantal'])), array('person_id' => $id, 'booking_id' => $ticket_booking[0]->booking_id));
                                    $wpdb->update('wp_3_em_tickets_bookings', array('ticket_booking_spaces' => $_POST['aantal']), array('ticket_id' => $ticket_booking[0]->ticket_id, 'booking_id' => $ticket_booking[0]->booking_id));
                                    ?>
                                    Het is gelukt, klik <a href =<?php echo bp_loggedin_user_domain( '/' ) . "reserveringen"; ?>>hier</a> om terug naar je reserveringen te gaan.
                                    <?php
                                }
                            }
                            else
                            {
                            ?>
                            <form method="post">
                                Vul het aantal kaartjes in dat je wilt:
                                <!-- drop menutje voor altijd kaartjes met begrenzing -->
                                <select name="aantal">
                                    
                                    <?php
                                    for ($i = 1; $i <= $ticketsAvailable; $i++)
                                    {
                                        ?>
                                        <option><?php echo $i; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                     kosten per kaartje: &euro; <?php echo round($ticket[0]->ticket_price, 2); ?> <br>
                                <input type="submit" value="Submit">
                            </form>
                            <?php
                            }
                        }
                        
                    ?>
                </div>
            </article>
    	</main><!-- .site-main -->
    </div><!-- .content-area -->
    <?php
    get_footer();
?>