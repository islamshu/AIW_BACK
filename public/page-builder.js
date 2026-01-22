(function () {
  function openMedia(sectionId) {
    var baseUrl = window.MEDIA_LIBRARY_URL || '/dashboard/media?select_mode=section';
    var url = baseUrl + (baseUrl.indexOf('?')>-1 ? '&' : '?') + 'section_id=' + encodeURIComponent(sectionId);
    window.activeSectionId = sectionId;
    window.open(url, 'MediaLibrary', 'width=1200,height=800');
  }

  document.addEventListener('click', function (e) {
    var btn = e.target.closest('.js-open-media');
    if (btn) {
      openMedia(btn.getAttribute('data-section-id'));
      return;
    }

    if (e.target.closest('.js-remove-repeater-item')) {
      e.preventDefault();
      var item = e.target.closest('.repeater-item');
      if (item) item.remove();
    }
  });

  // Receive selected media (expected message: {type:'media-selected', id:123, url:'...', section_id:...})
  window.addEventListener('message', function (event) {
    var data = event.data || {};
    if (data.type !== 'media-selected') return;

    var sectionId = data.section_id || window.activeSectionId;
    if (!sectionId) return;

    var idInput = document.getElementById('section_image_' + sectionId);
    var img = document.getElementById('section_preview_' + sectionId);
    var removeBtn = document.getElementById('section_remove_' + sectionId);

    if (idInput) idInput.value = data.id || '';
    if (img) {
      img.src = data.url || '';
      img.style.display = data.url ? 'block' : 'none';
    }
    if (removeBtn) removeBtn.style.display = data.url ? 'inline-flex' : 'none';
  });

  window.removeSectionImage = function (sectionId) {
    var idInput = document.getElementById('section_image_' + sectionId);
    var img = document.getElementById('section_preview_' + sectionId);
    var removeBtn = document.getElementById('section_remove_' + sectionId);

    if (idInput) idInput.value = '';
    if (img) { img.src = ''; img.style.display = 'none'; }
    if (removeBtn) removeBtn.style.display = 'none';
  };
})();
