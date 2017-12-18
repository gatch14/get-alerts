message test pour {{ $email }} <br/>
Cryptos alerte: <br/>
@foreach($cryptos as $crypto)
    <p><strong>Niveau atteint pour: </strong></p>
    {{ $crypto->name }} {{ $crypto->choices }} au prix de {{ $crypto->price }}
@endforeach