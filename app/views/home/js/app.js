function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const mainContent = document.getElementById("mainContent");
  const overlay = document.querySelector(".overlay");

  sidebar.classList.toggle("active");

  if (window.innerWidth > 768) {
    mainContent.classList.toggle("shifted");
  } else {
    if (sidebar.classList.contains("active")) {
      overlay.style.display = "block";
    } else {
      overlay.style.display = "none";
    }
  }
}

// Handle window resize
window.addEventListener("resize", function () {
  const sidebar = document.getElementById("sidebar");
  const mainContent = document.getElementById("mainContent");
  const overlay = document.querySelector(".overlay");

  if (window.innerWidth > 768) {
    overlay.style.display = "none";
    if (sidebar.classList.contains("active")) {
      mainContent.classList.add("shifted");
    }
  } else {
    mainContent.classList.remove("shifted");
    if (sidebar.classList.contains("active")) {
      overlay.style.display = "block";
    }
  }
});
