const body = document.querySelector("body");
const darkLight = document.querySelector("#darkLight");
const sidebar = document.querySelector(".sidebar");
const submenuItems = document.querySelectorAll(".submenu_item");
const sidebarOpen = document.querySelector("#sidebarOpen");
const sidebarClose = document.querySelector(".collapse_sidebar");
const sidebarExpand = document.querySelector(".expand_sidebar");

// Sidebar open toggle
sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

// Sidebar close (collapse)
sidebarClose?.addEventListener("click", () => {
  sidebar.classList.add("close", "hoverable");
});

// Sidebar expand
sidebarExpand?.addEventListener("click", () => {
  sidebar.classList.remove("close", "hoverable");
});

// Hover behavior for sidebar
sidebar.addEventListener("mouseenter", () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.remove("close");
  }
});
sidebar.addEventListener("mouseleave", () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.add("close");
  }
});

// Dark mode toggle with localStorage (optional)
if (localStorage.getItem("theme") === "dark") {
  body.classList.add("dark");
  darkLight.classList.replace("bx-sun", "bx-moon");
}

darkLight.addEventListener("click", () => {
  body.classList.toggle("dark");

  if (body.classList.contains("dark")) {
    darkLight.classList.replace("bx-sun", "bx-moon");
    localStorage.setItem("theme", "dark");
  } else {
    darkLight.classList.replace("bx-moon", "bx-sun");
    localStorage.setItem("theme", "light");
  }
});

// Submenu toggle
submenuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    item.classList.toggle("show_submenu");
    submenuItems.forEach((item2, index2) => {
      if (index !== index2) {
        item2.classList.remove("show_submenu");
      }
    });
  });
});

// Responsive sidebar state on load
if (window.innerWidth < 768) {
  sidebar.classList.add("close");
} else {
  sidebar.classList.remove("close");
}
