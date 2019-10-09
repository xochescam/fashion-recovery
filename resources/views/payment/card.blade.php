<form method="POST" action="#" class="needs-validation" novalidate>
    @csrf

    @include('alerts.success')
    @include('alerts.warning')

    <div class="px-0 mb-3">
        <label for="cc-name">Nombre como aparece en la tarjeta</label>
        <input type="text" class="form-control" id="cc-name" required>
        <div class="invalid-feedback">
            Nombre como aparece en la tarjeta es obligatorio.
        </div>
    </div>
    <div class="px-0 mb-3">
        <label for="cc-number">Número de tarjeta</label>
        <input type="number" class="form-control" id="cc-number" maxlength="16" placeholder="Ej: 12012341234" required>
        <div class="invalid-feedback">
            Número de tarjeta es obligatorio.
        </div>
    </div>

    <div class="row">
        <div class="col-6 mb-3">
            <label for="cc-cvv">AAAA</label>
            <select class="form-control" name="cc-aaaa" required>
                <option value="19">2019</option>
                <option value="20">2020</option>
                <option value="21">2021</option>
                <option value="22">2022</option>
                <option value="23">2023</option>
                <option value="24">2024</option>
                <option value="25">2025</option>
            </select>
            <div class="invalid-feedback">
                El año es obligatorio.
            </div>
        </div>
        <div class="col-6 mb-3">
            <label for="cc-expiration">MM</label>
            <select class="form-control" name="cc-mm" required>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <div class="invalid-feedback">
                El mes es obligatorio.
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3 mb-3">
            <label for="cc-cvv">CVV</label>
            <input type="password" class="form-control" id="cc-cvv" maxlength="4" required>
            <div class="invalid-feedback">
                CVV es obligatorio.
            </div>
        </div>
    </div>

<button class="btn btn-fr btn-block w-25 m-auto">
    <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
    Pagar
</button>
<!--     <div class="row">
        <a href="{{ url('summary',$address->ShippingAddID) }}" class="btn btn-fr w-25 m-auto">Pagar</a>
    </div> -->
</form>	