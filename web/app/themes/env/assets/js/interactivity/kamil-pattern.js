/**
 * WordPress Interactivity API Store for Kamil Pattern
 */
import { store } from "@wordpress/interactivity";

// Store definition for kamilPattern namespace
store("kamilPattern", {
	state: {
		// Globalny stan - działa na wszystkich instancjach patternu
		globalCounter: 0,
		isLoaded: false,
	},

	actions: {
		// Action wywoływana przez data-wp-on--click
		handleClick: () => {
			const context = store("kamilPattern").context;

			// Zwiększ lokalny counter
			context.counter = context.counter + 1;

			// Zwiększ globalny counter
			store("kamilPattern").state.globalCounter++;

			// Ustaw animację
			context.animating = true;

			// Ustaw tekst notyfikacji
			context.notificationText = `${context.message}\nKliknięto ${
				context.counter
			} razy lokalnie, ${
				store("kamilPattern").state.globalCounter
			} globalnie!`;

			// Pokaż notyfikację
			context.showNotification = true;

			// Schowaj animację po 150ms
			setTimeout(() => {
				context.animating = false;
			}, 150);

			// Schowaj notyfikację po 3 sekundach
			setTimeout(() => {
				context.showNotification = false;
			}, 3000);

			// Console log dla debugowania
			console.log("🚀 Kamil Interactive Pattern:", {
				localCounter: context.counter,
				globalCounter: store("kamilPattern").state.globalCounter,
			});
		},

		// Akcja wywoływana przy inicjalizacji
		init: () => {
			const context = store("kamilPattern").context;

			// Ustaw tytuł dynamicznie
			context.title = `Witaj Kamil! 👋 (Interactive API v${
				store("kamilPattern").state.globalCounter
			})`;

			// Oznacz jako załadowane
			store("kamilPattern").state.isLoaded = true;

			console.log("🎉 Kamil Pattern załadowany!", context);
		},
	},

	callbacks: {
		// Callback wywoływany gdy kontekst się inicjalizuje
		onInit: () => {
			console.log("📦 Kamil Pattern - kontekst inicjalizowany");
		},

		// Callback wywoływany gdy komponent jest w viewport
		onLoad: () => {
			const { actions } = store("kamilPattern");
			actions.init();
		},
	},
});

// Export store for manual usage if needed
export default store("kamilPattern");
