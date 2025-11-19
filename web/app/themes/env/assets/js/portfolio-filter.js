/**
 * Portfolio Filter System
 * Redirects taxonomy links to portfolio page with filter parameter
 */

document.addEventListener("DOMContentLoaded", function () {
  // Get portfolio page URL (change 'portfolio' to your page slug)
  const portfolioPageUrl = "/portfolio/"; // Update this path

  // Find all taxonomy links
  const taxonomyLinks = document.querySelectorAll(".wp-block-post-terms a");

  taxonomyLinks.forEach((link) => {
    // Add click handler
    link.addEventListener("click", function (e) {
      e.preventDefault();

      // Get term slug from URL
      const url = new URL(this.href);
      const pathParts = url.pathname.split("/");
      const termSlug = pathParts[pathParts.length - 2]; // Get second to last part

      // Redirect to portfolio page with filter
      const filterUrl = portfolioPageUrl + "?filter=" + termSlug;
      window.location.href = filterUrl;
    });

    // Add visual indication that it's clickable for filtering
    link.style.cursor = "pointer";
    link.title = "Filtruj portfolio po: " + link.textContent;
  });
});

/**
 * Portfolio Filter Handler
 * Handles filtering on portfolio page
 */
function initPortfolioFilter() {
  const urlParams = new URLSearchParams(window.location.search);
  const filter = urlParams.get("filter");

  if (filter) {
    // Add active filter class
    document.body.classList.add("filter-active");

    // Filter portfolio items
    const portfolioItems = document.querySelectorAll(".wp-block-post");

    portfolioItems.forEach((item) => {
      const terms = item.querySelectorAll(".wp-block-post-terms a");
      let hasMatchingTerm = false;

      terms.forEach((term) => {
        if (term.textContent.toLowerCase().includes(filter.toLowerCase())) {
          hasMatchingTerm = true;
        }
      });

      if (!hasMatchingTerm) {
        item.style.display = "none";
      }
    });

    // Show filter indicator
    const filterIndicator = document.createElement("div");
    filterIndicator.className = "filter-indicator";
    filterIndicator.innerHTML = `
            <span>Filtr aktywny: ${filter}</span>
            <button onclick="clearFilter()">Wyczyść filtr</button>
        `;

    const mainContent = document.querySelector(".main-content");
    if (mainContent) {
      mainContent.insertBefore(filterIndicator, mainContent.firstChild);
    }
  }
}

function clearFilter() {
  const url = new URL(window.location);
  url.searchParams.delete("filter");
  window.location.href = url.toString();
}

// Initialize filter when page loads
document.addEventListener("DOMContentLoaded", initPortfolioFilter);

