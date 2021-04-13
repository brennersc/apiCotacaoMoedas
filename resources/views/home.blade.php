@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Faça sua Cotação</h2>
            </div>
            <div class="card-body">
                <form id="cotar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">DE</h5>
                                    <div class="form-group">
                                        <label class="card-subtitle mb-2 text-muted" for="de">Selecione a moeda</label>
                                        <select class="form-control" id="de">
                                            <option value="BRL">Real Brasileiro</option>
                                            <option value="USD">Dólar Americano</option>
                                            <option value="CAD">Dólar Canadense</option>
                                            <option value="AUD">Dólar Australiano</option>
                                            <option value="EUR">Euro</option>
                                            <option value="GBP">Libra Esterlina</option>
                                            <option value="ARS">Peso Argentino</option>
                                            <option value="JPY">Iene Japonês</option>
                                            <option value="CHF">Franco Suíço</option>
                                            <option value="CNY">Yuan Chinês</option>
                                            <option value="YLS">Novo Shekel Israelense</option>
                                            <option value="BTC">Bitcoin</option>
                                            <option value="LTC">Litecoin</option>
                                            <option value="ETH">Ethereum</option>
                                            <option value="XRP">Ripple</option>
                                            <option value="DOGE">Dogecoin</option>
                                        </select>
                                        <div id="existe" class="invalid-feedback">Moedas iguais, selecione moedas diferentes!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">PARA</h5>
                                    <div class="form-group">
                                        <label class="card-subtitle mb-2 text-muted" for="para">Selecione a moeda</label>
                                        <select class="form-control" id="para">
                                            <option value="BRL">Real Brasileiro</option>
                                            <option value="USD">Dólar Americano</option>
                                            <option value="CAD">Dólar Canadense</option>
                                            <option value="AUD">Dólar Australiano</option>
                                            <option value="EUR">Euro</option>
                                            <option value="GBP">Libra Esterlina</option>
                                            <option value="ARS">Peso Argentino</option>
                                            <option value="JPY">Iene Japonês</option>
                                            <option value="CHF">Franco Suíço</option>
                                            <option value="CNY">Yuan Chinês</option>
                                            <option value="YLS">Novo Shekel Israelense</option>
                                            <option value="BTC">Bitcoin</option>
                                            <option value="LTC">Litecoin</option>
                                            <option value="ETH">Ethereum</option>
                                            <option value="XRP">Ripple</option>
                                            <option value="DOGE">Dogecoin</option>
                                        </select>
                                        <div id="existe" class="invalid-feedback">Moedas iguais, selecione moedas diferentes!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary float-right">Submit</button>
            </div>
            </form>
        </div>

        <hr>
        <div id='load' class="alert alert-warnig alert-dismissible fade show" role="alert"
            style="margin-top: 20px; display: none;">
            <center>
                <img src="http://portal.ufvjm.edu.br/a-universidade/cursos/grade_curricular_ckan/loading.gif" alt="load"
                    height="40px" width="40px" style="margin: 10px">
                <h3 style="color: #ccc"> Aguarde ...<h3>
            </center>
        </div>

        <div id="resultado" class="card text-white bg-success" style="display: none;">
            <div class="card-header"><h2>Cotação</h2></div>
            <div id="linha" class="card-body">

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.0-alpha/Chart.js"
        integrity="sha512-IWyUmbSE/5DsDNHIOdb/5pcTrYgmusAuUmvGzah4T5Z5aSX/iE9XDi9cVfk91S2OJWpzRse8Kt+xIUWTkUJw8A=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"
        integrity="sha512-U3hGSfg6tQWADDQL2TUZwdVSVDxUt2HZ6IMEIskuBizSDzoe65K3ZwEybo0JOcEjZWtWY3OJzouhmlGop+/dBg=="
        crossorigin="anonymous"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $("#cotar").submit(function(event) {
            event.preventDefault();
            console.log(linha);

            //variaveis
            var de = $("#de").val();
            var para = $("#para").val();

            //remover e lipar div
            $('#resultado').hide();
            $('#linha>').remove();

            //verificar valores iguais
            if(de == para){                
                $('#de').addClass("is-invalid");
                $('#para').addClass("is-invalid");
                exit();
            }else{
                $('#de').removeClass("is-invalid");
                $('#para').removeClass("is-invalid");
            }

            //gif carregar
            $('#load').show();            

            $.ajax({
                type: 'get',
                url: '/cotar',
                data: {
                    de: de,
                    para: para
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#load').hide();
                    $('#resultado').show();
                    console.log(data);
                    if (data.status == 404) {
                        $('#resultado').removeClass("bg-success").addClass("bg-danger");
                        var linha = '<h5 class="card-title">ERRO</h5>' +
                            '<p class="card-text">Cotação inexistente.</p>' +
                            '<p class="card-text">' + data.message.toUpperCase() + '</p>';
                            $('#linha').append(linha);
                    } else {
                        $('#resultado').removeClass("bg-danger").addClass("bg-success");
                        var linha = '<h5 class="card-title">' + data.name + '</h5>' +
                            '<p class="card-text"> Compra ' + parseFloat(data.bid).toLocaleString(
                                'pt-br', {
                                    style: 'decimal',
                                    minimumFractionDigits: 2
                                }) + '</p>' +
                            '<p class="card-text"> Venda ' + parseFloat(data.ask).toLocaleString(
                                'pt-br', {
                                    style: 'decimal',
                                    minimumFractionDigits: 2
                                }) + '</p>' +
                            '<p class="card-text"> Variação ' + data.varBid + '%</p>' +
                            '<p class="card-text"> Porcentagem de Variação ' + data.pctChange +
                            '%</p>' +
                            '<p class="card-text"> Máximo ' + parseFloat(data.high).toLocaleString(
                                'pt-br', {
                                    style: 'decimal',
                                    minimumFractionDigits: 2
                                }) + '</p>' +
                            '<p class="card-text"> Mínimo ' + parseFloat(data.low).toLocaleString(
                                'pt-br', {
                                    style: 'decimal',
                                    minimumFractionDigits: 2
                                }) + '</p>'
                        $('#linha').append(linha);
                    }
                }
            });
        });

    </script>
@endsection
