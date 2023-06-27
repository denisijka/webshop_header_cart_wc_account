//це якшо в шапці треба розташувати кошик та аккаунт
if ( ! function_exists( 'webshop_header_actions_markup' ) ) {

	/**
	 * Adds WebShop header actions markup
	 *
	 * @return void
	 */
	function webshop_header_actions_markup() {

		$account_enable = get_theme_mod( 'webshop_header_wc_account', true );
		$cart_enable    = get_theme_mod( 'webshop_header_cart', true );

		if ( ! ( $cart_enable || $account_enable ) ) {
			return;
		}
		?>
		<div class="ws-header-actions">

			<?php if ( $account_enable && WS_Utils::is_wc_active() ) : ?>
				<div class="ws-header-action wc-account">
					<?php
					if ( is_user_logged_in() ) {
						$account_title = __( 'My Account', 'webshop' );
					} else {
						$account_title = __( 'Login/Register', 'webshop' );
					}
					?>
					<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" title="<?php echo esc_attr( $account_title ); ?>" class="ws-account-link">
						<?php webshop_get_icon( 'user' ); ?>
					</a>
				</div> <!-- /.ws-account -->
			<?php endif; ?>

			<?php if ( $cart_enable && WS_Utils::is_wc_active() ) : ?>
				<?php
				if ( method_exists( 'WebShop_WooCommerce', 'header_cart' ) ) {
					WebShop_WooCommerce::header_cart();
				}
				?>
			<?php endif; ?>
		</div> <!-- /.ws-header-actions -->
		<?php
	}
	add_action( 'webshop_header_actions', 'webshop_header_actions_markup' );
}
