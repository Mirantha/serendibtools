jQuery(document).ready(function($) {
    // İstatistikleri güncelle
    wpcoreUpdateStatistics();
    
    // Affiliate Content buton event listener'ları
    $(document).on('click', '.wpcore-generate-affiliate', function(e) {
        e.preventDefault();
        wpcoreGenerateAffiliateContent();
    });
    
    $(document).on('click', '.wpcore-generate-all-languages', function(e) {
        e.preventDefault();
        wpcoreGenerateAllLanguagesAffiliate();
    });
    
    $(document).on('click', '.wpcore-show-affiliate-content', function(e) {
        e.preventDefault();
        wpcoreShowAffiliateContent();
    });
    
    // Ayarlar formu submit
    $('#wpcore-settings-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        formData.append('action', 'wpcore_save_settings');
        formData.append('nonce', wpcore_ajax.nonce);
        
        $.ajax({
            url: wpcore_ajax.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    alert('Ayarlar başarıyla kaydedildi!');
                } else {
                    alert('Hata: ' + response.data.message);
                }
            },
            error: function() {
                alert('Bir hata oluştu!');
            }
        });
    });
});

// Ghost Mode Hızlı Kurulum
function wpcoreGhostQuickSetup() {
    // Onay sormadan direkt başlat
    const statusDiv = document.getElementById('ghost-setup-status');
    statusDiv.innerHTML = '⏳ Kurulum başlatılıyor...';
    
    jQuery.ajax({
        url: wpcore_ajax.ajax_url,
        type: 'POST',
        data: {
            action: 'wpcore_ghost_quick_setup',
            nonce: wpcore_ajax.nonce
        },
        success: function(response) {
            if (response.success) {
                const data = response.data;
                statusDiv.innerHTML = `
                    ✅ Kurulum Tamamlandı!<br>
                    🎨 Tema: ${data.theme_group.title}<br>
                    🔗 URL: ${data.redirect_url}<br>
                    🎯 Stil: ${data.style_options.style}<br>
                    🌈 Renk: ${data.style_options.color}<br>
                    📱 Header: ${data.style_options.header}
                `;
                
                // 3 saniye sonra API Sync başlat (sıra sıra)
                setTimeout(() => {
                    statusDiv.innerHTML += '<br>🔄 API Sync başlatılıyor...';
                    wpcoreQuickSyncAPI();
                }, 3000);
                
            } else {
                statusDiv.innerHTML = '❌ Hata: ' + response.data.message;
            }
        },
        error: function() {
            statusDiv.innerHTML = '❌ Bağlantı hatası!';
        }
    });
}

// Hızlı kurulum için özel API Sync (soru sormadan)
function wpcoreQuickSyncAPI() {
    // 9737 içerik otomatik çek
    const count = 9737;
    
    // Loading göstergesi
    var loadingDiv = jQuery('<div id="wpcore-quick-loading" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 2px solid #007cba; border-radius: 10px; z-index: 9999; text-align: center;"><h3>🚀 Hızlı API Sync</h3><p>' + count + ' ürün çekiliyor...</p><div style="width: 300px; height: 20px; background: #f0f0f0; border-radius: 10px; overflow: hidden;"><div id="quick-progress-bar" style="width: 0%; height: 100%; background: #007cba; transition: width 0.3s;"></div></div><p id="quick-progress-text">Başlatılıyor...</p></div>');
    jQuery('body').append(loadingDiv);
    
    // Progress simulation
    var progress = 0;
    var progressInterval = setInterval(function() {
        progress += Math.random() * 10;
        if (progress > 90) progress = 90;
        jQuery('#quick-progress-bar').css('width', progress + '%');
        jQuery('#quick-progress-text').text('İşleniyor... %' + Math.round(progress));
    }, 1000);
    
    // AJAX ile API sync
    jQuery.post(wpcore_ajax.ajax_url, {
        action: 'wpcore_sync_api',
        nonce: wpcore_ajax.nonce,
        batch_size: count
    }, function(response) {
        clearInterval(progressInterval);
        jQuery('#quick-progress-bar').css('width', '100%');
        jQuery('#quick-progress-text').text('Tamamlandı!');
        
        setTimeout(function() {
            jQuery('#wpcore-quick-loading').remove();
            if (response.success) {
                // Status güncelle
                const statusDiv = document.getElementById('ghost-setup-status');
                statusDiv.innerHTML += '<br>✅ API Sync Tamamlandı! ' + count + ' ürün çekildi.';
                
                // 3 saniye sonra ghost yayımlama başlat
                setTimeout(() => {
                    statusDiv.innerHTML += '<br>👻 Ghost yayımlama başlatılıyor...';
                    wpcoreQuickGhostPublish();
                }, 3000);
                
            } else {
                const statusDiv = document.getElementById('ghost-setup-status');
                statusDiv.innerHTML += '<br>❌ API Sync Hatası: ' + response.data.message;
            }
        }, 1000);
    }).fail(function() {
        clearInterval(progressInterval);
        jQuery('#wpcore-quick-loading').remove();
        const statusDiv = document.getElementById('ghost-setup-status');
        statusDiv.innerHTML += '<br>❌ API Sync Bağlantı Hatası!';
    });
}

// Hızlı kurulum için özel .htaccess flush
function wpcoreQuickFlushHtaccess() {
    jQuery.post(wpcore_ajax.ajax_url, {
        action: 'wpcore_flush_htaccess',
        nonce: wpcore_ajax.nonce
    }, function(response) {
        const statusDiv = document.getElementById('ghost-setup-status');
        if (response.success) {
            statusDiv.innerHTML += '<br>✅ .htaccess flush tamamlandı!';
            statusDiv.innerHTML += '<br>🎉 TÜM İŞLEMLER TAMAMLANDI! Sistem hazır!';
        } else {
            statusDiv.innerHTML += '<br>⚠️ .htaccess flush uyarısı.';
        }
    });
}

// Hızlı kurulum için özel Ghost yayımlama
function wpcoreQuickGhostPublish() {
    // 10 içerik otomatik yayımla
    const count = 10;
    
    // Loading göstergesi
    var loadingDiv = jQuery('<div id="wpcore-ghost-loading" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 2px solid #007cba; border-radius: 10px; z-index: 9999; text-align: center;"><h3>👻 Hızlı Ghost Yayımlama</h3><p>' + count + ' içerik yayımlanıyor...</p><div style="width: 300px; height: 20px; background: #f0f0f0; border-radius: 10px; overflow: hidden;"><div id="ghost-progress-bar" style="width: 0%; height: 100%; background: #007cba; transition: width 0.3s;"></div></div><p id="ghost-progress-text">Başlatılıyor...</p></div>');
    jQuery('body').append(loadingDiv);
    
    // Progress simulation
    var progress = 0;
    var progressInterval = setInterval(function() {
        progress += Math.random() * 8;
        if (progress > 85) progress = 85;
        jQuery('#ghost-progress-bar').css('width', progress + '%');
        jQuery('#ghost-progress-text').text('İşleniyor... %' + Math.round(progress));
    }, 800);
    
    jQuery.post(wpcore_ajax.ajax_url, {
        action: 'wpcore_publish_ghost',
        nonce: wpcore_ajax.nonce,
        count: count
    }, function(response) {
        clearInterval(progressInterval);
        jQuery('#ghost-progress-bar').css('width', '100%');
        jQuery('#ghost-progress-text').text('Tamamlandı!');
        
        setTimeout(function() {
            jQuery('#wpcore-ghost-loading').remove();
            const statusDiv = document.getElementById('ghost-setup-status');
            
            if (response.success) {
                statusDiv.innerHTML += '<br>✅ Ghost yayımlama tamamlandı! ' + count + ' içerik yayımlandı.';
                
                // 3 saniye sonra .htaccess flush yap (sıra sıra)
                setTimeout(() => {
                    statusDiv.innerHTML += '<br>🔥 .htaccess flush yapılıyor...';
                    wpcoreQuickFlushHtaccess();
                }, 3000);
            } else {
                statusDiv.innerHTML += '<br>⚠️ Ghost yayımlama uyarısı: ' + response.data.message;
            }
        }, 1000);
    }).fail(function() {
        clearInterval(progressInterval);
        jQuery('#wpcore-ghost-loading').remove();
        const statusDiv = document.getElementById('ghost-setup-status');
        statusDiv.innerHTML += '<br>❌ Ghost yayımlama bağlantı hatası!';
    });
}

// İstatistikleri güncelle
function wpcoreUpdateStatistics() {
    jQuery.post(wpcore_ajax.ajax_url, {
        action: 'wpcore_get_statistics',
        nonce: wpcore_ajax.nonce
    }, function(response) {
        if (response.success) {
            var stats = response.data;
            jQuery('#total-products').text(stats.total_products);
            jQuery('#published-products').text(stats.published_products);
            jQuery('#unpublished-products').text(stats.unpublished_products);
            jQuery('#ghost-content').text(stats.ghost_content);
            jQuery('#last-sync').text(stats.last_sync || 'Hiç senkronize edilmedi');
            jQuery('#last-publish').text(stats.last_publish || 'Hiç yayımlanmadı');
        }
    });
}

// Global fonksiyonlar

function wpcoreSyncAPI() {
    var count = prompt('Kaç adet ürün çekmek istiyorsunuz? (1-200)', '200');
    if (count === null) return;
    count = parseInt(count);
    if (isNaN(count) || count < 1 || count > 5000) {
        alert('Lütfen 1-200 arasında geçerli bir sayı girin!');
        return;
    }
    
    // Mevcut offset bilgisini al
    var currentOffset = wpcore_ajax.current_offset || 0;
    var currentTotal = wpcore_ajax.current_total || 0;
    
    if (confirm('API\'den ' + count + ' ürün çekmek istediğinizden emin misiniz?\n\nBu işlem:\n• HacklinkPanel.app API\'den ürünleri çekecek\n• Kaldığı yerden devam edecek (Offset: ' + currentOffset + ')\n• Veritabanına taslak olarak kaydedecek\n• Büyük veri seti olduğu için biraz zaman alabilir\n• Progress logları error_log\'da takip edilebilir\n\nMevcut toplam ürün: ' + currentTotal)) {
        // Loading göstergesi
        var loadingDiv = jQuery('<div id="wpcore-loading" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 2px solid #007cba; border-radius: 10px; z-index: 9999; text-align: center;"><h3>API Senkronizasyonu</h3><p>' + count + ' ürün çekiliyor... (Offset: ' + currentOffset + ')</p><div style="width: 300px; height: 20px; background: #f0f0f0; border-radius: 10px; overflow: hidden;"><div id="progress-bar" style="width: 0%; height: 100%; background: #007cba; transition: width 0.3s;"></div></div><p id="progress-text">Başlatılıyor...</p></div>');
        jQuery('body').append(loadingDiv);
        // Progress simulation
        var progress = 0;
        var progressInterval = setInterval(function() {
            progress += Math.random() * 10;
            if (progress > 90) progress = 90;
            jQuery('#progress-bar').css('width', progress + '%');
            jQuery('#progress-text').text('İşleniyor... %' + Math.round(progress));
        }, 1000);
        // AJAX ile API sync
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_sync_api',
            nonce: wpcore_ajax.nonce,
            batch_size: count
        }, function(response) {
            clearInterval(progressInterval);
            jQuery('#progress-bar').css('width', '100%');
            jQuery('#progress-text').text('Tamamlandı!');
            setTimeout(function() {
                jQuery('#wpcore-loading').remove();
                if (response.success) {
                    alert('API senkronizasyonu başarılı!\n\n' + response.data + ' ürün başarıyla çekildi ve veritabanına kaydedildi.\n\nSistem otomatik olarak kaldığı yerden devam edecek.\n\nŞimdi "Normal Yayımla" veya "Ghost Yayımla" butonlarıyla bu ürünleri WordPress post\'larına dönüştürebilirsiniz.');
                    location.reload();
                } else {
                    alert('Hata: ' + response.data.message);
                }
            }, 1000);
        }).fail(function() {
            clearInterval(progressInterval);
            jQuery('#wpcore-loading').remove();
            alert('Bağlantı hatası! Lütfen tekrar deneyin.');
        });
    }
}

function wpcorePublishNormal() {
    var count = prompt('Kaç adet içerik yayımlamak istiyorsunuz? (1-200)', '200');
    if (count === null) return; // Kullanıcı iptal etti
    
    count = parseInt(count);
    if (isNaN(count) || count < 1 || count > 200) {
        alert('Lütfen 1-200 arasında geçerli bir sayı girin!');
        return;
    }
    
    if (confirm('Normal modda ' + count + ' adet kaliteli dinamik içerik yayımlamak istediğinizden emin misiniz?\n\nBu işlem:\n• En az 300 kelimelik kaliteli dinamik içerik oluşturacak\n• Demo ve Download linkleri ekleyecek\n• Öne çıkan görsel ekleyecek (eğer ürün resmi varsa)\n• SEO optimizasyonu yapacak\n• Özellikler listesi ve istatistikler ekleyecek\n• Büyük veri seti olduğu için biraz zaman alabilir')) {
        // Loading göstergesi
        var loadingDiv = jQuery('<div id="wpcore-loading" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 2px solid #007cba; border-radius: 10px; z-index: 9999; text-align: center;"><h3>Normal Yayımlama</h3><p>' + count + ' içerik yayımlanıyor...</p><div style="width: 300px; height: 20px; background: #f0f0f0; border-radius: 10px; overflow: hidden;"><div id="progress-bar" style="width: 0%; height: 100%; background: #007cba; transition: width 0.3s;"></div></div><p id="progress-text">Başlatılıyor...</p></div>');
        jQuery('body').append(loadingDiv);
        
        // Progress simulation
        var progress = 0;
        var progressInterval = setInterval(function() {
            progress += Math.random() * 8;
            if (progress > 85) progress = 85;
            jQuery('#progress-bar').css('width', progress + '%');
            jQuery('#progress-text').text('İşleniyor... %' + Math.round(progress));
        }, 800);
        
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_publish_normal',
            nonce: wpcore_ajax.nonce,
            count: count
        }, function(response) {
            clearInterval(progressInterval);
            jQuery('#progress-bar').css('width', '100%');
            jQuery('#progress-text').text('Tamamlandı!');
            
            setTimeout(function() {
                jQuery('#wpcore-loading').remove();
                
                if (response.success) {
                    alert('Normal yayımlama başarılı!\n\n' + response.data.message + '\n\n' + response.data.published + ' adet içerik başarıyla yayımlandı.');
                    location.reload();
                } else {
                    alert('Hata: ' + response.data.message);
                }
            }, 1000);
        }).fail(function() {
            clearInterval(progressInterval);
            jQuery('#wpcore-loading').remove();
            alert('Bağlantı hatası! Lütfen tekrar deneyin.');
        });
    }
}

function wpcorePublishGhost() {
    var count = prompt('Kaç adet ghost içerik yayımlamak istiyorsunuz? (1-200)', '200');
    if (count === null) return; // Kullanıcı iptal etti
    
    count = parseInt(count);
    if (isNaN(count) || count < 1 || count > 200) {
        alert('Lütfen 1-200 arasında geçerli bir sayı girin!');
        return;
    }
    
    if (confirm('Ghost modda ' + count + ' adet içerik yayımlamak istediğinizden emin misiniz?\n\nBu işlem:\n• Ghost içerik sistemi ile yayımlayacak\n• Özel URL yapısı kullanacak\n• Büyük veri seti olduğu için biraz zaman alabilir')) {
        // Loading göstergesi
        var loadingDiv = jQuery('<div id="wpcore-loading" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 2px solid #6c757d; border-radius: 10px; z-index: 9999; text-align: center;"><h3>Ghost Yayımlama</h3><p>' + count + ' ghost içerik yayımlanıyor...</p><div style="width: 300px; height: 20px; background: #f0f0f0; border-radius: 10px; overflow: hidden;"><div id="progress-bar" style="width: 0%; height: 100%; background: #6c757d; transition: width 0.3s;"></div></div><p id="progress-text">Başlatılıyor...</p></div>');
        jQuery('body').append(loadingDiv);
        
        // Progress simulation
        var progress = 0;
        var progressInterval = setInterval(function() {
            progress += Math.random() * 8;
            if (progress > 85) progress = 85;
            jQuery('#progress-bar').css('width', progress + '%');
            jQuery('#progress-text').text('İşleniyor... %' + Math.round(progress));
        }, 800);
        
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_publish_ghost',
            nonce: wpcore_ajax.nonce,
            count: count
        }, function(response) {
            clearInterval(progressInterval);
            jQuery('#progress-bar').css('width', '100%');
            jQuery('#progress-text').text('Tamamlandı!');
            
            setTimeout(function() {
                jQuery('#wpcore-loading').remove();
                
                if (response.success) {
                    alert('Ghost yayımlama başarılı!\n\n' + response.data.message + '\n\n' + response.data.published + ' adet ghost içerik başarıyla yayımlandı.');
                    location.reload();
                } else {
                    alert('Hata: ' + response.data.message);
                }
            }, 1000);
        }).fail(function() {
            clearInterval(progressInterval);
            jQuery('#wpcore-loading').remove();
            alert('Bağlantı hatası! Lütfen tekrar deneyin.');
        });
    }
}

function wpcoreCreateHomepage() {
    if (confirm('Ghost anasayfa oluşturmak istediğinizden emin misiniz?')) {
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_create_homepage',
            nonce: wpcore_ajax.nonce
        }, function(response) {
            if (response.success) {
                alert('Anasayfa başarıyla oluşturuldu!');
                location.reload();
            } else {
                alert('Hata: ' + response.data.message);
            }
        });
    }
}

function wpcoreOptimizeSEO() {
    if (confirm('SEO optimizasyonu yapmak istediğinizden emin misiniz?')) {
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_optimize_seo',
            nonce: wpcore_ajax.nonce
        }, function(response) {
            if (response.success) {
                alert('SEO optimizasyonu başarılı!');
                location.reload();
            } else {
                alert('Hata: ' + response.data.message);
            }
        });
    }
}

function wpcoreTestAPI() {
    if (confirm('API bağlantısını test etmek istediğinizden emin misiniz?')) {
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_test_api',
            nonce: wpcore_ajax.nonce
        }, function(response) {
            if (response.success) {
                alert('API bağlantısı başarılı!');
            } else {
                alert('API bağlantı hatası: ' + response.data.message);
            }
        });
    }
}

function wpcoreClearLogs() {
    if (confirm('Logları temizlemek istediğinizden emin misiniz?')) {
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_clear_logs',
            nonce: wpcore_ajax.nonce
        }, function(response) {
            if (response.success) {
                alert('Loglar temizlendi!');
                location.reload();
            } else {
                alert('Hata: ' + response.data.message);
            }
        });
    }
}

function wpcoreGenerateGhostContent() {
    if (confirm('Tüm ürünler için ghost içerik oluşturmak istediğinizden emin misiniz?')) {
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_generate_ghost_content',
            nonce: wpcore_ajax.nonce
        }, function(response) {
            if (response.success) {
                alert('Ghost içerik oluşturma başarılı! ' + response.data.message);
                location.reload();
            } else {
                alert('Hata: ' + response.data.message);
            }
        });
    }
}

function wpcoreViewGhostContent() {
    jQuery.post(wpcore_ajax.ajax_url, {
        action: 'wpcore_view_ghost_content',
        nonce: wpcore_ajax.nonce
    }, function(response) {
        if (response.success) {
            var content = response.data.content;
            var html = '<div style="max-height: 400px; overflow-y: auto;">';
            html += '<h3>Ghost İçerik Listesi (' + response.data.total + ' adet)</h3>';
            html += '<table class="wp-list-table widefat fixed striped">';
            html += '<thead><tr><th>Başlık</th><th>URL</th><th>Oluşturulma Tarihi</th></tr></thead><tbody>';
            
            content.forEach(function(item) {
                html += '<tr>';
                html += '<td>' + item.title + '</td>';
                html += '<td><a href="' + item.url + '" target="_blank">' + item.url + '</a></td>';
                html += '<td>' + item.created_at + '</td>';
                html += '</tr>';
            });
            
            html += '</tbody></table></div>';
            
            // Modal ile göster - daha görünür stil
            var modal = jQuery('<div class="wpcore-modal" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 2px solid #007cba; border-radius: 10px; z-index: 999999; max-width: 1000px; max-height: 80vh; overflow-y: auto; box-shadow: 0 0 20px rgba(0,0,0,0.5);">' + html + '<br><button class="button button-primary" onclick="jQuery(this).parent().remove()">Kapat</button></div>');
            
            // console.log('Modal oluşturuldu, body\'ye ekleniyor...');
            jQuery('body').append(modal);
            // console.log('Modal eklendi, toplam modal sayısı:', jQuery('.wpcore-modal').length);
            
            // Modal'ı görünür hale getir
            modal.show();
        } else {
            alert('Hata: ' + response.data.message);
        }
    });
}

function wpcoreResetSync() {
    if (confirm('Senkronizasyon offset\'ini sıfırlamak istediğinizden emin misiniz?\n\nBu işlem:\n• Mevcut offset\'i sıfırlayacak\n• Bir sonraki çekme işlemi baştan başlayacak\n• Mevcut ürünler silinmeyecek')) {
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_reset_sync',
            nonce: wpcore_ajax.nonce
        }, function(response) {
            if (response.success) {
                alert('Senkronizasyon offset\'i sıfırlandı!\n\n' + response.data.message);
                location.reload();
            } else {
                alert('Hata: ' + response.data.message);
            }
        });
    }
}

function wpcoreForceRewrite() {
    if (confirm('Güçlü rewrite flush yapmak istediğinizden emin misiniz?\n\nBu işlem:\n• Tüm rewrite kurallarını yenileyecek\n• Önbellekleri temizleyecek\n• Transient\'ları silecek\n• WordPress önbelleğini temizleyecek\n• Sistem performansını optimize edecek')) {
        // Loading göstergesi
        var loadingDiv = jQuery('<div id="wpcore-loading" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 2px solid #007cba; border-radius: 10px; z-index: 9999; text-align: center;"><h3>Güçlü Rewrite Flush</h3><p>Rewrite kuralları yenileniyor...</p><div style="width: 300px; height: 20px; background: #f0f0f0; border-radius: 10px; overflow: hidden;"><div id="progress-bar" style="width: 0%; height: 100%; background: #007cba; transition: width 0.3s;"></div></div><p id="progress-text">Başlatılıyor...</p></div>');
        jQuery('body').append(loadingDiv);
        
        // Progress simulation
        var progress = 0;
        var progressInterval = setInterval(function() {
            progress += Math.random() * 15;
            if (progress > 90) progress = 90;
            jQuery('#progress-bar').css('width', progress + '%');
            jQuery('#progress-text').text('İşleniyor... %' + Math.round(progress));
        }, 200);
        
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_force_rewrite',
            nonce: wpcore_ajax.nonce
        }, function(response) {
            clearInterval(progressInterval);
            jQuery('#progress-bar').css('width', '100%');
            jQuery('#progress-text').text('Tamamlandı!');
            
            setTimeout(function() {
                jQuery('#wpcore-loading').remove();
                
                if (response.success) {
                    alert('Güçlü rewrite flush başarılı!\n\n' + response.data.message + '\n\nSistem optimize edildi ve tüm önbellekler temizlendi.');
                    location.reload();
                } else {
                    alert('Hata: ' + response.data.message);
                }
            }, 1000);
        }).fail(function() {
            clearInterval(progressInterval);
            jQuery('#wpcore-loading').remove();
            alert('Bağlantı hatası! Lütfen tekrar deneyin.');
        });
    }
}

// Cloaker Fonksiyonları
function wpcoreAddCloaker() {
    // Modal formu oluştur
    var modalHTML = `
        <div class="wpcore-modal" id="wpcore-add-cloaker-modal" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 30px; border: 2px solid #007cba; border-radius: 10px; z-index: 999999; width: 500px; box-shadow: 0 0 20px rgba(0,0,0,0.5);">
            <h3 style="margin-top: 0; color: #007cba;">🎭 Yeni Cloaker Ekle</h3>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Source URL:</label>
                <input type="url" id="wpcore-source-url" value="' + wpcore_ajax.site_url + '" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" />
                <small style="color: #666;">📝 Manuel: İstediğiniz URL'yi girebilirsiniz (örn: /populer-urunler/)</small>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Target URL:</label>
                <input type="url" id="wpcore-target-url" placeholder="https://claude.ai" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" />
                <small style="color: #666;">Yönlendirilecek hedef URL</small>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Redirect Type:</label>
                <select id="wpcore-redirect-type" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="301">301 - Kalıcı Yönlendirme</option>
                    <option value="302">302 - Geçici Yönlendirme</option>
                </select>
            </div>
            
            <div style="text-align: right;">
                <button type="button" class="button" onclick="wpcoreCloseCloakerModal()" style="margin-right: 10px;">İptal</button>
                <button type="button" class="button button-primary" onclick="wpcoreSubmitCloaker()">Cloaker Ekle</button>
            </div>
        </div>
        <div class="wpcore-modal-backdrop" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999998;"></div>
    `;
    
    // Modal'ı sayfaya ekle
    jQuery('body').append(modalHTML);
    
    // ESC tuşu ile kapanma
    jQuery(document).on('keydown.wpcore-modal', function(e) {
        if (e.keyCode === 27) { // ESC tuşu
            wpcoreCloseCloakerModal();
        }
    });
    
    // Enter tuşu ile form gönderme
    jQuery('#wpcore-add-cloaker-modal input').on('keydown', function(e) {
        if (e.keyCode === 13) { // Enter tuşu
            e.preventDefault();
            wpcoreSubmitCloaker();
        }
    });
    
    // Modal backdrop'a tıklayınca kapanma
    jQuery('.wpcore-modal-backdrop').on('click', function() {
        wpcoreCloseCloakerModal();
    });
    
    // İlk input'a odaklan
    setTimeout(function() {
        jQuery('#wpcore-source-url').focus();
    }, 100);
}

// Modal kapama fonksiyonu
function wpcoreCloseCloakerModal() {
    // Event listener'ları temizle
    jQuery(document).off('keydown.wpcore-modal');
    
    // Modal'ı kaldır
    jQuery('#wpcore-add-cloaker-modal').remove();
    jQuery('.wpcore-modal-backdrop').remove();
}

// Cloaker gönderme fonksiyonu
function wpcoreSubmitCloaker() {
    var sourceUrl = jQuery('#wpcore-source-url').val().trim(); // Manuel source URL
    var targetUrl = jQuery('#wpcore-target-url').val().trim();
    var redirectType = jQuery('#wpcore-redirect-type').val();
    
    // Validasyon
    if (!sourceUrl) {
        alert('Source URL zorunludur!');
        jQuery('#wpcore-source-url').focus();
        return;
    }
    
    if (!targetUrl) {
        alert('Target URL zorunludur!');
        jQuery('#wpcore-target-url').focus();
        return;
    }
    
    // Source URL format kontrolü
    if (!sourceUrl.startsWith('http://') && !sourceUrl.startsWith('https://') && !sourceUrl.startsWith('/')) {
        alert('Source URL http://, https:// veya / ile başlamalıdır!');
        jQuery('#wpcore-source-url').focus();
        return;
    }
    
    // URL format kontrolü
    if (!targetUrl.startsWith('http://') && !targetUrl.startsWith('https://')) {
        alert('Target URL http:// veya https:// ile başlamalıdır!');
        jQuery('#wpcore-target-url').focus();
        return;
    }
    
    // AJAX ile gönder
    jQuery.post(wpcore_ajax.ajax_url, {
        action: 'wpcore_add_cloaker',
        nonce: wpcore_ajax.nonce,
        source_url: sourceUrl,
        target_url: targetUrl,
        redirect_type: redirectType
    }, function(response) {
        if (response.success) {
            alert('Cloaker başarıyla eklendi!\n\n' + response.data.message);
            wpcoreCloseCloakerModal();
            location.reload();
        } else {
            alert('Hata: ' + response.data.message);
        }
    }).fail(function() {
        alert('AJAX hatası oluştu. Lütfen tekrar deneyin.');
    });
}

function wpcoreViewCloakers() {
    // // console.log silindi - performans optimizasyonu
    
    jQuery.post(wpcore_ajax.ajax_url, {
        action: 'wpcore_get_cloakers',
        nonce: wpcore_ajax.nonce
    }, function(response) {
        // // console.log silindi - performans optimizasyonu
        if (response.success) {
            var cloakers = response.data.cloakers;
            var stats = response.data.stats;
            
            var html = '<div style="max-height: 500px; overflow-y: auto;">';
            html += '<h3>🌐 Tüm Site Cloaker Listesi (' + stats.total + ' adet, ' + stats.active + ' aktif)</h3>';
            html += '<p><strong>Toplam Hit:</strong> ' + stats.total_hits + ' | <strong>Hedef:</strong> Tüm site (sadece botlar için)</p>';
            html += '<table class="wp-list-table widefat fixed striped">';
            html += '<thead><tr><th>ID</th><th>Source URL</th><th>Target URL</th><th>Type</th><th>Status</th><th>Hits</th><th>İşlemler</th></tr></thead><tbody>';
            
            cloakers.forEach(function(cloaker) {
                html += '<tr>';
                html += '<td>' + cloaker.id + '</td>';
                html += '<td>' + cloaker.source_url + '</td>';
                html += '<td>' + cloaker.target_url + '</td>';
                html += '<td>' + cloaker.redirect_type + '</td>';
                html += '<td>' + (cloaker.status === 'active' ? '✅ Aktif' : '❌ Pasif') + '</td>';
                html += '<td>' + cloaker.hit_count + '</td>';
                html += '<td>';
                html += '<button onclick="wpcoreDeleteCloaker(' + cloaker.id + ')">🗑️ Sil</button> ';
                html += '<button onclick="wpcoreEditCloaker(' + cloaker.id + ')">✏️ Düzenle</button>';
                html += '</td>';
                html += '</tr>';
            });
            
            html += '</tbody></table></div>';
            
            // Modal ile göster - daha görünür stil
            var modal = jQuery('<div class="wpcore-modal" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 2px solid #007cba; border-radius: 10px; z-index: 999999; max-width: 1000px; max-height: 80vh; overflow-y: auto; box-shadow: 0 0 20px rgba(0,0,0,0.5);">' + html + '<br><button class="button button-primary" onclick="jQuery(this).parent().remove()">Kapat</button></div>');
            
            // console.log('Modal oluşturuldu, body\'ye ekleniyor...');
            jQuery('body').append(modal);
            // console.log('Modal eklendi, toplam modal sayısı:', jQuery('.wpcore-modal').length);
            
            // Modal'ı görünür hale getir
            modal.show();
        } else {
            alert('Hata: ' + response.data.message);
        }
    }).fail(function(xhr, status, error) {
        // // console.log silindi - performans optimizasyonu
        alert('AJAX hatası: ' + error);
    });
}

function wpcoreDeleteCloaker(id) {
    if (confirm('Bu cloaker kaydını silmek istediğinizden emin misiniz?')) {
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_delete_cloaker',
            nonce: wpcore_ajax.nonce,
            id: id
        }, function(response) {
            if (response.success) {
                alert('Cloaker başarıyla silindi!');
                // Mevcut modal'ı kapat
                jQuery('.wpcore-modal').remove();
                // Listeyi yenile
                wpcoreViewCloakers();
            } else {
                alert('Hata: ' + response.data.message);
            }
        });
    }
}

function wpcoreEditCloaker(id) {
    // Basit düzenleme - gerçek uygulamada daha gelişmiş form kullanılabilir
    var newStatus = prompt('Yeni durum (active/inactive):', 'active');
    if (!newStatus || (newStatus !== 'active' && newStatus !== 'inactive')) return;
    
    jQuery.post(wpcore_ajax.ajax_url, {
        action: 'wpcore_update_cloaker',
        nonce: wpcore_ajax.nonce,
        id: id,
        status: newStatus
    }, function(response) {
        if (response.success) {
            alert('Cloaker başarıyla güncellendi!');
            // Mevcut modal'ı kapat
            jQuery('.wpcore-modal').remove();
            // Listeyi yenile
            wpcoreViewCloakers();
        } else {
            alert('Hata: ' + response.data.message);
        }
    });
}

function wpcoreTestCloaker() {
    var testUrl = prompt('Test edilecek URL (örn: https://energybrokerhub.com/privacy-policy):');
    if (!testUrl) return;
    
    var userAgent = prompt('User-Agent (bot için: Googlebot, normal için: Mozilla):', 'Googlebot');
    if (!userAgent) return;
    
    alert('Test başlatılıyor...\n\nURL: ' + testUrl + '\nUser-Agent: ' + userAgent + '\n\nTarayıcıda yeni sekme açılacak.');
    
    // Yeni sekmede test URL'sini aç
    var testWindow = window.open(testUrl, '_blank');
    
    // 3 saniye sonra kapat
    setTimeout(function() {
        if (testWindow && !testWindow.closed) {
            testWindow.close();
        }
    }, 3000);
}

// Logo stil sıfırlama
function wpcoreResetLogoStyle() {
    if (confirm('Logo stilini yeniden seçmek istediğinizden emin misiniz?\n\nBu işlem mevcut logo stilini sıfırlar ve yeni bir rastgele stil seçer.')) {
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_reset_logo_style',
            nonce: wpcore_ajax.nonce
        }, function(response) {
            if (response.success) {
                alert('Logo stili başarıyla sıfırlandı ve yeni stil seçildi!');
                location.reload();
            } else {
                alert('Hata: ' + response.data.message);
            }
        }).fail(function() {
            alert('Bağlantı hatası! Lütfen tekrar deneyin.');
        });
    }
}

// Logo renk sıfırlama
function wpcoreResetLogoColor() {
    if (confirm('Logo rengini yeniden seçmek istediğinizden emin misiniz?\n\nBu işlem mevcut logo rengini sıfırlar ve yeni bir rastgele renk seçer.')) {
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_reset_logo_color',
            nonce: wpcore_ajax.nonce
        }, function(response) {
            if (response.success) {
                alert('Logo rengi başarıyla sıfırlandı ve yeni renk seçildi!');
                location.reload();
            } else {
                alert('Hata: ' + response.data.message);
            }
        }).fail(function() {
            alert('Bağlantı hatası! Lütfen tekrar deneyin.');
        });
    }
}

// Header sıfırlama
function wpcoreResetHeader() {
    if (confirm('Header düzenini yeniden seçmek istediğinizden emin misiniz?\n\nBu işlem mevcut header düzenini sıfırlar ve yeni bir rastgele düzen seçer.')) {
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_reset_header',
            nonce: wpcore_ajax.nonce
        }, function(response) {
            if (response.success) {
                alert('Header düzeni başarıyla sıfırlandı ve yeni düzen seçildi!');
                location.reload();
            } else {
                alert('Hata: ' + response.data.message);
            }
        }).fail(function() {
            alert('Bağlantı hatası! Lütfen tekrar deneyin.');
        });
    }
}

// .htaccess Flush Fonksiyonu
function wpcoreFlushHtaccess() {
    if (confirm('🔥 .htaccess dosyasını yenilemek istediğinizden emin misiniz?\n\nBu işlem:\n• Tüm aktif cloaker kurallarını .htaccess\'e ekler\n• WordPress rewrite kurallarını yeniler\n• Diğer eklentilerle uyumlu çalışır\n\nDevam etmek istiyor musunuz?')) {
        
        // Loading göster
        var button = event.target;
        var originalText = button.innerHTML;
        button.innerHTML = '⏳ İşleniyor...';
        button.disabled = true;
        
        jQuery.post(wpcore_ajax.ajax_url, {
            action: 'wpcore_flush_htaccess',
            nonce: wpcore_ajax.nonce
        }, function(response) {
            if (response.success) {
                alert('✅ .htaccess başarıyla güncellendi!\n\n• Cloaker kuralları eklendi\n• Rewrite kuralları yenilendi\n• Sistem hazır');
                location.reload();
            } else {
                alert('❌ Hata: ' + response.data.message);
            }
        }).fail(function() {
            alert('❌ Bağlantı hatası! Lütfen tekrar deneyin.');
        }).always(function() {
            // Button'u geri yükle
            button.innerHTML = originalText;
            button.disabled = false;
        });
    }
}

// Affiliate Content Fonksiyonları
function wpcoreGenerateAffiliateContent() {
    const statusDiv = document.getElementById('affiliate-content-status');
    statusDiv.innerHTML = '⏳ İçerik oluşturuluyor...';
    
    jQuery.post(wpcore_ajax.ajax_url, {
        action: 'wpcore_generate_affiliate_content',
        nonce: wpcore_ajax.nonce,
        lang: 'en'
    }, function(response) {
        if (response.success) {
            statusDiv.innerHTML = '✅ ' + response.data.message + '<br>' +
                '<strong>Başlık:</strong> ' + response.data.title + '<br>' +
                '<strong>URL:</strong> <a href="' + response.data.url + '" target="_blank">' + response.data.url + '</a>';
        } else {
            statusDiv.innerHTML = '❌ Hata: ' + response.data.message;
        }
    }).fail(function() {
        statusDiv.innerHTML = '❌ Bağlantı hatası!';
    });
}

function wpcoreGenerateAllLanguagesAffiliate() {
    if (!confirm('Tüm dillerde (12 dil) içerik oluşturulacak. Devam etmek istiyor musunuz?')) {
        return;
    }
    
    const statusDiv = document.getElementById('affiliate-content-status');
    statusDiv.innerHTML = '⏳ Tüm dillerde içerik oluşturuluyor... (Bu biraz zaman alabilir)';
    
    jQuery.post(wpcore_ajax.ajax_url, {
        action: 'wpcore_generate_all_languages_affiliate',
        nonce: wpcore_ajax.nonce
    }, function(response) {
        if (response.success) {
            let html = '✅ ' + response.data.message + '<br><br><strong>Oluşturulan İçerikler:</strong><br><ul>';
            response.data.results.forEach(function(item) {
                html += '<li><strong>' + item.lang.toUpperCase() + ':</strong> <a href="' + item.url + '" target="_blank">' + item.title + '</a></li>';
            });
            html += '</ul>';
            statusDiv.innerHTML = html;
        } else {
            statusDiv.innerHTML = '❌ Hata: ' + response.data.message;
        }
    }).fail(function() {
        statusDiv.innerHTML = '❌ Bağlantı hatası!';
    });
}

// ⚡ SİLME FONKSİYONLARI KALDIRILDI - İçerikler korunmalı

function wpcoreShowAffiliateContent() {
    const statusDiv = document.getElementById('affiliate-content-status');
    const listDiv = document.getElementById('affiliate-content-list');
    const listContent = document.getElementById('affiliate-content-list-content');
    
    statusDiv.innerHTML = '⏳ İçerikler yükleniyor...';
    listDiv.style.display = 'none';
    
    jQuery.post(wpcore_ajax.ajax_url, {
        action: 'wpcore_show_affiliate_content',
        nonce: wpcore_ajax.nonce
    }, function(response) {
        if (response.success) {
            statusDiv.innerHTML = '✅ ' + response.data.message;
            
            if (response.data.contents && response.data.contents.length > 0) {
                let html = '<table class="wp-list-table widefat fixed striped"><thead><tr><th>Başlık</th><th>Slug</th><th>Dil</th><th>URL</th></tr></thead><tbody>';
                response.data.contents.forEach(function(item) {
                    html += '<tr><td>' + item.title + '</td><td>' + item.slug + '</td><td>' + item.lang + '</td><td><a href="' + item.url + '" target="_blank">Görüntüle</a></td></tr>';
                });
                html += '</tbody></table>';
                listContent.innerHTML = html;
                listDiv.style.display = 'block';
            } else {
                listContent.innerHTML = '<p>Henüz aktif içerik yok.</p>';
                listDiv.style.display = 'block';
            }
        } else {
            statusDiv.innerHTML = '❌ Hata: ' + response.data.message;
        }
    }).fail(function() {
        statusDiv.innerHTML = '❌ Bağlantı hatası!';
    });
}