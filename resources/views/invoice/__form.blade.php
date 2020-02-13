<div class="form-row">
    <div class="form-group col-md-6">
        <label for="title">Título: </label>
        <input type="text" class="form-control @error('title')is-invalid @enderror" id="title" name="title" placeholder="título" value="{{ $invoice->title }}" required>
    </div>
    <div class="form-group col-md-6">
        <label for="code">Código: </label>
        <input type="text" class="form-control @error('code')is-invalid @enderror" id="code" name="code" placeholder="código" value="{{ $invoice->code }}" required>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Vendedor: </label>
        <select name="company" id="company" class="form-control @error('company') is-invalid @enderror">
            @foreach($companies as $company)
            <option value="{{ $company->id }}" {{ $invoice->company_id == $company->id ? 'selected' : ''}}> {{ $company->nit . ': ' . $company->name }} </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Cliente: </label>
        <select name="client" id="client" class="form-control @error('client') is-invalid @enderror">
            @foreach($clients as $client)
            <option value="{{ $client->id }}" {{ $invoice->client_id == $client->id ? 'selected' : ''}}> {{ $client->id_type . ' ' . $client->id_card . ': ' . $client->name . ' ' . $client->last_name  }} </option>
            @endforeach
        </select>
    </div>
</div>