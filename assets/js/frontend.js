jQuery(document).ready(function ($) {
  // Initialize any interactive elements here

  // Make sure cards with links are clickable
  $(".multi-card-link").on("click", function (e) {
    // If the click was on the button, let it handle the click
    if (
      $(e.target).hasClass("multi-card-button") ||
      $(e.target).closest(".multi-card-button").length
    ) {
      e.stopPropagation();
    }
  });
});
