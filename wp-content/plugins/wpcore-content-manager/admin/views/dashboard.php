<div class="wrap">
    <h1>WPCore Auto Publisher - Dashboard</h1>
    
    <!-- Menü Öğeleri -->
    <div class="wpcore-admin-menu" style="margin: 20px 0; padding: 15px; background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px;">
        <h2 style="margin-top: 0; margin-bottom: 15px; color: #495057;">📋 Admin Menüsü</h2>
        <div class="wpcore-menu-buttons" style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="<?php echo admin_url('admin.php?page=wpcore-dashboard'); ?>" class="button button-primary" style="text-decoration: none;">
                🏠 Dashboard
            </a>
            <a href="<?php echo admin_url('admin.php?page=wpcore-settings'); ?>" class="button button-secondary" style="text-decoration: none;">
                ⚙️ Ayarlar
            </a>
            <a href="<?php echo admin_url('admin.php?page=wpcore-content'); ?>" class="button button-secondary" style="text-decoration: none;">
                📝 İçerik Yöneticisi
            </a>
            <a href="<?php echo admin_url('admin.php?page=wpcore-logs'); ?>" class="button button-secondary" style="text-decoration: none;">
                📋 Loglar
            </a>
        </div>
        <div style="margin-top: 10px; font-size: 12px; color: #6c757d;">
            💡 <strong>Hızlı Erişim:</strong> Bu menü öğeleri ile eklentinin tüm özelliklerine kolayca erişebilirsiniz.
        </div>
    </div>
    
    <div class="wpcore-stats-grid">
        <div class="stat-card">
            <h3>Toplam Ürün</h3>
            <div class="stat-number" id="total-products"><?php echo esc_html($stats['total_products']); ?></div>
        </div>
        <div class="stat-card">
            <h3>Yayımlanmış</h3>
            <div class="stat-number" id="published-products"><?php echo esc_html($stats['published_products']); ?></div>
        </div>
        <div class="stat-card">
            <h3>Yayımlanmamış</h3>
            <div class="stat-number" id="unpublished-products"><?php echo esc_html($stats['unpublished_products']); ?></div>
        </div>
        <div class="stat-card">
            <h3>Ghost İçerik</h3>
            <div class="stat-number" id="ghost-content"><?php echo esc_html($stats['ghost_content']); ?></div>
        </div>
        <div class="stat-card">
            <h3>Son Senkronizasyon</h3>
            <div class="stat-text" id="last-sync"><?php echo esc_html($stats['last_sync'] ?? 'Hiç senkronize edilmedi'); ?></div>
        </div>
        <div class="stat-card">
            <h3>Son Yayımlama</h3>
            <div class="stat-text" id="last-publish"><?php echo esc_html($stats['last_publish'] ?? 'Hiç yayımlanmadı'); ?></div>
        </div>
    </div>

    <div class="wpcore-quick-actions">
        <h2>Hızlı İşlemler</h2>
        
        <!-- DEVRE DIŞI: Ghost Mode Otomatik Kurulum - Sessiz çalışma modu -->
        <?php /* Otomatik kurulum butonu kaldırıldı - sadece manuel ayarlar */ ?>
        
        <div class="action-buttons">
            <button class="button button-primary" onclick="wpcoreSyncAPI()">🔄 API Sync</button>
            <button class="button button-secondary" onclick="wpcorePublishNormal()">📝 Normal Yayımla (Kaliteli Dinamik İçerik)</button>
            <button class="button button-secondary" onclick="wpcorePublishGhost()">👻 Ghost Yayımla</button>
            <button class="button button-secondary" onclick="wpcoreCreateHomepage()">🏠 Anasayfa Oluştur</button>
            <button class="button button-secondary" onclick="wpcoreOptimizeSEO()">🔍 SEO Optimize Et</button>
            <button class="button button-secondary" onclick="wpcoreTestAPI()">🔗 API Test</button>
            <button class="button button-secondary" onclick="wpcoreGenerateGhostContent()">👻 Ghost İçerik Oluştur</button>
            <button class="button button-secondary" onclick="wpcoreViewGhostContent()">👁️ Ghost İçerik Görüntüle</button>
            <button class="button button-secondary" onclick="wpcoreResetSync()">🔄 Sync Offset Sıfırla</button>
            <button class="button button-secondary" onclick="wpcoreForceRewrite()">⚡ Güçlü Rewrite Flush</button>
            
            <!-- Cloaker Butonları -->
            <button class="button button-secondary" onclick="wpcoreAddCloaker()">🎭 Cloaker Ekle</button>
            <button class="button button-secondary" onclick="wpcoreViewCloakers()">👁️ Cloaker Listesi</button>
            <button class="button button-secondary" onclick="wpcoreTestCloaker()">🧪 Cloaker Test</button>
            <button class="button button-primary" onclick="wpcoreFlushHtaccess()">🔥 .htaccess Flush</button>
        </div>
        
        <?php 
        $current_offset = get_option('wpcore_sync_offset', 0);
        if ($current_offset > 0): 
        ?>
        <div class="wpcore-sync-info" style="margin-top: 15px; padding: 10px; background: #f0f8ff; border: 1px solid #007cba; border-radius: 5px;">
            <strong>🔄 Senkronizasyon Durumu:</strong> 
            Mevcut offset: <strong><?php echo number_format($current_offset); ?></strong> | 
            Bir sonraki çekme işlemi bu noktadan devam edecek.
        </div>
        <?php endif; ?>
    </div>

    <div class="wpcore-recent-posts">
        <h2>Son Yayımlanan İçerikler</h2>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Başlık</th>
                    <th>Mod</th>
                    <th>Tarih</th>
                    <th>URL</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recent_posts as $post): ?>
                    <tr>
                        <td><?php echo esc_html($post->post_title); ?></td>
                        <td><?php echo get_post_meta($post->ID, 'wpcore_mode', true) === 'ghost' ? '👻 Ghost' : '📝 Normal'; ?></td>
                        <td><?php echo get_the_date('d.m.Y H:i', $post->ID); ?></td>
                        <td><a href="<?php echo get_permalink($post->ID); ?>" target="_blank">Görüntüle</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- DEVRE DIŞI: Otomatik Ghost Mode Setup Script - Sessiz çalışma modu -->
<script>
// Otomatik kurulum devre dışı - sadece manuel işlemler
</script> 