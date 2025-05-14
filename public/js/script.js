$(() => {
  $('.edit-btn').on('click', function(){
    // 1) lê dados do botão
    const id    = $(this).data('id');
    const name  = $(this).data('name');
    const price = $(this).data('price');
    const quantity = $(this).data('quantity');

    // 2) popula o form
    $('#product-name').val(name);
    $('#product-price').val(price);
    $('#product-quantity').val(quantity)

    // 3) muda a action para update
    $('#product-form')
      .attr('action', '/products/' + id);

    // 4) troca method hidden para PUT e o texto do botão
    $('#form-method').val('PUT');
    $('#form-submit-btn').text('Atualizar');
  });
});
