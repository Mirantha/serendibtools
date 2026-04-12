<div class="changelog_container">
    <?php
    $land_excavator_changelog_entries = get_changelog_from_readme();
    if (!empty($land_excavator_changelog_entries)) :
        foreach ($land_excavator_changelog_entries as $land_excavator_entry) :
            $land_excavator_version = esc_html($land_excavator_entry[1]);
            $land_excavator_date = esc_html($land_excavator_entry[2]);
            $land_excavator_details = explode("\n", trim($land_excavator_entry[3]));
            ?>
            <div class="changelog_element">
                <span class="theme_version">
                    <strong><?php echo 'v' . $land_excavator_version; ?></strong>
                    <?php echo 'Release date: ' . $land_excavator_date; ?>
                    <span class="dashicons dashicons-arrow-down-alt2"></span>
                </span>

                <div class="changelog_details" style="display: none;">
                    <ul>
                        <?php foreach ($land_excavator_details as $land_excavator_detail) : ?>
                            <li><?php echo esc_html(trim($land_excavator_detail, "- \t")); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php
        endforeach;
    else :
        ?>
        <p><?php esc_html_e('No changelog available.', 'land-excavator'); ?></p>
    <?php endif; ?>
</div>