const navbar = document.getElementById("navbar");

// Store the original styles of the navbar
const originalNavbarStyles = {
    backgroundColor: "transparent",
    boxShadow: "none",
};

const navLinks = document.querySelectorAll(".nav-link");
const logo = document.querySelector(".navbar-brand");
const separator = document.querySelector(".separtor");
const postBtn = document.querySelector(
    ".navbar .navbar-nav a.nav-link.post-btn"
);
const postBtnspan = document.querySelector(
    ".navbar .navbar-nav a.nav-link.post-btn span"
);
const loginBtn = document.querySelector(
    ".navbar .navbar-nav a.nav-link.login-btn"
);
const jobsIcon = document.querySelector(
    ".navbar .navbar-nav a.nav-link.post-btn svg path"
);
const navTogglerlight = document.querySelector(
    ".navbar .navbar-toggler i .light"
);
const navTogglerdark = document.querySelector(
    ".navbar .navbar-toggler i .dark"
);
const registerBtn = document.querySelector(
    ".navbar .navbar-nav a.nav-link.register-btn"
);

// Function to update styles on scroll
function updateNavbarStyles() {
    const scrolled = window.scrollY;

    if (scrolled <= 200) {
        navbar.style.backgroundColor = originalNavbarStyles.backgroundColor;
        navbar.style.boxShadow = originalNavbarStyles.boxShadow;
        logo.style.color = "#fff";
        separator.style.backgroundColor = "#fff";
        jobsIcon.fill = "#fff"; // Reset icon color

        if (loginBtn) {
            // Hover effect
            loginBtn.style.borderColor = "#fff";

            loginBtn.addEventListener("mouseenter", () => {
                loginBtn.style.backgroundColor = "rgba(0, 0, 0, 0.4)";
            });

            loginBtn.addEventListener("mouseleave", () => {
                loginBtn.style.backgroundColor = ""; // Reset to original
            });

            // Focus effect
            loginBtn.addEventListener("focus", () => {
                loginBtn.style.borderColor = "#80b2ff";
            });

            loginBtn.addEventListener("blur", () => {
                loginBtn.style.borderColor = ""; // Reset to original
            });
        }

        if (postBtn && jobsIcon) {
            jobsIcon.setAttribute("fill", "#fff");
            postBtnspan.style.color = "#fff";
            postBtn.style.borderColor = "";

            postBtn.addEventListener("mouseenter", () => {
                postBtn.style.backgroundColor = "rgba(0, 0, 0, 0.4)";
                postBtn.style.color = "#fff";
                postBtnspan.style.color = "#fff";
            });
            postBtn.addEventListener("mouseleave", () => {
                postBtn.style.backgroundColor = "";
                Color = "";
                postBtnspan.style.color = "";
            });
        }
        //jos icon
        navLinks.forEach((link) => {
            link.style.color = "#fff";
        });
        if (navTogglerlight && navTogglerdark) {
            navTogglerlight.style.display = "block"; // ✅ Correct
            navTogglerdark.style.display = "none"; // ✅ Correct
        }
    } else {
        navbar.style.backgroundColor = "#fff";
        navbar.style.boxShadow =
            "0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19)";
        logo.style.color = "rgb(0,85,217)";
        separator.style.backgroundColor = "rgb(131,145,167)";
        // Change icon color when scrolled

        if (loginBtn) {
            // Hover effect
            loginBtn.style.borderColor = "rgb(131,145,167)";

            loginBtn.addEventListener("mouseenter", () => {
                loginBtn.style.backgroundColor = "rgb(230, 239, 255)";
            });

            loginBtn.addEventListener("mouseleave", () => {
                loginBtn.style.backgroundColor = ""; // Reset to original
            });

            // Focus effect
            loginBtn.addEventListener("focus", () => {
                loginBtn.style.borderColor = "rgb(128, 178, 255)";
            });

            loginBtn.addEventListener("blur", () => {
                loginBtn.style.borderColor = ""; // Reset to original
            });
        }

        // Add event listeners for hover effect on postBtn
        if (postBtn && jobsIcon) {
            jobsIcon.setAttribute("fill", "rgb(131,145,167)"); // Change color when scrolled
            postBtnspan.style.color = "rgb(131,145,167)";

            postBtn.style.borderColor = "";

            postBtn.addEventListener("mouseenter", () => {
                postBtn.style.backgroundColor = "rgb(235, 237, 240)";
                postBtn.style.color = "rgb(131,145,167)";
                postBtnspan.style.color = "rgb(131,145,167)";
            });
            postBtn.addEventListener("mouseleave", () => {
                postBtn.style.backgroundColor = "";
                postBtnspan.style.color = "rgb(131,145,167)";
            });
        }
        navLinks.forEach((link) => {
            link.style.color = "rgb(64, 86, 120)";
        });
        registerBtn.style.color = "#fff";
        if (navTogglerlight && navTogglerdark) {
            navTogglerlight.style.display = "none"; // ✅ Correct
            navTogglerdark.style.display = "block"; // ✅ Correct
        }
    }
}

// Add scroll event listener
window.addEventListener("scroll", updateNavbarStyles);

// Initial call to set correct styles
updateNavbarStyles();
