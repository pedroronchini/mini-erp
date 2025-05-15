<div class="mb-3">
  <label class="form-label">Código</label>
  <input type="text" name="code"
         value="{{ old('code', $coupon->code ?? '') }}"
         class="form-control" required>
</div>

<div class="mb-3">
  <label class="form-label">Tipo</label>
  <select name="type" class="form-select" required>
    <option value="fixed"   {{ (old('type', $coupon->type ?? '')=='fixed')?'selected':'' }}>Valor Fixo</option>
    <option value="percent" {{ (old('type', $coupon->type ?? '')=='percent')?'selected':'' }}>Porcentagem</option>
  </select>
</div>

<div class="mb-3">
  <label class="form-label">Valor</label>
  <input type="number" name="value" step="0.01"
         value="{{ old('value', $coupon->value ?? '') }}"
         class="form-control" required>
</div>

<div class="mb-3">
  <label class="form-label">Subtotal Mínimo</label>
  <input type="number" name="min_subtotal" step="0.01"
         value="{{ old('min_subtotal', $coupon->min_subtotal ?? '0.00') }}"
         class="form-control" required>
</div>

<div class="mb-3">
  <label class="form-label">Data de Expiração</label>
  <input type="date" name="expires_at"
         value="{{ old('expires_at', isset($coupon)? $coupon->expires_at->format('Y-m-d') : '') }}"
         class="form-control" required>
</div>
