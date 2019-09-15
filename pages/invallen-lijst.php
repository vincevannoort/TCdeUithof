<?php
/**
* Template Name: invallen-lijst
*/
    get_header();
    /* speeldata aanpassen en tabel in database invallen_competitie leeg gooien en het het staat klaar voor een nieuw competitie seizoen */
    $speeldata = ["Vrijdag", "Zaterdag", "Zondag"];
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
                    $query = "SELECT * FROM invallen_competitie";
                    $result = $wpdb->get_results($query);
                    ?>
                    <table>
                        <tr>
                            <td>Naam</td>
                            <td>Geslacht</td>
                            <td>Dagen</td>
                            <td>Enkel</td>
                            <td>Dubbel</td>
                            <td>Telefoonnummer</td>
                        </tr>
                    <?php
                    foreach($result as $person)
                    {
                        ?>
                        <tr>
                            <td>
                                <?php echo $person->Naam; ?>
                            </td>
                            <td>
                                <?php 
                                if ($person->Man == 1)
                                {
                                    echo "Man";
                                }
                                else
                                {
                                    echo "Vrouw";
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $person->Data; ?>
                            </td>
                            <td>
                                <?php echo $person->Enkel; ?>
                            </td>
                            <td>
                                <?php echo $person->Dubbel; ?>
                            </td>
                            <td>
                                <?php echo $person->Nummer; ?>
                            </td>
                            
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                </div>
            </article>
    	</main><!-- .site-main -->
    </div><!-- .content-area -->
    <?php
    get_footer();
?>