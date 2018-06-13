import 'bootstrap';


$(document).ready(function() {
  console.log('APP:start');

  //заказ лифта
  $(document).on('click', '.order-create', function() {
    let url = document.getElementById('order').value;
    window.location.href = url;
  });
});
