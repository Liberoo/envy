// Portfolio rows: make the whole row clickable, not just the title link.

function initPortfolioRows() {
  document.querySelectorAll(".env-portfolio__list > li").forEach((row) => {
    const link = row.querySelector(".env-portfolio__title a");
    if (!link) return;

    row.style.cursor = "pointer";

    row.addEventListener("click", (event) => {
      // Let real links/buttons handle their own clicks.
      if (event.target.closest("a, button")) return;

      if (event.metaKey || event.ctrlKey) {
        window.open(link.href, "_blank");
      } else {
        window.location.href = link.href;
      }
    });
  });
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initPortfolioRows);
} else {
  initPortfolioRows();
}
