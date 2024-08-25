function suggetion() {
  $('#sug_input').keyup(function (e) {
    var formData = {
      product_name: $('input[name=title]').val(),
    };

    if (formData['product_name'].length >= 1) {
      $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: formData,
        dataType: 'json',
        encode: true,
      }).done(function (data) {
        $('#result').html(data).fadeIn();
        $('#result li').click(function () {
          $('#sug_input').val($(this).text());
          $('#sug-form').submit();
          $('#result').fadeOut(500);
          $('#sug_input').val('');
          // Verifica si #idCliente tiene HTML
          setTimeout(function () {
            if ($('#idCliente').html().trim() !== '') {
              // Si tiene HTML, desactiva el <select>
              $('#product_list tr td select[name=customer]').prop(
                'disabled',
                true
              );
            } else {
              // Si no tiene HTML, activa el <select>
              $('#product_list tr td select[name=customer]').prop(
                'disabled',
                false
              );
            }
          }, 100);
        });

        $('#sug_input').blur(function () {
          $('#result').fadeOut(500);
        });
      });
    } else {
      $('#result').hide();
    }

    e.preventDefault();
  });
}

$('#sug-form').submit(function (e) {
  var formData = {
    p_name: $('input[name=title]').val(),
  };
  $.ajax({
    type: 'POST',
    url: 'ajax.php',
    data: formData,
    dataType: 'json',
    encode: true,
  })
    .done(function (data) {
      $('#product_list').html(data).show();
      total();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      $('#product_list')
        .html('<p>Error en la solicitud: ' + textStatus + '</p>')
        .show();
      console.error('Error: ' + errorThrown);
    });
  e.preventDefault();
});

function total() {
  $('#product_list').on('change', 'input[name=quantity]', function () {
    calcularTotal();
  });
  calcularTotal();

  function calcularTotal() {
    $('#product_list tr').each(function () {
      var price = +$(this).find('input[name=price]').val() || 0;
      var qty = +$(this).find('input[name=quantity]').val() || 0;
      var total = qty * price;
      console.log(total);
      $(this).find('input[name=total]').val(total.toFixed(2));
    });
  }
}

function subTotal() {
  var subtotal = 0;
  $('#product_info tr').each(function () {
    var total = +$(this).find('td.total').text() || 0;
    subtotal += total;
  });
  $('#subtotal tr').remove();
  $('#subtotal').append(`<tr>
        <td colspan="3" style="text-align: right;"><strong>Total</strong></td>
        <td colspan="1" style="text-align: right;"><strong>${subtotal.toFixed(
    2
  )}</strong></td>
        <td></td>
      </tr>`);
  console.log('subtotal: ' + subtotal);
  if (subtotal != 0) {
    $('#save-sale').prop('disabled', false);
  } else if (subtotal == 0) {
    $('#save-sale').prop('disabled', true);
  }
}

$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();
  $('.submenu-toggle').click(function () {
    $(this).parent().children('ul.submenu').toggle(200);
  });
  suggetion();
  total();

  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true,
  });

  // Handle add-product button click
  $('#product_list').on('click', '.add-product', function () {
    var row = $(this).closest('tr');
    var product = {
      id: row.find('input[name=s_id]').val(),
      name: row.find('td:eq(0)').text(),
      price: row.find('input[name=price]').val(),
      quantity: row.find('input[name=quantity]').val(),
      total: row.find('input[name=total]').val(),
    };

    var productRow = `<tr>
      <td><input type="hidden" name="product_id[]" value="${product.id}">${product.name}</td>
      <td style="text-align: right;"><input type="hidden" name="price[]">${product.price}</td>
      <td style="text-align: right;"><input type="hidden" name="quantity[]" id="cant" value="${product.quantity}">${product.quantity}</td>
      <td style="text-align: right;" class="total"><input type="hidden" name="subtotal[]" value="${product.total}">${product.total}</td>
      <td style="text-align: center;"><button type="button" class="btn btn-danger remove-product">Eliminar</button></td>
    </tr>`;

    var idCliente = `<i>
      <p>Cliente: ${$('select[name=customer] option:selected').text()}</p>
    </i>`;

    var customer_id = $('select[name=customer]').val();
    console.log('valor de customer_id : ' + customer_id);

    $('#product_info').append(productRow);
    subTotal();
    $('#idCliente').empty();
    $('#idCliente').append(idCliente);
    $('#customer_id').empty();
    $('#customer_id').append(customer_id);
    $('#customer_id').val(customer_id);
    $('select[name=customer]').prop('disabled', true);
    $('#save-sale').prop('disabled', false);

    //Modificar stock de producto agregado
    let old_stock = document.getElementById('stock').value;
    let new_stock = old_stock - product.quantity;
    document.getElementById('stock').value = new_stock;

    //Setear la cantidad en 1
    document.getElementById('c').value = 1;
    if (new_stock == 0) {
      $('#add-product').prop('disabled', true);
      document.getElementById('c').value = 0;
      $('#c').prop('disabled', true);
    } else {
      $('#add-product').prop('disabled', false);
      document.getElementById('c').value = 1;
      $('#c').prop('disabled', false);
    }
  });

  // Handle remove-product button click
  $('#product_info').on('click', '.remove-product', function () {
    var row = $(this).closest('tr');
    //Modificar stock de producto eliminado
    let old_stock = parseFloat(document.getElementById('stock').value) || 0;
    var cant = parseFloat(row.find('td').eq(2).text().trim()) || 0;
    let new_stock = old_stock + cant;
    document.getElementById('stock').value = new_stock;
    row.remove();
    subTotal();
    //Activar la cantidad
    if (new_stock == 0) {
      $('#add-product').prop('disabled', true);
      document.getElementById('c').value = 0;
      $('#c').prop('disabled', true);
    } else {
      $('#add-product').prop('disabled', false);
      document.getElementById('c').value = 1;
      $('#c').prop('disabled', false);
    }
  });
  $('#view-receipt').click(function () {
    window.open("boleta.php", "_blank");
  });
});
