@extends ('layout.master')

@section ('content')


<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Detalhes do Pedido</div>
  <div class="panel-body">

  <!-- Table -->
  <table class="table table-sm">
    <thead>
      <tr>
        <th>Descrição</th>
        <th>Data do pedido</th>
        <th>Cores ou Preto e Branco</th>
        <th>Tipo de impressão</th>
        <th>Agravado?</th>
        <th>Dimensão do papel</th>
        <th>Tipo do papel</th>
        <th>Link para o ficheiro</th>
        <th>Estado do pedido</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">{{$dadosImpressao->description}}</th>
        <td>{{$dadosImpressao->created_at}}</td>
        <td><?php
        if($dadosImpressao->colored == 1)
        echo("Cores");
        else echo ("Preto e Branco");
             ?></td>
        <td><?php
        if($dadosImpressao->front_back == 1)
        echo("Frente e Verso");
        else echo ("Página Unica");
             ?></td>
        <td><?php
        if($dadosImpressao->stapled == 1)
        echo("Sim");
        else echo ("Não");
             ?></td>
        <td>{{$dadosImpressao->paper_size}}</td>
        <td>{{$dadosImpressao->paper_type}}</td>
        <td>{{$dadosImpressao->file}}</td>
        <td><?php
        if($dadosImpressao->status == 1)
        echo("Completo");
        else echo ("A processar");
             ?></td>
      </tr>
    </tbody>
  </table>
    <div class="panel-heading">Funcionário</div>
  <table class="table table-sm">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Departamento</th>
        <th>Email</th>
        <th>Telefone</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">{{$dadosUtilizador->name}}</th>
        <td>{{$departamentoUtilizador->name}}</td>
        <td>{{$dadosUtilizador->email}}</td>
        <td>{{$dadosUtilizador->phone}}</td>
      </tr>
    </tbody>
  </table>
</div>
</div>
  </div>

@endsection

@section ('footer')

@endsection
