// Load environment variables
import("./js-helpers/loadEnv.mjs").then(({ default: loadEnv }) => loadEnv());

const usePreflightFront = false;

module.exports = {
  // use preflight (reset CSS) override fonts size from theme.json
  corePlugins: {
    preflight: process.env.IS_EDITOR ? false : usePreflightFront,
  },
  content: ["./footer-credit.php"],
  theme: {
    extend: {
      gridTemplateColumns: {
        main: "8rem 1fr 8rem",
        "main-small": "1rem 1fr 1rem",
      },
      backgroundImage: (theme) => ({
        "wp-performance": "url('/assets/media/wp-performance.png')",
        star: "url('/assets/media/star.svg')",
        zip: "url('/assets/media/zip.svg')",
        noise: "url('/assets/media/noise.png')",
        "link-gradient": "linear-gradient(to left,#BE185D,rgb(150,20,90));",
      }),
      colors: {
        body: "linear-gradient(217deg, rgba(255,0,0,.8), rgba(255,0,0,0) 70.71%), linear-gradient(127deg, rgba(0,255,0,.8), rgba(0,255,0,0) 70.71%),linear-gradient(336deg, rgba(0,0,255,.8), rgba(0,0,255,0) 70.71%);",
        primary: "var(--wp--preset--color--primary)",
        accent: "var(--wp--preset--color--accent)",
      },
      animation: {
        "text-gradient": "gradient-text 5s ease infinite",
      },
      keyframes: {
        "text-gradient": {
          "0%, 100%": {
            "background-size": "200% 200%",
            "background-position": "left center",
          },
          "50%": {
            "background-size": "200% 200%",
            "background-position": "right center",
          },
        },
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
  // Default -> add your custom patterns below
  safelist:
    process.env.WP_TAILWIND === "full"
      ? [{ pattern: /.*/ }]
      : [
          // Add your patterns here - they will be available in Gutenberg editor

          // Example: Background colors you use
          "bg-yellow-400",
          "bg-red-500",
          "bg-blue-600",

          // Example: Common utilities
          "text-center",
          "rounded-lg",
          "shadow-md",

          // Example: Layout classes
          "p-4",
          "p-8",
          "m-4",
          "flex",
          "block",

          // Example: Pattern for all red backgrounds
          // { pattern: /bg-red-\d+/ },

          // Example: Pattern for padding/margin
          // { pattern: /[pm]-\d+/ },
        ],
};
