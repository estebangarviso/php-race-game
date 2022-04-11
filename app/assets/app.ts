import 'bootstrap';
import $, { ajax } from 'jquery';

$(function () {
  $('#run-simulation').on('submit', function (e) {
    e.preventDefault();
    const form = $(this);
    const url = form.attr('action');
    const data = form.serialize();
    ajax({
      url,
      data,
      method: 'POST',
      success: function (response) {
        console.log(response);

        $('#race-result').html(response);
      },
    });
  });
});
