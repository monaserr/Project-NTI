<div class="pf-resource-row">
    <div class="pf-resource-icon" style="background:<?= htmlspecialchars($item["bg"], ENT_QUOTES, "UTF-8") ?>;">
        <i class="bi <?= htmlspecialchars($item["icon"], ENT_QUOTES, "UTF-8") ?>"></i>
    </div>

    <div class="flex-grow-1">
        <div class="pf-resource-title"><?= htmlspecialchars($item["title"], ENT_QUOTES, "UTF-8") ?></div>
        <p class="pf-resource-desc"><?= htmlspecialchars($item["desc"], ENT_QUOTES, "UTF-8") ?></p>
    </div>

    <span class="pf-badge"><?= htmlspecialchars($item["badge"], ENT_QUOTES, "UTF-8") ?></span>

    <a href="<?= htmlspecialchars($item["link"], ENT_QUOTES, "UTF-8") ?>" target="_blank" rel="noopener noreferrer"
        class="pf-link-btn text-decoration-none" title="Open Resource">
        <i class="bi bi-box-arrow-up-right"></i>
    </a>
</div>