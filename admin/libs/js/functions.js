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
  $('#clie_input').keyup(function (e) {
    var formData = {
      customer: $('input[name=title]').val(),
    };

    if (formData['customer'].length >= 1) {
      $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: formData,
        dataType: 'json',
        encode: true,
      }).done(function (data) {
        $('#result').html(data).fadeIn();
        $('#result li').click(function () {
          $('#clie_input').val($(this).text());
          $('#clie-form').submit();
          $('#result').fadeOut(500);
          $('#clie_input').val('');
          // Verifica si #idCliente tiene HTML
          setTimeout(function () {
            if ($('#idCliente').html().trim() !== '') {
              // Si tiene HTML, desactiva el <select>
              $('#idCliente').prop('disabled', true);
            } else {
              // Si no tiene HTML, activa el <select>
              $('#idCliente').prop('disabled', false);
            }
          }, 100);
        });

        $('#clie_input').blur(function () {
          $('#result').fadeOut(500);
        });
      });
    } else {
      $('#result').hide();
    }

    e.preventDefault();
  });
  $('#sug_input_i').keyup(function (e) {
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
          $('#sug_input_i').val($(this).text());
          $('#sug-form_i').submit();
          $('#result').fadeOut(500);
          $('#sug_input_i').val('');
          // Verifica si #idProvider tiene HTML
          setTimeout(function () {
            if ($('#idProvider').html().trim() !== '') {
              // Si tiene HTML, desactiva el <select>
              $('#product_list_i tr td select[name=provider]').prop(
                'disabled',
                true
              );
            } else {
              // Si no tiene HTML, activa el <select>
              $('#product_list_i tr td select[name=provider]').prop(
                'disabled',
                false
              );
            }
          }, 100);
        });

        $('#sug_input_i').blur(function () {
          $('#result').fadeOut(500);
        });
      });
    } else {
      $('#result').hide();
    }

    e.preventDefault();
  });
  $('#prov_input').keyup(function (e) {
    var formData = {
      provider: $('input[name=title]').val(),
    };
    console.log(formData['provider'])
    if (formData['provider'].length >= 1) {
      $.ajax({
        type: 'POST',
        url: 'ajax_p.php',
        data: formData,
        dataType: 'json',
        encode: true,
      }).done(function (data) {
        $('#result').html(data).fadeIn();
        $('#result li').click(function () {
          $('#prov_input').val($(this).text());
          $('#prov-form').submit();
          $('#result').fadeOut(500);
          $('#prov_input').val('');
        });

        $('#prov_input').blur(function () {
          $('#result').fadeOut(500);
        });
      }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Error en la solicitud: " + textStatus);
        console.error('Error: ' + errorThrown);
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

$('#sug-form_i').submit(function (e) {
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
      $('#product_list_i').html(data).show();
      total();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      $('#product_list_i')
        .html('<p>Error en la solicitud: ' + textStatus + '</p>')
        .show();
      console.error('Error: ' + errorThrown);
    });
  e.preventDefault();
});

$('#clie-form').submit(function (e) {
  var formData = {
    c_name: $('input[name=title]').val(),
    c_id: $('#clie_input').attr('id'),
    sxc: $('#salesxclie').attr('id'),
  };
  $.ajax({
    type: 'POST',
    url: 'ajax.php',
    data: formData,
    dataType: 'json',
    encode: true,
  })
    .done(function (data) {
      $('#' + formData.c_id).val(data.clie_value).show();
      $('#' + formData.sxc).val(data.clie_id).show();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      $('#' + formData.c_id)
        .val('Error en la solicitud: ' + textStatus)
        .show();
      console.error('Error: ' + errorThrown);
    });
  e.preventDefault();
});

$('#prov-form').submit(function (e) {
  var formData = {
    p_name: $('input[name=title]').val(),
    p_id: $('#prov_input').attr('id'),
    ixp: $('#incomesxprov').attr('id'),
  };
  console.log('submit: ' + formData['p_name'])
  $.ajax({
    type: 'POST',
    url: 'ajax_p.php',
    data: formData,
    dataType: 'json',
    encode: true,
  })
    .done(function (data) {
      $('#' + formData.p_id).val(data.prov_value).show();
      $('#' + formData.ixp).val(data.prov_id).show();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      $('#' + formData.p_id)
        .val('Error en la solicitud: ' + textStatus)
        .show();
      console.error('Error: ' + errorThrown);
    });
  e.preventDefault();
});

function total() {
  $('#product_list').on('change', 'input[name=qty]', function () {
    calcularTotal();
  });
  $('#product_list_i').on('change', 'input[name=qty]', function () {
    calcularTotal();
  });
  calcularTotal();

  function calcularTotal() {
    $('#product_list tr').each(function () {
      var price = +$(this).find('input[name=price]').val() || 0;
      var qty = +$(this).find('input[name=qty]').val() || 0;
      var total = qty * price;
      $(this).find('input[name=total]').val(total.toFixed(2));
    });
    $('#product_list_i tr').each(function () {
      var price = +$(this).find('input[name=price]').val() || 0;
      var qty = +$(this).find('input[name=qty]').val() || 0;
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
  $('#product_info_i tr').each(function () {
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
    $('#save-income').prop('disabled', false);
  } else if (subtotal == 0) {
    $('#save-sale').prop('disabled', true);
    $('#save-income').prop('disabled', true);
  }
}

function buscarVentasxDia() {
  console.log("buscarVentasxDia initialized");
  $('select[name="select_day"]').change(function () {
    var day = $(this).val();
    console.log("Day selected: ", day);
    var month = $('#s_month_daily').val();
    console.log("Month selected: ", month);
    var year = $('#s_year_daily').val();
    console.log("Year selected: ", year);
    var customer = $('#salesxclie').val(); // Obtener el ID del cliente seleccionado
    console.log("Customer ID: ", customer);
    $.ajax({
      url: 'daily_sales.php', // Asegúrate de que la ruta sea correcta
      type: 'POST',
      data: {
        day: day,
        month: month,
        year: year,
        c_id: customer,
        SSC: true // Indica que se desea buscar por cliente si está presente
      },
      success: function (response) {
        console.log("Año: ", response.year);
        console.log("Mes: ", response.month);
        console.log("Día: ", response.day);
        console.log("CustomerID: ", response.customer);
        // Actualiza la tabla con los datos devueltos
        $('table tbody').html(response.table_data);
        // Actualizar los totales en el pie de tabla (tfoot)
        $('table tfoot .sum_importe').text(response.sum_importe);
        $('table tfoot .sum_igv').text(response.sum_igv);
        $('table tfoot .sum_total').text(response.sum_total);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud:", textStatus, errorThrown);
      }
    });
  });
  $('select[name="select_month_daily"]').change(function () {
    var month = $(this).val();
    console.log("Month selected: ", month);
    var day = $('#s_day').val();
    console.log("Day selected: ", day);
    var year = $('#s_year_daily').val();
    console.log("Year selected: ", year);
    var customer = $('#salesxclie').val(); // Obtener el ID del cliente seleccionado
    console.log("Customer ID: ", customer);
    $.ajax({
      url: 'daily_sales.php', // Asegúrate de que la ruta sea correcta
      type: 'POST',
      data: {
        day: day,
        month: month,
        year: year,
        c_id: customer,
        SSC: true // Indica que se desea buscar por cliente si está presente
      },
      success: function (response) {
        console.log("Año: ", response.year);
        console.log("Mes: ", response.month);
        console.log("Día: ", response.day);
        console.log("CustomerID: ", response.customer);
        // Actualiza la tabla con los datos devueltos
        $('table tbody').html(response.table_data);
        // Actualizar los totales en el pie de tabla (tfoot)
        $('table tfoot .sum_importe').text(response.sum_importe);
        $('table tfoot .sum_igv').text(response.sum_igv);
        $('table tfoot .sum_total').text(response.sum_total);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud:", textStatus, errorThrown);
      }
    });
  });
  $('select[name="select_year_daily"]').change(function () {
    var year = $(this).val();
    console.log("Year selected: ", year);
    var day = $('#s_day').val();
    console.log("Day selected: ", day);
    var month = $('#s_month_daily').val();
    console.log("Month selected: ", month);
    var customer = $('#salesxclie').val(); // Obtener el ID del cliente seleccionado
    console.log("Customer ID: ", customer);
    $.ajax({
      url: 'daily_sales.php', // Asegúrate de que la ruta sea correcta
      type: 'POST',
      data: {
        day: day,
        month: month,
        year: year,
        c_id: customer,
        SSC: true // Indica que se desea buscar por cliente si está presente
      },
      success: function (response) {
        console.log("Año: ", response.year);
        console.log("Mes: ", response.month);
        console.log("Día: ", response.day);
        console.log("CustomerID: ", response.customer);
        // Actualiza la tabla con los datos devueltos
        $('table tbody').html(response.table_data);
        // Actualizar los totales en el pie de tabla (tfoot)
        $('table tfoot .sum_importe').text(response.sum_importe);
        $('table tfoot .sum_igv').text(response.sum_igv);
        $('table tfoot .sum_total').text(response.sum_total);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud:", textStatus, errorThrown);
      }
    });
  });
}

function buscarVentasxMes() {
  console.log("buscarVentasxMes initialized");
  $('select[name="select_month"]').change(function () {
    var month = $(this).val();
    console.log("Month selected: ", month);
    var year = $('#s_year').val();
    console.log("Year selected: ", year);
    var customer = $('#salesxclie').val(); // Obtener el ID del cliente seleccionado
    console.log("Customer ID: ", customer);
    $.ajax({
      url: 'monthly_sales.php', // Asegúrate de que la ruta sea correcta
      type: 'POST',
      data: {
        month: month,
        year: year,
        c_id: customer,
        SSC: true // Indica que se desea buscar por cliente si está presente
      },
      success: function (response) {
        console.log("Año: ", response.year);
        console.log("Mes: ", response.month);
        console.log("CustomerID: ", response.customer);
        // Actualiza la tabla con los datos devueltos
        $('table tbody').html(response.table_data);
        // Actualizar los totales en el pie de tabla (tfoot)
        $('table tfoot .sum_importe').text(response.sum_importe);
        $('table tfoot .sum_igv').text(response.sum_igv);
        $('table tfoot .sum_total').text(response.sum_total);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud:", textStatus, errorThrown);
      }
    });
  });
  $('select[name="select_year_month"]').change(function () {
    var year = $(this).val();
    console.log("Year selected: ", year);
    var month = $('#s_month').val();
    console.log("Month selected: ", month);
    var customer = $('#salesxclie').val(); // Obtener el ID del cliente seleccionado
    console.log("Customer ID: ", customer);
    $.ajax({
      url: 'monthly_sales.php', // Asegúrate de que la ruta sea correcta
      type: 'POST',
      data: {
        month: month,
        year: year,
        c_id: customer,
        SSC: true // Indica que se desea buscar por cliente si está presente
      },
      success: function (response) {
        console.log("Año: ", response.year);
        console.log("Mes: ", response.month);
        console.log("CustomerID: ", response.customer);
        // Actualiza la tabla con los datos devueltos
        $('table tbody').html(response.table_data);
        // Actualizar los totales en el pie de tabla (tfoot)
        $('table tfoot .sum_importe').text(response.sum_importe);
        $('table tfoot .sum_igv').text(response.sum_igv);
        $('table tfoot .sum_total').text(response.sum_total);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud:", textStatus, errorThrown);
      }
    });
  });
}

function buscarVentasxAnio() {
  console.log("buscarVentasxAnio initialized");
  $('select[name="select_year"]').change(function () {
    var year = $(this).val(); // Usar el año actual
    var customer = $('#salesxclie').val(); // Obtener el ID del cliente seleccionado
    console.log("Customer ID: ", customer);
    $.ajax({
      url: 'annually_sales.php', // Asegúrate de que la ruta sea correcta
      type: 'POST',
      data: {
        year: year,
        c_id: customer,
        SSC: true // Indica que se desea buscar por cliente si está presente
      },
      success: function (response) {
        console.log("Año: ", response.year);
        console.log("CustomerID: ", response.customer);
        // Actualiza la tabla con los datos devueltos
        $('table tbody').html(response.table_data);
        // Actualizar los totales en el pie de tabla (tfoot)
        $('table tfoot .sum_importe').text(response.sum_importe);
        $('table tfoot .sum_igv').text(response.sum_igv);
        $('table tfoot .sum_total').text(response.sum_total);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud:", textStatus, errorThrown);
      }
    });
  });
}

$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();
  $('.submenu-toggle').click(function () {
    $(this).parent().children('ul.submenu').toggle(200);
  });
  suggetion();
  total();
  buscarVentasxDia();
  buscarVentasxMes();
  buscarVentasxAnio();
  buscarComprasxDia();
  buscarComprasxMes();
  buscarComprasxAnio();

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
      qty: row.find('input[name=qty]').val(),
      total: row.find('input[name=total]').val(),
    };

    var productRow = `<tr>
      <td><input type="hidden" name="product_id[]" value="${product.id}">${product.name}</td>
      <td style="text-align: right;"><input type="hidden" name="price[]">${product.price}</td>
      <td style="text-align: right;"><input type="hidden" name="qty[]" id="cant" value="${product.qty}">${product.qty}</td>
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
    let new_stock = old_stock - product.qty;
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

  //Incomes
  //Validar num_comprobante
  $('input[name="n_voucher"]').on('blur', function () {
    var n_vouch = $(this).val();
    console.log('Valor de num_voucher : ' + n_vouch);

    // Realizar la validación por AJAX
    $.ajax({
      url: 'validate_voucher.php',
      type: 'POST',
      data: { n_voucher: n_vouch },
      dataType: 'json',
      success: function (response) {
        if (response.status === 'exists') {
          // Mostrar el mensaje de error y detener cualquier acción posterior
          alert(response.message);
          // Aquí puedes desactivar el botón de envío si quieres, por ejemplo:
          $('button[type="submit"]').prop('disabled', true);
        } else {
          // Si no existe, activar el botón de envío por si estaba desactivado
          $('button[type="submit"]').prop('disabled', false);
        }
      },
      error: function (xhr, status, error) {
        console.error("Error en la validación del voucher: ", status, error);
      }
    });
  });
  // Handle add-product button click
  $('#product_list_i').on('click', '.add-product', function () {
    var row = $(this).closest('tr');
    var product = {
      id: row.find('input[name=s_id]').val(),
      name: row.find('td:eq(0)').text(),
      price: row.find('input[name=price]').val(),
      qty: row.find('input[name=qty]').val(),
      total: row.find('input[name=total]').val(),
    };

    var productRow = `<tr>
      <td><input type="hidden" name="product_id[]" value="${product.id}">${product.name}</td>
      <td style="text-align: right;"><input type="hidden" name="price[]">${product.price}</td>
      <td style="text-align: right;"><input type="hidden" name="qty[]" id="cant" value="${product.qty}">${product.qty}</td>
      <td style="text-align: right;" class="total"><input type="hidden" name="subtotal[]" value="${product.total}">${product.total}</td>
      <td style="text-align: center;"><button type="button" class="btn btn-danger remove-product">Eliminar</button></td>
    </tr>`;

    var provider_id = $('select[name=provider]').val();
    console.log('valor de provider_id : ' + provider_id);
    var n_vouch = $('input[name=n_voucher]').val();
    console.log('valor de num_voucher : ' + n_vouch);

    var idProveedor = `<i>
      <p>Cliente: ${$('select[name=provider] option:selected').text()}</p>
    </i>`;
    var num_voucher = `<i>
      <p>N° comprobante: ${$('input[name=n_voucher]').val()}</p>
    </i>`;


    $('#product_info_i').append(productRow);
    subTotal();
    $('#idProvider').empty();
    $('#idProvider').append(idProveedor);
    $('#num_voucher').empty();
    $('#num_voucher').append(num_voucher);
    $('#provider_id').empty();
    $('#provider_id').append(provider_id);
    $('#provider_id').val(provider_id);
    $('#n_vouch').empty();
    $('#n_vouch').append(n_vouch);
    $('#n_vouch').val(n_vouch);
    $('select[name=provider]').prop('disabled', true);
    $('input[name=n_voucher]').prop('disabled', true);
    $('#save-income').prop('disabled', false);

    //Modificar stock de producto agregado
    let old_stock = document.getElementById('stock').value;
    let new_stock = parseFloat(old_stock) + parseFloat(product.qty);
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

  //Eliminación de usuario
  var userId;
  $('.delete-user').click(function () {
    userId = $(this).data('id');
    $('#confirmDeleteModal').modal('show');
  });
  $('#confirmDeleteBtnUser').click(function () {
    window.location.href = 'delete_user.php?id=' + userId;
  });
  //Eliminación de categoria
  var categorieId;
  $('.delete-categorie').click(function () {
    categorieId = $(this).data('id');
    $('#confirmDeleteModal').modal('show');
  });
  $('#confirmDeleteBtnCategorie').click(function () {
    window.location.href = 'delete_categorie.php?id=' + categorieId;
  });
  $('#msgModal').modal('show');
  //Eliminación de producto
  var productId;
  $('.delete-product').click(function () {
    productId = $(this).data('id');
    $('#confirmDeleteModal').modal('show');
  });
  $('#confirmDeleteBtnProduct').click(function () {
    window.location.href = 'delete_product.php?id=' + productId;
  });
  //Eliminación de media
  var mediaId;
  $('.delete-media').click(function () {
    mediaId = $(this).data('id');
    $('#confirmDeleteModal').modal('show');
  });
  $('#confirmDeleteBtnMedia').click(function () {
    window.location.href = 'delete_media.php?id=' + mediaId;
  });
  //Eliminación de compra
  var incomeId;
  $('.delete-income').click(function () {
    incomeId = $(this).data('id');
    $('#confirmDeleteModal').modal('show');
  });
  $('#confirmDeleteBtnIncome').click(function () {
    window.location.href = 'delete.php?id=' + incomeId;
  });
  //Eliminación de proveedor
  var providerId;
  $('.delete-provider').click(function () {
    providerId = $(this).data('id');
    $('#confirmDeleteModal').modal('show');
  });
  $('#confirmDeleteBtnProvider').click(function () {
    window.location.href = 'delete.php?id=' + providerId;
  });
  //Eliminación de venta
  var saleId;
  $('.delete-sale').click(function () {
    saleId = $(this).data('id');
    $('#confirmDeleteModal').modal('show');
  });
  $('#confirmDeleteBtnSale').click(function () {
    window.location.href = 'delete.php?id=' + saleId;
  });
  //Eliminación de customer
  var customerId;
  $('.delete-customer').click(function () {
    customerId = $(this).data('id');
    $('#confirmDeleteModal').modal('show');
  });
  $('#confirmDeleteBtnCustomer').click(function () {
    window.location.href = 'delete.php?id=' + customerId;
  });
  // Llamamos a la función inmediatamente para mostrar la hora actual al cargar la página
  updateClock();

  // Actualizamos cada 60000 milisegundos (1 minuto)
  setInterval(updateClock, 60000);
});
document.addEventListener('DOMContentLoaded', function () {
  // Seleccionamos el input de tipo file
  var fileInput = document.querySelector('input[name="file_upload"]');
  var fileNameSpan = document.getElementById('file-name');

  if (fileInput && fileNameSpan) {
    fileInput.addEventListener('change', function () {
      // Verificamos si se ha seleccionado un archivo
      if (fileInput.files.length > 0) {
        var fileName = fileInput.files[0].name;
        fileNameSpan.textContent = fileName;
      } else {
        fileNameSpan.textContent = 'No se ha seleccionado ningún archivo';
      }
    });
  }
});

//Incomes
function buscarComprasxDia() {
  console.log("buscarComprasxDia initialized");
  $('select[name="select_day_i"]').change(function () {
    var day = $(this).val();
    console.log("Day selected: ", day);
    var month = $('#s_month_daily').val();
    console.log("Month selected: ", month);
    var year = $('#s_year_daily').val();
    console.log("Year selected: ", year);
    var provider = $('#incomesxprov').val(); // Obtener el ID del cliente seleccionado
    console.log("Provider ID: ", provider);
    $.ajax({
      url: 'daily_income.php', // Asegúrate de que la ruta sea correcta
      type: 'POST',
      data: {
        day: day,
        month: month,
        year: year,
        p_id: provider,
        SSC: true // Indica que se desea buscar por cliente si está presente
      },
      success: function (response) {
        console.log("Año: ", response.year);
        console.log("Mes: ", response.month);
        console.log("Día: ", response.day);
        console.log("ProviderID: ", response.provider);
        // Actualiza la tabla con los datos devueltos
        $('table tbody').html(response.table_data);
        // Actualizar los totales en el pie de tabla (tfoot)
        $('table tfoot .sum_importe').text(response.sum_importe);
        $('table tfoot .sum_igv').text(response.sum_igv);
        $('table tfoot .sum_total').text(response.sum_total);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud:", textStatus, errorThrown);
      }
    });
  });
  $('select[name="select_month_daily_i"]').change(function () {
    var month = $(this).val();
    console.log("Month selected: ", month);
    var day = $('#s_day').val();
    console.log("Day selected: ", day);
    var year = $('#s_year_daily').val();
    console.log("Year selected: ", year);
    var provider = $('#incomesxprov').val(); // Obtener el ID del cliente seleccionado
    console.log("Provider ID: ", provider);
    $.ajax({
      url: 'daily_income.php', // Asegúrate de que la ruta sea correcta
      type: 'POST',
      data: {
        day: day,
        month: month,
        year: year,
        p_id: provider,
        SSC: true // Indica que se desea buscar por cliente si está presente
      },
      success: function (response) {
        console.log("Año: ", response.year);
        console.log("Mes: ", response.month);
        console.log("Día: ", response.day);
        console.log("ProviderID: ", response.provider);
        // Actualiza la tabla con los datos devueltos
        $('table tbody').html(response.table_data);
        // Actualizar los totales en el pie de tabla (tfoot)
        $('table tfoot .sum_importe').text(response.sum_importe);
        $('table tfoot .sum_igv').text(response.sum_igv);
        $('table tfoot .sum_total').text(response.sum_total);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud:", textStatus, errorThrown);
      }
    });
  });
  $('select[name="select_year_daily_i"]').change(function () {
    var year = $(this).val();
    console.log("Year selected: ", year);
    var day = $('#s_day').val();
    console.log("Day selected: ", day);
    var month = $('#s_month_daily').val();
    console.log("Month selected: ", month);
    var provider = $('#incomesxprov').val(); // Obtener el ID del cliente seleccionado
    console.log("Provider ID: ", provider);
    $.ajax({
      url: 'daily_income.php', // Asegúrate de que la ruta sea correcta
      type: 'POST',
      data: {
        day: day,
        month: month,
        year: year,
        p_id: provider,
        SSC: true // Indica que se desea buscar por cliente si está presente
      },
      success: function (response) {
        console.log("Año: ", response.year);
        console.log("Mes: ", response.month);
        console.log("Día: ", response.day);
        console.log("ProviderID: ", response.provider);
        // Actualiza la tabla con los datos devueltos
        $('table tbody').html(response.table_data);
        // Actualizar los totales en el pie de tabla (tfoot)
        $('table tfoot .sum_importe').text(response.sum_importe);
        $('table tfoot .sum_igv').text(response.sum_igv);
        $('table tfoot .sum_total').text(response.sum_total);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud:", textStatus, errorThrown);
      }
    });
  });
}

function buscarComprasxMes() {
  console.log("buscarComprasxMes initialized");
  $('select[name="select_month_i"]').change(function () {
    var month = $(this).val();
    console.log("Month selected: ", month);
    var year = $('#s_year').val();
    console.log("Year selected: ", year);
    var provider = $('#incomesxprov').val(); // Obtener el ID del cliente seleccionado
    console.log("Provider ID: ", provider);
    $.ajax({
      url: 'monthly_income.php', // Asegúrate de que la ruta sea correcta
      type: 'POST',
      data: {
        month: month,
        year: year,
        p_id: provider,
        SSC: true // Indica que se desea buscar por cliente si está presente
      },
      success: function (response) {
        console.log("Año: ", response.year);
        console.log("Mes: ", response.month);
        console.log("ProviderID: ", response.provider);
        // Actualiza la tabla con los datos devueltos
        $('table tbody').html(response.table_data);
        // Actualizar los totales en el pie de tabla (tfoot)
        $('table tfoot .sum_importe').text(response.sum_importe);
        $('table tfoot .sum_igv').text(response.sum_igv);
        $('table tfoot .sum_total').text(response.sum_total);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud:", textStatus, errorThrown);
      }
    });
  });
  $('select[name="select_year_month_i"]').change(function () {
    var year = $(this).val();
    console.log("Year selected: ", year);
    var month = $('#s_month').val();
    console.log("Month selected: ", month);
    var provider = $('#incomesxprov').val(); // Obtener el ID del cliente seleccionado
    console.log("Provider ID: ", provider);
    $.ajax({
      url: 'monthly_income.php', // Asegúrate de que la ruta sea correcta
      type: 'POST',
      data: {
        month: month,
        year: year,
        p_id: provider,
        SSC: true // Indica que se desea buscar por cliente si está presente
      },
      success: function (response) {
        console.log("Año: ", response.year);
        console.log("Mes: ", response.month);
        console.log("ProviderID: ", response.provider);
        // Actualiza la tabla con los datos devueltos
        $('table tbody').html(response.table_data);
        // Actualizar los totales en el pie de tabla (tfoot)
        $('table tfoot .sum_importe').text(response.sum_importe);
        $('table tfoot .sum_igv').text(response.sum_igv);
        $('table tfoot .sum_total').text(response.sum_total);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud:", textStatus, errorThrown);
      }
    });
  });
}

function buscarComprasxAnio() {
  console.log("buscarComprasxAnio initialized");
  $('select[name="select_year_i"]').change(function () {
    var year = $(this).val(); // Usar el año actual
    var provider = $('#incomesxprov').val(); // Obtener el ID del cliente seleccionado
    console.log("Provider ID: ", provider);
    $.ajax({
      url: 'annually_income.php', // Asegúrate de que la ruta sea correcta
      type: 'POST',
      data: {
        year: year,
        p_id: provider,
        SSC: true // Indica que se desea buscar por cliente si está presente
      },
      success: function (response) {
        console.log("Año: ", response.year);
        console.log("ProviderID: ", response.provider);
        // Actualiza la tabla con los datos devueltos
        $('table tbody').html(response.table_data);
        // Actualizar los totales en el pie de tabla (tfoot)
        $('table tfoot .sum_importe').text(response.sum_importe);
        $('table tfoot .sum_igv').text(response.sum_igv);
        $('table tfoot .sum_total').text(response.sum_total);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud:", textStatus, errorThrown);
      }
    });
  });
}

function updateClock() {
  // Obtenemos el elemento span con id "clock"
  var clockElement = document.getElementById('clock');

  // Creamos un nuevo objeto de fecha
  var now = new Date();

  // Formateamos la fecha y la hora en el formato "dd/mm/yyyy h:i am/pm"
  var day = ('0' + now.getDate()).slice(-2);
  var month = ('0' + (now.getMonth() + 1)).slice(-2); // Los meses en JavaScript son 0-11
  var year = now.getFullYear();
  var hours = now.getHours();
  var minutes = ('0' + now.getMinutes()).slice(-2);
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // El valor 0 se convierte en 12

  // Formateamos el string
  var formattedTime = `${day}/${month}/${year} ${hours}:${minutes} ${ampm}`;

  // Actualizamos el contenido del span con el nuevo valor
  clockElement.innerHTML = formattedTime;
}