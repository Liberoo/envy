const VARIATION_NAME = "wp-performance/related-post";

// Register block variation when editor is ready.
if (window._wpLoadBlockEditor) {
  window._wpLoadBlockEditor.then(() => {
    wp.blocks.registerBlockVariation("core/query", {
      name: VARIATION_NAME,
      title: "Random Related Posts",
      description:
        "Display 3 random related posts, excluding the current post.",
      icon: "randomize",
      scope: ["inserter"],
      isActive: ["namespace"],
      attributes: {
        namespace: VARIATION_NAME,
        query: {
          perPage: 3,
          pages: 0,
          offset: 0,
          postType: "post",
          order: "desc",
          orderBy: "rand",
          author: "",
          search: "",
          exclude: [],
          sticky: "",
          inherit: false,
        },
      },
      innerBlocks: [
        [
          "core/post-template",
          {},
          [["core/post-title", { isLink: true }], ["core/post-date"]],
        ],
        ["core/query-no-results"],
      ],
    });
  });
} else {
  // Fallback if _wpLoadBlockEditor is not available.
  wp.domReady(() => {
    wp.blocks.registerBlockVariation("core/query", {
      name: VARIATION_NAME,
      title: "Random Related Posts",
      description:
        "Display 3 random related posts, excluding the current post.",
      icon: "randomize",
      scope: ["inserter"],
      isActive: ["namespace"],
      attributes: {
        namespace: VARIATION_NAME,
        query: {
          perPage: 3,
          pages: 0,
          offset: 0,
          postType: "post",
          order: "desc",
          orderBy: "rand",
          author: "",
          search: "",
          exclude: [],
          sticky: "",
          inherit: false,
        },
      },
      innerBlocks: [
        [
          "core/post-template",
          {},
          [["core/post-title", { isLink: true }], ["core/post-date"]],
        ],
        ["core/query-no-results"],
      ],
    });
  });
}
