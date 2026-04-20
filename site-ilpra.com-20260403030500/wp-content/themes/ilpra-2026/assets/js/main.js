document.documentElement.classList.add('ilpra-2026-ready');

const navToggle = document.querySelector('.site-header__toggle');
const navPanel = document.querySelector('.site-nav');
const searchPanel = document.querySelector('.site-search-panel');
const searchInput = document.querySelector('.site-search-form__input');
const searchTriggers = document.querySelectorAll('.site-nav__item--search > .site-nav__link');
const siteHeader = document.querySelector('.site-header');

const syncHeaderMeasurements = () => {
  if (!siteHeader) {
    return;
  }

  document.documentElement.style.setProperty('--ilpra-header-offset', `${siteHeader.offsetHeight}px`);
};

const syncHeaderScrollState = () => {
  document.body.classList.toggle('is-header-at-top', window.scrollY <= 6);
};

syncHeaderMeasurements();
syncHeaderScrollState();
window.addEventListener('resize', () => {
  syncHeaderMeasurements();
  syncHeaderScrollState();
});
window.addEventListener('scroll', syncHeaderScrollState, { passive: true });

if (navToggle && navPanel) {
  const closeNavPanel = () => {
    navPanel.classList.remove('is-open');
    navToggle.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('is-nav-open');
  };

  navToggle.addEventListener('click', () => {
    const isOpen = navPanel.classList.toggle('is-open');
    navToggle.setAttribute('aria-expanded', String(isOpen));
    document.body.classList.toggle('is-nav-open', isOpen);
  });

  window.addEventListener('resize', () => {
    if (!window.matchMedia('(max-width: 991px)').matches) {
      closeNavPanel();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape' || !navPanel.classList.contains('is-open')) {
      return;
    }

    closeNavPanel();
  });

  document.addEventListener('click', (event) => {
    if (
      !navPanel.classList.contains('is-open') ||
      navPanel.contains(event.target) ||
      navToggle.contains(event.target)
    ) {
      return;
    }

    closeNavPanel();
  });
}

document.querySelectorAll('.site-nav__submenu-toggle').forEach((toggle) => {
  toggle.addEventListener('click', () => {
    const item = toggle.closest('.site-nav__item--has-children');

    if (!item) {
      return;
    }

    const isOpen = item.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', String(isOpen));
  });
});

document.querySelectorAll('.site-footer__widget-group').forEach((group) => {
  const toggle = group.querySelector('.site-footer__accordion-toggle');
  const panel = group.querySelector('.site-footer__accordion-panel');

  if (!toggle || !panel) {
    return;
  }

  const isMobileFooter = () => window.matchMedia('(max-width: 991px)').matches;

  const syncFooterPanel = (shouldOpen) => {
    group.classList.toggle('is-open', shouldOpen);
    toggle.setAttribute('aria-expanded', String(shouldOpen));
    panel.style.maxHeight = shouldOpen && isMobileFooter() ? `${panel.scrollHeight}px` : '';
  };

  syncFooterPanel(false);

  toggle.addEventListener('click', () => {
    if (!isMobileFooter()) {
      return;
    }

    const shouldOpen = !group.classList.contains('is-open');
    syncFooterPanel(shouldOpen);
  });

  window.addEventListener('resize', () => {
    if (!isMobileFooter()) {
      group.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
      panel.style.maxHeight = '';
      return;
    }

    if (group.classList.contains('is-open')) {
      panel.style.maxHeight = `${panel.scrollHeight}px`;
    } else {
      panel.style.maxHeight = '0px';
    }
  });
});

if (searchPanel && searchTriggers.length) {
  let searchHideTimeout = null;

  const closeSearchPanel = () => {
    searchPanel.classList.remove('is-open');
    document.body.classList.remove('is-search-open');
    window.clearTimeout(searchHideTimeout);
    searchHideTimeout = window.setTimeout(() => {
      searchPanel.hidden = true;
    }, 220);
  };

  const openSearchPanel = () => {
    window.clearTimeout(searchHideTimeout);
    searchPanel.hidden = false;
    document.body.classList.add('is-search-open');

    window.requestAnimationFrame(() => {
      searchPanel.classList.add('is-open');
      if (searchInput) {
        searchInput.focus({ preventScroll: true });
      }
    });
  };

  searchTriggers.forEach((trigger) => {
    trigger.addEventListener('click', (event) => {
      event.preventDefault();

      if (navPanel && navPanel.classList.contains('is-open')) {
        navPanel.classList.remove('is-open');
        navToggle?.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('is-nav-open');
      }

      if (searchPanel.classList.contains('is-open')) {
        closeSearchPanel();
        return;
      }

      openSearchPanel();
    });
  });

  document.addEventListener('click', (event) => {
    const clickedSearchTrigger = event.target.closest('.site-nav__item--search > .site-nav__link');

    if (
      !searchPanel.classList.contains('is-open') ||
      searchPanel.contains(event.target) ||
      clickedSearchTrigger
    ) {
      return;
    }

    closeSearchPanel();
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && searchPanel.classList.contains('is-open')) {
      closeSearchPanel();
    }
  });
}

const pillsTrack = document.querySelector('[data-tm-pills-track]');
const pillsPrev = document.querySelector('.tm-arrow-prev');
const pillsNext = document.querySelector('.tm-arrow-next');

if (pillsTrack && pillsPrev && pillsNext) {
  const scrollAmount = () => {
    const firstPill = pillsTrack.querySelector('.tm-pill');
    const gap = Number.parseFloat(window.getComputedStyle(pillsTrack).gap || '0');

    if (firstPill) {
      return firstPill.getBoundingClientRect().width + gap;
    }

    return pillsTrack.clientWidth;
  };

  pillsPrev.addEventListener('click', () => {
    pillsTrack.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
  });

  pillsNext.addEventListener('click', () => {
    pillsTrack.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
  });

  const activePill = pillsTrack.querySelector('.tm-pill.active');

  if (activePill) {
    activePill.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
  }
}

const byIndustryTrack = document.querySelector('[data-bi-track]');
const byIndustryPrev = document.querySelector('[data-bi-prev]');
const byIndustryNext = document.querySelector('[data-bi-next]');

if (byIndustryTrack && byIndustryPrev && byIndustryNext) {
  const getIndustryStep = () => {
    const firstPill = byIndustryTrack.querySelector('.bi-pill');
    const gap = Number.parseFloat(window.getComputedStyle(byIndustryTrack).gap || '0');

    if (!firstPill) {
      return byIndustryTrack.clientWidth;
    }

    return firstPill.getBoundingClientRect().width + gap;
  };

  byIndustryPrev.addEventListener('click', () => {
    byIndustryTrack.scrollBy({ left: -getIndustryStep(), behavior: 'smooth' });
  });

  byIndustryNext.addEventListener('click', () => {
    byIndustryTrack.scrollBy({ left: getIndustryStep(), behavior: 'smooth' });
  });

  const activeIndustryPill = byIndustryTrack.querySelector('.bi-pill.is-active');

  if (activeIndustryPill) {
    activeIndustryPill.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
  }
}

const techButtons = document.querySelectorAll('.tm-tech-button');
const productCards = document.querySelectorAll('.tm-product-card');
const taxonomyTitleText = document.querySelector('.tm-title-text');
const infoTrigger = document.querySelector('.tm-info-trigger');

if (techButtons.length && productCards.length) {
  const parentName = taxonomyTitleText ? (taxonomyTitleText.textContent.split(' - ')[1] || '').trim() : '';

  const filterCards = (technologyId) => {
    productCards.forEach((card) => {
      card.hidden = card.dataset.tech !== technologyId;
    });
  };

  const syncHeader = (button) => {
    if (!button || !taxonomyTitleText) {
      return;
    }

    const nextTitle = parentName ? `${button.dataset.name} - ${parentName}` : button.dataset.name;
    taxonomyTitleText.textContent = nextTitle;

    if (infoTrigger) {
      infoTrigger.dataset.title = nextTitle;
      infoTrigger.dataset.description = button.dataset.description || '';
    }
  };

  const activeButton = document.querySelector('.tm-tech-button.active');

  if (activeButton) {
    filterCards(activeButton.dataset.tech);
    syncHeader(activeButton);
  }

  techButtons.forEach((button) => {
    button.addEventListener('click', () => {
      techButtons.forEach((item) => item.classList.remove('active'));
      button.classList.add('active');
      filterCards(button.dataset.tech);
      syncHeader(button);
    });
  });
}

const taxonomyModal = document.querySelector('[data-tm-modal]');

if (taxonomyModal) {
  const modalTitle = taxonomyModal.querySelector('[data-tm-modal-title]');
  const modalDescription = taxonomyModal.querySelector('[data-tm-modal-description]');

  const closeModal = () => {
    taxonomyModal.hidden = true;
    document.body.classList.remove('is-modal-open');
  };

  document.addEventListener('click', (event) => {
    const trigger = event.target.closest('.tm-info-trigger');

    if (trigger) {
      if (modalTitle) {
        modalTitle.textContent = trigger.dataset.title || '';
      }

      if (modalDescription) {
        modalDescription.textContent = trigger.dataset.description || '';
      }

      taxonomyModal.hidden = false;
      document.body.classList.add('is-modal-open');
      return;
    }

    if (event.target.closest('[data-tm-modal-close]')) {
      closeModal();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && !taxonomyModal.hidden) {
      closeModal();
    }
  });
}

document.querySelectorAll('.pm-accordion').forEach((accordion) => {
  const items = accordion.querySelectorAll('.pm-accordion__item');

  const setOpenState = (item, shouldOpen) => {
    const content = item.querySelector('.pm-accordion__content');
    const trigger = item.querySelector('.pm-accordion__header');

    item.classList.toggle('is-open', shouldOpen);

    if (trigger) {
      trigger.setAttribute('aria-expanded', String(shouldOpen));
    }

    if (content) {
      content.style.maxHeight = shouldOpen ? `${content.scrollHeight}px` : '0px';
    }
  };

  items.forEach((item) => {
    const trigger = item.querySelector('.pm-accordion__header');

    if (!trigger) {
      return;
    }

    trigger.addEventListener('click', () => {
      const isOpen = item.classList.contains('is-open');

      items.forEach((otherItem) => setOpenState(otherItem, false));

      if (!isOpen) {
        setOpenState(item, true);
        requestAnimationFrame(() => setOpenState(item, true));
      }
    });
  });

  window.addEventListener('resize', () => {
    const openItem = accordion.querySelector('.pm-accordion__item.is-open');

    if (openItem) {
      setOpenState(openItem, true);
    }
  });
});

document.querySelectorAll('[data-pm-details]').forEach((detailsSection) => {
  const detailCards = Array.from(detailsSection.querySelectorAll('[data-detail-target]'));
  const detailPreviews = Array.from(detailsSection.querySelectorAll('[data-detail-preview]'));
  let activeDetailId = null;
  let ticking = false;

  if (!detailCards.length || !detailPreviews.length) {
    return;
  }

  const activateDetail = (detailId) => {
    if (!detailId || detailId === activeDetailId) {
      return;
    }

    activeDetailId = detailId;

    detailCards.forEach((card) => {
      card.classList.toggle('is-active', card.dataset.detailTarget === detailId);
    });

    detailPreviews.forEach((preview) => {
      preview.classList.toggle('is-active', preview.dataset.detailPreview === detailId);
    });
  };

  activateDetail(detailCards[0].dataset.detailTarget);

  if (window.matchMedia('(min-width: 992px)').matches) {
    const updateActiveDetail = () => {
      const viewportAnchor = window.innerHeight * 0.34;
      let nearestCard = detailCards[0];
      let nearestDistance = Number.POSITIVE_INFINITY;

      detailCards.forEach((card) => {
        const rect = card.getBoundingClientRect();
        const cardAnchor = rect.top + Math.min(rect.height * 0.28, 140);
        const distance = Math.abs(cardAnchor - viewportAnchor);

        if (distance < nearestDistance) {
          nearestDistance = distance;
          nearestCard = card;
        }
      });

      if (nearestCard) {
        activateDetail(nearestCard.dataset.detailTarget);
      }
    };

    const requestUpdate = () => {
      if (ticking) {
        return;
      }

      ticking = true;

      window.requestAnimationFrame(() => {
        updateActiveDetail();
        ticking = false;
      });
    };

    updateActiveDetail();
    window.addEventListener('scroll', requestUpdate, { passive: true });
    window.addEventListener('resize', requestUpdate);
  }
});

document.querySelectorAll('[data-pm-gallery]').forEach((gallery) => {
  const track = gallery.querySelector('[data-pm-gallery-track]');
  const prev = gallery.querySelector('[data-pm-gallery-prev]');
  const next = gallery.querySelector('[data-pm-gallery-next]');
  let isPointerDown = false;
  let startX = 0;
  let startScrollLeft = 0;

  if (!track) {
    return;
  }

  const getStep = () => {
    const firstItem = track.querySelector('.pm-gallery__item');

    if (!firstItem) {
      return track.clientWidth;
    }

    const gap = Number.parseFloat(window.getComputedStyle(track).gap || '0');
    return firstItem.getBoundingClientRect().width + gap;
  };

  if (prev) {
    prev.addEventListener('click', () => {
      track.scrollBy({ left: -getStep(), behavior: 'smooth' });
    });
  }

  if (next) {
    next.addEventListener('click', () => {
      track.scrollBy({ left: getStep(), behavior: 'smooth' });
    });
  }

  const startDrag = (clientX) => {
    isPointerDown = true;
    startX = clientX;
    startScrollLeft = track.scrollLeft;
    track.classList.add('is-dragging');
  };

  const moveDrag = (clientX) => {
    if (!isPointerDown) {
      return;
    }

    const delta = clientX - startX;
    track.scrollLeft = startScrollLeft - delta;
  };

  const stopDrag = () => {
    if (!isPointerDown) {
      return;
    }

    isPointerDown = false;
    track.classList.remove('is-dragging');
  };

  track.addEventListener('mousedown', (event) => {
    startDrag(event.pageX);
  });

  window.addEventListener('mousemove', (event) => {
    moveDrag(event.pageX);
  });

  window.addEventListener('mouseup', stopDrag);
  track.addEventListener('mouseleave', stopDrag);

  track.addEventListener('touchstart', (event) => {
    if (event.touches[0]) {
      startDrag(event.touches[0].pageX);
    }
  }, { passive: true });

  track.addEventListener('touchmove', (event) => {
    if (event.touches[0]) {
      moveDrag(event.touches[0].pageX);
    }
  }, { passive: true });

  track.addEventListener('touchend', stopDrag);
});
