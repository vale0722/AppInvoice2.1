<div class="form-row">
    <div class="form-group col-md-6">
        <label for="title">Título: </label>
        <input type="text" class="form-control @error('title')is-invalid @enderror" id="title" name="title" placeholder="título" value="{{ (isset($invoice->title) ? $invoice->title : old('title')) }}" required>
    </div>
    <div class="form-group col-md-6">
        <label for="code">Código: </label>
        <input type="text" class="form-control @error('code')is-invalid @enderror" id="code" name="code" placeholder="código" value="{{ (isset($invoice->code) ? $invoice->code : old('code')) }}" required>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <label>Cliente: </label>
        <select name="client" id="client" class="form-control @error('client') is-invalid @enderror">
            @foreach($clients as $client)
            <option value="{{ $client->id }}" {{ $invoice->client_id == $client->id ? 'selected' : ''}}> {{ $client->id_type . ' ' . $client->id_card . ': ' . $client->user->name . ' ' . $client->user->lastname  }} </option>
            @endforeach
        </select>
    </div>
</div>