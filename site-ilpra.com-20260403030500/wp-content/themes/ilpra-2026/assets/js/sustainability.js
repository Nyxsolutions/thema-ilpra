document.addEventListener('DOMContentLoaded', () => {
  const tabs = Array.from(document.querySelectorAll('.sustainability-tabs-list a'));
  const panels = Array.from(document.querySelectorAll('[data-sustainability-panel]'));
  const tabsWrapper = document.querySelector('#tabs_wrapper');

  const showPanel = (key) => {
    panels.forEach((panel) => {
      const isActive = panel.dataset.sustainabilityPanel === key;
      panel.hidden = !isActive;
      panel.classList.toggle('is-active', isActive);
    });

    tabs.forEach((tab) => {
      const isActive = tab.getAttribute('href') === `#${key}`;
      tab.parentElement?.classList.toggle('active', isActive);
      tab.setAttribute('aria-current', isActive ? 'page' : 'false');
    });
  };

  if (tabs.length && panels.length) {
    showPanel('sustainability');

    tabs.forEach((tab) => {
      tab.addEventListener('click', (event) => {
        event.preventDefault();
        const target = tab.getAttribute('href')?.replace('#', '').toLowerCase();

        if (!target) {
          return;
        }

        showPanel(target);

        if (tabsWrapper) {
          tabsWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });
  }

  const revealItems = document.querySelectorAll('.img-reveal');

  if ('IntersectionObserver' in window && revealItems.length) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) {
          return;
        }

        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      });
    }, {
      threshold: 0.18,
    });

    revealItems.forEach((item) => observer.observe(item));
  } else {
    revealItems.forEach((item) => item.classList.add('is-visible'));
  }
});
