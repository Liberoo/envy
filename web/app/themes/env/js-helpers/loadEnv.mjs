import { config } from "dotenv";
import { resolve, dirname } from "path";
import { fileURLToPath } from "url";

// Get current directory
const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

// Load .env from bedrock root (4 levels up from theme)
config({ path: resolve(__dirname, "../../../../../.env") });

export default function loadEnv() {
	// Set default IS_EDITOR if not defined (used by postcss and tailwind)
	if (!process.env.IS_EDITOR) {
		process.env.IS_EDITOR = "false";
	}

	// This function can be called to ensure env is loaded
	return process.env;
}
