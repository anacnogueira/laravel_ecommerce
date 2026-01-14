export function menumaker(menuDropdown, options = {}) {
    const settings = {
        format: "dropdown",
        sticky: false,
        ...options,
    };

    // Botão principal do menu
    const buttons = menuDropdown.querySelectorAll(".button");
    buttons.forEach(function (button) {
        button.addEventListener("click", function () {
            button.classList.toggle("menu-opened");
            const mainmenu = button.nextElementSibling;
            if (!mainmenu) return;

            if (mainmenu.classList.contains("open")) {
                mainmenu.classList.remove("open");
                slideToggle(mainmenu, false);
            } else {
                mainmenu.classList.add("open");
                slideToggle(mainmenu, true);
                if (settings.format === "dropdown") {
                    mainmenu
                        .querySelectorAll("ul")
                        .forEach((ul) => (ul.style.display = "block"));
                }
            }
        });
    });

    // Adiciona classe has-sub
    menuDropdown.querySelectorAll("li ul").forEach(function (ul) {
        const parentLi = ul.parentElement;
        if (parentLi) parentLi.classList.add("has-sub");
    });

    function multiTg() {
        menuDropdown.querySelectorAll(".has-sub").forEach(function (li) {
            const submenuBtn = document.createElement("span");
            submenuBtn.className = "submenu-button";
            li.insertBefore(submenuBtn, li.firstChild);

            submenuBtn.addEventListener("click", function () {
                submenuBtn.classList.toggle("submenu-opened");
                const subUl = li.querySelector("ul");

                if (!subUl || subUl.tagName.toLowerCase() !== "ul") return;

                if (subUl.classList.contains("open")) {
                    subUl.classList.remove("open");
                    slideToggle(subUl, false);
                } else {
                    subUl.classList.add("open");
                    slideToggle(subUl, true);
                }
            });
        });
    }

    if (settings.format === "multitoggle") {
        multiTg();
    } else {
        menuDropdown.classList.add("dropdown");
    }

    if (settings.sticky === true) {
        menuDropdown.style.position = "relative";
    }

    function resizeFix() {
        const mediasize = 960;
        if (window.innerWidth > mediasize) {
            menuDropdown.querySelectorAll("ul").forEach((ul) => {
                ul.style.display = "block";
            });
        } else {
            menuDropdown.querySelectorAll("ul").forEach((ul) => {
                ul.style.display = "none";
                ul.classList.remove("open");
            });
        }
    }

    resizeFix();
    window.addEventListener("resize", resizeFix);
}

// Função para simular o slideToggle (simplificado)
function slideToggle(element, show) {
    element.style.transition = "max-height 0.3s ease";
    if (show) {
        element.style.display = "block";
        element.style.maxHeight = element.scrollHeight + "px";
    } else {
        element.style.maxHeight = "0px";
        setTimeout(() => {
            element.style.display = "none";
        }, 300);
    }
}
