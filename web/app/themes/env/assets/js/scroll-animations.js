// Scroll animations: reveal .js-animation, delayed graytext on [data-graytext].

document.addEventListener("DOMContentLoaded", () => {
  const animationObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("js-animation--open");
          animationObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.1 },
  );

  document.querySelectorAll(".js-animation").forEach((element) => {
    animationObserver.observe(element);
  });

  const graytextObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          setTimeout(() => entry.target.classList.add("is-gray"), 700);
          graytextObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.5 },
  );

  document.querySelectorAll("[data-graytext]").forEach((element) => {
    graytextObserver.observe(element);
  });
});
