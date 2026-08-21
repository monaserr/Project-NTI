document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".pf-filter-btn");
  const sections = document.querySelectorAll(".pf-track-section");

  function activate(filter) {
    buttons.forEach((b) =>
      b.classList.toggle("active", b.dataset.filter === filter),
    );
    sections.forEach(
      (s) => (s.style.display = s.dataset.section === filter ? "" : "none"),
    );
  }

  buttons.forEach((btn) => {
    btn.addEventListener("click", () => {
      activate(btn.dataset.filter);
      // reflect selection in the URL without reloading, so it's shareable / linkable
      const url = new URL(window.location);
      url.searchParams.set("track", btn.dataset.filter);
      window.history.replaceState({}, "", url);
    });
  });

  // Auto-activate from ?track=... (used when coming from the Tracks page)
  const params = new URLSearchParams(window.location.search);
  const trackParam = params.get("track");
  if (
    trackParam &&
    document.querySelector('.pf-filter-btn[data-filter="' + trackParam + '"]')
  ) {
    activate(trackParam);
    document
      .getElementById("pf-resource-container")
      .scrollIntoView({ behavior: "smooth", block: "start" });
  }
});
