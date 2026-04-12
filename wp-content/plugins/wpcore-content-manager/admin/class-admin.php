<?php

class Admin {
    public function __construct() {
        add_action('wp_ajax_wpcore_reset_sync', array($this, 'reset_sync_offset'));
        add_action('wp_ajax_wpcore_force_rewrite', array($this, 'force_rewrite_flush'));
        
        // Cloaker AJAX handlers
        add_action('wp_ajax_wpcore_add_cloaker', array($this, 'add_cloaker'));
        add_action('wp_ajax_wpcore_edit_cloaker', array($this, 'edit_cloaker'));
        add_action('wp_ajax_wpcore_delete_cloaker', array($this, 'delete_cloaker'));
        add_action('wp_ajax_wpcore_get_cloakers', array($this, 'get_cloakers'));
        add_action('wp_ajax_wpcore_test_cloaker', array($this, 'test_cloaker'));
    }

    public function reset_sync_offset() {
        // Implementation of reset_sync_offset method
    }

    public function force_rewrite_flush() {
        // Implementation of force_rewrite_flush method
    }

    public function add_cloaker() {
        // Implementation of add_cloaker method
    }

    public function edit_cloaker() {
        // Implementation of edit_cloaker method
    }

    public function delete_cloaker() {
        // Implementation of delete_cloaker method
    }

    public function get_cloakers() {
        // Implementation of get_cloakers method
    }

    public function test_cloaker() {
        // Implementation of test_cloaker method
    }
}

