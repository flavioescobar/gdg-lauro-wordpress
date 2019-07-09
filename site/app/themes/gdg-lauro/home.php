<?php
defined( 'ABSPATH' ) or die;
get_header();
?>

<!-- Body -->
<main>
    <div class="container">

        <!-- Info -->
        <section class="pt2 pb3">                    
            <img class="mb3" src="<?php echo IMAGES_PATH; ?>presentor.jpg" alt="Huddle presentation">
            <div class="grid-row">
                <div class="grid-column span-one-third mt1">
                    <img class="icon mb1" src="<?php echo IMAGES_PATH; ?>bucket.svg">
                    <p>Equidem soleo etiam quod uno Graeci, si aliter non possum idem&nbsp;pluribus.</p>
                </div>
                <div class="grid-column span-one-third mt1">
                    <img class="icon mb1" src="<?php echo IMAGES_PATH; ?>flask.svg">
                    <p>Nonne videmus quanta perturbatio rerum omnium consequatur&nbsp;quanta.</p>
                </div>
                <div class="grid-column span-one-third mt1">
                    <img class="icon mb1" src="<?php echo IMAGES_PATH; ?>aircraft.svg">
                    <p>Hoc enim constituto in philosophia constituta sunt omnia aliter&nbsp;possum.</p>
                </div>
            </div>
             
        </section>

        <!-- Presenters -->
        <section class="pt3 pb3 align--center">
            <h3 class="mb1">The talkers</h3>
            <div class="grid-row">
                <?php
                $palestrantes = get_posts( array(
                    'post_type'      => 'palestrante',
                    'numberofposts'  => 6,
                    'orderby'        => 'title',
                    'order'          => 'asc',
                    'posts_per_page' => -1, // O default de posts por página no WordPress é 5
                ) );

                foreach ( $palestrantes as $palestrante ) {
                    $nome = $palestrante->post_title;
                    ?>
                    <div class="grid-column span-2 mt2">
                        <img class="mb1" src="<?php echo get_the_post_thumbnail_url( $palestrante->ID ); ?>" alt="<?php echo $nome; ?>">
                        <p class="small"><?php echo $nome; ?></p>
                    </div>
                    <?php
                }

                wp_reset_postdata(); // Faz com que o WordPress saia do loop local e retorne ao global.
                ?>
            </div>
        </section>

        <!-- Sponsors -->
        <section class="pt3 pb3 align--center">
            <h3 class="mb2">Some generous peeps</h3>
            <img class="m1" src="<?php echo IMAGES_PATH; ?>stripe.svg" alt="Stripe" style="height:50px">
            <img class="m1" src="<?php echo IMAGES_PATH; ?>segment.svg" alt="Segment" style="height:45px">
            <img class="m1" src="<?php echo IMAGES_PATH; ?>newrelic.svg" alt="New Relic" style="height:35px">
            <img class="m1" src="<?php echo IMAGES_PATH; ?>drift.svg" alt="Drift" style="height:50px">
            <img class="m1" src="<?php echo IMAGES_PATH; ?>zopim.svg" alt="Zopim" style="height:50px">
        </section>

        <!-- Testimonials -->
        <section class="pt2 pb3">
            <h3 class="align--center mb2">On the record</h3>
            <div class="grid-row">
                <div class="grid-column span-one-third mt1">
                    <blockquote class="blockquote">
                        <p>This conference changed my life because I found my wife&nbsp;there.</p>
                        <p>> <cite>Randy Johnson</cite></p>
                    </blockquote>
                </div>
                <div class="grid-column span-one-third mt1">
                    <blockquote class="blockquote">
                        <p>It takes a really long time to get to this event. Worth it?&nbsp;Maybe.</p>
                        <p>> <cite>Jill Carson</cite></p>
                    </blockquote>
                </div>
                <div class="grid-column span-one-third mt1">
                    <blockquote class="blockquote">
                        <p>Sometimes I like to be glamorous. It makes me feel good&nbsp;inside.</p>
                        <p>> <cite>Chase Harrop</cite></p>
                    </blockquote>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="align--center pt3 pb3">
            <p class="h3 mb2">Tickets start at&nbsp;$950.</p>
            <a href="" class="btn btn--outline">Download Schedule</a>
            <a href="https://www.eventbrite.com/" class="btn btn--default">Get a ticket →</a>
            <p class="small mt1 text--gray">Tickets available on Eventbrite.</p>
        </section>

        <!-- CTA -->
        <section class="align--center pt3 pb3">
            <p class="h3 mb2">Contate-nos</p>
            <?php do_shortcode( '[gdg_contato]' ); ?>
        </section>

    </div>
</main>

<?php get_footer(); ?>
