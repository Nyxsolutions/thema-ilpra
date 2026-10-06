document.addEventListener('click', (event) => {
  const addButton = event.target.closest('.nyx-hreflang-editor__add');

  if (addButton) {
    const editor = addButton.closest('.nyx-hreflang-editor');
    const template = editor?.querySelector('.nyx-hreflang-editor__template');
    const body = editor?.querySelector('tbody');

    if (!template || !body) {
      return;
    }

    body.insertAdjacentHTML('beforeend', template.innerHTML.trim());
    body.querySelector('tr:last-child input')?.focus();
    return;
  }

  const removeButton = event.target.closest('.nyx-hreflang-editor__remove');

  if (!removeButton) {
    return;
  }

  const row = removeButton.closest('tr');
  const body = row?.parentElement;

  if (row && body && body.querySelectorAll('tr').length > 1) {
    row.remove();
    return;
  }

  row?.querySelectorAll('input').forEach((input) => {
    input.value = '';
  });
});
