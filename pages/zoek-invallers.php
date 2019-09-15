<?php
/**
* Template Name: zoek-invallers
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
                    if ($_POST)
                    {
                        if (!(isset($_POST['gender']) && isset($_POST['enkel']) && isset($_POST['dubbel']) && isset($_POST['data'])))
                        {
                            echo "Vul alles in!";
                        }
                        else
                        {
                            global $wpdb;
                            $id = get_current_user_id();
                            if ($_POST['gender'] == "man")
                            {
                                $man = 1;
                            }
                            else
                            {
                                $man = 0;
                            }
                            $query = "SELECT * FROM invallen_competitie WHERE enkel =" .$_POST['enkel'] . " AND dubbel = " .$_POST['dubbel'] . " AND man = " . $man;
                            $result = $wpdb->get_results($query);
                            ?>
                            <table>
                            <?php
                            foreach($result as $person)
                            {
                                if (strpos($person->Data, $_POST['data']) !== false)
                                {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $person->Naam; ?>
                                    </td>
                                    <td>
                                        <?php echo $person->Nummer; ?>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                            ?>
                            </table>
                            <?php
                        }
                    }
                    ?>
                    <form method="post">
                    <input type="radio" name="gender" value="man">Man<br>
                    <input type="radio" name="gender" value="vrouw">Vrouw<br>
                    Speelsterkte enkel: <select name="enkel">
                            
                            <?php
                            for ($i = 1; $i < 10; $i++)
                            {
                                ?>
                                <option><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select><br>
                    Speelsterkte dubbel: <select name="dubbel">
                            
                            <?php
                            for ($i = 1; $i < 10; $i++)
                            {
                                ?>
                                <option><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select><br>
                    Welke datum: <br>
                    <!-- value wordt gebruikt om een array te maken en weg te schrijven in de database -->
                    <?php
                    /* !== moet door hoe strpos werkt helaas */
                    
                    foreach ($speeldata as $datum)
                    {
                        ?>
                        <input type="radio" name="data" value="<?php echo $datum; ?>"><?php echo $datum; ?><br>
                        <?php
                    }
                    ?>
                    <input type="submit" value="Submit">
                    </form>
                    
                    
                        
                    
                        
                </div>
            </article>
    	</main><!-- .site-main -->
    </div><!-- .content-area -->
    <?php
    get_footer();
?>