import 'bootstrap';
import $ from 'jquery';

$(function () {
  $('#run-simulation').on('submit', function (e) {
    e.preventDefault();
    const form = $(this);
    const url = form.attr('action');
    const data = form.serialize();
    const submitBtn = form.find('button[type="submit"]');

    submitBtn.prop('disabled', true);

    $.ajax({
      url,
      data,
      method: 'POST',
      success: function (response) {
        const target = $('#race-result');
        target.html(response);
        target.addClass('show');
        submitBtn.prop('disabled', false);
      },
    });
  });
});
