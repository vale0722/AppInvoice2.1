<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name">Nombre</label>
        <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" value="{{ (isset($client->name) ? $client->name : old('name')) }}" placeholder="Nombre">
    </div>
    <div class="form-group col-md-6">
        <label for="last_name">Apellido</label>
        <input type="text" class="form-control @error('last_name')is-invalid @enderror" id="last_name" name="last_name" value="{{ (isset($client->last_name) ? $client->last_name : old('last_name')) }}" placeholder="Apellido">
    </div>
</div>
<div class="form-group">
    <label>Tipo de Documento: </label>
    <select class="form-control" name="id_type">
        @foreach($types_documents as $typeDocument)
        <option value="{{ $typeDocument->code }}" {{ isset($client->id_type) == 'true' ? ($client->id_type == $typeDocument->code ? 'selected' : ' ') : ' ' }}> {{ $typeDocument->name }} </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="id_card">Número de Documento: </label>
    <input type="text" value="{{ (isset($client->id_card) ? $client->id_card : old('id_card')) }}" class="form-control @error('id_card')is-invalid @enderror" id="id_card" name="id_card" placeholder="0">
</div>
<div class="form-group">
    <label for="email">Correo Electrónico</label>
    <input type="email" class="form-control @error('email')is-invalid @enderror" id="email" name="email" value="{{ (isset($client->email) ? $client->email : old('email')) }}" placeholder="Correo Electrónico">
</div>
<div class="form-group">
    <label for="cellphone">Celular</label>
    <input type="number" class="form-control @error('cellphone')is-invalid @enderror" id="cellphone" name="cellphone" value="{{ (isset($client->cellphone) ? $client->cellphone : old('cellphone')) }}" placeholder="0">
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        <label for="country">País</label>
        <input type="text" class="form-control @error('country')is-invalid @enderror" id="country" name="country" value="{{ (isset($client->country) ? $client->country : old('country')) }}" placeholder="País">
    </div>
    <div class="form-group col-md-4">
        <label for="city">Departamento</label>
        <input type="text" class="form-control @error('department')is-invalid @enderror" id="department" name="department" value="{{ (isset($client->department) ? $client->department : old('department')) }}" placeholder="Departamento">
    </div>
    <div class="form-group col-md-4">
        <label for="city">Ciudad</label>
        <input type="text" class="form-control @error('city')is-invalid @enderror" id="city" name="city" value="{{ (isset($client->city) ? $client->city : old('city')) }}" placeholder="Ciudad">
    </div>
</div>
<div class="form-group">
    <label for="address">Dirección</label>
    <input type="address" class="form-control @error('address')is-invalid @enderror" id="address" name="address" value="{{ (isset($client->address) ? $client->address : old('address')) }}" placeholder="Dirección">
</div>
