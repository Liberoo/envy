document.querySelectorAll("button[aria-controls]").forEach((button) => {
  const targetId = button.getAttribute("aria-controls");
  const target = document.getElementById(targetId);

  // Sprawdź czy target istnieje
  if (!target) {
    console.warn(`FAQ: Element with ID "${targetId}" not found`);
    return;
  }

  button.addEventListener("click", () => {
    const expanded = button.getAttribute("aria-expanded") === "true";
    button.setAttribute("aria-expanded", !expanded);

    if (!expanded) {
      target.style.maxHeight = target.scrollHeight + "px";
      target.classList.add("open");
    } else {
      target.style.maxHeight = "0px";
      target.classList.remove("open");
    }
  });
});
