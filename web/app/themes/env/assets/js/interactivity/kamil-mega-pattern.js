/**
 * WordPress Interactivity API Store for Kamil MEGA Pattern
 * Pokazuje wszystkie możliwości: stan, akcje, warunki, pętle, eventy
 */
import { store } from "@wordpress/interactivity";

// Utility functions
const generateId = () => Date.now() + Math.random();

// Store definition for kamilMegaPattern namespace
store("kamilMegaPattern", {
	state: {
		// Globalny stan
		totalPatterns: 0,
		globalTheme: "light",
	},

	actions: {
		// Toggle theme
		toggleTheme: () => {
			const context = store("kamilMegaPattern").context;
			context.theme = context.theme === "light" ? "dark" : "light";

			// Update global theme too
			store("kamilMegaPattern").state.globalTheme = context.theme;

			// Apply theme to body (optional)
			document.body.classList.toggle(
				"dark-theme",
				context.theme === "dark"
			);

			console.log("🎨 Theme changed to:", context.theme);
		},

		// Increment counter and level up
		incrementCounter: () => {
			const context = store("kamilMegaPattern").context;

			if (context.counter < 10) {
				context.counter++;

				// Level up every 3 clicks
				if (context.counter % 3 === 0) {
					context.user.level++;
					console.log(
						`🎉 Level up! Jesteś teraz na poziomie ${context.user.level}`
					);
				}

				// Update title based on level
				context.title = `🚀 MEGA Interactive Pattern dla ${context.user.name} (Poziom ${context.user.level})`;
			}
		},

		// Toggle TODO form
		toggleTodoForm: () => {
			const context = store("kamilMegaPattern").context;
			context.showForm = !context.showForm;

			// Focus input when form opens
			if (context.showForm) {
				setTimeout(() => {
					const input = document.querySelector(
						'.kamil-mega-interactive input[type="text"]'
					);
					if (input) input.focus();
				}, 100);
			}
		},

		// Update new todo input
		updateNewTodo: (event) => {
			const context = store("kamilMegaPattern").context;
			context.newTodo = event.target.value;
		},

		// Handle keyboard input
		handleKeyUp: (event) => {
			if (event.key === "Enter") {
				const { actions } = store("kamilMegaPattern");
				actions.addTodo();
			}
		},

		// Add new todo
		addTodo: () => {
			const context = store("kamilMegaPattern").context;

			if (context.newTodo.trim().length >= 3) {
				const newTodo = {
					id: generateId(),
					text: context.newTodo.trim(),
					completed: false,
					createdAt: new Date().toLocaleString(),
				};

				// Add to todos array
				context.todos = [...context.todos, newTodo];

				// Clear input
				context.newTodo = "";

				console.log("✅ Dodano nowe zadanie:", newTodo);

				// Auto-close form if more than 3 todos
				if (context.todos.length > 3) {
					context.showForm = false;
				}
			}
		},

		// Toggle todo completion
		toggleTodo: (event) => {
			const context = store("kamilMegaPattern").context;
			const todoId = parseFloat(
				event.target.getAttribute("data-todo-id")
			);

			context.todos = context.todos.map((todo) =>
				todo.id === todoId
					? { ...todo, completed: !todo.completed }
					: todo
			);

			console.log("🔄 Zmieniono status zadania:", todoId);
		},

		// Remove todo
		removeTodo: (event) => {
			const context = store("kamilMegaPattern").context;
			const todoId = parseFloat(
				event.target.getAttribute("data-todo-id")
			);

			context.todos = context.todos.filter((todo) => todo.id !== todoId);

			console.log("🗑️ Usunięto zadanie:", todoId);
		},

		// Initialize pattern
		init: () => {
			const context = store("kamilMegaPattern").context;

			// Set initial title
			context.title = `🚀 MEGA Interactive Pattern dla ${context.user.name} (Poziom ${context.user.level})`;

			// Increment global pattern counter
			store("kamilMegaPattern").state.totalPatterns++;

			// Add some demo todos if none exist
			if (context.todos.length === 0) {
				context.todos = [
					{
						id: generateId(),
						text: "Przetestować Interactivity API",
						completed: false,
						createdAt: new Date().toLocaleString(),
					},
					{
						id: generateId(),
						text: "Stworzyć własny pattern",
						completed: false,
						createdAt: new Date().toLocaleString(),
					},
				];
			}

			console.log(
				"🎉 MEGA Pattern zainicjalizowany dla:",
				context.user.name
			);
		},
	},

	callbacks: {
		// Called when the component is initialized
		onInit: () => {
			console.log("📦 MEGA Pattern - kontekst inicjalizowany");
		},

		// Called when the component loads
		onLoad: () => {
			const { actions } = store("kamilMegaPattern");
			actions.init();
		},

		// Called when counter changes (derived state example)
		onCounterChange: () => {
			const context = store("kamilMegaPattern").context;

			// Special effects at certain milestones
			if (context.counter === 5) {
				console.log("🎊 Gratulacje! Osiągnąłeś 5 kliknięć!");
			}

			if (context.counter === 10) {
				console.log("🏆 MAKSYMALNY POZIOM OSIĄGNIĘTY!");
			}
		},
	},

	// Computed properties (getters)
	derived: {
		// Calculate completion percentage
		completionPercentage: () => {
			const context = store("kamilMegaPattern").context;
			if (context.todos.length === 0) return 0;

			const completed = context.todos.filter(
				(todo) => todo.completed
			).length;
			return Math.round((completed / context.todos.length) * 100);
		},

		// Get user status based on level
		userStatus: () => {
			const context = store("kamilMegaPattern").context;
			const level = context.user.level;

			if (level >= 5) return "Expert";
			if (level >= 3) return "Advanced";
			if (level >= 2) return "Intermediate";
			return "Beginner";
		},
	},
});

// Export store for manual usage
export default store("kamilMegaPattern");
