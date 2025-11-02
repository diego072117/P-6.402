document.addEventListener("DOMContentLoaded", function () {
  // --- Lógica para ABRIR/CERRAR el menú principal (HU-001) ---
  const menuToggle = document.getElementById("mobile-menu-toggle");
  const menuClose = document.getElementById("mobile-menu-close");
  const menu = document.getElementById("mobile-menu");

  if (menuToggle && menu) {
    menuToggle.addEventListener("click", function () {
      // Muestra el menú moviéndolo a su posición (de -100% a 0%)
      menu.classList.remove("-translate-x-full");
      menu.classList.add("translate-x-0");
      this.setAttribute("aria-expanded", "true");
    });
  }

  if (menuClose && menu) {
    menuClose.addEventListener("click", function () {
      // Oculta el menú moviéndolo fuera de la pantalla (de 0% a -100%)
      menu.classList.remove("translate-x-0");
      menu.classList.add("-translate-x-full");
      if (menuToggle) {
        menuToggle.setAttribute("aria-expanded", "false");
      }
    });
  }

  // --- LÓGICA para el ACORDEÓN de sub-menús (HU-001) ---
  // "Cuando el usuario le da clic a un enlace se despliegan las secciones"

  // Buscamos TODOS los botones de despliegue DENTRO del menú móvil
  const submenuToggles = document.querySelectorAll(
    "#mobile-menu .mobile-submenu-toggle"
  );

  submenuToggles.forEach((toggle) => {
    toggle.addEventListener("click", function (e) {
      e.preventDefault(); // Previene que la página salte

      // Encuentra el <li> padre y el <ul> sub-menu más cercanos
      const li = this.closest("li.menu-item-has-children");
      const submenu = li.querySelector("ul.sub-menu");

      if (submenu) {
        // Alternar estado ARIA para accesibilidad
        const isExpanded = this.getAttribute("aria-expanded") === "true";
        this.setAttribute("aria-expanded", !isExpanded);

        // Alternar ícono (gira la flecha)
        this.querySelector("svg").classList.toggle("rotate-180");

        // Alternar clases de Tailwind para la animación

        if (!isExpanded) {
          // ABRIR: Agregar altura, padding y mostrar
          submenu.classList.remove("max-h-0");
          submenu.classList.add("max-h-screen");
          submenu.classList.remove("py-0"); // ⭐ NUEVO
          submenu.classList.add("py-2"); // ⭐ NUEVO
          submenu.classList.remove("opacity-0"); // ⭐ NUEVO (opcional, para fade)
          submenu.classList.add("opacity-100"); // ⭐ NUEVO
        } else {
          // CERRAR: Remover altura, padding y ocultar
          submenu.classList.remove("max-h-screen");
          submenu.classList.add("max-h-0");
          submenu.classList.remove("py-2"); // ⭐ NUEVO
          submenu.classList.add("py-0"); // ⭐ NUEVO
          submenu.classList.remove("opacity-100"); // ⭐ NUEVO
          submenu.classList.add("opacity-0"); // ⭐ NUEVO
        }
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const sliderWrapper = document.getElementById("slider-wrapper");
  const sliderContainer = document.getElementById("slider-container");
  const dotsContainer = document.getElementById("slider-dots");
  const arrowLeft = document.getElementById("arrow-left");
  const arrowRight = document.getElementById("arrow-right");

  let originals = Array.from(sliderContainer.querySelectorAll(".slide"));
  const totalSlides = originals.length;

  // Desktop muestra 3, mobile 1
  const isMobile = () => window.innerWidth < 768;
  const visibleSlides = () => (isMobile() ? 1 : 3);

  // Clonar para infinito: necesitamos al menos `visibleSlides()` clones a cada lado
  const clonesToAdd = Math.max(3, totalSlides);

  // Clones al final
  for (let i = 0; i < clonesToAdd; i++) {
    const clone = originals[i % totalSlides].cloneNode(true);
    clone.id = `clone-end-${i}`;
    clone.classList.add("clone");
    sliderContainer.appendChild(clone);
  }

  // Clones al inicio
  for (let i = 0; i < clonesToAdd; i++) {
    const clone =
      originals[(totalSlides - 1 - i + totalSlides) % totalSlides].cloneNode(
        true
      );
    clone.id = `clone-start-${i}`;
    clone.classList.add("clone");
    sliderContainer.insertBefore(clone, sliderContainer.firstChild);
  }

  let slides = Array.from(sliderContainer.querySelectorAll(".slide, .clone"));
  let index = clonesToAdd; // Empezar en el primer slide real
  let transitioning = false;

  const getGap = () =>
    parseFloat(getComputedStyle(sliderContainer).columnGap || 0);

  const unitWidth = () => {
    const slideW = isMobile()
      ? sliderWrapper.clientWidth
      : originals[0].getBoundingClientRect().width;
    return slideW + getGap();
  };

  const moveToIndex = (animate = true) => {
    const w = unitWidth();
    sliderContainer.style.transition = animate
      ? "transform 0.45s ease-in-out"
      : "none";
    sliderContainer.style.transform = `translateX(-${w * index}px)`;

    // Actualiza dots (solo mobile)
    if (dotsContainer && isMobile()) {
      const realIndex =
        (((index - clonesToAdd) % totalSlides) + totalSlides) % totalSlides;
      dotsContainer.querySelectorAll("div").forEach((d, i) => {
        d.classList.toggle("bg-[#EAA40C]", i === realIndex);
        d.classList.toggle("bg-gray-300", i !== realIndex);
      });
    }
  };

  // Crear dots solo para mobile
  if (dotsContainer) {
    dotsContainer.innerHTML = "";
    for (let i = 0; i < totalSlides; i++) {
      const dot = document.createElement("div");
      dot.className =
        "w-3 h-3 rounded-full bg-gray-300 transition duration-300 cursor-pointer";
      dot.addEventListener("click", () => {
        if (transitioning) return;
        index = i + clonesToAdd;
        moveToIndex();
      });
      dotsContainer.appendChild(dot);
    }
  }

  // Funciones de navegación
  const next = () => {
    if (transitioning) return;
    transitioning = true;
    index++;
    moveToIndex();
  };

  const prev = () => {
    if (transitioning) return;
    transitioning = true;
    index--;
    moveToIndex();
  };

  arrowRight?.addEventListener("click", next);
  arrowLeft?.addEventListener("click", prev);

  // Swipe móvil
  let startX = 0;
  sliderContainer.addEventListener(
    "touchstart",
    (e) => {
      startX = e.touches[0].clientX;
    },
    { passive: true }
  );

  sliderContainer.addEventListener(
    "touchend",
    (e) => {
      const endX = e.changedTouches[0].clientX;
      const diff = startX - endX;

      if (Math.abs(diff) > 50) {
        if (diff > 0) next();
        else prev();
      }
    },
    { passive: true }
  );

  // Loop infinito: cuando llegue a un clon, saltar sin animación
  sliderContainer.addEventListener("transitionend", () => {
    const w = unitWidth();

    // Si estamos en los clones del final, volver al inicio real
    if (index >= clonesToAdd + totalSlides) {
      sliderContainer.style.transition = "none";
      index = clonesToAdd + (index - clonesToAdd - totalSlides);
      sliderContainer.style.transform = `translateX(-${w * index}px)`;
    }

    // Si estamos en los clones del inicio, volver al final real
    if (index < clonesToAdd) {
      sliderContainer.style.transition = "none";
      index = clonesToAdd + totalSlides + (index - clonesToAdd);
      sliderContainer.style.transform = `translateX(-${w * index}px)`;
    }

    requestAnimationFrame(() => {
      transitioning = false;
    });
  });

  // Reajuste al redimensionar
  let resizeTimeout;
  window.addEventListener("resize", () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      moveToIndex(false);
    }, 100);
  });

  // Inicializar
  moveToIndex(false);
});

// Carrusel de Historias (solo mobile)
document.addEventListener("DOMContentLoaded", () => {
  const historiasWrapper = document.getElementById("historias-slider-wrapper");
  const historiasContainer = document.getElementById(
    "historias-slider-container"
  );
  const historiasDots = document.getElementById("historias-slider-dots");

  if (!historiasWrapper || !historiasContainer) return;

  let originals = Array.from(
    historiasContainer.querySelectorAll(".historias-slide")
  );
  const totalSlides = originals.length;

  // Clonar para infinito
  const firstClone = originals[0].cloneNode(true);
  const lastClone = originals[originals.length - 1].cloneNode(true);
  firstClone.id = "historias-first-clone";
  lastClone.id = "historias-last-clone";
  historiasContainer.appendChild(firstClone);
  historiasContainer.insertBefore(lastClone, originals[0]);

  let slides = Array.from(
    historiasContainer.querySelectorAll(
      ".historias-slide, #historias-first-clone, #historias-last-clone"
    )
  );
  let index = 1;
  let transitioning = false;

  const unitWidth = () => historiasWrapper.clientWidth;

  const moveToIndex = (animate = true) => {
    const w = unitWidth();
    historiasContainer.style.transition = animate
      ? "transform 0.45s ease-in-out"
      : "none";
    historiasContainer.style.transform = `translateX(-${w * index}px)`;

    // Actualizar dots
    const real = (index - 1 + totalSlides) % totalSlides;
    historiasDots?.querySelectorAll("div").forEach((d, i) => {
      d.classList.toggle("bg-[#EAA40C]", i === real);
      d.classList.toggle("bg-gray-300", i !== real);
    });
  };

  // Crear dots
  if (historiasDots) {
    historiasDots.innerHTML = "";
    for (let i = 0; i < totalSlides; i++) {
      const dot = document.createElement("div");
      dot.className =
        "w-3 h-3 rounded-full bg-gray-300 transition duration-300 cursor-pointer";
      dot.addEventListener("click", () => {
        if (transitioning) return;
        index = i + 1;
        moveToIndex();
      });
      historiasDots.appendChild(dot);
    }
  }

  // Swipe
  let startX = 0;
  historiasContainer.addEventListener(
    "touchstart",
    (e) => (startX = e.touches[0].clientX),
    { passive: true }
  );
  historiasContainer.addEventListener(
    "touchend",
    (e) => {
      const endX = e.changedTouches[0].clientX;
      const diff = startX - endX;

      if (Math.abs(diff) > 50) {
        if (transitioning) return;
        transitioning = true;
        if (diff > 0) index++;
        else index--;
        moveToIndex();
      }
    },
    { passive: true }
  );

  // Loop infinito
  historiasContainer.addEventListener("transitionend", () => {
    const current = slides[index];
    const w = unitWidth();

    if (current?.id === "historias-first-clone") {
      historiasContainer.style.transition = "none";
      index = 1;
      historiasContainer.style.transform = `translateX(-${w * index}px)`;
    }
    if (current?.id === "historias-last-clone") {
      historiasContainer.style.transition = "none";
      index = totalSlides;
      historiasContainer.style.transform = `translateX(-${w * index}px)`;
    }

    requestAnimationFrame(() => (transitioning = false));
  });

  // Reajuste al redimensionar
  window.addEventListener("resize", () => moveToIndex(false));

  // Inicializar
  moveToIndex(false);
});
