<div class="wrap">
    <h1>WPCore Auto Publisher - İçerik Yöneticisi</h1>
    
    <!-- Menü Öğeleri -->
    <div class="wpcore-admin-menu" style="margin: 20px 0; padding: 15px; background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px;">
        <h2 style="margin-top: 0; margin-bottom: 15px; color: #495057;">📋 Admin Menüsü</h2>
        <div class="wpcore-menu-buttons" style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="<?php echo admin_url('admin.php?page=wpcore-dashboard'); ?>" class="button button-secondary" style="text-decoration: none;">
                🏠 Dashboard
            </a>
            <a href="<?php echo admin_url('admin.php?page=wpcore-settings'); ?>" class="button button-secondary" style="text-decoration: none;">
                ⚙️ Ayarlar
            </a>
            <a href="<?php echo admin_url('admin.php?page=wpcore-content'); ?>" class="button button-primary" style="text-decoration: none;">
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
    
    <div class="wpcore-content-actions">
        <button class="button button-primary" onclick="wpcoreSyncAPI()">🔄 API'den Çek</button>
        <button class="button button-secondary" onclick="wpcorePublishNormal()">📝 Normal Yayımla</button>
        <button class="button button-secondary" onclick="wpcorePublishGhost()">👻 Ghost Yayımla</button>
    </div>

    <div class="wpcore-products-list">
        <h2>Veritabanındaki Ürünler</h2>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Ürün ID</th>
                    <th>Başlık</th>
                    <th>Kategori</th>
                    <th>Versiyon</th>
                    <th>İndirme</th>
                    <th>Durum</th>
                    <th>Son Güncelleme</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo esc_html($product->product_id); ?></td>
                        <td><?php echo esc_html($product->title); ?></td>
                        <td><?php echo esc_html($product->category); ?></td>
                        <td><?php echo esc_html($product->version); ?></td>
                        <td><?php echo esc_html($product->downloads_count); ?></td>
                        <td><?php echo esc_html($product->status); ?></td>
                        <td><?php echo esc_html($product->updated_at); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div> 