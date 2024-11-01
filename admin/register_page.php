<?php 
function wpc_core_update_admin_init() {
	register_setting('wpc_core_update_options', 'wpc_core_update_active');
} 
add_action('admin_init', wpc_core_update_admin_init);
?>