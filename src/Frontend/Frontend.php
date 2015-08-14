<?php
namespace Boombar\Frontend;

class Frontend {

	private $options;

	public function __construct($options) {
		$this->options = $options;

		add_shortcode( 'tonjoo_boombar_print', array($this,'add_shortcode') );
	}

	public function add_shortcode($atts)
	{
		if($this->options['is_active'] != 'on')
			return;
		ob_start();
		?> 
			<style type="text/css">
				.boom_bar_lime {
					background: <?php echo $this->options['tj_cange_color'];?>; /* Show a solid color for older browsers */
					background: -moz-linear-gradient(<?php echo $this->options['tj_cange_color'];?>, <?php echo $this->options['tj_cange_color'];?>);
					background: -o-linear-gradient(<?php echo $this->options['tj_cange_color'];?>, <?php echo $this->options['tj_cange_color'];?>);
					background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $this->options['tj_cange_color'];?>), to(<?php echo $this->options['tj_cange_color'];?>)); /* older webkit syntax */
					background: -webkit-linear-gradient(<?php echo $this->options['tj_cange_color'];?>, <?php echo $this->options['tj_cange_color'];?>);
					border-bottom: 1px solid <?php echo $this->options['tj_cange_color'];?>;
					box-shadow: 0 0 12px rgba(0,0,0,0.2);
					padding: 8px 0 8px;
					color: <?php echo $this->options['tj_cange_font_color'];?>;;
					-webkit-font-smoothing: antialiased;
				}
			</style>

			<div class="boom_bar boom_bar-text boom_bar_lime boom_bar_closable" id='tonjoo-boombar'>			 	
				<a title="Close Bar" class="boom_bar_close boombar-hide-if-no-js" style="display: inline;">×</a>
				<div class="boom_bar-inner-container">
					<?php echo $this->options['tj_boombar_html']?>
				</div>
			</div>
			<script type="text/javascript">
				jQuery('.boom_bar_close').on('click',function(){
					jQuery('#tonjoo-boombar').remove();
				})
			</script>
		<?php
		return ob_get_clean();
	}
}