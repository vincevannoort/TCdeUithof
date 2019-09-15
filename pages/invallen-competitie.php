<?php
/**
* Template Name: invallen-competitie
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
                        $query = "SELECT * FROM invallen_competitie WHERE ID =" . $id;
                        $result = $wpdb->get_row($query);
                        $result = (array)$result;
                        if ($_POST)
                        {
                           
                            if (empty($_POST['naam']) || !isset($_POST['enkel']) || !isset($_POST['dubbel']) || empty($_POST['nummer']) || !isset($_POST['gender']))
                            {
                                echo "Niet opgeslagen, vul minimaal je naam, geslacht, speelsterkte en telefoonnummer in";
                            }
                            else
                            {
                                $data = "";
                                /* simpel loopje om dagen op te slaan in data*/
                                foreach ($speeldata as $datum)
                                {
                                    if (isset($_POST[$datum]))
                                    {
                                        $data .= $_POST[$datum];
                                        $data .= ';';
                                    }
                                }
                                if ($_POST['gender'] == "man")
                                {
                                    $man = 1;
                                }
                                else
                                {
                                    $man = 0;
                                }
                                if (!$result)
                                {
                                    $wpdb->insert('invallen_competitie', array(
                                        'ID' => $id,
                                        'Naam' => $_POST['naam'],
                                        'Man' => $man,
                                        'Enkel' => $_POST['enkel'],
                                        'Dubbel' => $_POST['dubbel'],
                                        'Nummer' => $_POST['nummer'],
                                        'Data' => $data
                                        ));
                                    echo "Je informatie is opgeslagen!";
                                }
                                else
                                {
                                    $wpdb->update('invallen_competitie', array(
                                        'ID' => $id,
                                        'Naam' => $_POST['naam'],
                                        'Man' => $man,
                                        'Enkel' => $_POST['enkel'],
                                        'Dubbel' => $_POST['dubbel'],
                                        'Nummer' => $_POST['nummer'],
                                        'Data' => $data
                                        ), array ('ID' => $id));
                                    echo "Je informatie is geupdate!";
                                }
                                $result = $wpdb->get_row($query);
                                $result = (array)$result;
                                
                            }
                            ?>
                            <br>
                            <?php
                        }
                        ?>
                        <form method="post">
                            Naam: <input type="text" name="naam" value=<?php echo $result['Naam']; ?>><br>
                            <input type="radio" name="gender" value="man">Man<br>
                            <input type="radio" name="gender" value="vrouw">Vrouw<br>
                            Speelsterkte enkel: <select name="enkel">
                                    
                                    <?php
                                    for ($i = 1; $i < 10; $i++)
                                    {
                                        if ($result['Enkel'] == $i)
                                        {
                                            ?>
                                            <option selected="selected"><?php echo $i; ?></option>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <option><?php echo $i; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select><br>
                            Speelsterkte dubbel: <select name="dubbel">
                                    
                                    <?php
                                    for ($i = 1; $i < 10; $i++)
                                    {
                                        if ($result['Dubbel'] == $i)
                                        {
                                            ?>
                                            <option selected="selected"><?php echo $i; ?></option>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <option><?php echo $i; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select><br>
                            Telefoonnummer: <input type="text" name="nummer" value=<?php echo $result['Nummer']; ?>><br>
                            
                            Ik kan op: <br>
                            <!-- value wordt gebruikt om een array te maken en weg te schrijven in de database -->
                            <?php
                            /* !== moet door hoe strpos werkt helaas */
                            
                            foreach ($speeldata as $datum)
                            {
                                if(strpos($result['Data'], $datum) !== false)
                                {
                                    ?>
                                    <input type="checkbox" name="<?php echo $datum; ?>" value="<?php echo $datum; ?>" checked><?php echo $datum; ?><br>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <input type="checkbox" name="<?php echo $datum; ?>" value="<?php echo $datum; ?>"><?php echo $datum; ?><br>
                                    <?php
                                }
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