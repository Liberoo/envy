// Kamil Pattern Advanced JavaScript
console.log("🚀 Kamil pattern JS loaded!");

class KamilPattern {
	constructor(element) {
		this.element = element;
		this.button = element.querySelector("[data-kamil-button]");
		this.counter = 0;
		this.init();
	}

	init() {
		if (this.button) {
			this.button.addEventListener("click", (e) => this.handleClick(e));
			this.addHoverEffects();
		}
	}

	handleClick(e) {
		e.preventDefault();
		this.counter++;

		const message = e.target.getAttribute("data-message");
		const finalMessage = `${message}\nKliknięto ${this.counter} razy!`;

		// Zamiast alert, można użyć toast notification
		this.showNotification(finalMessage);

		// Dodaj confetti effect
		this.createConfetti();
	}

	addHoverEffects() {
		this.button.style.transition = "all 0.3s ease";

		this.button.addEventListener("mouseenter", () => {
			this.button.style.transform = "translateY(-2px)";
			this.button.style.boxShadow = "0 4px 8px rgba(0,0,0,0.2)";
		});

		this.button.addEventListener("mouseleave", () => {
			this.button.style.transform = "translateY(0)";
			this.button.style.boxShadow = "none";
		});
	}

	showNotification(message) {
		const notification = document.createElement("div");
		notification.innerHTML = message.replace(/\n/g, "<br>");
		notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #2563eb;
            color: white;
            padding: 1rem;
            border-radius: 8px;
            z-index: 9999;
            max-width: 300px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateX(100%);
            transition: transform 0.3s ease;
        `;

		document.body.appendChild(notification);

		// Animate in
		setTimeout(() => {
			notification.style.transform = "translateX(0)";
		}, 100);

		// Remove after 3 seconds
		setTimeout(() => {
			notification.style.transform = "translateX(100%)";
			setTimeout(() => notification.remove(), 300);
		}, 3000);
	}

	createConfetti() {
		// Simple confetti effect
		for (let i = 0; i < 30; i++) {
			const confetti = document.createElement("div");
			confetti.style.cssText = `
                position: fixed;
                width: 10px;
                height: 10px;
                background: ${
					["#ff6b6b", "#4ecdc4", "#45b7d1", "#f9ca24", "#f0932b"][
						Math.floor(Math.random() * 5)
					]
				};
                top: 50%;
                left: 50%;
                pointer-events: none;
                z-index: 9999;
                border-radius: 50%;
            `;

			document.body.appendChild(confetti);

			const angle = (Math.PI * 2 * i) / 30;
			const velocity = 5 + Math.random() * 5;

			let x = 0,
				y = 0;
			const animate = () => {
				x += Math.cos(angle) * velocity;
				y += Math.sin(angle) * velocity + 2; // gravity

				confetti.style.transform = `translate(${x}px, ${y}px)`;
				confetti.style.opacity = Math.max(0, 1 - Math.abs(y) / 200);

				if (confetti.style.opacity > 0) {
					requestAnimationFrame(animate);
				} else {
					confetti.remove();
				}
			};

			animate();
		}
	}
}

// Initialize all Kamil patterns on the page
document.querySelectorAll(".kamil-pattern").forEach((element) => {
	new KamilPattern(element);
});

export default KamilPattern;
