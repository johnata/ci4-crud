$(document).ready(function () {
  $('.btn-lock').on('click', function (e) {
    e.preventDefault();
    let userId = $(this).data('id');
    $.ajax({
      url: base_url + 'users/toggleActive/' + userId,
      method: 'POST',
      data: {
        id: userId,
        // <?= csrf_token() ?>: "<?= csrf_hash() ?>" // se CSRF estiver ativo
      },
      success: function (response) {
        if (response.status === 'success') {
          location.reload();
        } else if (response.status === 'error') {
          showMessage({
            title: 'Erro',
            message: response.message,
            type: 'danger',
          });
        } else {
          showMessage({
            title: 'Erro',
            message: 'Unexpected error while changing user status.',
            type: 'danger',
          });
        }
      },
      error: function (xhr) {
        showMessage({
          title: 'Erro',
          message: 'Error changing user status.',
          type: 'danger',
        });
      },
    });
  });

  $('.btn-delete').on('click', function (e) {
    e.preventDefault();
    const userId = $(this).data('id');

    showModal({
      title: 'Deleting User',
      message: 'This is will delete the user. Are you sure?',
      type: 'warning',
      confirmText: 'Yes, delete it!',
      cancelText: 'No, cancel',
      onConfirm: function () {
        deleteUser(userId);
      },
    });
  });
});

function deleteUser(userId) {
  $.ajax({
    url: base_url + 'users/delete/' + userId,
    type: 'POST',
    data: {
      _method: 'DELETE',
    },
    success: function (response) {
      location.reload();
    },
    error: function (xhr) {
      showMessage({
        title: 'Error',
        message: 'Error trying to delete user.',
        type: 'danger',
      });
    },
  });
}
