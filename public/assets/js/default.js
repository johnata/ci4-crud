function showModal({
  title = 'Atenção',
  message = 'aaaaa',
  type = 'info', // info, success, warning, danger
  confirmText = 'OK',
  cancelText = null,
  onConfirm = null,
}) {
  const typeStyles = {
    info: { bg: 'bg-info-subtle text-dark', icon: 'ℹ️' },
    success: { bg: 'bg-success-subtle text-dark', icon: '✅' },
    warning: { bg: 'bg-warning-subtle text-dark', icon: '⚠️' },
    danger: { bg: 'bg-danger-subtle text-dark', icon: '❌' },
  };

  const current = typeStyles[type] || typeStyles.info;

  $('#genericModalHeader')
    .removeClass()
    .addClass('modal-header ' + current.bg);

  $('#genericModalLabel').text(title);
  $('#genericModalMessage').text(message);
  $('#genericModalIcon').html(current.icon);
  $('#genericConfirmBtn').text(confirmText);

  const modal = new bootstrap.Modal(document.getElementById('genericModal'));

  // Mostrar ou esconder botão Cancelar
  if (cancelText) {
    $('#genericCancelBtn').removeClass('d-none').text(cancelText);
  } else {
    $('#genericCancelBtn').addClass('d-none');
  }

  // Limpar evento anterior
  $('#genericConfirmBtn').off('click');

  // Adicionar novo
  $('#genericConfirmBtn').on('click', function () {
    modal.hide();
    if (typeof onConfirm === 'function') {
      onConfirm();
    }
  });

  modal.show();
}

function showMessage({
  title = 'Alerta',
  message = '',
  type = 'info',
  dismissible = true,
}) {
  const types = {
    info: { bg: 'alert-info', icon: 'ℹ️' },
    success: { bg: 'alert-success', icon: '✅' },
    warning: { bg: 'alert-warning', icon: '⚠️' },
    danger: { bg: 'alert-danger', icon: '❌' },
  };

  const selected = types[type] || types.info;

  const alertHTML = `
      <div class="alert ${
        selected.bg
      } alert-dismissible fade show" role="alert">
        <strong>${selected.icon} ${title}</strong> ${message}
        ${
          dismissible
            ? '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
            : ''
        }
      </div>
    `;

  document.getElementById('alertPlaceholder').innerHTML = alertHTML;

  setTimeout(() => {
    const alertSelector = document.querySelector('.alert');
    if (alertSelector) {
      alertSelector.remove();
    }
  }, 10000);
}
