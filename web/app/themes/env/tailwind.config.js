// Load environment variables
import("./js-helpers/loadEnv.mjs").then(({ default: loadEnv }) => loadEnv());

const usePreflightFront = false;

module.exports = {
  // use preflight (reset CSS) override fonts size from theme.json
  corePlugins: {
    preflight: process.env.IS_EDITOR ? false : usePreflightFront,
  },
  content: [
    "./templates/**/*.html",
    "./parts/**/*.html",
    "./patterns/**/*.php",
  ],
  theme: {
    extend: {
      // Recurring fluid spacing (clamp) tokens → gap-fluid-*, p-fluid-*, py-fluid-* …
      // Named tokens generate reliably; an arbitrary clamp() in a class does not.
      spacing: {
        "fluid-xs": "clamp(20px, 4vw, 40px)",
        "fluid-sm": "clamp(40px, 6vw, 80px)",
        "fluid-md": "clamp(60px, 8vw, 90px)",
        "fluid-lg": "clamp(70px, 9vw, 110px)",
        "fluid-xl": "clamp(80px, 10vw, 120px)",
        "fluid-2xl": "clamp(90px, 11vw, 140px)",
      },
      fontFamily: {
        pressstart: ["'Press Start 2P'", "cursive"],
      },
    },
  },
  variants: {
    scrollbar: ["rounded"],
  },
  plugins: [
    require("@_tw/themejson")(require("./theme.json")),
    require("tailwind-scrollbar")({ nocompatible: true }),
  ],
  // Control Tailwind loading via WP_TAILWIND variable
  // WP_TAILWIND=full -> generate all classes (slow but complete)
  // Default -> generate only the safelisted classes below
  safelist:
    process.env.WP_TAILWIND === "full"
      ? [{ pattern: /.*/ }]
      : [
          "bg-yellow-400",
          "bg-red-500",
          "bg-blue-600",
          "text-center",
          "rounded-lg",
          "shadow-md",
          "p-4",
          "p-8",
          "m-4",
          "flex",
          "block",
        ],
};
