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

  $('#btn-validate-cep').on('click', function(){
    const cep = $('#cep').val().replace(/\D/g,'');

    if(cep.length !== 8) {
      alert('Formato de CEP inválido.');
      return;
    }

    // busca no ViaCEP
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
      .then(res => res.json())
      .then(data => {
        if(data.erro){
          alert('CEP não encontrado.');
          return;
        }
        // monta endereço
        const logradouro = data.logradouro != '' && data.logradouro != null ? `${data.logradouro},` : '';
        const bairro = data.bairro != '' && data.bairro != null ? ` ${data.bairro},` : '';

        const addr = `${logradouro} ${bairro} ${data.localidade} - ${data.uf}`;
        $('#address-info').html(`<div class="alert alert-success">${addr}</div>`);
        // preenche hidden no form de checkout
        $('input[name="address"]').val(addr);
        // habilita botão de checkout
        $('#btn-checkout').prop('disabled', false);
      })
      .catch(() => {
        alert('Erro ao buscar CEP no ViaCEP.');
      });
  });
});
