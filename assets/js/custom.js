// menu mobil
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
          submenu.classList.remove("py-0");
          submenu.classList.add("py-2");
          submenu.classList.remove("opacity-0");
          submenu.classList.add("opacity-100");
        } else {
          // CERRAR: Remover altura, padding y ocultar
          submenu.classList.remove("max-h-screen");
          submenu.classList.add("max-h-0");
          submenu.classList.remove("py-2");
          submenu.classList.add("py-0");
          submenu.classList.remove("opacity-100");
          submenu.classList.add("opacity-0");
        }
      }
    });
  });
});

/* ============================================
   CARRUSEL: Slider de Noticias
   ============================================ */
document.addEventListener("DOMContentLoaded", () => {
  const sliderWrapper = document.getElementById("slider-wrapper-noticias");
  const sliderContainer = document.getElementById("slider-container-noticias");
  const dotsContainer = document.getElementById("slider-dots-noticias");
  const arrowLeft = document.getElementById("arrow-left-noticias");
  const arrowRight = document.getElementById("arrow-right-noticias");

  if (!sliderContainer || !sliderWrapper) return;

  let originals = Array.from(
    sliderContainer.querySelectorAll(".slide-noticia")
  );
  const totalSlides = originals.length;

  if (totalSlides === 0) return;

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

  let slides = Array.from(
    sliderContainer.querySelectorAll(".slide-noticia, .clone")
  );
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

  if (totalSlides === 0) return;

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

/* ============================================
   BANNER HERO ANIMADO
   ============================================ */
document.addEventListener("DOMContentLoaded", function () {
  const banners = document.querySelectorAll(".banner-hero-container");

  banners.forEach(function (banner) {
    const slides = banner.querySelectorAll(".banner-hero-slide");
    const dots = banner.querySelectorAll(".banner-hero-dot");
    const progressBar = banner.querySelector(".banner-hero-progress-bar");
    const totalSlides = slides.length;

    if (totalSlides === 0) {
      console.warn("Banner Hero: No hay slides");
      return;
    }

    let currentSlide = 0;
    let autoplayInterval;
    let progressInterval;
    let progress = 0;

    const intervalo = parseInt(banner.getAttribute("data-intervalo")) || 5000;

    function goToSlide(index) {
      // Remover clase active de todos
      slides.forEach(function (slide) {
        slide.classList.remove("active");
      });
      dots.forEach(function (dot) {
        dot.classList.remove("active");
      });

      // Agregar clase active al slide y dot actual
      slides[index].classList.add("active");
      dots[index].classList.add("active");

      currentSlide = index;

      // Resetear barra de progreso
      progress = 0;
      if (progressBar) {
        progressBar.style.height = "0%";
      }
    }

    function updateProgress() {
      const increment = 100 / (intervalo / 50);
      progress += increment;

      if (progress >= 100) {
        progress = 100;
      }

      if (progressBar) {
        progressBar.style.height = progress + "%";
      }
    }

    function nextSlide() {
      const next = (currentSlide + 1) % totalSlides;
      goToSlide(next);
    }

    function startAutoplay() {
      stopAutoplay();
      autoplayInterval = setInterval(nextSlide, intervalo);
      progressInterval = setInterval(updateProgress, 50);
    }

    function stopAutoplay() {
      if (autoplayInterval) {
        clearInterval(autoplayInterval);
      }
      if (progressInterval) {
        clearInterval(progressInterval);
      }
    }

    dots.forEach(function (dot, index) {
      dot.addEventListener("click", function () {
        goToSlide(index);
        startAutoplay();
      });
    });

    startAutoplay();

    document.addEventListener("visibilitychange", function () {
      if (document.hidden) {
        console.log("Pestaña oculta - pausando");
        stopAutoplay();
      } else {
        console.log("Pestaña visible - reanudando");
        startAutoplay();
      }
    });
  });
});

/* ============================================
   CARRUSEL POR QUÉ SE DEMANDA A URIBE (Mobile)
   ============================================ */
document.addEventListener("DOMContentLoaded", () => {
  const porQueUribeWrapper = document.getElementById(
    "por-que-uribe-slider-wrapper"
  );
  const porQueUribeContainer = document.getElementById(
    "por-que-uribe-slider-container"
  );
  const porQueUribeDots = document.getElementById("por-que-uribe-slider-dots");

  if (!porQueUribeWrapper || !porQueUribeContainer) return;

  let originals = Array.from(
    porQueUribeContainer.querySelectorAll(".por-que-uribe-slide")
  );
  const totalSlides = originals.length;

  if (totalSlides === 0) return;

  // Clonar para infinito
  const firstClone = originals[0].cloneNode(true);
  const lastClone = originals[originals.length - 1].cloneNode(true);
  firstClone.id = "por-que-uribe-first-clone";
  lastClone.id = "por-que-uribe-last-clone";
  porQueUribeContainer.appendChild(firstClone);
  porQueUribeContainer.insertBefore(lastClone, originals[0]);

  let slides = Array.from(
    porQueUribeContainer.querySelectorAll(
      ".por-que-uribe-slide, #por-que-uribe-first-clone, #por-que-uribe-last-clone"
    )
  );
  let index = 1;
  let transitioning = false;

  const unitWidth = () => porQueUribeWrapper.clientWidth;

  const moveToIndex = (animate = true) => {
    const w = unitWidth();
    porQueUribeContainer.style.transition = animate
      ? "transform 0.45s ease-in-out"
      : "none";
    porQueUribeContainer.style.transform = `translateX(-${w * index}px)`;

    // Actualizar dots
    const real = (index - 1 + totalSlides) % totalSlides;
    porQueUribeDots?.querySelectorAll("div").forEach((d, i) => {
      d.classList.toggle("bg-[#EAA40C]", i === real);
      d.classList.toggle("bg-gray-300", i !== real);
    });
  };

  // Crear dots
  if (porQueUribeDots) {
    porQueUribeDots.innerHTML = "";
    for (let i = 0; i < totalSlides; i++) {
      const dot = document.createElement("div");
      dot.className =
        "w-3 h-3 rounded-full bg-gray-300 transition duration-300 cursor-pointer";
      dot.addEventListener("click", () => {
        if (transitioning) return;
        index = i + 1;
        moveToIndex();
      });
      porQueUribeDots.appendChild(dot);
    }
  }

  // Swipe
  let startX = 0;
  porQueUribeContainer.addEventListener(
    "touchstart",
    (e) => (startX = e.touches[0].clientX),
    { passive: true }
  );
  porQueUribeContainer.addEventListener(
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
  porQueUribeContainer.addEventListener("transitionend", () => {
    const current = slides[index];
    const w = unitWidth();

    if (current?.id === "por-que-uribe-first-clone") {
      porQueUribeContainer.style.transition = "none";
      index = 1;
      porQueUribeContainer.style.transform = `translateX(-${w * index}px)`;
    }
    if (current?.id === "por-que-uribe-last-clone") {
      porQueUribeContainer.style.transition = "none";
      index = totalSlides;
      porQueUribeContainer.style.transform = `translateX(-${w * index}px)`;
    }

    requestAnimationFrame(() => (transitioning = false));
  });

  // Reajuste al redimensionar
  window.addEventListener("resize", () => moveToIndex(false));

  // Inicializar
  moveToIndex(false);
});

/* ============================================
   CARRUSEL VÍCTIMAS QUE DEMANDAN (Mobile)
   ============================================ */
document.addEventListener("DOMContentLoaded", () => {
  const victimasWrapper = document.getElementById("victimas-slider-wrapper");
  const victimasContainer = document.getElementById(
    "victimas-slider-container"
  );
  const victimasDots = document.getElementById("victimas-slider-dots");

  if (!victimasWrapper || !victimasContainer) return;

  let originals = Array.from(
    victimasContainer.querySelectorAll(".victimas-slide")
  );
  const totalSlides = originals.length;

  if (totalSlides === 0) return;

  // Clonar para infinito
  const firstClone = originals[0].cloneNode(true);
  const lastClone = originals[originals.length - 1].cloneNode(true);
  firstClone.id = "victimas-first-clone";
  lastClone.id = "victimas-last-clone";
  victimasContainer.appendChild(firstClone);
  victimasContainer.insertBefore(lastClone, originals[0]);

  let slides = Array.from(
    victimasContainer.querySelectorAll(
      ".victimas-slide, #victimas-first-clone, #victimas-last-clone"
    )
  );
  let index = 1;
  let transitioning = false;

  const unitWidth = () => victimasWrapper.clientWidth;

  const moveToIndex = (animate = true) => {
    const w = unitWidth();
    victimasContainer.style.transition = animate
      ? "transform 0.45s ease-in-out"
      : "none";
    victimasContainer.style.transform = `translateX(-${w * index}px)`;

    // Actualizar dots
    const real = (index - 1 + totalSlides) % totalSlides;
    victimasDots?.querySelectorAll("div").forEach((d, i) => {
      d.classList.toggle("bg-[#EAA40C]", i === real);
      d.classList.toggle("bg-gray-300", i !== real);
    });
  };

  // Crear dots
  if (victimasDots) {
    victimasDots.innerHTML = "";
    for (let i = 0; i < totalSlides; i++) {
      const dot = document.createElement("div");
      dot.className =
        "w-3 h-3 rounded-full bg-gray-300 transition duration-300 cursor-pointer";
      dot.addEventListener("click", () => {
        if (transitioning) return;
        index = i + 1;
        moveToIndex();
      });
      victimasDots.appendChild(dot);
    }
  }

  // Swipe
  let startX = 0;
  victimasContainer.addEventListener(
    "touchstart",
    (e) => (startX = e.touches[0].clientX),
    { passive: true }
  );
  victimasContainer.addEventListener(
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
  victimasContainer.addEventListener("transitionend", () => {
    const current = slides[index];
    const w = unitWidth();

    if (current?.id === "victimas-first-clone") {
      victimasContainer.style.transition = "none";
      index = 1;
      victimasContainer.style.transform = `translateX(-${w * index}px)`;
    }
    if (current?.id === "victimas-last-clone") {
      victimasContainer.style.transition = "none";
      index = totalSlides;
      victimasContainer.style.transform = `translateX(-${w * index}px)`;
    }

    requestAnimationFrame(() => (transitioning = false));
  });

  // Reajuste al redimensionar
  window.addEventListener("resize", () => moveToIndex(false));

  // Inicializar
  moveToIndex(false);
});

/* ============================================
   AJAX: Cargar Más Noticias
   ============================================ */
document.addEventListener("DOMContentLoaded", function () {
  const btnCargarMas = document.getElementById("cargar-mas-noticias");

  if (!btnCargarMas) return;

  const gridDesktop = document.getElementById("noticias-grid-desktop");
  const gridMobile = document.getElementById("noticias-grid-mobile");
  const btnText = btnCargarMas.querySelector(".btn-text");
  const btnLoading = btnCargarMas.querySelector(".btn-loading");

  btnCargarMas.addEventListener("click", function () {
    const offset = parseInt(this.getAttribute("data-offset"));
    const porCarga = parseInt(this.getAttribute("data-por-carga"));
    const total = parseInt(this.getAttribute("data-total"));
    const contador = parseInt(this.getAttribute("data-contador"));

    // Deshabilitar botón durante la carga
    btnCargarMas.disabled = true;
    btnText.classList.add("hidden");
    btnLoading.classList.remove("hidden");

    // Hacer petición AJAX
    fetch(noticiasAjax.ajax_url, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        action: "cargar_mas_noticias",
        nonce: noticiasAjax.nonce,
        offset: offset,
        por_carga: porCarga,
        contador: contador,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Añadir nuevas noticias al DOM
          if (gridDesktop && data.data.html_desktop) {
            gridDesktop.insertAdjacentHTML("beforeend", data.data.html_desktop);
          }
          if (gridMobile && data.data.html_mobile) {
            gridMobile.insertAdjacentHTML("beforeend", data.data.html_mobile);
          }

          // Actualizar atributos del botón
          btnCargarMas.setAttribute("data-offset", data.data.nuevo_offset);
          btnCargarMas.setAttribute("data-contador", data.data.nuevo_contador);

          // Verificar si hay más noticias
          if (data.data.nuevo_offset >= total || !data.data.tiene_mas) {
            btnText.textContent = "No hay más noticias";
            btnCargarMas.disabled = true;
          } else {
            btnCargarMas.disabled = false;
          }

          // Restaurar texto del botón
          btnText.classList.remove("hidden");
          btnLoading.classList.add("hidden");
        } else {
          console.error("Error al cargar noticias");
          btnCargarMas.disabled = false;
          btnText.classList.remove("hidden");
          btnLoading.classList.add("hidden");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        btnCargarMas.disabled = false;
        btnText.classList.remove("hidden");
        btnLoading.classList.add("hidden");
      });
  });
});

/* ============================================
   AJAX: Cargar Más Actividades
   ============================================ */
document.addEventListener("DOMContentLoaded", function () {
  const btnCargarMas = document.getElementById("cargar-mas-actividades");

  if (!btnCargarMas) return;

  const gridDesktop = document.getElementById("actividades-grid-desktop");
  const gridMobile = document.getElementById("actividades-grid-mobile");
  const btnText = btnCargarMas.querySelector(".btn-text");
  const btnLoading = btnCargarMas.querySelector(".btn-loading");

  btnCargarMas.addEventListener("click", function () {
    const offset = parseInt(this.getAttribute("data-offset"));
    const porCarga = parseInt(this.getAttribute("data-por-carga"));
    const total = parseInt(this.getAttribute("data-total"));
    const contador = parseInt(this.getAttribute("data-contador"));

    // Deshabilitar botón durante la carga
    btnCargarMas.disabled = true;
    btnText.classList.add("hidden");
    btnLoading.classList.remove("hidden");

    // Hacer petición AJAX
    fetch(actividadesAjax.ajax_url, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        action: "cargar_mas_actividades",
        nonce: actividadesAjax.nonce,
        offset: offset,
        por_carga: porCarga,
        contador: contador,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Añadir nuevas actividades al DOM
          if (gridDesktop && data.data.html_desktop) {
            gridDesktop.insertAdjacentHTML("beforeend", data.data.html_desktop);
          }
          if (gridMobile && data.data.html_mobile) {
            gridMobile.insertAdjacentHTML("beforeend", data.data.html_mobile);
          }

          // Actualizar atributos del botón
          btnCargarMas.setAttribute("data-offset", data.data.nuevo_offset);
          btnCargarMas.setAttribute("data-contador", data.data.nuevo_contador);

          // Verificar si hay más actividades
          if (data.data.nuevo_offset >= total || !data.data.tiene_mas) {
            btnText.textContent = "No hay más actividades";
            btnCargarMas.disabled = true;
          } else {
            btnCargarMas.disabled = false;
          }

          // Restaurar texto del botón
          btnText.classList.remove("hidden");
          btnLoading.classList.add("hidden");
        } else {
          console.error("Error al cargar actividades");
          btnCargarMas.disabled = false;
          btnText.classList.remove("hidden");
          btnLoading.classList.add("hidden");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        btnCargarMas.disabled = false;
        btnText.classList.remove("hidden");
        btnLoading.classList.add("hidden");
      });
  });
});

/* ============================================
   Modal de Galería - Actividades
   ============================================ */
document.addEventListener("DOMContentLoaded", function () {
  let galleryImages = [];
  let currentImageIndex = 0;

  // Inicializar galería cuando existan imágenes
  if (typeof window.galleryImagesData !== "undefined") {
    galleryImages = window.galleryImagesData;
  }

  window.openGalleryModal = function (index) {
    currentImageIndex = index;
    updateModalImage();
    document.getElementById("gallery-modal").classList.remove("hidden");
    document.body.style.overflow = "hidden";
  };

  window.closeGalleryModal = function (event) {
    if (event) event.stopPropagation();
    document.getElementById("gallery-modal").classList.add("hidden");
    document.body.style.overflow = "";
  };

  function updateModalImage() {
    const modalImage = document.getElementById("modal-image");
    const currentNumber = document.getElementById("current-image-number");

    if (modalImage && currentNumber && galleryImages.length > 0) {
      modalImage.src = galleryImages[currentImageIndex];
      currentNumber.textContent = currentImageIndex + 1;
    }
  }

  window.nextImage = function (event) {
    if (event) event.stopPropagation();
    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
    updateModalImage();
  };

  window.prevImage = function (event) {
    if (event) event.stopPropagation();
    currentImageIndex =
      (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
    updateModalImage();
  };

  // Navegación con teclado
  document.addEventListener("keydown", function (e) {
    const modal = document.getElementById("gallery-modal");
    if (modal && !modal.classList.contains("hidden")) {
      if (e.key === "Escape") window.closeGalleryModal();
      if (e.key === "ArrowRight") window.nextImage();
      if (e.key === "ArrowLeft") window.prevImage();
    }
  });
});

/* ========================================
   TOAST NOTIFICATIONS - FORMULARIO CONTACTO
   ======================================== */

// Auto-cerrar toast después de 3 segundos
document.addEventListener("DOMContentLoaded", function () {
  const toast = document.getElementById("toast-notification");
  if (toast) {
    setTimeout(function () {
      cerrarToast();
    }, 3000);
  }
});

function cerrarToast() {
  const toast = document.getElementById("toast-notification");
  if (toast) {
    const alert = toast.querySelector('[role="alert"]');
    if (alert) {
      alert.classList.remove("animate-slide-down");
      alert.classList.add("animate-slide-up");
    }

    setTimeout(function () {
      // Limpiar URL sin recargar la página
      const url = new URL(window.location);
      url.searchParams.delete("contacto");
      window.history.replaceState({}, "", url);
      toast.remove();
    }, 500);
  }
}

/* ========================================
   ANIMACIÓN BARRA DE PROGRESO - CONTADOR FIRMAS
   ======================================== */

document.addEventListener("DOMContentLoaded", function () {
  // Buscar todos los contenedores de barra de progreso
  const progressContainers = document.querySelectorAll(".progress-container");

  if (progressContainers.length === 0) return;

  // Crear Intersection Observer para detectar cuando el elemento es visible
  const observerOptions = {
    root: null,
    rootMargin: "0px",
    threshold: 0.3, // Se activa cuando el 30% del elemento es visible
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      // Si el elemento es visible y no ha sido animado aún
      if (
        entry.isIntersecting &&
        !entry.target.classList.contains("progress-animated")
      ) {
        const progressContainer = entry.target;
        const targetPercentage =
          progressContainer.getAttribute("data-percentage");

        // Marcar como animado para no repetir
        progressContainer.classList.add("progress-animated");

        // Esperar un pequeño delay para que se vea la animación
        setTimeout(function () {
          // Agregar clase para iniciar animación
          progressContainer.classList.add("progress-loaded");

          // Aplicar el porcentaje objetivo
          progressContainer.style.setProperty(
            "--progress-width",
            targetPercentage + "%"
          );
        }, 300); // Delay de 300ms antes de iniciar la animación

        // Animar los números del contador
        animateCounterNumbers();

        // Dejar de observar este elemento
        observer.unobserve(progressContainer);
      }
    });
  }, observerOptions);

  // Observar todos los contenedores de progreso
  progressContainers.forEach(function (container) {
    observer.observe(container);
  });
});

// Función para animar los números del contador
function animateCounterNumbers() {
  const counterElements = document.querySelectorAll(".animate-counter");

  counterElements.forEach(function (element) {
    // Solo animar si no ha sido animado antes
    if (element.classList.contains("counter-animated")) return;

    element.classList.add("counter-animated");

    const target = parseInt(element.getAttribute("data-target"));
    const duration = 2000; // 2 segundos
    const increment = target / (duration / 16); // 60fps
    let current = 0;

    const updateCounter = function () {
      current += increment;
      if (current < target) {
        element.textContent = Math.floor(current).toLocaleString("es-CO");
        requestAnimationFrame(updateCounter);
      } else {
        element.textContent = target.toLocaleString("es-CO");
      }
    };

    updateCounter();
  });
}
/* ========================================
   Script de animación para Banner Principal
   ======================================== */
document.addEventListener("DOMContentLoaded", function () {
  const container = document.querySelector(".banner-principal-container");
  if (!container) return;

  const mostrarFondo = container.dataset.mostrarFondo === "1";
  if (!mostrarFondo) return;

  const slides = container.querySelectorAll(".banner-principal-slide");
  const progressBar = container.querySelector(".banner-principal-progress-bar");
  const intervalo = parseInt(container.dataset.intervalo) || 5000;

  if (slides.length <= 1) return;

  let currentIndex = 0;
  let progressInterval;

  function cambiarSlide(siguiente) {
    // Ocultar slide actual
    slides[currentIndex].classList.remove("active");
    slides[currentIndex].style.opacity = "0";

    // Calcular siguiente índice
    currentIndex =
      siguiente !== undefined ? siguiente : (currentIndex + 1) % slides.length;

    // Mostrar nuevo slide
    slides[currentIndex].classList.add("active");
    slides[currentIndex].style.opacity = "1";

    // Reiniciar barra de progreso
    if (progressBar) {
      progressBar.style.transition = "none";
      progressBar.style.height = "0%";
      setTimeout(() => {
        progressBar.style.transition = `height ${intervalo}ms linear`;
        progressBar.style.height = "100%";
      }, 50);
    }
  }

  // Iniciar barra de progreso
  if (progressBar) {
    setTimeout(() => {
      progressBar.style.transition = `height ${intervalo}ms linear`;
      progressBar.style.height = "100%";
    }, 50);
  }

  // Rotación automática
  progressInterval = setInterval(() => {
    cambiarSlide();
  }, intervalo);

  // Pausar en hover (opcional)
  container.addEventListener("mouseenter", () => {
    clearInterval(progressInterval);
    if (progressBar) {
      progressBar.style.animationPlayState = "paused";
    }
  });

  container.addEventListener("mouseleave", () => {
    progressInterval = setInterval(() => {
      cambiarSlide();
    }, intervalo);
    if (progressBar) {
      progressBar.style.animationPlayState = "running";
    }
  });
});
