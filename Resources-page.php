<?php
$pageTitle = "Resources";

include_once("includes/navbar.php");
require_once("connect.php");

$categories = [
    "all" => "All",
    "frontend" => "Frontend",
    "backend" => "Backend",
    "cybersecurity" => "Cybersecurity",
    "ai-ml" => "AI",
    "data-science" => "Data Science"
];

$initialTrack = isset($_GET["track"]) && array_key_exists($_GET["track"], $categories)
    ? $_GET["track"]
    : "all";

$selectedCourseId = isset($_GET["course_id"]) ? (int) $_GET["course_id"] : 0;
$initialStep = $_GET["step"] ?? "";
$courses = [];

$courseSql = "SELECT id, title FROM courses ORDER BY id ASC";
$courseResult = mysqli_query($conn, $courseSql);

if ($courseResult) {
    while ($course = mysqli_fetch_assoc($courseResult)) {
        $courses[] = [
            "id" => (int) $course["id"],
            "title" => $course["title"]
        ];
    }
}

$resources = [];

$sql = "SELECT
            r.id,
            r.course_id,
            r.category,
            r.topic,
            r.title,
            r.description,
            r.icon,
            r.bg,
            r.link,
            r.badge,
            c.title AS course_name
        FROM resources r
        LEFT JOIN courses c ON r.course_id = c.id
        ORDER BY r.id ASC";

$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $resources[] = [
            "id" => (int) $row["id"],
            "course_id" => $row["course_id"] !== null ? (int) $row["course_id"] : null,
            "course_name" => $row["course_name"],
            "category" => $row["category"],
            "topic" => $row["topic"],
            "title" => $row["title"],
            "desc" => $row["description"],
            "icon" => $row["icon"],
            "bg" => $row["bg"],
            "link" => $row["link"],
            "badge" => $row["badge"]
        ];
    }
}
?>

<div class="container mt-4">
    <h2 class="pf-page-title">Resources</h2>
    <p class="pf-page-subtitle">Curated resources to help you learn better</p>

    <div class="d-flex flex-wrap gap-2 my-4" id="pf-filters">
        <?php foreach ($categories as $slug => $label): ?>
            <button
                type="button"
                class="pf-filter-btn <?= $slug === $initialTrack ? "active" : "" ?>"
                data-filter="<?= htmlspecialchars($slug, ENT_QUOTES, "UTF-8") ?>"
            >
                <?= htmlspecialchars($label, ENT_QUOTES, "UTF-8") ?>
            </button>
        <?php endforeach; ?>
    </div>

    <div id="pf-resource-container" class="pb-5">
        <?php foreach ($categories as $slug => $label): ?>
            <?php
            $topics = [];

            foreach ($resources as $item) {
                if ($slug === "all") {
                    if ($item["category"] !== "all") {
                        continue;
                    }
                } else {
                    if ($item["category"] !== $slug) {
                        continue;
                    }
                }

                $topic = !empty($item["topic"]) ? $item["topic"] : "Resources";

                if (!isset($topics[$topic])) {
                    $topics[$topic] = [];
                }

                $topics[$topic][] = $item;
            }
            ?>

            <div
                class="pf-track-section"
                data-section="<?= htmlspecialchars($slug, ENT_QUOTES, "UTF-8") ?>"
                style="<?= $initialTrack === $slug ? "" : "display:none;" ?>"
            >
                <?php if (empty($topics)): ?>
                    <div class="alert alert-info">
                        No resources available in this category yet.
                    </div>
                <?php else: ?>
                    <?php foreach ($topics as $topicName => $items): ?>
                        <div class="pf-group-title">
                            <i class="bi bi-map-fill"></i>
                            <?= htmlspecialchars($topicName, ENT_QUOTES, "UTF-8") ?>
                        </div>

                        <?php foreach ($items as $item): ?>
                            <?php include __DIR__ . "/resource_row.php"; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".pf-filter-btn");
    const sections = document.querySelectorAll(".pf-track-section");

    buttons.forEach(function (button) {
        button.addEventListener("click", function () {
            const filter = this.getAttribute("data-filter");

            buttons.forEach(function (btn) {
                btn.classList.remove("active");
            });

            this.classList.add("active");

            sections.forEach(function (section) {
                section.style.display =
                    section.getAttribute("data-section") === filter ? "" : "none";
            });

            const url = new URL(window.location.href);

            if (filter === "all") {
                url.searchParams.delete("track");
            } else {
                url.searchParams.set("track", filter);
            }

            window.history.replaceState({}, "", url);
        });
    });
});
</script>

<?php include_once("includes/footer.php"); ?>