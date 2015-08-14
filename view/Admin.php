<div class="wrap" id="panels-settings-page">
	<div class="settings-banner">
		<h3><?php _e('Boombar Setting', 'tonjoo-boombar') ?></h3>
	</div>

	<?php if( $this->settings_saved ) : ?>
		<div id="setting-error-settings_updated" class="updated settings-error">
			<p><strong><?php _e('Settings Saved', 'siteorigin-panels') ?></strong></p>
		</div>
	<?php endif; ?>

	<form action="<?php echo admin_url('options-general.php?page=tonjoo_boombar_page') ?>" method="post" >

		<div id="panels-settings-sections">

			<div id="panels-settings-section-<?php echo esc_attr($section_id) ?>" class="panels-settings-section" data-section="<?php echo esc_attr($section_id) ?>">
				<table class="form-table">
					<tbody>
						<tr>
							<td width="10%" style="vertical-align:top">
								<?php _e( 'HTML', 'tonjoo-boomber' ); ?>
							</td>
							<td>
								<textarea id="tj_boombar_html" name="tonjoo_boombar_value[tj_boombar_html]" class="CodeMirror"><?php echo $data_boombar['tj_boombar_html'] ?></textarea>
							</td>
						</tr>

						<tr>
							<td></td>
							<td>
								<label>
									<input  name="tonjoo_boombar_value[is_active]" type="checkbox" <?php checked( !empty(@$data_boombar['is_active']) ) ?> />
									<?php echo __('Active', 'siteorigin-panels') ?>								
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<label for="tj_boombar_html"><?php _e( 'Font Color', 'tonjoo-boomber' ); ?></label>
							</td>
							<td>
								<input type="text" name="tonjoo_boombar_value[tj_cange_font_color]" value="<?php echo $data_boombar['tj_cange_font_color'] ?>" class="my-color-field" />
							</td>
						</tr>
						<tr>
							<td>
								<label for="tj_boombar_html"><?php _e( 'Background Color', 'tonjoo-boomber' ); ?></label>
							</td>
							<td>
								<input type="text" name="tonjoo_boombar_value[tj_cange_color]" value="<?php echo $data_boombar['tj_cange_color'] ?>" class="my-color-field" />
							</td>
						</tr>
						
						<script type="text/javascript">
						    var config, editor;

						    config = {
						        lineNumbers: true,
						        mode: "text/html",
				         		extraKeys: {"Ctrl-Space": "autocomplete"}
						    };

						    editor = CodeMirror.fromTextArea(document.getElementById("tj_boombar_html"), config);

						    function selectTheme() {
						        editor.setOption("theme", "monokai");
						    }
						    setTimeout(selectTheme, 1000);

						    jQuery(document).ready(function($){
								$('.my-color-field').wpColorPicker();
							});
						</script>

					</tbody>
				</table>
			</div>
		</div>

		<div class="submit">
			<?php wp_nonce_field( 'panels-settings' ) ?>
			<input type="submit" value="<?php _e('Save Settings', 'siteorigin-panels') ?>" class="button-primary" />
		</div>
	</form>

</div>