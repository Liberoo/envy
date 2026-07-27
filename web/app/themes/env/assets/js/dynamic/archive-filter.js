// Archive filter: AJAX blog archive filtering.
// Category / pagination clicks fetch the target page, swap the posts grid
// and pagination (.env-archive__query) and update the URL via
// history.pushState (back/forward handled through popstate).
// Lazy-loaded by importObserver on .env-archive__filters.

class ArchiveFilter {
  constructor(root) {
    this.root = root;
    this.query = root.querySelector(".env-archive__query");
    if (!this.query) return;

    root.addEventListener("click", (event) => {
      const link = event.target.closest(
        ".env-archive__filters a, .env-archive__pagination a",
      );
      if (!link) return;

      const isPagination = !!link.closest(".env-archive__pagination");
      event.preventDefault();
      this.load(link.href, { push: true, scroll: isPagination });
    });

    window.addEventListener("popstate", () => {
      this.load(window.location.href, { push: false, scroll: false });
    });

    this.markActive();
  }

  async load(url, { push, scroll }) {
    this.query.classList.add("is-loading");

    try {
      const response = await fetch(url);
      if (!response.ok) throw new Error(`HTTP ${response.status}`);
      const html = await response.text();
      const doc = new DOMParser().parseFromString(html, "text/html");
      const fresh = doc.querySelector(".env-archive__query");
      if (!fresh) throw new Error("no query block in response");

      // Reveal swapped-in cards immediately: the scroll-animation observer
      // in scripts.js does not know about these new elements.
      fresh.querySelectorAll(".js-animation").forEach((el) => {
        el.classList.add("js-animation--open");
      });

      this.query.replaceWith(fresh);
      this.query = fresh;

      if (push) window.history.pushState({}, "", url);
      this.markActive();

      if (scroll) {
        this.root
          .querySelector(".env-archive__body")
          ?.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    } catch (error) {
      // Fallback to a full navigation instead of leaving a broken state.
      window.location.href = url;
    } finally {
      this.query.classList.remove("is-loading");
    }
  }

  markActive() {
    const path = window.location.pathname.replace(/page\/\d+\/?$/, "");
    this.root.querySelectorAll(".env-archive__filters a").forEach((link) => {
      const linkPath = new URL(link.href, window.location.origin).pathname;
      link.classList.toggle("is-active", linkPath === path);
    });
  }
}

document.querySelectorAll("main.env-archive").forEach((root) => {
  new ArchiveFilter(root);
});
