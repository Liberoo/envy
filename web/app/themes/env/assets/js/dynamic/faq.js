// FAQ accordion: toggle aria-expanded and animate the linked panel height.

document.querySelectorAll("button[aria-controls]").forEach((button) => {
  const target = document.getElementById(button.getAttribute("aria-controls"));
  if (!target) return;

  button.addEventListener("click", () => {
    const expanded = button.getAttribute("aria-expanded") === "true";
    button.setAttribute("aria-expanded", String(!expanded));

    if (!expanded) {
      target.style.maxHeight = `${target.scrollHeight}px`;
      target.classList.add("open");
    } else {
      target.style.maxHeight = "0px";
      target.classList.remove("open");
    }
  });
});
