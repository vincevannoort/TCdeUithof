<?php
/**
* Template Name: Reserveringen
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
                    global $wpdb;       
                    $id = get_current_user_id();
                    $usersBookings = $wpdb->get_results('SELECT booking_id, event_id FROM wp_3_em_bookings WHERE event_id IN (SELECT event_id FROM wp_3_em_events WHERE event_end_date >= CURDATE()) AND person_id = ' . $id);
                    
                    foreach ($usersBookings as $booking)
                    {
                        $tickets = $wpdb->get_results('SELECT * FROM wp_3_em_tickets WHERE ticket_id IN (SELECT ticket_id FROM wp_3_em_tickets_bookings WHERE booking_id = '. $booking->booking_id . ')');
                        $event = $wpdb->get_results('SELECT event_name FROM wp_3_em_events WHERE event_id =' . $booking->event_id);
                        echo "Voor " . $event[0]->event_name . " heb je de volgende kaartjes: </br> ";
                        foreach ($tickets as $ticket)
                        {
                            $aantal = $wpdb->get_results('SELECT ticket_booking_spaces, ticket_booking_id FROM wp_3_em_tickets_bookings WHERE booking_id = ' . $booking->booking_id . ' AND ticket_id = ' . $ticket->ticket_id);
                            echo $aantal[0]->ticket_booking_spaces . " keer " . $ticket->ticket_name . " van " . $ticket->ticket_price ." per stuk";
                            $dt = new DateTime();
                            if ($ticket->ticket_end > $dt->format('Y-m-d H:i:s') || !$ticket->ticket_end)
                            {
                                $redirect_URL_edit = "https://tcdeuithof.nl/mijntc/aanpassen-tickets/" . $aantal[0]->ticket_booking_id;
                                ?>
                                <a href= <?php echo $redirect_URL_edit; ?>><button>Aanpassen</button></a>
                                <?php 
                                $redirect_URL = "https://tcdeuithof.nl/mijntc/verwijder-tickets/" . $aantal[0]->ticket_booking_id;
                                ?>
                                <a href= <?php echo $redirect_URL; ?>><button>Verwijderen</button></a>
                                <?php
                            }
                            ?>
                            <br>
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