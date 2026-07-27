// Newsletter form (pattern env/newsletter). POSTs to env/v1/subscribe
// (inc/newsletter.php), which forwards to MailerLite. Config (endpoint,
// nonce) comes from window.ENV_NL printed in wp_footer. Lazy-loaded.

class NewsletterForm {
  constructor(form) {
    this.form = form;
    this.nameInput = form.querySelector('input[name="name"]');
    this.emailInput = form.querySelector('input[name="email"]');
    this.consentInput = form.querySelector('input[name="consent"]');
    this.submitButton = form.querySelector('button[type="submit"]');
    this.message = form.querySelector(".env-newsletter__msg");

    form.addEventListener("submit", (event) => this.onSubmit(event));
  }

  setMessage(text, type) {
    if (!this.message) return;
    this.message.textContent = text;
    this.message.classList.remove("is-success", "is-error");
    if (type) this.message.classList.add(type);
  }

  async onSubmit(event) {
    event.preventDefault();

    const config = window.ENV_NL;
    if (!config || !config.endpoint) {
      this.setMessage("Newsletter jest chwilowo niedostępny.", "is-error");
      return;
    }

    const email = this.emailInput ? this.emailInput.value.trim() : "";
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      this.emailInput?.classList.add("is-invalid");
      this.setMessage("Podaj poprawny adres e-mail.", "is-error");
      return;
    }
    this.emailInput?.classList.remove("is-invalid");

    if (this.consentInput && !this.consentInput.checked) {
      this.setMessage("Zaznacz zgodę na przetwarzanie danych.", "is-error");
      return;
    }

    this.submitButton?.setAttribute("disabled", "disabled");
    this.setMessage("Zapisuję…", null);

    try {
      const response = await fetch(config.endpoint, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-WP-Nonce": config.nonce,
        },
        body: JSON.stringify({
          email,
          name: this.nameInput ? this.nameInput.value.trim() : "",
          consent: true,
        }),
      });

      const data = await response.json();

      if (response.ok && data.success) {
        this.setMessage(data.message, "is-success");
        this.form.reset();
      } else {
        this.setMessage(
          data.message || "Zapis nie powiódł się. Spróbuj ponownie później.",
          "is-error",
        );
      }
    } catch (error) {
      this.setMessage(
        "Nie udało się połączyć. Spróbuj ponownie później.",
        "is-error",
      );
    } finally {
      this.submitButton?.removeAttribute("disabled");
    }
  }
}

document
  .querySelectorAll(".env-newsletter__form")
  .forEach((form) => new NewsletterForm(form));
