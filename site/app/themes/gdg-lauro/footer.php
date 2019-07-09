<?php
defined( 'ABSPATH' ) or die;
wp_footer();
?>
<!-- Footer -->
<footer class="mt2 pb3 align--center">
    <ul class="no-bullets list--inline mb0">
        <li class="m1 block-on-mobile"><a href="https://www.twitter.com" class="link"><img class="icon" src="<?php echo IMAGES_PATH; ?>twitter.svg" alt="Twitter"> Twitter</a></li>
        <li class="m1 block-on-mobile"><a href="https://www.facebook.com" class="link"><img class="icon" src="<?php echo IMAGES_PATH; ?>facebook.svg" alt="Facebook"> Facebook</a></li>
        <li class="m1 block-on-mobile"><a href="https://www.instagram.com" class="link"><img class="icon" src="<?php echo IMAGES_PATH; ?>instagram.svg" alt="Instagram"> Instagram</a></li>
        <li class="m1 block-on-mobile"><a href="https://www.youtube.com" class="link"><img class="icon" src="<?php echo IMAGES_PATH; ?>youtube.svg" alt="YouTube"> YouTube</a></li>
    </ul>
    <p class="mt1 small text--gray">Design by <a href="https://www.eatapapaya.com" class="link">Papaya</a>.</p>
</footer>

</div></div>
<?php
// Só adicionaremos nossos scripts caso esta não seja a página do Customizer. Assim evitamos alguns conflitos que podem quebrar o Customizer.
if ( !is_customize_preview() ) {
	// <script ...>
	// <script ...>
}
?>
</body>
</html>
